@extends('dashboard.layouts.master')
@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Receips - Edit</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="table-responsive">

      @include("dashboard.utility.error_messages")
      <form method="POST" action="{{ url('dashboard/recepies') }}/{{$receips->id}}" class="form_submit_model" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="name" value="{{$receips->name}}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6" >
              <div class="col-lg-12 upload_img" >
                <div class="mb-3">
                  <label class="form-label">@lang('site.image')</label>
                  <input type="file" class="form-control" onchange="loadPreview(this)" name="img"  id="img" >
                  <img src="{{url('/')}}{{$receips->image}}" width="100" height="100" />
                  <div id="thumb-output"></div>
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control desc" rows="3" name="body">{{$receips->desciption}}</textarea>
              </div>
            </div>
          </div>

          <div class="row masged">
            <input type="hidden" name="character_num" value="{{count($recep_integrate)}}" />
              <div class="col-lg-12">
                <div class="mb-3">
                  <label class="form-label">Choose Food and Serving number</label>
                  <div class="msgd_characters_div">
                    @foreach($recep_integrate as $k=>$sp)
                      @php  $i = $k + 1; @endphp
                    <div class="row  ch_htm_div msgd_remove_ch_div{{$i}}">
                       <div class="col-lg-2">
                         <label>Food</label>
                         <select name="food_{{$i}}" class="form-control select_food">
                           <option value="">Select</option>
                           @foreach(\App\Programme::where("type","dietary meals")->get() as $programme)
                              <option value="{{$programme->id}}" {{$programme->id == $sp->programme_id ?"selected":""}}>{{$programme->title}}</option>
                           @endforeach
                         </select>

                       </div>
                       <div class="col-lg-2">
                         <label> Serving size  , Calories , ... </label>
                         <select name="integrate_{{$i}}" class="form-control">
                           @foreach($sp->programme->integrate as $integrate)
                             <option value='{{$integrate->id}}'{{$integrate->id == $sp->integrate_programme_id?"selected":"" }}>Serving size ({{$integrate->serving_size}}) - Calories ({{$integrate->calories}}) - Carbs({{$integrate->carbs}}) - Protein({{$integrate->protein}}) - Fat({{$integrate->fat}}) </option>
                           @endforeach
                         </select>
                       </div>
                       <div class="col-lg-2">
                         <label>Serving num</label>
                          <input type="text" class="form-control" name="serving_num_{{$i}}" value="{{$sp->serving}}">
                       </div>
                       @if($i != 1)
                        <div class="col-lg-2">
                          <div class="div_h_20"></div>
                          <button type="button" class="btn btn-danger msg_rem_btn" data-remove="{{$i}}">-</button>
                        </div>
                       @endif
                    </div>
                    @endforeach
                  </div>
                  <div class="row">
                      <div class="col-lg-12">
                        <button type="button" class="btn btn-primary msgd_add_character">+</button>
                      </div>
                  </div>

                </div>
              </div>
            </div>



          <input type="hidden" name="method_type" value="add" />
          <input type="hidden" name="item_id" value="0" />
          <input type="hidden" name="vedio_or_image" value="" />
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">+ {{ __('site.save') }} </button>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection
@section('footerjscontent')
<script type="text/javascript">

  function loadPreview(input){
      var data = $(input)[0].files; //this file data
      $.each(data, function(index, file){
          if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){
              var fRead = new FileReader();
              fRead.onload = (function(file){
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image thumb element
                      $('#thumb-output').append(img);
                  };
              })(file);
              fRead.readAsDataURL(file);
          }
      });
  }

  var i = parseInt($("input[name='character_num']").val());
  var _select_food = function()
  {
    $(".select_food").off();
    $(".select_food").on("change",function(){

       var val = $(this).val();
       var name = $(this).attr("name");
       var parts = name.split("_");
       var select_name = "integrate_"+parts[1];
       var url = '{{url("/dashboard/recepies/select/integration")}}'+"/"+val;
       $.ajax({url: url , success: function(result){
          var result = JSON.parse(result);
          $("select[name="+select_name+"]").html("");
          $("select[name="+select_name+"]").append(result.integrate);

       }});
    });

  }
    _select_food();
  var _remove_m = function()
{
  $(".msg_rem_btn").off();
  $(".msg_rem_btn").on("click",function(){

     var val = $(this).attr("data-remove");
     var rem = "msgd_remove_ch_div"+val;
     $(".msgd_characters_div").find("."+rem).remove();
  });
}
  $(".msgd_add_character").on("click",function(){
  i = i +1;
  var food = "food_"+i;
  var integrate = "integrate_"+i;
  var serving_num = "serving_num_"+i;

  var $options = $("select[name='food_1'] > option").clone();

  var rem = "msgd_remove_ch_div"+i;
  html = '<div class="row ch_htm_div '+rem+'">';
  html +='<div class="col-lg-2"><label>Food</label><select name="'+food+'" class="form-control select_food"></select></div>';
  html +='<div class="col-lg-2"><label>Serving size  , Calories , ... </label><select name="'+integrate+'" class="form-control"></select></div>';
  html +='<div class="col-lg-2"><label>Serving num</label><input type="text" class="form-control" name="'+serving_num+'" ></div>';
  html +='<div class="col-lg-2"><div class="div_h_20"></div><button type="button" class="btn btn-danger msg_rem_btn" data-remove="'+i+'">-</button></div>';
  html +='</div>';

  $(".msgd_characters_div").append(html);
  $("select[name='"+food+"']").append($options);
  _remove_m();
  _select_food();
  $("input[name='character_num']").val(i);
});
</script>
@endsection
