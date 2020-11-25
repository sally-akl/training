<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\ClientRequests;
use App\Messages;
use App\User;
use Session;
use Validator;
class SupportController extends Controller
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
       $client_requests = ClientRequests::orderBy("id","desc")->paginate($this->pagination_num);
       return view('dashboard.clientrequests.index',compact('client_requests'));
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $client_request = ClientRequests::findOrFail($id);
      return view('dashboard.clientrequests.show',array("messages"=>$client_request->messages , "crequest"=> $client_request,  "id"=>$id , "client"=>User::findOrFail($client_request->user_id)));
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
        $client_request = ClientRequests::findOrFail($id);
        $client_request->status = $request->status;
        $client_request->save();
        return redirect('/dashboard/support')->with("message",trans('site.update_sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $client_request = ClientRequests::findOrFail($id);
      $client_request->delete();
      Session::put('message', trans('site.delete_sucessfully'));
      return json_encode(array("sucess"=>true));
    }

    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
               'user_body' => 'required',
        ]);
        if ($validator->fails())
          return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));
        $message = new Messages();
        $message->msg = $request->user_body;
        $message->send_date = date("Y-m-d");
        $message->from_user = Auth::user()->id;
        $message->request_id = $request->crequest;
        $message->save();
        return json_encode(array("sucess"=>true,"sucess_text"=>trans('site.add_sucessfully')));
    }
}
