<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Transactions;
use Session;
use Validator;

class UserAreaController extends Controller
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
    public function profile()
    {
      $user = Auth::user();
      return view('dashboard.trainerArea.profile',compact('user'));
    }

    public function subscrips()
    {
      $id = Auth::id();
      $subscrips = Transactions::where("user_id",$id)->paginate($this->pagination_num);
      return view('dashboard.clientArea.subscripe',compact('subscrips'));
    }
    public function subscrip_details($id)
    {
      $transaction = Transactions::findOrFail($id);
      return view('dashboard.clientArea.subscrip_details',compact('transaction'));
    }
}
