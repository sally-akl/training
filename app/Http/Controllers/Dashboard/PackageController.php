<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Package;
use Session;
use Validator;

class PackageController extends Controller
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
       $packages = Package::orderBy("id","desc")->paginate($this->pagination_num);
       return view('dashboard.package.index',compact('packages'));
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
             'package_name' => 'required|max:250',
             'package_duration' => 'required',
             'package_duration_type' => 'required',
             'package_price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
             'package_type'=>'required',
             'package_status'=>'required',
             'pack_desc'=>'required',
             'pack_question'=>'required',
      ]);
      if ($validator->fails())
        return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));
      $package = new Package();
      $package->package_name = $request->package_name;
      $package->package_desc = $request->pack_desc;
      $package->package_duration_type = $request->package_duration_type;
      $package->package_duration = $request->package_duration;
      $package->package_price = $request->package_price;
      $package->package_questionaire = $request->pack_question;
      $package->package_type = $request->package_type;
      $package->package_status = $request->package_status;
      $package->user_id = Auth::id();
      $package->save();
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
      $package = Package::findOrFail($id);
      return view('dashboard.package.show',compact('package'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $package = Package::findOrFail($id);
      return   $package;
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
        $package = Package::findOrFail($id);
        if(isset($request->admin_accept))
        {
          $package->accepted_from_admin = $request->admin_accept;
          $package->save();
          return redirect('/dashboard/package')->with("message",trans('site.update_sucessfully'));
        }
        else{
          $validator = Validator::make($request->all(), [
                 'package_name' => 'required|max:250',
                 'package_duration' => 'required',
                 'package_duration_type' => 'required',
                 'package_price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
                 'package_type'=>'required',
                 'package_status'=>'required',
                 'pack_desc'=>'required',
                 'pack_question'=>'required',
          ]);
          if ($validator->fails())
            return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));
          $package->package_name = $request->package_name;
          $package->package_desc = $request->pack_desc;
          $package->package_duration_type = $request->package_duration_type;
          $package->package_duration = $request->package_duration;
          $package->package_price = $request->package_price;
          $package->package_questionaire = $request->pack_question;
          $package->package_type = $request->package_type;
          $package->package_status = $request->package_status;
          $package->save();
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
        $package = Package::findOrFail($id);
        $package->delete();
        Session::put('message', trans('site.delete_sucessfully'));
        return json_encode(array("sucess"=>true));
    }
}
