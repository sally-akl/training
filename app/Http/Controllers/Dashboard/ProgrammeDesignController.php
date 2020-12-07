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
    public function index($day , $package , $user_id = 0)
    {
      $id = Auth::id();
      $user = Auth::user();
      if($user_id == 0)
      {
        $plan_data = Plan::join("programm_designs","programm_designs.id","package_user_plan.programme_design_id")
                                ->whereraw("(programm_designs.type = 'exercises' or programm_designs.type ='food supplements')")
                                ->where("package_user_plan.package_id",$package)
                                ->where("package_user_plan.day_num",$day)
                                ->paginate($this->pagination_num);

        $plan_receps = Plan::join("receips","receips.id","package_user_plan.recepe_id")
                            ->where("package_user_plan.package_id",$package)
                            ->where("package_user_plan.day_num",$day)
                            ->paginate($this->pagination_num);
      }
      else{

        $plan_data = Plan::join("programm_designs","programm_designs.id","package_user_plan.programme_design_id")
                                ->whereraw("(programm_designs.type = 'exercises' or programm_designs.type ='food supplements')")
                                ->whereraw("(package_user_plan.package_id = $package or package_user_plan.user_id=$user_id)")
                                ->where("package_user_plan.day_num",$day)
                                ->paginate($this->pagination_num);

        $plan_receps = Plan::join("receips","receips.id","package_user_plan.recepe_id")
                            ->whereraw("(package_user_plan.package_id = $package or package_user_plan.user_id=$user_id)")
                            ->where("package_user_plan.day_num",$day)
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
      $plan_section_receps = [];
      foreach($plan_receps as $recp)
      {
        if(!array_key_exists($recp->section_id,$plan_section_receps))
          $plan_section_receps[$recp->section_id] = [];

          $plan_section_receps[$recp->section_id][] = $recp;
      }
      return view('dashboard.trainerArea.plan.index',compact('plan','day','package','user_id','plan_section_receps'));
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

      $values = Session::get($type."_values");
      if($type == "excercises" || $type == "supliment" )
      {
        foreach($values as $val)
        {
          $plan = new Plan();
          $plan->day_num = $day;
          $plan->package_id = $package;
          $plan->programme_design_id = $val;
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
          $plan->section_id = $request->section_val;
          if($user != 0)
            $plan->user_id = $user;
          $plan->save();
        }

      }

      Session::forget($type."_values");
      return redirect('dashboard/trainers/programmes/design/'.$day.'/'.$package.'/'.$user)->with("message","Sucessfully Added");
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
    public function destroy($day , $package , $programme_id ,  $user_id = 0)
    {
      $query = Plan::where("day_num",$day)->where("package_id",$package);
      if($user_id != 0)
         $query = $query->where("user_id",$user_id);
      $query = $query->where("programme_design_id",$programme_id)->delete();
      return json_encode(array("sucess"=>true));
    }
    public function destroy_receps($day , $package , $recep_id , $section ,  $user_id = 0)
    {
      $query = Plan::where("day_num",$day)->where("package_id",$package);
      if($user_id != 0)
         $query = $query->where("user_id",$user_id);
      $query = $query->where("recepe_id",$recep_id)->where("section_id",$section)->delete();
      return json_encode(array("sucess"=>true));
    }





}
