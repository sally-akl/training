<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.home');
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
      return "ok";
    }

}
