<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function trainer_details($id , $details)
    {
      $user = \App\User::findOrFail($id);
      return view('trainer_details',compact("user"));
    }
    public function login()
    {
      return view('login');
    }
    public function sign_in(Request $request)
    {
      $messages = [
          'email.required' => 'Email is required',
          'password.required' => 'Password is required',
      ];
      $validator = Validator::make($request->all(), [
             'password' => 'required',
             'email' => 'required|email',
      ],$messages);
      if ($validator->fails())
        return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));

      if (\Auth::attempt([
         'email' => $request->email,
         'password' => $request->password])
        ){
          return json_encode(array("sucess"=>true));
        }
       return json_encode(array("errors"=>array("not_login"=>"Email address or password not correct")));

    }
    public function usersubscribe()
    {
      if(Auth::user())
      {
        $user_id = Auth::user()->id;
        $bookings = \App\Transactions::orderBy("id","desc")->where('user_id',$user_id)->get();
        return view('mysubscription',compact("bookings"));

      }

      return redirect('auth-customer');
    }
}
