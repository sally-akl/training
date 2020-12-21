<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Transactions;
use App\Plan;
use App\Programme;
use App\Receips;
use Session;
use Validator;

class ProgrammeDesignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination_num = 10;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function days($week,$transaction_num,$package,$user_id)
    {
      return view('dashboard.trainerArea.prograame_design_days',compact('week','transaction_num','package','user_id'));
    }
    public function index($day ,$week, $transaction_num ,  $package , $user_id = 0,Request $request)
    {
      $id = Auth::id();
      $user = Auth::user();
      if($user_id == 0)
      {
        $plan_data = Plan::join("programm_designs","programm_designs.id","package_user_plan.programme_design_id")
                                ->whereraw("(programm_designs.type = 'exercises' or programm_designs.type ='food supplements')")
                                ->where("package_user_plan.package_id",$package)
                                ->where("package_user_plan.day_num",$day)
                                ->where("package_user_plan.transaction_id",$transaction_num)
                                ->paginate($this->pagination_num);

        $plan_receps = Plan::join("receips","receips.id","package_user_plan.recepe_id")
                            ->where("package_user_plan.package_id",$package)
                            ->where("package_user_plan.day_num",$day)
                            ->where("package_user_plan.transaction_id",$transaction_num)
                            ->paginate($this->pagination_num);
      }
      else{

        $plan_data = Plan::selectraw("package_user_plan.* , package_user_plan.id as plan_id")->join("programm_designs","programm_designs.id","package_user_plan.programme_design_id")
                                ->whereraw("(programm_designs.type = 'exercises' or programm_designs.type ='food supplements')")
                                ->whereraw("(package_user_plan.package_id = $package or package_user_plan.user_id=$user_id)")
                                ->where("package_user_plan.day_num",$day)
                                ->where("package_user_plan.transaction_id",$transaction_num)
                                ->paginate($this->pagination_num);

        $plan_receps = Plan::selectraw("package_user_plan.* , package_user_plan.id as plan_id")->join("receips","receips.id","package_user_plan.recepe_id")
                            ->whereraw("(package_user_plan.package_id = $package or package_user_plan.user_id=$user_id)")
                            ->where("package_user_plan.day_num",$day)
                            ->where("package_user_plan.transaction_id",$transaction_num)
                            ->paginate($this->pagination_num);

      }
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


      return view('dashboard.trainerArea.plan.index',compact('plan','day','package','user_id','plan_section_receps','transaction_num','week','programme_search','suplement_search','recepie_search'));
    }

    public function addprogramme($type , $id)
    {

      if(Session::get($type."_values"))
      {
         $values = Session::get($type."_values");
         if(!in_array($id, $values))
         {
           $values[] = $id;
           Session::put($type."_values", $values);
         }
      }
      else {
         $values = array();
         $values[] = $id;
         Session::put($type."_values", $values);
      }
      return "ok";
    }
    public function createplan(Request $request)
    {
      $type = $request->programme_type;
      $day = $request->day_num;
      $package = $request->package_num;
      $user = $request->user_num;
      $transaction_num = $request->transaction;
      $week = $request->week;

      $values = Session::get($type."_values");
      if($type == "excercises" || $type == "supliment" )
      {
        foreach($values as $val)
        {
          $plan = new Plan();
          $plan->day_num = $day;
          $plan->package_id = $package;
          $plan->programme_design_id = $val;
          $plan->transaction_id = $transaction_num;
          if($user != 0)
            $plan->user_id = $user;
          $plan->save();
        }
      }
      else if($type == "recepies")
      {
        foreach($values as $val)
        {
          $plan = new Plan();
          $plan->day_num = $day;
          $plan->package_id = $package;
          $plan->recepe_id = $val;
          $plan->transaction_id = $transaction_num;
        //  $plan->section_id = $request->section_val;
          if($user != 0)
            $plan->user_id = $user;
          $plan->save();
        }

      }

      Session::forget($type."_values");
      return redirect('dashboard/trainers/programmes/design/'.$day.'/'.$week.'/'.$transaction_num.'/'.$package.'/'.$user)->with("message","Sucessfully Added");
    }
    public function show($id)
    {
      $programme = Programme::findOrFail($id);
      $programme_integrate = \App\ProgrammeIntegrent::where("programme_id",$programme->id)->get();
      return view('dashboard.trainerArea.plan.show',compact('programme','programme_integrate'));
    }
    public function show_receps($id)
    {
       $recepe = Receips::findOrFail($id);
       $recepe_integrate = \App\RecepiesIntegrate::where("recep_id",$recepe->id)->get();
       return view('dashboard.trainerArea.plan.show_recepe',compact('recepe','recepe_integrate'));

    }
    public function destroy($id)
    {
      $plan = Plan::find($id);
      $plan->delete();
      return json_encode(array("sucess"=>true));
    }

    public function copy(Request $request)
    {
      $copy_to = $request->to_transaction;
      $transaction_copy_num = $request->transaction_copy_num;
      $copy_type = $request->copy_type;
      $transaction = \App\Transactions::find($transaction_copy_num);
      $transaction_to = \App\Transactions::find($copy_to);
      $plans = $transaction->plan;
      foreach($plans as $plan)
      {
        $p = \App\Plan::firstOrNew(['day_num' => $plan->day_num ,
                                    'package_id' => $transaction_to->package_id  ,
                                    'user_id'=> $transaction_to->user_id ,
                                    'programme_design_id'=>$plan->programme_design_id,
                                    'recepe_id'=>$plan->recepe_id,
                                    'transaction_id'=>$copy_to,
             ]);
        $p->save();
      }
      return json_encode(array("sucess"=>true,"sucess_text"=>trans('site.add_sucessfully')));
    }






}
