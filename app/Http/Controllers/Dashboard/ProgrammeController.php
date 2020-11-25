<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Programme;
use App\ProgrammeImages;
use Session;
use Validator;

class ProgrammeController extends Controller
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
    public function index(Request $request)
    {
      if(isset($request->search))
      {
        $query = Programme::orderBy("id","desc");
        if(!empty($request->programme_type))
          $query = $query->where("type",$request->programme_type);
          $programmes = $query->paginate($this->pagination_num);
      }
      else
        $programmes = Programme::orderBy("id","desc")->paginate($this->pagination_num);
      return view('dashboard.programme.index',compact('programmes'));
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
      $validate_arr = [
          'title' => ['required', 'string', 'max:255'],
          'upload_type' => ['required', 'string'],
          'programme_type' => ['required', 'string'],
          'desc'=>['required'],
      ];
      if($request->upload_type != "image")
        $validate_arr["vedio"] = ['required'];

      $validator = Validator::make($request->all(), $validate_arr);
      if ($validator->fails())
        return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));


      $programme = new Programme();
      if($request->upload_type != "image")
      {
        $programme->vedio = $request->vedio;
      }

      $programme->title = $request->title;
      $programme->desc = $request->desc;
      $programme->media_type =  $request->upload_type;
      $programme->type =  $request->programme_type;
      $programme->save();
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
      $programme = Programme::findOrFail($id);
      return view('dashboard.programme.show',compact('programme'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $programme = Programme::findOrFail($id);
        return $programme;
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
      $programme = Programme::findOrFail($id);
      $validate_arr = [
          'title' => ['required', 'string', 'max:255'],
          'upload_type' => ['required', 'string'],
          'programme_type' => ['required', 'string'],
          'desc'=>['required'],
      ];
      if($request->upload_type != "image")
         $validate_arr["vedio"] = "required";
      $validator = Validator::make($request->all(),$validate_arr);
      if ($validator->fails())
        return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));
      $programme->title = $request->title;
      $programme->desc = $request->desc;
      $programme->media_type =  $request->upload_type;
      $programme->type =  $request->programme_type;
      if($request->upload_type != "image")
      {
        $programme->vedio = $request->vedio;
      }
      else
      {
        $programme->vedio = "";
      }

      $programme->save();
      return json_encode(array("sucess"=>true,"sucess_text"=>trans('site.update_sucessfully')));
    }

    public function uploadImage(Request $request)
    {
      $validate_arr = [];
      if($request->upload_type == "image")
        $validate_arr["img"] = ['required','image','mimes:jpeg,png,jpg','max:5000'];

      $validator = Validator::make($request->all(),$validate_arr);
      if ($validator->fails())
        return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));

        $photo = $request->img;
        $photo_name = md5(rand(1,1000).time()).'.'.$photo->getClientOriginalExtension();
        $photo->move(public_path('/img/programme/'), $photo_name);
        $photo_name = '/img/programme/'.$photo_name;

      $programme_images = new ProgrammeImages();
      $programme_images->image = $photo_name;
      $programme_images->programme_id = $request->image_item_id;
      $programme_images->save();
      return json_encode(array("sucess"=>true,"sucess_text"=>trans('site.add_sucessfully')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $programme = Programme::findOrFail($id);
      $programme->delete();
      Session::put('message', trans('site.delete_sucessfully'));
      return json_encode(array("sucess"=>true));
    }
}
