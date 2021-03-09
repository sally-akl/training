<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use App;
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
    public function usersubscribe_details($id)
    {
      if(Auth::user())
      {
        $transaction = \App\Transactions::find($id);
        return view('mysubscription_details',compact("transaction"));
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
    public function addticket(Request $request)
    {
      if(Auth::user())
      {
        $messages = [
          'add_subject.required' => 'Subject is required',
          'add_msg.required' => 'Message is required',

        ];
        $validator = Validator::make($request->all(), [
                 'add_subject' => 'required',
                 'add_msg'=>'required'
        ],$messages);
        if($validator->fails())
          return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));
        $client_request = new \App\ClientRequests();
        $client_request->subject = $request->add_subject;
        $client_request->msg = $request->add_msg;
        $client_request->send_date = date("Y-m-d");
        $client_request->user_id  = Auth::user()->id;
        $client_request->status  = "in progress";
        $client_request->save();
        return json_encode(array("sucess"=>true,"sucess_text"=>trans('site.add_sucessfully')));
      }
      return redirect('auth-customer');
    }
    public function save_ticket_message(Request $request)
    {
      if(Auth::user())
      {
        $validator = Validator::make($request->all(), [
               'message' => 'required',
        ]);
        if ($validator->fails())
          return redirect()->back()->withErrors($validator->errors())->withInput();

        $message = new \App\Messages();
        $message->msg = $request->message;
        $message->send_date = date("Y-m-d");
        $message->from_user = Auth::user()->id;
        $message->request_id = $request->id;
        $message->save();
        return redirect('ticket/'.$request->id."/".$request->subject);
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
      $user->phone = $request->phone;
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
    public function weekdays($week)
    {
      $end  = 7 ;
      $begin = 1;
      $end_day = $week * 7;
      $begin_day = ($end_day-7)+1;
      $days_real = [];
      for($j=$begin_day;$j<=$end_day;$j++)
      {
        $days_real[]=$j;
      }
      $html="";
      for($day = $begin;$day<=$end;$day++)
      {
        $to_day = $days_real[$day-1];
        $dd = "Day ".$day;
        $html .="<option value='".$to_day."'>".$dd."</option>";
      }
      return $html;
    }
    public function get_excercise_byday($day,$id)
    {
      $transaction = \App\Transactions::find($id);
      $plan_data = \App\Plan::join("programm_designs","programm_designs.id","package_user_plan.programme_design_id")
                              ->whereraw("(programm_designs.type = 'exercises')")
                              ->where("package_user_plan.package_id",$transaction->package->id)
                              ->where("package_user_plan.day_num",$day)
                              ->where("package_user_plan.transaction_id",$transaction->id)
                              ->get();
      return view('excercices_partial',compact('plan_data'));
    }
    public function get_suppliment_byday($day,$id)
    {
      $transaction = \App\Transactions::find($id);
      $plan_data = \App\Plan::join("programm_designs","programm_designs.id","package_user_plan.programme_design_id")
                              ->whereraw("(programm_designs.type = 'food supplements')")
                              ->where("package_user_plan.package_id",$transaction->package->id)
                              ->where("package_user_plan.day_num",$day)
                              ->where("package_user_plan.transaction_id",$transaction->id)
                              ->get();
      return view('suppliment_partial',compact('plan_data'));
    }
    public function get_food_byday($day,$id)
    {
      $transaction = \App\Transactions::find($id);
      $plan_receps = \App\Plan::join("receips","receips.id","package_user_plan.recepe_id")
                         ->where("package_user_plan.package_id",$transaction->package->id)
                         ->where("package_user_plan.day_num",$day)
                         ->where("package_user_plan.transaction_id",$transaction->id)
                         ->get();
      return view('food_partial',compact('plan_receps'));

    }
    public function checkout($name , $id)
    {
      $package = \App\Package::find($id);
      return view('checkout',compact('package'));
    }
    public function payment($type,$id)
    {
      if(Auth::user())
      {
        $package = \App\Package::find($id);
        $exist_trans = \App\Transactions::where("user_id",Auth::user()->id)
                                   ->where("trainer_id",$package->user->id)
                                   ->where("package_id",$id)
                                   ->where("transfer_payment_type",$type)
                                   ->first();

        if($type == "free")
        {
          if($package !== null)
          {
            if(isset($exist_trans->transfer_date))
            {
              $expire_date = date('Y-m-d', strtotime(date('Y-m-d',strtotime($exist_trans->transfer_date)). ' + '.$package->package_duration.' weeks'));
              if(date('Y-m-d',strtotime($exist_trans->transfer_date)) <= $expire_date)
              {
                return redirect()->back()->withErrors(array("errors"=>array("exist"=>"You already Subscribe to this package")));
              }
              else{
                $transaction = new \App\Transactions();
                $transaction->transaction_num = $this->getCode(10);
                $transaction->user_id = Auth::user()->id;
                $transaction->trainer_id  =$package->user->id;
                $transaction->package_id   =$id;
                $transaction->transfer_date = date("Y-m-d");
                $transaction->is_payable = 1;
                $transaction->transfer_payment_type = $type;
                $transaction->paymentToken = "none";
                $transaction->paymentId = "none";
                $transaction->amount = 0;
                $transaction->save();
              }
            }
            else{
              $transaction = new \App\Transactions();
              $transaction->transaction_num = $this->getCode(10);
              $transaction->user_id = Auth::user()->id;
              $transaction->trainer_id  =$package->user->id;
              $transaction->package_id   =$id;
              $transaction->transfer_date = date("Y-m-d");
              $transaction->is_payable = 1;
              $transaction->transfer_payment_type = $type;
              $transaction->paymentToken = "none";
              $transaction->paymentId = "none";
              $transaction->amount = 0;
              $transaction->save();
            }
          }
          else{
              return redirect()->back()->withErrors(array("errors"=>array("exist"=>"Wrong package")));
          }
        }
        else{
          if($type == "visa" || $type == "mastercard")
          {
              return redirect('strip/pay/'.$type."/".$id);
          }
        }
      //  return redirect('my-subscription');
      return redirect('subscribe/questions');
      }
      return redirect('auth-customer');
    }
    public function subscribequestions($id)
    {
      $questions = \App\Questions::all();
      return view('subscribequestions',compact('questions','id'));
    }
    public function complete_subscribequestions(Request $request)
    {
      $questions = \App\Questions::all();
      foreach($questions as $question)
      {
        $answers = new \App\QuestionsAnswers();
        $answers->question_id = $question->id;
        $qid = "qu_".$question->id;
        $answers->answer = $request->$qid;
        $answers->transaction_id = $request->trans;
        $answers->save();
      }
      return redirect('my-subscription');
    }
    public function save_image_chat(Request $request)
    {
      $sender = $request->sender;
      $receiver = $request->receiver;
      $booking = $request->booking;
      $message = $request->msg;

      $photo = $request->image;
      $photo_name = md5(rand(1,1000).time()).'.'.$photo->getClientOriginalExtension();
      $photo->move(public_path('/img/profile/'), $photo_name);

      $chat = new \App\Chat();
      $chat->msg = "/img/profile/".$photo_name;
      $chat->from_user  = $sender;
      $chat->to_user = $receiver;
      $chat->booking_id  = $booking;
      $chat->msg_type = "image";
      $chat->save();

      $notification = new \App\Notifications();
      $notification->msg = $chat->msg;
      $notification->user_id =$receiver;
      $notification->send_from =$sender;
      $notification->send_date = date("Y-m-d");
      $notification->is_send = 1;
      $notification->save();

      return "/img/profile/".$photo_name;
    }
    public function complete_excercise(Request $request)
    {
      if(Auth::user())
      {
        $exist = \App\CompleteExcercies::where("programme_id",$request->pr_id)->where("user_id",Auth::user()->id)->where("day_num",$request->day_num)->first();
        if(!isset($exist->programme_id))
        {
          $complete = new \App\CompleteExcercies();
          $complete->programme_id = $request->pr_id;
          $complete->day_num = $request->day_num;
          $complete->user_id = Auth::user()->id;
          $complete->save();
        }

        return json_encode(array("sucess"=>true));
      }
    }

    public function lang($lang)
    {
      App::setLocale($lang);
      session()->put('locale', $lang);
      return redirect()->back();
    }

    private  function getCode($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
