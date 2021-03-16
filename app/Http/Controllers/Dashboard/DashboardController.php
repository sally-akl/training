<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Events\NotifyChatMessage;

class DashboardController extends MainAdminController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $check_permission = "manage_dashboard";
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      if(Auth::user()->role->name=="admin")
        return view('dashboard.home');
      else if(Auth::user()->role->name=="Trainer")
        return view('dashboard.traner_dashboard');
    }
    public function chat(Request $request)
    {
      $sender = $request->sender;
      $receiver = $request->receiver;
      $booking = $request->booking;
      $message = $request->msg;
      $chat = new \App\Chat();
      $chat->msg = $message;
      $chat->from_user  = $sender;
      $chat->to_user = $receiver;
      $chat->booking_id  = $booking;
      $chat->save();

      $notification = new \App\Notifications();
      $notification->msg = $request->msg;
      $notification->user_id =$receiver;
      $notification->send_from =$sender;
      $notification->send_date = date("Y-m-d");
      $notification->is_send = 1;
      $notification->save();

      event(new NotifyChatMessage($request->booking));
      return "ok";
    }


}
