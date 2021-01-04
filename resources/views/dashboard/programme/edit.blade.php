@extends('dashboard.layouts.master')
@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">@lang('site.Program_design') - Edit - {{$programme->title}}</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="table-responsive">

      @include("dashboard.utility.error_messages")
      <form method="POST" action="{{ url('dashboard/programme') }}/{{$programme->id}}" class="form_submit_model" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">@lang('site.programme_title')</label>
                <input type="text" class="form-control" name="title" value="{{$programme->title}}">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">@lang('site.programme_title') (ar)</label>
                <input type="text" class="form-control" name="title_ar" value="{{$programme->title_ar}}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">@lang('site.programme_type')</label>
                <select name="programme_type" class="form-control" disabled>
                  <option value="">@lang('site.select')</option>
                  <option value="exercises" {{ $programme->type == 'exercises'?'selected':''}}>@lang('site.exercises')</option>
                  <option value="dietary meals" {{ $programme->type == 'dietary meals'?'selected':''}}>@lang('site.dietary_meals')</option>
                  <option value="food supplements" {{ $programme->type == 'food supplements'?'selected':''}}>@lang('site.food_supplements')</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 upload_programme" {{$programme->type == "exercises" || $programme->type == "food supplements"?'':'style=display:none'}} >
              <div class="mb-3">
                <label class="form-label">@lang('site.upload_programme')</label>
                <select name="upload_type" class="form-control">
                  <option value="">@lang('site.select')</option>
                  <option value="image" {{ $programme->media_type == 'image'?'selected':''}}>@lang('site.image')</option>
                  <option value="vedio" {{ $programme->media_type == 'vedio'?'selected':''}}>@lang('site.vedio')</option>
                </select>
              </div>
            </div>
            <div class="col-lg-6 upload_vedio"  {{$programme->media_type == "vedio"?'':'style=display:none'}} >
              <div class="mb-3">
                 <label class="form-label">@lang('site.link')</label>
                 <input type="text" class="form-control" name="vedio" value="{{$programme->vedio}}">
                 <div class="vedio_edit" style="display:none" >
                 </div>
              </div>
            </div>

            <div class="col-lg-12 upload_img" {{$programme->media_type == "image"?'':'style=display:none'}}>
              <div class="mb-3">
                <label class="form-label">@lang('site.image')</label>
                <input type="file" class="form-control" onchange="loadPreview(this)" name="img[]"  id="img" multiple="multiple">
                <label class="custom-file-label" for="images">Prss Ctrl button when select images</label>
                <div id="thumb-output"></div>
                <table class="table card-table table-vcenter text-nowrap datatable">
                  <thead>
                    <tr>
                      <th>
                        Image
                      </th>

                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($programme_images as $key => $images)
                    <tr>
                      <td><img src="{{url('/')}}{{$images->image}}" width="100" height="100" /></td>
                      <td class="text-right">
                        <a href="#" class="btn btn-danger btn-xs delete_btn"  bt-data="{{$images->id}}">
                          <i class="far fa-trash-alt"></i>
                        </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-lg-6 sets_num"  {{$programme->type == "exercises"?'':'style=display:none'}}>
              <div class="mb-3">
                <label class="form-label">Number of sets</label>
                <input type="text" class="form-control" name="sets_num" value="{{$programme->number_of_sets}}">
              </div>
            </div>
            <div class="col-lg-6 serving_size"  {{$programme->type == "food supplements"?'':'style=display:none'}}>
              <div class="mb-3">
                <label class="form-label">Serving size</label>
                <input type="text" class="form-control" name="serving_size" value="{{$programme->serving_size}}">
              </div>
            </div>
          </div>
          <div class="row masged"  {{$programme->type == "dietary meals"?'':'style=display:none'}}>
            <input type="hidden" name="character_num" value="{{count($programme_integrate)}}" />
              <div class="col-lg-12">
                <div class="mb-3">
                  <label class="form-label">Food nutritional values </label>
                  <div class="msgd_characters_div">
                    @foreach($programme_integrate as $k=>$sp)
                      @php  $i = $k + 1; @endphp
                    <div class="row  ch_htm_div msgd_remove_ch_div{{$i}}">
                       <div class="col-lg-2">
                         <label>Serving size</label>
                          <input type="text" class="form-control" name="serv_size{{$i}}" value="{{$sp->serving_size}}">
                       </div>
                       <div class="col-lg-2">
                         <label>Calories</label>
                          <input type="text" class="form-control" name="calories{{$i}}" value="{{$sp->calories}}">
                       </div>
                       <div class="col-lg-2">
                          <label>Carbs</label>
                          <input type="text" class="form-control" name="carbs{{$i}}" value="{{$sp->carbs}}">
                       </div>
                       <div class="col-lg-2">
                         <label>Protein</label>
                          <input type="text" class="form-control" name="protein{{$i}}" value="{{$sp->protein}}">
                       </div>
                       <div class="col-lg-2">
                         <label>Fat</label>
                          <input type="text" class="form-control" name="fat{{$i}}" value="{{$sp->fat}}">
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
                <!--  <div class="row">
                      <div class="col-lg-12">
                        <button type="button" class="btn btn-primary msgd_add_character">+</button>
                      </div>
                  </div>
                -->

                </div>
              </div>
            </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="mb-3">
                <label class="form-label">@lang('site.programme_desc')</label>
                <textarea class="form-control desc" rows="3" name="desc">{{$programme->desc}}</textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="mb-3">
                <label class="form-label">@lang('site.programme_desc') (ar)</label>
                <textarea class="form-control desc" rows="3" name="desc_ar">{{$programme->desc_ar}}</textarea>
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
@include("dashboard/utility/modal_delete")
@endsection
@section('footerjscontent')
<script type="text/javascript">
  $("select[name='upload_type']").on("change",function(){
    var val = $(this).val();
    $("input[name='vedio_or_image']").val(val);
    $(".upload_img").css("display","none");
    $(".upload_vedio").css("display","none");
    if(val == "image")
      $(".upload_img").css("display","block");
    else
      $(".upload_vedio").css("display","block");
  });
  $("select[name='programme_type']").on("change",function(){
    var val = $(this).val();
    $(".upload_programme").css("display","none");
    $(".sets_num").css("display","none");
    $(".serving_size").css("display","none");
    $(".upload_vedio").css("display","none");
    $(".upload_img").css("display","none");
    $(".masged").css("display","none");

    if(val == "exercises")
    {
        $(".upload_programme").css("display","block");
        $(".sets_num").css("display","block");
    }
    else if( val =="dietary meals")
    {
        $(".masged").css("display","block");
    }
    else if( val =="food supplements")
    {
      $(".serving_size").css("display","block");
      $(".upload_programme").css("display","block");
      $("select[name='upload_type']").val("image");
      $(".upload_img").css("display","block");
    }
  });
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
  var _remove_m = function()
{
  $(".msg_rem_btn").off();
  $(".msg_rem_btn").on("click",function(){

     var val = $(this).attr("data-remove");
     var rem = "msgd_remove_ch_div"+val;
     $(".msgd_characters_div").find("."+rem).remove();
  });
}
_remove_m();
  $(".msgd_add_character").on("click",function(){
  i = i +1;
  var serv_size = "serv_size"+i;
  var calories = "calories"+i;
  var carbs = "carbs"+i;
  var protein = "protein"+i;
  var fat = "fat"+i;
  var rem = "msgd_remove_ch_div"+i;
  html = '<div class="row ch_htm_div '+rem+'">';
  html +='<div class="col-lg-2"><label>Serving size </label><input type="text" class="form-control" name="'+serv_size+'" ></div>';
  html +='<div class="col-lg-2"><label>Calories</label><input type="text" class="form-control" name="'+calories+'" ></div>';
  html +='<div class="col-lg-2"><label>Carbs</label><input type="text" class="form-control" name="'+carbs+'" ></div>';
  html +='<div class="col-lg-2"><label>Protein</label><input type="text" class="form-control" name="'+protein+'" ></div>';
  html +='<div class="col-lg-2"><label>Fat</label><input type="text" class="form-control" name="'+fat+'" ></div>';
  html +='<div class="col-lg-2"><div class="div_h_20"></div><button type="button" class="btn btn-danger msg_rem_btn" data-remove="'+i+'">-</button></div>';
  html +='</div>';
  $(".msgd_characters_div").append(html);
  _remove_m();
  $("input[name='character_num']").val(i);
});
$(".delete_btn").on("click",function(){
  $('#delete_modal').modal('show');
  $("input[name='delete_val']").val($(this).attr("bt-data"));
  return false;
});
$(".delete_it_sure").on("click",function(){
  var id = $("input[name='delete_val']").val();
  var url_delete = '{{url("/dashboard/programmeimage")}}'+"/"+id;
  $.ajax({url: url_delete ,type: "DELETE", success: function(result){
    var result = JSON.parse(result);
    if(result.sucess)
      window.location.href = '{{url("/dashboard/programme")}}'+'/'+'{{$programme->id}}/edit';
  }});
});
</script>
@endsection
