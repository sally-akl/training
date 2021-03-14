<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\ReadyPlan;
use App\ReadyPlanPackage;
use Session;
use Validator;

class ReadyplanpackageController extends MainAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination_num = 10;
    protected $role_num = 1;
    protected $check_permission = "manage_ready_plan";
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }
    public function index()
    {
      $readyplanspackages = ReadyPlanPackage::orderBy("id","desc")->paginate($this->pagination_num);
      return view('dashboard.ready.packages',compact('readyplanspackages'));
    }

    public function weeks($id)
    {
      return view('dashboard.ready.weeks',compact('id'));
    }
    public function days($week,$transaction_num)
    {
      return view('dashboard.ready.prograame_design_days',compact('week','transaction_num'));
    }
    public function design($day ,$week, $transaction_num ,Request $request)
    {
      $plan_data = ReadyPlan::selectraw("ready_plan.* , ready_plan.id as plan_id")->join("programm_designs","programm_designs.id","ready_plan.programme_design_id")
                              ->whereraw("(programm_designs.type = 'exercises' or programm_designs.type ='food supplements')")
                              ->where("ready_plan.day_num",$day)
                              ->where("ready_plan.package_id",$transaction_num)
                              ->paginate($this->pagination_num);

      $plan_receps = ReadyPlan::selectraw("ready_plan.* , ready_plan.id as plan_id")->join("receips","receips.id","ready_plan.recepe_id")
                          ->where("ready_plan.day_num",$day)
                          ->where("ready_plan.package_id",$transaction_num)
                          ->paginate($this->pagination_num);

      $plan = [];
      foreach($plan_data as $p)
      {
        if(!array_key_exists("excercises",$plan))
          $plan["excercises"] = [];
        if(!array_key_exists("supliment",$plan))
          $plan["supliment"] = [];
        if($p->programme->type == "exercises")
          $plan["excercises"][] = $p;
        if($p->programme->type == "food supplements")
          $plan["supliment"][] = $p;
      }
      $plan_section_receps = $plan_receps;
      $programme_search="";
      if(!empty($request->p_name))
        $programme_search = $request->p_name;
      $suplement_search="";
      if(!empty($request->food_supliment_name))
        $suplement_search = $request->food_supliment_name;
      $recepie_search="";
      if(!empty($request->recepie_name))
        $recepie_search = $request->recepie_name;

      $t="excercises";
      if(isset($request->type))
         $t = $request->type;

      return view('dashboard.ready.plan',compact('plan','day','plan_section_receps','transaction_num','week','programme_search','suplement_search','recepie_search','t'));
    }
    public function createplan(Request $request)
    {
      $type = $request->programme_type;
      $day = $request->day_num;
      $package = $request->package_num;
      $user = $request->user_num;
      $transaction_num = $request->transaction;
      $week = $request->week;

      $values = Session::get($type."_readyplanall_values");
      if($type == "excercises" || $type == "supliment" )
      {
        foreach($values as $val)
        {
          $plan = new ReadyPlan();
          $plan->day_num = $day;
          $plan->package_id = $transaction_num;
          $plan->programme_design_id = $val;
          if($type == "excercises")
          {
            $set_number_is = "selected_text_".$val;
            $plan->set_num = $request->$set_number_is;
          }
          if($type == "supliment")
          {
            $serving_number_is = "selected_text_serving_".$val;
            $plan->suplement_serving_size = $request->$serving_number_is;
          }
          $plan->save();
        }
      }
      else if($type == "recepies")
      {
        foreach($values as $val)
        {
          $plan = new ReadyPlan();
          $plan->day_num = $day;
          $plan->package_id = $transaction_num;
          $plan->recepe_id = $val;
          $plan->save();
        }

      }

      Session::forget($type."_readyplanall_values");
      return redirect('dashboard/readypackage/programmes/design/'.$day.'/'.$week.'/'.$transaction_num."?type=".$type)->with("message","Sucessfully Added");
    }
    public function addprogramme($type , $id)
    {

      if(Session::get($type."_readyplanall_values"))
      {
         $values = Session::get($type."_readyplanall_values");
         if(!in_array($id, $values))
         {
           $values[] = $id;
           Session::put($type."_readyplanall_values", $values);
         }
      }
      else {
         $values = array();
         $values[] = $id;
         Session::put($type."_readyplanall_values", $values);
      }
      return "ok";
    }
    public function delete($id)
    {
      $filter = ReadyPlan::findOrFail($id);
      $filter->delete();
      Session::put('message', trans('site.delete_sucessfully'));
      return json_encode(array("sucess"=>true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }


    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'title' => ['required', 'string', 'max:250'],
          'title_ar' => ['required', 'string', 'max:250'],
          'weeks' => ['required'],
      ]);
      if ($validator->fails())
        return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));
      $filter = new ReadyPlanPackage();
      $filter->title = $request->title;
      $filter->title_ar = $request->title_ar;
      $filter->weeks = $request->weeks;
      $filter->save();

      return json_encode(array("sucess"=>true,"sucess_text"=>trans('site.add_sucessfully')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $filter = ReadyPlanPackage::findOrFail($id);
        return $filter;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
        'title' => ['required', 'string', 'max:250'],
        'title_ar' => ['required', 'string', 'max:250'],
        'weeks' => ['required'],
      ]);
      if ($validator->fails())
        return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));
      $filter = ReadyPlanPackage::findOrFail($id);
      $filter->title = $request->title;
      $filter->title_ar = $request->title_ar;
      $filter->weeks = $request->weeks;
      $filter->save();
      return json_encode(array("sucess"=>true,"sucess_text"=>trans('site.update_sucessfully')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $filter = ReadyPlanPackage::findOrFail($id);
      $filter->delete();
      Session::put('message', trans('site.delete_sucessfully'));
      return json_encode(array("sucess"=>true));
    }

}
