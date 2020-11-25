@extends('dashboard.layouts.master')
@section('content')
@if(count($programmes)==0)
<div class="empty">
  <div class="empty-icon">
    <img src="{{url('/')}}/img/illustrations/undraw_printing_invoices_5r4r.svg" height="128" class="mb-4"  alt="">
  </div>
  <p class="empty-title h3">@lang('site.no_result')</p>
  <p class="empty-subtitle text-muted">
    @lang('site.add_new_records')
  </p>
  <div class="empty-action">
    <a href="#" class="btn btn-primary add_btn">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
      @lang('site.new_add')
    </a>
  </div>
</div>
@else
<div class="page-header">
            <div class="row align-items-center">
              <div class="col-auto">
                <h2 class="page-title">
                @lang('site.Program_design')
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ml-auto d-print-none">
                <a href="./." class="btn btn-primary add_btn">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                  @lang('site.new_add')
                </a>
              </div>
            </div>
</div>
<div class="row row-deck">
  @include("dashboard.utility.sucess_message")
	@foreach ($programmes as $key => $programme)
  <div class="col-sm-6 col-xl-4">
              <div class="card d-flex flex-column">

                @if($programme->media_type == "image")
                <a href="#">
                  <img class="card-img-top" src="{{$programme->image}}" alt="{{$programme->title}}">
                </a>
                @else
                <div data-vedio="{{$programme->vedio}}" class="vedio_selected">
                  <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" class="icon icon-md icon_height" fill="currentColor"><path d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"></path></svg>
               </div>
                @endif
                <div class="card-body d-flex flex-column">
                  <h3 class="card-title"><a href="#">{{$programme->title}}</a></h3>
                  <div class="text-muted">{{$programme->desc}}</div>
                  <div class="d-flex align-items-center pt-5 mt-auto">

                    <div class="ml-3">
                      <a href="" class="text-body">Type : {{$programme->type}}</a>
                    </div>
                    <div class="ml-3">
                      <a class='btn btn-info btn-xs  edit_btn' bt-data="{{$programme->id}}">
                       <i class="far fa-edit"></i>
                     </a>
                     <a href="#" class="btn btn-danger btn-xs  delete_btn"  bt-data="{{$programme->id}}">
                       <i class="far fa-trash-alt"></i>
                     </a>
                    </div>

                  </div>
                </div>
              </div>
            </div>

  @endforeach
</div>
<div class="row">
   <div class="col-md-12 col-xl-12">
     {{$programmes->links('dashboard.vendor.pagination.default')}}
   </div>
</div>

@endif

<div class="modal modal-blur fade" id="add_edit_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">@lang('site.new_add')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
        </button>
      </div>
      <div class="alert alert-danger alert-danger-modal" style="display:none">

      </div>
      <div class="alert alert-success alert-success-modal" style="display:none">

      </div>
      <form method="POST" action="{{ url('dashboard/programme') }}" class="form_submit_model" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">@lang('site.programme_title')</label>
                <input type="text" class="form-control" name="title">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">@lang('site.upload_programme')</label>
                <select name="upload_type" class="form-control">
                  <option value="">@lang('site.select')</option>
                  <option value="image">@lang('site.image')</option>
                  <option value="vedio">@lang('site.vedio')</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 upload_img"  style="display:none">
              <div class="mb-3">
                <label class="form-label">@lang('site.image')</label>
                <input type="file" class="form-control" name="img"  id="img">
                <img src="" class="img_edit" style="display:none" width="100" height="100"/>
              </div>
            </div>
            <div class="col-lg-6 upload_vedio"  style="display:none">
              <div class="mb-3">
                 <input type="file" class="form-control" name="vedio"  id="vedio">
                 <video src=''  controls width='50px' height='50px' class="vedio_edit">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">@lang('site.programme_type')</label>
                <select name="programme_type" class="form-control">
                  <option value="">@lang('site.select')</option>
                  <option value="exercises">@lang('site.exercises')</option>
                  <option value="dietary meals">@lang('site.dietary_meals')</option>
                  <option value="food supplements">@lang('site.food_supplements')</option>
                </select>
              </div>
            </div>
          </div>

          <div class="col-lg-12">
            <div class="mb-3">
              <label class="form-label">@lang('site.programme_desc')</label>
              <textarea class="form-control desc" rows="3" name="desc"></textarea>
            </div>
          </div>
          <input type="hidden" name="method_type" value="add" />
          <input type="hidden" name="item_id" value="0" />
          <input type="hidden" name="vedio_or_image" value="" />
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-link link-secondary" data-dismiss="modal">
            @lang('site.cancel')
          </a>
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
  var files;
  var formData;
  var _sucess_msg = function(response)
  {
    $(".alert-success-modal").html(response.sucess_text);
    $(".alert-success-modal").css("display","block");
    $('#add_edit_modal').modal('hide');
    $("input[name='method_type']").val("add");
    $(".img_profile").css("display","none");
    window.location.href = '{{url("/dashboard/programme")}}';
  }
  var _error_msgs = function(response)
  {
    var $error_text = "";
    var errors = response.errors;

    $.each(errors, function (key, value) {
      $error_text +=value+"<br>";
    });

    $(".alert-danger-modal").html($error_text);
    $(".alert-danger-modal").css("display","block");
  }
  var _sucess = function(response,is_uploaded)
  {
    if(response.sucess)
    {
      if(is_uploaded == 1)
      {
          var formData = new FormData();
          var id = $("input[name='item_id']").val();
          if($("select[name='upload_type']").val() == "image")
            formData.append('img',files[0]);
          else
           formData.append('vedio',files[0]);

          formData.append('upload_type',$("select[name='upload_type']").val());
          $.ajax({
              url: '{{url("/dashboard/programmes/uploadImage")}}'+"/"+id,
              type: 'post',
              data: formData,
              contentType: false,
              processData: false,
                dataType: 'json',
              success: function(response){

                if(response.sucess)
                {
                   _sucess_msg(response);
                }
                else
                {
                  _error_msgs(response);
                }

              },
          });
      }
      else {
        _sucess_msg(response);
      }


    }
    else
    {
      _error_msgs(response);

    }

  }
  $(".edit_btn").on("click",function()
  {
      $(".password_div").css("display","none");
      var id = $(this).attr("bt-data");
      var url_edit = '{{url("/dashboard/programme")}}'+"/"+id;
      $("input[name='item_id']").val(id);
      $(".form_submit_model").attr("action",url_edit);
      $(".img_edit").css("display","none");
      $(".upload_img").css("display","none");
      $(".vedio_edit").css("display","none");
      $(".upload_vedio").css("display","none");
      $.ajax({
          url: '{{url("/dashboard/programme")}}'+"/"+id+"/edit",
          type: 'GET',
          dataType: 'json',
          success: function (response) {
            $("input[name='title']").val(response.title);
            $("textarea[name='desc']").val(response.desc);
            $("select[name='programme_type']").val(response.type);
            $("select[name='upload_type']").val(response.media_type);
            $("input[name='method_type']").val("edit");
            $("input[name='item_id']").val(response.id);
            if(response.media_type == "image")
            {
               $(".img_edit").attr("src",response.image);
               $(".img_edit").css("display","block");
               $(".upload_img").css("display","block");
            }
            else
            {
              $(".vedio_edit").attr("src",response.vedio);
              $(".vedio_edit").css("display","block");
              $(".upload_vedio").css("display","block");
            }

            $('#add_edit_modal').modal('show');
          },
      });

        return false;
  });
  $(".add_btn").on("click",function(){
      $(".password_div").css("display","flex");
      $(".upload_img").css("display","none");
      $(".upload_vedio").css("display","none");
      $(".img_edit").css("display","none");
      $(".vedio_edit").css("display","none");
      $("input[name='method_type']").val("add");
      $(".form_submit_model").attr("action",'{{url("/dashboard/programme")}}');
      $('#add_edit_modal').modal('show');
      return false;
  });
  $(".form_submit_model").submit(function(e){

      e.preventDefault();
      var submit_form_url = $(this).attr('action');
      var $method_is = "POST";
      formData = new FormData($(this)[0]);
      $(".alert-success-modal").css("display","none");
      $(".alert-danger-modal").css("display","none");
      if($("select[name='upload_type']").val() == "image")
        files = $('#img')[0].files;
      else
        files = $('#vedio')[0].files;



      if(formData.get("method_type") == "edit")
      {
          $method_is = "PUT";

          var data = {
            title : $("input[name='title']").val(),
            programme_type : $("select[name='programme_type']").val(),
            desc : $("textarea[name='desc']").val(),
            upload_type : $("select[name='upload_type']").val(),
          };
          $.ajax({
              type: $method_is,
              url: submit_form_url,
              contentType: 'application/json',
              dataType: 'json',
              data: JSON.stringify(data),
              success: function (response) {
                if(files.length > 0 ){
                    _sucess(response,1);
                }
                else{
                  _sucess(response,0);
                }
              },
            error : function( data )
            {

            },
          });
      }
      else {
        if(files.length > 0 ){
           if($("select[name='upload_type']").val() == "image")
              formData.append('img',files[0]);
           else
             formData.append('vedio',files[0]);
         }
        $.ajax({
                  url: submit_form_url,
                  type: $method_is,
                  data: formData,
                  async: false,
                  dataType: 'json',
                  success: function (response) {
                    _sucess(response,0);
                  },
                error : function( data )
                {

                },
                cache: false,
                contentType: false,
                processData: false
        });

      }

        return false;
  });
  $(".delete_btn").on("click",function(){
    $('#delete_modal').modal('show');
    $("input[name='delete_val']").val($(this).attr("bt-data"));
    return false;
  });
  $(".delete_it_sure").on("click",function(){
    var id = $("input[name='delete_val']").val();
    var url_delete = '{{url("/dashboard/programme")}}'+"/"+id;
    $.ajax({url: url_delete ,type: "DELETE", success: function(result){
            var result = JSON.parse(result);
            if(result.sucess)
            {
              window.location.href = '{{url("/dashboard/programme")}}';
            }
    }});
  });
  $("select[name='upload_type']").on("change",function(){
    console.log("thereeee");
    var val = $(this).val();
    $("input[name='vedio_or_image']").val(val);
    $(".upload_img").css("display","none");
    $(".upload_vedio").css("display","none");
    if(val == "image")
      $(".upload_img").css("display","block");
    else
      $(".upload_vedio").css("display","block");
  });
</script>
@endsection
