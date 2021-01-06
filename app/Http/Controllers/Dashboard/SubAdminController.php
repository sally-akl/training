<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\UserRoles;
use Session;
use Validator;

class SubAdminController extends MainAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination_num = 10;
    protected $role_num = 1;
    protected $check_permission = "manage_subadmn";
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }
    public function index()
    {
       $customers = User::where("role_id",$this->role_num)->where("id","!=",1)->orderBy("id","desc")->paginate($this->pagination_num);
       return view('dashboard.subadmin.index',compact('customers'));
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
      ]);
      if ($validator->fails())
        return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));
      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = Hash::make($request->password) ;
      $user->role_id = $this->role_num;
      $user->save();
      if(count($request->permssions))
      {
        $perms = $request->permssions;
        foreach($perms as $perm)
        {
          $user_role = new UserRoles();
          $user_role->user_id = $user->id;
          $user_role->permssion_name = $perm;
          $user_role->save();

        }
      }
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
        //
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
      $validator = Validator::make($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
      ]);
      if ($validator->fails())
        return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));
      $user = User::findOrFail($id);
      $user->name = $request->name;
      $user->email = $request->email;
      $user->role_id = $this->role_num;
      $user->save();
      UserRoles::where("user_id",$user->id)->delete();
      if(count($request->permssions))
      {
        $perms = $request->permssions;
        foreach($perms as $perm)
        {
          $user_role = new UserRoles();
          $user_role->user_id = $user->id;
          $user_role->permssion_name = $perm;
          $user_role->save();

        }
      }
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
