@extends('dashboard.layouts.master')
@section('content')
@if(count($notifications)==0)
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
                @lang('site.Notifications')
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
<div class="row">
    @include("dashboard.utility.sucess_message")
    @foreach ($notifications as $key => $notify)

    <div class="col-xl-6">
              <div class="card">
                <div class="card-body">
                  <div class="row row-sm align-items-center">
                    <div class="col-auto">
                      <span class="avatar avatar-lg" >

                        @if($notify->user != null)
                          @php
                               $words = explode(" ", $notify->user->name);
                                $output= "";
                                foreach ($words as $w) {
                                   $output .= $w[0];
                                 }
                                 echo $output;
                           @endphp
                         @endif


                      </span>
                    </div>
                    <div class="col">
                      <h4 class="card-title m-0">
                        To :
                           @if($notify->user != null)
                              {{$notify->user->name}}
                           @endif

                      </h4>
                      <div class="text-muted">
                      Msg: {{$notify->msg}}
                      </div>
                      <div class="small mt-1">
                        Send Date :
                        @if($notify->send_date != null)
                          {{ date("Y-m-d", strtotime($notify->send_date))}}
                        @endif
                      </div>
                      <div class="small mt-1">
                        Is sent :
                             @if($notify->is_send == 1)
                                 <span class="badge bg-azure">Yes</span>
                             @else
                                 <span class="badge bg-red">No</span>
                             @endif
                      </div>
                    </div>
                    <div class="col-auto">
                    @if($notify->is_send == 0)
                      <a class='btn btn-sm btn-white d-none d-md-inline-block' href="{{url('/dashboard/notify/send')}}/{{$notify->id}}">
                         Send notifification
                      </a>
                     @endif
                    </div>
                    <div class="col-auto">
                      <div class="dropdown">
                        <button class="btn-options" type="button" data-toggle="dropdown">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="19" r="1"></circle><circle cx="12" cy="5" r="1"></circle></svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">

                          <a href="#" class="dropdown-item  delete_btn"  bt-data="{{$notify->id}}">
                             <i class="far fa-trash-alt"></i>  Delete
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

    @endforeach
</div>
<div class="row">
   <div class="col-md-12 col-xl-12">
     {{$notifications->links('dashboard.vendor.pagination.default')}}
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
      <form method="POST" action="{{ url('dashboard/notifications') }}" class="form_submit_model">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">@lang('site.client_name')</label>
            <select class="form-control" name="user">
              <option value="">@lang('site.select')</option>
              <option value="0">All</option>
              @foreach(\App\User::where("role_id",3)->get() as $customer)
               <option value="{{$customer->id}}">{{$customer->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">@lang('site.msg')</label>
              <textarea class="form-control notify_msg" rows="3" name="notify_msg"></textarea>
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
      window.location.href = '{{url("/dashboard/notifications")}}';
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

  $(".add_btn").on("click",function(){
      $("input[name='method_type']").val("add");
      $(".form_submit_model").attr("action",'{{url("/dashboard/notifications")}}');
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
    var url_delete = '{{url("/dashboard/notifications")}}'+"/"+id;
    $.ajax({url: url_delete ,type: "DELETE", success: function(result){
            var result = JSON.parse(result);
            if(result.sucess)
            {
              window.location.href = '{{url("/dashboard/notifications")}}';
            }
    }});
  });
</script>
@endsection
