<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use Session;
use Validator;

class TrainerAreaController extends Controller
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
    public function index()
    {
      $id = Auth::id();
      $user = Auth::user();
      $transactions = \App\Transactions::orderBy("id","desc")->where("trainer_id",$id)->paginate($this->pagination_num);
      $withdraws = \App\Withdrow::orderBy("id","desc")->where("trainer_id",$id)->paginate($this->pagination_num);
      $sales_with_months = \App\Transactions::selectraw("YEAR(transfer_date) as year, MONTHNAME(transfer_date) as month,sum(amount) as total , count(id) as count")->where("trainer_id",$id)->groupby("year",'month')->orderBy("id","desc")->get();
      return view('dashboard.trainerArea.show',compact('user','transactions','withdraws','sales_with_months'));
    }
    public function addwithdraw(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'amount' => ['required','regex:/^[0-9]+(\.[0-9][0-9]?)?$/'],
      ]);
      if ($validator->fails())
        return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));

      $user = Auth::user();
      $current_balance = $user->transactions()->sum("amount") - $user->withdraws()->where("is_execute",1)->sum("withdrw_amount");
      if($request->amount > $current_balance)
        return json_encode(array("sucess"=>false ,"errors"=> array("request_exceed_balance"=>"Amout is exceed current balance")));

      $withdrow = new \App\Withdrow();
      $withdrow->withdrw_num = $this->getCode();
      $withdrow->withdrw_amount =$request->amount;
      $withdrow->trainer_id = Auth::id();
      $withdrow->save();
      return json_encode(array("sucess"=>true,"sucess_text"=>trans('site.add_sucessfully')));
    }
    public function profile()
    {
      $user = Auth::user();
      return view('dashboard.trainerArea.profile',compact('user'));
    }
    private function validation(Request $request )
    {
      $validator = Validator::make($request->all(),[
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.Auth::id()],
        'password' => ['required', 'string', 'min:8'],
        'user_body'=>['required'],
        'city_id'=>'required',
        'category_id'=>'required',
        'profile_img'=> ['image','mimes:jpeg,png,jpg','max:5000'],
      ]);
      return $validator;
    }
    public function update(Request $request)
    {
      $user = Auth::user();
      $validator = $this->validation($request);
      if ($validator->fails())
        return back()->withInput()->withErrors($validator->errors());


      $user->name = $request->name;
      $user->email = $request->email;
      if(!empty($request->password))
        $user->password = Hash::make($request->password) ;
      $user->desc =  $request->user_body;
      $user->city_id =  $request->city_id;
      $user->category_id =  $request->category_id;
      $photo_name = $user->image;
      if($request->profile_img != null)
      {
        $photo = $request->profile_img;
        $photo_name = md5(rand(1,1000).time()).'.'.$photo->getClientOriginalExtension();
        $photo->move(public_path('/img/profile/'), $photo_name);
        $photo_name = "/img/profile/".$photo_name;
      }
      $user->image = $photo_name;
      $user->save();
      return redirect('dashboard/trainers/profile')->with("message","Sucessfully Updated");
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
