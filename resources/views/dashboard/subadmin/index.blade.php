@extends('dashboard.layouts.master')
@section('content')
@if(count($customers)==0)
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
    <h3 class="card-title">@lang('site.sub_admins')</h3>
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
               @lang('site.name')
            </th>
            <th>
               @lang('site.email')
            </th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          	@foreach ($customers as $key => $user)
          <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td class="text-right">
              <a class='btn btn-info btn-xs edit_btn' bt-data="{{$user->id}}">
    						<i class="far fa-edit"></i>
    					</a>
    					<a href="#" class="btn btn-danger btn-xs delete_btn"  bt-data="{{$user->id}}">
    						<i class="far fa-trash-alt"></i>
    					</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex align-items-center">
      {{$customers->links('dashboard.vendor.pagination.default')}}
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
      <form method="POST" action="{{ url('dashboard/subadmin') }}" class="form_submit_model">
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">@lang('site.name')</label>
                <input type="text" class="form-control" name="name">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">@lang('site.email')</label>
                <input type="email" class="form-control" name="email">
              </div>
            </div>
          </div>
          <div class="row password_div">
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">@lang('site.password')</label>
                <input type="password" class="form-control" name="password">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">@lang('site.re_password')</label>
                <input type="password" class="form-control" name="password_confirmation">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4">
              <div class="mb-3">
                <label>Manage Categories</label>
                <input type="checkbox" name="permssions[]" value="manage_cat">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="mb-3">
                <label>Manage Sub-admin</label>
                <input type="checkbox" name="permssions[]" value="manage_subadmn">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="mb-3">
                <label>Manage Booking</label>
                <input type="checkbox" name="permssions[]" value="manage_booking">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4">
              <div class="mb-3">
                <label>Manage Users</label>
                <input type="checkbox" name="permssions[]" value="manage_user">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="mb-3">
                <label>Manage Trainers</label>
                <input type="checkbox" name="permssions[]" value="manage_trainers">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="mb-3">
                <label>Manage packages</label>
                <input type="checkbox" name="permssions[]" value="manage_packages">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4">
              <div class="mb-3">
                <label>View Sales</label>
                <input type="checkbox" name="permssions[]" value="view_sales">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="mb-3">
                <label>Manage Support</label>
                <input type="checkbox" name="permssions[]" value="manage_support">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="mb-3">
                <label>Manange Notfications</label>
                <input type="checkbox" name="permssions[]" value="manange_notfications">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4">
              <div class="mb-3">
                <label>Manage Program design</label>
                <input type="checkbox" name="permssions[]" value="manage_program_design">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="mb-3">
                <label>Dashboard</label>
                <input type="checkbox" name="permssions[]" value="manage_dashboard">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="mb-3">
                <label>Manange Muscles</label>
                <input type="checkbox" name="permssions[]" value="manange_muscles">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4">
              <div class="mb-3">
                <label>Manage  Exercise Type</label>
                <input type="checkbox" name="permssions[]" value="manage_exercisetype">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="mb-3">
                <label>Manage Equipment</label>
                <input type="checkbox" name="permssions[]" value="manage_equipment">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="mb-3">
                <label>Manange Mechanics Type</label>
                <input type="checkbox" name="permssions[]" value="manange_mechanicstype">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4">
              <div class="mb-3">
                <label>Manage  Level</label>
                <input type="checkbox" name="permssions[]" value="manage_level">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="mb-3">
                      <label>Manage  Questions</label>
                <input type="checkbox" name="permssions[]" value="manange_questions">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="mb-3">
                      <label>Manage Ready plan</label>
                <input type="checkbox" name="permssions[]" value="manage_ready_plan">
              </div>
            </div>
          </div>

          <input type="hidden" name="method_type" value="add" />
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
  var _sucess = function(response)
  {
    if(response.sucess)
    {
      $(".alert-success-modal").html(response.sucess_text);
      $(".alert-success-modal").css("display","block");
      $('#add_edit_modal').modal('hide');
      $("input[name='method_type']").val("add");
      window.location.href = '{{url("/dashboard/subadmin")}}';
    }
    else
    {
      var $error_text = "";
      var errors = response.errors;

      $.each(errors, function (key, value) {
        $error_text +=value+"<br>";
      });

      $(".alert-danger-modal").html($error_text);
      $(".alert-danger-modal").css("display","block");

    }

  }
  $(".edit_btn").on("click",function()
  {
      $(".password_div").css("display","none");
      var id = $(this).attr("bt-data");
      var url_edit = '{{url("/dashboard/subadmin")}}'+"/"+id;
      $(".form_submit_model").attr("action",url_edit);
      $.ajax({
          url: '{{url("/dashboard/subadmin")}}'+"/"+id+"/edit",
          type: 'GET',
          dataType: 'json',
          success: function (response) {
            $("input[name='name']").val(response.name);
            $("input[name='email']").val(response.email);
            $("input[name='method_type']").val("edit");
            $('#add_edit_modal').modal('show');
            for(var j=0;j<response.userroles.length;j++)
            {
              var val = response.userroles[j];
              $("input[name='permssions[]']").each(function(){

                  console.log(val.permssion_name);
                  if(val.permssion_name == $(this).val())
                  {
                    $(this).attr('checked', 'checked')
                  }

              });

            }


          },
      });

        return false;
  });
  $(".add_btn").on("click",function(){
      $(".password_div").css("display","flex");
      $("input[name='method_type']").val("add");
      $(".form_submit_model").attr("action",'{{url("/dashboard/subadmin")}}');
      $('#add_edit_modal').modal('show');
      return false;
  });
  $(".form_submit_model").submit(function(e){

      e.preventDefault();
      var submit_form_url = $(this).attr('action');
      var $method_is = "POST";
      var formData = new FormData($(this)[0]);
      $(".alert-success-modal").css("display","none");
      $(".alert-danger-modal").css("display","none");



      if(formData.get("method_type") == "edit")
      {
          $method_is = "PUT";
          var permssions = new Array();
          $("input[name='permssions[]']:checked:enabled").each(function () {
             permssions.push($(this).val());
          });
          var data = {
            name : $("input[name='name']").val(),
            email : $("input[name='email']").val(),
            permssions : permssions
          };
          $.ajax({
              type: $method_is,
              url: submit_form_url,
              contentType: 'application/json',
              dataType: 'json',
              data: JSON.stringify(data),
              success: function (response) {
                _sucess(response);
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
                    _sucess(response);
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
    var url_delete = '{{url("/dashboard/subadmin")}}'+"/"+id;
    $.ajax({url: url_delete ,type: "DELETE", success: function(result){
            var result = JSON.parse(result);
            if(result.sucess)
            {
              window.location.href = '{{url("/dashboard/subadmin")}}';
            }
    }});
  });
</script>
@endsection
