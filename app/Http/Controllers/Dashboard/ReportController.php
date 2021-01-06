<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transactions;
use App\Programme;
use Session;
use Validator;

class ReportController extends MainAdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination_num = 10;
    protected $check_permission = "view_sales";
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
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
}
