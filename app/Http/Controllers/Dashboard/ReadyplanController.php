<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\ReadyPlan;
use Session;
use Validator;

class ReadyplanController extends MainAdminController
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
       $readyplans = ReadyPlan::orderBy("id","desc")->paginate($this->pagination_num);
       return view('dashboard.ready.index',compact('readyplans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.ready.create');
    }

    public function get_excercise_div(Request $request)
    {
      return view('dashboard.ready.excercise_part',array("data"=>$request));
    }
    public function get_supplement_div(Request $request)
    {
      return view('dashboard.ready.suppliment_part',array("data"=>$request));
    }
    public function get_meals_div(Request $request)
    {
      return view('dashboard.ready.meals_part',array("data"=>$request));
    }

    public function addprogramme($type , $id)
    {

      if(Session::get($type."_values_ready"))
      {
         $values = Session::get($type."_values_ready");
         if(!in_array($id, $values))
         {
           $values[] = $id;
           Session::put($type."_values_ready", $values);
         }
      }
      else {
         $values = array();
         $values[] = $id;
         Session::put($type."_values_ready", $values);
      }
      return "ok";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'ready_type' => ['required']
      ]);
      if ($validator->fails())
        return back()->withInput()->withErrors($validator->errors());
      $ready_type = $request->ready_type;
      if($ready_type == "exercises")
        $type = "excercises";
      if($ready_type == "food supplements")
        $type = "supliment";
      if($ready_type == "dietary meals")
        $type = "recepies";
      $values = Session::get($type."_values_ready");
      if($type == "excercises" || $type == "supliment" )
      {
        foreach($values as $val)
        {
          $plan = new ReadyPlan();
          $plan->day_num = $request->select_day;
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
          $plan->day_num = $request->select_day;
          $plan->recepe_id = $val;
          $plan->save();
        }
      }

      Session::forget($type."_values_ready");
      return redirect('dashboard/readyplan')->with("message","Sucessfully Added");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $filter = ReadyPlan::findOrFail($id);
      $filter->delete();
      Session::put('message', trans('site.delete_sucessfully'));
      return json_encode(array("sucess"=>true));
    }
}
