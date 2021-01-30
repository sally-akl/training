<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Programme;
use App\ProgrammeImages;
use App\ProgrammeIntegrent;
use Session;
use Validator;

class ProgrammeController extends MainAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination_num = 10;
    protected $role_num = 2;
    protected $check_permission = "manage_program_design";
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
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
      return view('dashboard.programme.create');
    }

    private function validation(Request $request , $id = 0)
    {
      $validate_arr =  [
          'title' => ['required', 'string', 'max:255'],
          'desc'=>['required'],
          'title_ar' => ['required', 'string', 'max:255'],
          'desc_ar' =>['required'],
        ];
        if($id == 0)
        {
          $validate_arr["programme_type"] =  ['required', 'string'];
          if($request->programme_type == "exercises")
          {
            $validate_arr["upload_type"] =  ['required', 'string'];
            if($request->upload_type != "image")
              $validate_arr["vedio"] = ['required'];
            if($request->upload_type == "image")
            {
              $validate_arr["img"] = 'required';
              $validate_arr["img.*"] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
            }

          }
          if($request->programme_type == "dietary meals")
          {
              $validate_arr["serv_size1"] = 'required';
              $validate_arr["calories1"] = 'required';
              $validate_arr["carbs1"] = 'required';
              $validate_arr["protein1"] = 'required';
              $validate_arr["fat1"] = 'required';
          }

        }
        else
        {
           $programme = Programme::findOrFail($id);
           if($programme->type == "exercises")
           {
             $validate_arr["upload_type"] =  ['required', 'string'];
             if($request->upload_type != "image")
               $validate_arr["vedio"] = ['required'];
             if($request->upload_type == "image")
             {
               $validate_arr["img"] = 'required';
               $validate_arr["img.*"] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
             }

           }
           if($programme->type == "dietary meals")
           {
               $validate_arr["serv_size1"] = 'required';
               $validate_arr["calories1"] = 'required';
               $validate_arr["carbs1"] = 'required';
               $validate_arr["protein1"] = 'required';
               $validate_arr["fat1"] = 'required';
           }
        }







      $validator = Validator::make($request->all(),$validate_arr);
      return $validator;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = $this->validation($request);
      if ($validator->fails())
        return back()->withInput()->withErrors($validator->errors());


      $programme = new Programme();
      if($request->upload_type != "image")
      {
        $vedio_parts = explode("?v=", $request->vedio);
        if(count($vedio_parts) == 2)
          $programme->vedio = "https://www.youtube.com/embed/".$vedio_parts[1];
      }




      $programme->title = $request->title;
      $programme->title_ar = $request->title_ar;
      $programme->desc = $request->desc;
      $programme->desc_ar  = $request->desc_ar;
      $programme->media_type =  $request->upload_type;
      $programme->type =  $request->programme_type;
      if($request->programme_type == "exercises")
        $programme->number_of_sets = $request->sets_num;
      if($request->programme_type == "food supplements")
        $programme->serving_size = $request->serving_size;

      $programme->save();
      if ($request->hasFile('img')) {
         $image = $request->file('img');
         foreach ($image as $photo) {
           $photo_name = md5(rand(1,1000).time()).'.'.$photo->getClientOriginalExtension();
           $photo->move(public_path('/img/programme/'), $photo_name);
           $photo_name = '/img/programme/'.$photo_name;
           $programme_images = new ProgrammeImages();
           $programme_images->image = $photo_name;
           $programme_images->programme_id = $programme->id;
           $programme_images->save();
         }
       }
       if($request->programme_type == "dietary meals")
      {
        for($i=1;$i<=$request->character_num;$i++)
        {
            $s = "serv_size".$i;
            $cal = "calories".$i;
            $car = "carbs".$i;
            $pro = "protein".$i;
            $fat = "fat".$i;
            if(isset($request->$s) && isset($request->$cal) && isset($request->$car) && isset($request->$pro) &&  isset($request->$fat))
            {
              $sp = new ProgrammeIntegrent();
              $sp->programme_id =  $programme->id;
              $sp->serving_size = $request->$s;
              $sp->calories = $request->$cal;
              $sp->carbs = $request->$car;
              $sp->protein = $request->$pro;
              $sp->fat = $request->$fat;
              $sp->save();
            }
        }
      }
        return redirect('dashboard/programme')->with("message","Sucessfully Added");
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
      $programme_integrate = ProgrammeIntegrent::where("programme_id",$programme->id)->get();
      return view('dashboard.programme.show',compact('programme','programme_integrate'));
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
        $programme_images = ProgrammeImages::where("programme_id",$programme->id)->get();
        $programme_integrate = ProgrammeIntegrent::where("programme_id",$programme->id)->get();
        return view('dashboard.programme.edit',compact('programme','programme_images','programme_integrate'));
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
      $validator = $this->validation($request,$id);
      if ($validator->fails())
        return back()->withInput()->withErrors($validator->errors());


      if($request->upload_type != "image")
      {
          $vedio_parts = explode("?v=", $request->vedio);
          if(count($vedio_parts) == 2)
            $programme->vedio = "https://www.youtube.com/embed/".$vedio_parts[1];
          else{
            $programme->vedio = $request->vedio;
          }
      }




      $programme->title = $request->title;
      $programme->title_ar = $request->title_ar;
      $programme->desc = $request->desc;
      $programme->desc_ar  = $request->desc_ar;
      $programme->media_type =  $request->upload_type;
    //  $programme->type =  $request->programme_type;
      if($programme->type == "exercises")
        $programme->number_of_sets = $request->sets_num;
      if($programme->type == "food supplements")
        $programme->serving_size = $request->serving_size;

      $programme->save();
      if ($request->hasFile('img')) {
         $image = $request->file('img');
         foreach ($image as $photo) {
           $photo_name = md5(rand(1,1000).time()).'.'.$photo->getClientOriginalExtension();
           $photo->move(public_path('/img/programme/'), $photo_name);
           $photo_name = '/img/programme/'.$photo_name;
           $programme_images = new ProgrammeImages();
           $programme_images->image = $photo_name;
           $programme_images->programme_id = $programme->id;
           $programme_images->save();
         }
       }
       if($programme->type== "dietary meals")
      {
         ProgrammeIntegrent::where("programme_id",$programme->id)->delete();
        for($i=1;$i<=$request->character_num;$i++)
        {
            $s = "serv_size".$i;
            $cal = "calories".$i;
            $car = "carbs".$i;
            $pro = "protein".$i;
            $fat = "fat".$i;
            if(isset($request->$s) && isset($request->$cal) && isset($request->$car) && isset($request->$pro) &&  isset($request->$fat))
            {
              $sp = new ProgrammeIntegrent();
              $sp->programme_id =  $programme->id;
              $sp->serving_size = $request->$s;
              $sp->calories = $request->$cal;
              $sp->carbs = $request->$car;
              $sp->protein = $request->$pro;
              $sp->fat = $request->$fat;
              $sp->save();
            }
        }
      }
        return redirect('dashboard/programme')->with("message","Sucessfully Updated");
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
