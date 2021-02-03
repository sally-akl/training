<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slider;
use Session;
use Validator;

class SliderController extends MainAdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination_num = 10;
    protected $check_permission = "manage_cat";
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    public function index()
    {
       $categories = Slider::orderBy("id","desc")->paginate($this->pagination_num);
       return view('dashboard.slider.index',compact('categories'));
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
             'image'=> ['required','image','mimes:jpeg,png,jpg','max:5000'],
      ]);
      if ($validator->fails())
        return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));

      $photo = $request->image;
      $photo_name = md5(rand(1,1000).time()).'.'.$photo->getClientOriginalExtension();
      $photo->move(public_path('/img/profile/'), $photo_name);

      $category = new Slider();
      $category->image = "/img/profile/".$photo_name;
      $category->save();
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
        $category = Slider::findOrFail($id);
        return $category;
    }




    public function uploadImage(Request $request, $id)
    {
      $category = Slider::findOrFail($id);
      $validator = Validator::make($request->all(), [
        'image'=> ['image','mimes:jpeg,png,jpg','max:5000'],
      ]);
      if ($validator->fails())
        return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));
      $photo_name = $category->image;
      if($request->image != null)
      {
        $photo = $request->image;
        $photo_name = md5(rand(1,1000).time()).'.'.$photo->getClientOriginalExtension();
        $photo->move(public_path('/img/profile/'), $photo_name);
        $photo_name = "/img/profile/".$photo_name;
      }
      $category->image = $photo_name;
      $category->save();
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
      $category = Slider::findOrFail($id);
      $category->delete();
      Session::put('message', trans('site.delete_sucessfully'));
      return json_encode(array("sucess"=>true));
    }
}
