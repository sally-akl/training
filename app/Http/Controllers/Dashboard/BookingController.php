<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transactions;
use App\Programme;
use Session;
use Validator;

class BookingController extends MainAdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination_num = 10;
    protected $check_permission = "manage_booking";
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    public function index(Request $request)
    {
       if($request->search)
       {
          $query = Transactions::orderBy("id","desc");
          if(!empty($request->trainer))
            $query = $query->where('trainer_id',$request->trainer);
          if(!empty($request->user))
            $query = $query->where('user_id',$request->user);
          if(!empty($request->from) && !empty($request->to))
            $query = $query->whereraw('transfer_date between "'.$request->from.'" and "'.$request->to.'"');

          $transactions = $query->paginate($this->pagination_num);
       }
       else
         $transactions = Transactions::orderBy("id","desc")->paginate($this->pagination_num);
       return view('dashboard.transaction.index',compact('transactions'));
    }

    public function getTrainerBookings($id)
    {
       $transactions = Transactions::where('trainer_id',$id)->orderBy("id","desc")->paginate($this->pagination_num);
       return view('dashboard.transaction.index',compact('transactions'));
    }

    public function sales(Request $request)
    {
      if($request->search)
      {
         $query = Transactions::selectraw("trainer_id  , sum(amount) as total");
         if(!empty($request->trainer))
           $query = $query->where('trainer_id',$request->trainer);
         if(!empty($request->from) && !empty($request->to))
           $query = $query->whereraw('transfer_date between "'.$request->from.'" and "'.$request->to.'"');

         $transactions = $query->groupby("trainer_id")->orderBy("id","desc")->get();
      }
      else
        $transactions = Transactions::selectraw("trainer_id  , sum(amount) as total")->groupby("trainer_id")->orderBy("id","desc")->get();
      return view('dashboard.transaction.sales',compact('transactions'));
    }
    public function getBookingProgrammes(Request $request , $id)
    {
       $programme = Programme::select("programm_designs.title","programm_design_calendar.start","programm_design_calendar.end")
                    ->join("programm_design_calendar","programm_design_calendar.programme_id","programm_designs.id")
                    ->where("programm_design_calendar.booking_id",$id)->where("programm_designs.type",$request->ptype)->get();
       return json_encode($programme);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $transaction = Transactions::findOrFail($id);
       return view('dashboard.transaction.show',compact('transaction'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
