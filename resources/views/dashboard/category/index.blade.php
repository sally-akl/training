@extends('dashboard.layouts.master')
@section('content')
@if(count($categories)==0)
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
<div class="card">
  <div class="card-header">
    <h3 class="card-title">@lang('site.categories')</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="d-flex">
      <a href="./." class="btn btn-primary add_btn">
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
              Image
            </th>
            <th>
               @lang('site.category_name')
            </th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          	@foreach ($categories as $key => $category)
          <tr>
            <td>
               <span class="avatar avatar-xl" style="background-image: url({{url($category->image)}})"></span>
              </td>
            <td>{{$category->title}}</td>
            <td class="text-right">
              <a class='btn btn-info btn-xs edit_btn' bt-data="{{$category->id}}">
    						<i class="far fa-edit"></i>
    					</a>
    					<a href="#" class="btn btn-danger btn-xs delete_btn"  bt-data="{{$category->id}}">
    						<i class="far fa-trash-alt"></i>
    					</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex align-items-center">
      {{$categories->links('dashboard.vendor.pagination.default')}}
    </div>
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
      <form method="POST" action="{{ url('dashboard/category') }}" class="form_submit_model">
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">@lang('site.category_name')</label>
                <input type="text" class="form-control" name="title">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" class="form-control" name="image"  id="profile_img">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                  <img src="" class="img_profile" style="display:none" width="100" height="100"/>
              </div>
            </div>
          </div>

          <input type="hidden" name="method_type" value="add" />
          <input type="hidden" name="item_id" value="0" />
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
    window.location.href = '{{url("/dashboard/category")}}';
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
          formData.append('image',files[0]);
          $.ajax({
              url: '{{url("/dashboard/categores/uploadImage")}}'+"/"+id,
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
      var id = $(this).attr("bt-data");
      var url_edit = '{{url("/dashboard/category")}}'+"/"+id;
      $("input[name='item_id']").val(id);
      $(".form_submit_model").attr("action",url_edit);
      $.ajax({
          url: '{{url("/dashboard/category")}}'+"/"+id+"/edit",
          type: 'GET',
          dataType: 'json',
          success: function (response) {
            $("input[name='title']").val(response.title);
            $("input[name='method_type']").val("edit");
            var img_val = '{{url("/")}}'+response.image;
            $(".img_profile").attr("src",img_val);
            $(".img_profile").css("display","block");
            $('#add_edit_modal').modal('show');
          },
      });

        return false;
  });
  $(".add_btn").on("click",function(){
      $('#add_edit_modal').modal('show');
      $("input[name='method_type']").val("add");
        $(".img_profile").css("display","none");
      $(".form_submit_model").attr("action",'{{url("/dashboard/category")}}');
      return false;
  });
  $(".form_submit_model").submit(function(e){

      e.preventDefault();
      var submit_form_url = $(this).attr('action');
      var $method_is = "POST";
      formData = new FormData($(this)[0]);
      $(".alert-success-modal").css("display","none");
      $(".alert-danger-modal").css("display","none");
      files = $('#profile_img')[0].files;


      if(formData.get("method_type") == "edit")
      {
          $method_is = "PUT";
          var data = {
             title : $("input[name='title']").val()
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
                else {
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
           formData.append('image',files[0]);
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
    var url_delete = '{{url("/dashboard/category")}}'+"/"+id;
    $.ajax({url: url_delete ,type: "DELETE", success: function(result){
            var result = JSON.parse(result);
            if(result.sucess)
            {
              window.location.href = '{{url("/dashboard/category")}}';
            }
    }});
  });
</script>
@endsection
