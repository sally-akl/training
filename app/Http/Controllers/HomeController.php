<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
         'password' => $request->password], false, true)
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
    public function tickets()
    {
      if(Auth::user())
      {
        $user_id = Auth::user()->id;
        $pending_tickets = \App\ClientRequests::orderBy("id","desc")->orderby("send_date","desc")->where('user_id',$user_id)->whereraw('status="pending" or status="in progress"')->get();
        $solved_tickets = \App\ClientRequests::orderBy("id","desc")->orderby("send_date","desc")->where('user_id',$user_id)->whereraw('status="resolved"')->get();
        return view('tickets',compact("pending_tickets","solved_tickets"));

      }

      return redirect('auth-customer');
    }
    public function ticket_details($id,$subject)
    {
      if(Auth::user())
      {
        $ticket = \App\ClientRequests::find($id);
        return view('ticket_details',compact("ticket"));
      }
      return redirect('auth-customer');
    }
    public function sign_out(Request $request)
    {
      if(\Auth::check())
      {
        \Auth::logout();
        $request->session()->invalidate();
      }
      return  redirect('/');
    }
    public function signup()
    {
      return view('signup');
    }
    public function submit_signup(Request $request)
    {

      $validator = Validator::make($request->all(), [
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'password' => ['required', 'string', 'min:8', 'confirmed'],
      ]);
      if ($validator->fails())
        return redirect()->back()->withErrors($validator->errors())->withInput();

      $user = new \App\User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->role_id = 3;
      $user->save();
      auth()->login($user);
      return  redirect('/');
    }
    public function profile()
    {
      return view('profile');
    }
    public function edit_profile(Request $request)
    {
       if(Auth::user())
       {
         $validator = Validator::make($request->all(), [
             'name' => ['required', 'string', 'max:255'],
             'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.Auth::user()->id],
             'password' => ['string', 'min:8', 'confirmed'],
             'profile_img'=> ['image','mimes:jpeg,png,jpg','max:5000'],
         ]);

         if(isset($request->profile_img))
         {
           $photo = $request->profile_img;
           $photo_name = md5(rand(1,1000).time()).'.'.$photo->getClientOriginalExtension();
           $photo->move(public_path('/img/profile/'), $photo_name);
         }



         $user = \App\User::find(Auth::user()->id);
         $user->name = $request->name;
         $user->email = $request->email;
         if(!empty($request->password))
           $user->password = Hash::make($request->password);
         if(isset($request->profile_img))
           $user->image = "/img/profile/".$photo_name;
         $user->save();
         return  redirect('/');
       }
       return  redirect('/auth-customer');
    }
}
