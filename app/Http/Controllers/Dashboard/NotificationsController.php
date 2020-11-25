<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications;
use App\User;
use Session;
use Validator;

class NotificationsController extends Controller
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
       $notifications = Notifications::orderBy("id","desc")->paginate($this->pagination_num);
       return view('dashboard.notify.index',compact('notifications'));
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
             'user' => 'required',
             'notify_msg' => 'required',
      ]);
      if ($validator->fails())
        return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));

      if($request->user == 0)
      {
         $users = User::where("role_id",3)->get();
         foreach($users as $user)
         {
           $notification = new Notifications();
           $notification->msg = $request->notify_msg;
           $notification->user_id = $user->id;
           $notification->save();
         }
      }
      else
      {
        $notification = new Notifications();
        $notification->msg = $request->notify_msg;
        $notification->user_id = $request->user;
        $notification->save();
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $notify = Notifications::findOrFail($id);
      $notify->delete();
      Session::put('message', trans('site.delete_sucessfully'));
      return json_encode(array("sucess"=>true));
    }
    public function senfNotify($id)
    {
      $notify = Notifications::findOrFail($id);
      $notify->send_date = date("Y-m-d");
      $notify->is_send = 1;
      $notify->save();
      return redirect('/dashboard/notifications')->with("message",trans('site.send_sucessfully'));
    }
}
