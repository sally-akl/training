@extends('dashboard.layouts.master')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Details of request</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="d-flex">

    </div>
    <div class="table-responsive">
      <table class="table card-table table-vcenter text-nowrap datatable">
        <tbody>

          <tr>
            <th>@lang('site.client_name')</th><td>
               @if(date("Y-m-d",strtotime($crequest->send_date)) >= date('Y-m-d',strtotime("last Monday")) &&  date("Y-m-d",strtotime($crequest->send_date)) <= date('Y-m-d'))
                   <span class="badge bg-azure">New</span>
              @endif
               @if($crequest->user != null)
                 {{$crequest->user->name}}
               @endif
             </td>
          </tr>
          <tr>
            <th> @lang('site.send_date')</th><td>{{date("Y-m-d",strtotime($crequest->send_date))}}</td>
          </tr>
          <tr>
            <th> @lang('site.status')</th><td>{{$crequest->status}}</td>
          </tr>
          <tr>
            <th>  @lang('site.msg')</th><td>{{$crequest->msg}}</td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Timeline of support messages</h3>
  </div>
  <div class="card-body">
    <ul class="list list-timeline">

      @foreach($messages as $message)
      <li>
        <div class="list-timeline-icon bg-success"><!-- SVG icon code -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M5 12l5 5l10 -10"></path></svg>
        </div>
        <div class="list-timeline-content">
          <div class="list-timeline-time">{{date("Y-m-d",strtotime($message->send_date))}}</div>
          <p class="list-timeline-title">{{$message->msg}}</p>
          <p class="text-muted">From :
            @if($message->user != null)
               {{$message->user->name}}
            @endif
           </p>
        </div>
      </li>
      @endforeach
    </ul>
  </div>
</div>


<div class="card">
  <div class="card-header">
    <h3 class="card-title">Send Message To
       @if($client != null)
          {{$client->name}}
       @endif
     </h3>
  </div>
  <div class="card-body">
    <div class="alert alert-danger alert-danger-modal" style="display:none">

    </div>
    <div class="alert alert-success alert-success-modal" style="display:none">

    </div>
    <form method="POST" action="{{ url('dashboard/messages/send') }}" class="form_submit_model" enctype="multipart/form-data">
         <div class="row">
           <div class="col-lg-12">
             <div class="mb-3">
               <label class="form-label">@lang('site.msg')</label>
               <textarea class="form-control user_body" rows="3" name="user_body"></textarea>
             </div>
           </div>
         </div>
         <input type="hidden" name="crequest" value="{{$id}}" />
         <button type="submit" class="btn btn-primary">+ {{ __('site.send') }} </button>
    </form>

  </div>
</div>
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
    window.location.href = '{{url("/dashboard/support")}}/{{$id}}';
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

$(".form_submit_model").submit(function(e){

    e.preventDefault();
    var submit_form_url = $(this).attr('action');
    var $method_is = "POST";
    var formData = new FormData($(this)[0]);
    $(".alert-success-modal").css("display","none");
    $(".alert-danger-modal").css("display","none");

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

      return false;
});

</script>
@endsection
