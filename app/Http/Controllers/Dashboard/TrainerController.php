<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use Session;
use Validator;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination_num = 10;
    protected $role_num = 2;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
       $customers = User::where("role_id",$this->role_num)->orderBy("id","desc")->paginate($this->pagination_num);
       return view('dashboard.trainer.index',compact('customers'));
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
      $validator = Validator::make($request->all(), [
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'password' => ['required', 'string', 'min:8', 'confirmed'],
          'user_body'=>['required'],
          'profile_img'=> ['required','image','mimes:jpeg,png,jpg','max:5000'],
          'city_id'=>'required',
          'category_id'=>'required',
      ]);
      if ($validator->fails())
        return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));

      $photo = $request->profile_img;
      $photo_name = md5(rand(1,1000).time()).'.'.$photo->getClientOriginalExtension();
      $photo->move(public_path('/img/profile/'), $photo_name);

      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = Hash::make($request->password) ;
      $user->role_id = $this->role_num;
      $user->image = "/img/profile/".$photo_name;
      $user->desc =  $request->user_body;
      $user->city_id =  $request->city_id;
      $user->category_id =  $request->category_id;
      $user->name_ar =  $request->name_ar;
      $user->description_ar =  $request->description_ar;
      $user->city_ar =  $request->city_ar;
      $user->save();
      return json_encode(array("sucess"=>true,"sucess_text"=>trans('site.add_sucessfully')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = User::findOrFail($id);
      $transactions = \App\Transactions::orderBy("id","desc")->where("trainer_id",$id)->paginate($this->pagination_num);
      $withdraws = \App\Withdrow::orderBy("id","desc")->where("trainer_id",$id)->paginate($this->pagination_num);
      $sales_with_months = \App\Transactions::selectraw("YEAR(transfer_date) as year, MONTHNAME(transfer_date) as month,sum(amount) as total , count(id) as count")->where("trainer_id",$id)->groupby("year",'month')->orderBy("id","desc")->get();
      return view('dashboard.trainer.show',compact('user','transactions','withdraws','sales_with_months'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return $user;
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
      $user = User::findOrFail($id);
      $validator = Validator::make($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
        'user_body'=>['required'],
        'city_id'=>'required',
        'category_id'=>'required',
      ]);
      if ($validator->fails())
        return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));
      $user->name = $request->name;
      $user->email = $request->email;
      $user->role_id = $this->role_num;
      $user->desc =  $request->user_body;
      $user->city_id =  $request->city_id;
      $user->category_id =  $request->category_id;
      $user->name_ar =  $request->name_ar;
      $user->description_ar =  $request->description_ar;
      $user->city_ar =  $request->city_ar;
      if(!empty($request->password))
        $user->password = Hash::make($request->password) ;
      $user->save();
      return json_encode(array("sucess"=>true,"sucess_text"=>trans('site.update_sucessfully')));
    }

    public function uploadImage(Request $request, $id)
    {
      $user = User::findOrFail($id);
      $validator = Validator::make($request->all(), [
        'profile_img'=> ['image','mimes:jpeg,png,jpg','max:5000'],
      ]);
      if ($validator->fails())
        return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));
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
      return json_encode(array("sucess"=>true,"sucess_text"=>trans('site.update_sucessfully')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::findOrFail($id);
      $user->delete();
      Session::put('message', trans('site.delete_sucessfully'));
      return json_encode(array("sucess"=>true));
    }
}
