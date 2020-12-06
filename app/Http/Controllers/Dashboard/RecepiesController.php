<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Receips;
use Session;
use Validator;

class RecepiesController extends Controller
{

   protected $pagination_num = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receips = Receips::orderBy("id","desc")->paginate($this->pagination_num);
        return view('dashboard.receips.index',compact('receips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.receips.add');
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


          $recepe = new Receips();
          $recepe->name = $request->name;
          $recepe->desciption = $request->body;
          if ($request->hasFile('img')) {
               $photo = $request->file('img');
               $photo_name = md5(rand(1,1000).time()).'.'.$photo->getClientOriginalExtension();
               $photo->move(public_path('/img/programme/'), $photo_name);
               $photo_name = '/img/programme/'.$photo_name;
               $recepe->image = $photo_name;
           }
          $recepe->save();
          for($i=1;$i<=$request->character_num;$i++)
          {
              $s = "food_".$i;
              $cal = "integrate_".$i;
              $car = "serving_num_".$i;
              if(isset($request->$s) && isset($request->$cal) && isset($request->$car))
              {
                $sp = new \App\RecepiesIntegrate();
                $sp->programme_id  = $request->$s;
                $sp->integrate_programme_id  = $request->$cal;
                $sp->recep_id  = $recepe->id;
                $sp->serving  =$request->$car;
                $sp->save();
              }
          }

          return redirect('dashboard/recepies')->with("message","Sucessfully Added");

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $receips = Receips::find($id);
        $recep_integrate = $receips->integrate;
        return view('dashboard.receips.edit',compact('receips','recep_integrate'));
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
        $validator = $this->validation($request);
        if ($validator->fails())
             return back()->withInput()->withErrors($validator->errors());

         $recepe = Receips::find($id);
         $recepe->name = $request->name;
         $recepe->desciption = $request->body;
         if ($request->hasFile('img')) {
             $photo = $request->file('img');
             $photo_name = md5(rand(1,1000).time()).'.'.$photo->getClientOriginalExtension();
             $photo->move(public_path('/img/programme/'), $photo_name);
             $photo_name = '/img/programme/'.$photo_name;
             $recepe->image = $photo_name;
          }
         $recepe->save();
         \App\RecepiesIntegrate::where("recep_id",$recepe->id)->delete();
         for($i=1;$i<=$request->character_num;$i++)
         {
             $s = "food_".$i;
             $cal = "integrate_".$i;
             $car = "serving_num_".$i;
             if(isset($request->$s) && isset($request->$cal) && isset($request->$car))
             {
               $sp = new \App\RecepiesIntegrate();
               $sp->programme_id  = $request->$s;
               $sp->integrate_programme_id  = $request->$cal;
               $sp->recep_id  = $recepe->id;
               $sp->serving  =$request->$car;
               $sp->save();
             }
         }
         return redirect('dashboard/recepies')->with("message","Sucessfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $receps = Receips::find($id);
        $receps->delete();
        Session::put('message',"Sucessfully Delete");
        return json_encode(array("sucess"=>true));
    }

    public function select_integration($id)
    {
      $programme = \App\Programme::find($id);
      $html = "";
      foreach($programme->integrate as $integrate)
      {
        $html .="<option value='".$integrate->id."'>Serving size (".$integrate->serving_size.") - Calories (".$integrate->calories.") - Carbs(".$integrate->carbs.") - Protein(".$integrate->protein.") - Fat(".$integrate->fat.") </option>";
      }
      return json_encode(array("integrate"=>$html));
    }
    /**
     * validation for articles form
     * @return Validator
     */

    private function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
                    'body' => 'required',
                    'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
              ]);
         return $validator;

    }
}
