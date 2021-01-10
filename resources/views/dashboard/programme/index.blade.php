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
    <a href="{{ url('dashboard/programme/create') }}" class="btn btn-primary add_btn">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
      @lang('site.new_add')
    </a>
  </div>
</div>
@else
<div class="card">
  <div class="card-header">
    <h3 class="card-title">@lang('site.Program_design')</h3>
    <div class="search">
         <button type="button" class="btn search_btn"><i class="fa fa-search" aria-hidden="true"></i> {{ __('site.search') }} </button>
    </div>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="row">
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body p-2 text-center">
          <div class="text-right text-green">

          </div>
          <div class="h1 m-0">{{\App\Programme::where("type","exercises")->count()}}</div>
          <div class="text-muted mb-4">Exercises</div>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body p-2 text-center">
          <div class="text-right text-green">

          </div>
          <div class="h1 m-0">{{\App\Programme::where("type","dietary meals")->count()}}</div>
          <div class="text-muted mb-4">Dietary meals</div>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body p-2 text-center">
          <div class="text-right text-green">

          </div>
          <div class="h1 m-0">{{\App\Programme::where("type","food supplements")->count()}}</div>
          <div class="text-muted mb-4">Food supplements</div>
        </div>
      </div>
    </div>
  </div>
    <div class="d-flex">
      <a href="{{ url('dashboard/programme/create') }}" class="btn btn-primary add_btn">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
        @lang('site.new_add')
      </a>
    </div>

    <div class="table-responsive">
      @include("dashboard.utility.sucess_message")
      <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
          <tr>
            <th>
               Image / Video 
            </th>
            <th>
               @lang('site.programme_title')
            </th>
            <th>
               @lang('site.programme_type')
            </th>
            <th>
               @lang('site.upload_programme')
            </th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        	@foreach ($programmes as $key => $programme)
          <tr>
            <td>

              @if($programme->media_type == "image")
                @if(count($programme->images)>0)
                  <img src="{{url('/')}}{{$programme->images[0]->image}}" width="100" height="100" />
                @endif
              @elseif($programme->media_type == "vedio")
                 {!! $programme->vedio !!}
              @endif


            </td>
            <td>{{$programme->title}}</td>
            <td>{{$programme->type}}</td>
            <td>{{$programme->media_type}}</td>
            <td class="text-right">
              <a href='{{url("/dashboard/programme")}}/{{$programme->id}}/edit' class='btn btn-info btn-xs' >
    						<i class="far fa-edit"></i>
    					</a>
    					<a href="#" class="btn btn-danger btn-xs delete_btn"  bt-data="{{$programme->id}}">
    						<i class="far fa-trash-alt"></i>
    					</a>
              <a href="{{ url('dashboard/programme') }}/{{$programme->id}}" class="btn  btn-xs "  bt-data="{{$programme->id}}">
    						Details
    					</a>
              @if($programme->media_type == "image")
               <span></span>
              @elseif($programme->media_type == "vedio")
              <a href="#" class="btn  btn-xs vedio_view"  data-vedio="{{$programme->vedio}}">
               View Vedio
              </a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex align-items-center">
      {{$programmes->links('dashboard.vendor.pagination.default')}}
    </div>
  </div>
</div>
@endif

<div class="modal modal-blur fade" id="vedio_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Vedio content</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
        </button>
      </div>
      <div class="modal-body">
        <div class="vedio_content">
        </div>

      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-link link-secondary" data-dismiss="modal">
          @lang('site.cancel')
        </a>
      </div>
    </div>
  </div>
</div>
<div class="modal modal-blur fade" id="image_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
        </button>
      </div>
      <div class="alert alert-danger alert-danger-modal2" style="display:none">

      </div>
      <div class="alert alert-success alert-success-modal2" style="display:none">

      </div>
      <form method="POST" action="{{ url('/dashboard/programmes/uploadImage') }}" class="image_submit_model" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="mb-3">
                <label class="form-label">@lang('site.image')</label>
                <input type="file" class="form-control" name="img"  id="img">
              </div>
            </div>
          </div>
          <input type="hidden" name="image_item_id" value="0" />
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
<div class="modal modal-blur fade" id="serach_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">@lang('site.search')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
        </button>
      </div>
      <form method="GET" action="{{ url('dashboard/programme') }}" >
        <div class="modal-body">
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
        <input type="hidden" name="search" value="search" />
        <div class="modal-footer">
          <a href="#" class="btn btn-link link-secondary" data-dismiss="modal">
            @lang('site.cancel')
          </a>
          <button type="submit" class="btn btn-primary">{{ __('site.search') }} </button>
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
  var edit_row;
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
      _sucess_msg(response);
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
            edit_row = response;
            if(response.media_type == "image")
            {
               var img_val = '{{url("/")}}'+response.image;
               $(".img_edit").attr("src",img_val);
               $(".img_edit").css("display","block");
               $(".upload_img").css("display","block");
            }
            else
            {
              $(".vedio_edit").html(response.vedio);
              $("input[name='vedio']").val(response.vedio);
              $(".vedio_edit").css("display","block");
              $(".upload_vedio").css("display","block");
            }

            $('#add_edit_modal').modal('show');
          },
      });

        return false;
  });
  $(".form_submit_model").submit(function(e){

      e.preventDefault();
      var submit_form_url = $(this).attr('action');
      var $method_is = "POST";
      formData = new FormData($(this)[0]);
      $(".alert-success-modal").css("display","none");
      $(".alert-danger-modal").css("display","none");



      if(formData.get("method_type") == "edit")
      {
          $method_is = "PUT";

          var data = {
            title : $("input[name='title']").val(),
            programme_type : $("select[name='programme_type']").val(),
            desc : $("textarea[name='desc']").val(),
            upload_type : $("select[name='upload_type']").val(),
          };
          if($("select[name='upload_type']").val() != "image")
            data.vedio = $("input[name='vedio']").val()
          $.ajax({
              type: $method_is,
              url: submit_form_url,
              contentType: 'application/json',
              dataType: 'json',
              data: JSON.stringify(data),
              success: function (response) {
                _sucess(response,0);
              },
            error : function( data )
            {

            },
          });
      }
      else {

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
    var val = $(this).val();
    $("input[name='vedio_or_image']").val(val);
    $(".upload_img").css("display","none");
    $(".upload_vedio").css("display","none");
    if(val == "image")
      $(".upload_img").css("display","block");
    else
      $(".upload_vedio").css("display","block");
  });
  $(".vedio_view").on("click",function(){
    var val = $(this).attr("data-vedio");
    $(".vedio_content").html(val);
    $('#vedio_modal').modal('show');
  });
  $(".add_new_image").on("click",function(){
    var val = $(this).attr("bt-data");
    $("input[name='image_item_id']").val(val);
    $('#image_modal').modal('show');
    $(".image_submit_model").submit(function(e){
      e.preventDefault();
      var submit_form_url = $(this).attr('action');
      var $method_is = "POST";
      formData = new FormData($(this)[0]);
      $(".alert-success-modal2").css("display","none");
      $(".alert-danger-modal2").css("display","none");
      files = $('#img')[0].files;
      formData.append('img',files[0]);
      $.ajax({
                url: submit_form_url,
                type: $method_is,
                data: formData,
                async: false,
                dataType: 'json',
                success: function (response) {
                  if(response.sucess)
                  {
                    $(".alert-success-modal2").html(response.sucess_text);
                    $(".alert-success-modal2").css("display","block");
                  }
                  else
                  {
                    var $error_text = "";
                    var errors = response.errors;

                    $.each(errors, function (key, value) {
                      $error_text +=value+"<br>";
                    });

                    $(".alert-danger-modal2").html($error_text);
                    $(".alert-danger-modal2").css("display","block");
                  }
                },
              error : function( data )
              {

              },
              cache: false,
              contentType: false,
              processData: false
      });

    });
  });
  $(".search_btn").on("click",function(){
      $('#serach_modal').modal('show');
      return false;
  });
</script>
@endsection
