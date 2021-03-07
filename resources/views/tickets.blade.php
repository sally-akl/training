@extends('layouts.app')

@section('content')
<!-- ==== Main content ==== -->
<main class="main-content ticket-page">
    <div class="container">
        <div class="ticket-content">
            <div class="ticket-txt">
                <div class="d-flex justify-content-between">
                    <h4>@lang('front.Tickethistory')</h4>
                    <a href="#" class="sec-btn">@lang('front.RaiseATicket')</a>
                </div>
                <p class="t_1">@lang('front.t_1') </p>
            </div>
            @foreach ($pending_tickets as $key => $crequest)
            <div class="main-card with-brd issue-block">
                <div class="card-content">
                    <div class="d-sm-flex justify-content-between">
                        <div class="ticket-id">
                            <span>@lang('front.TICETID')</span>
                            <span>#{{$crequest->id}}</span>
                        </div>
                        <div class="ticket-meta d-flex">
                            <span>{{date("D,M d, Y, g:i a",strtotime($crequest->send_date))}}</span>
                            @if($crequest->status == "pending")
                              <small>@lang('front.Pending')</small>
                            @elseif($crequest->status == "in progress")
                              <small>@lang('front.Inprogress')</small>
                            @endif
                            <i class="fas fa-redo-alt"></i>
                        </div>
                    </div>
                    <h4><a href="{{url("/")}}/ticket/{{$crequest->id}}/{{$crequest->subject}}" style="color:#fff">{{$crequest->subject}}</a></h4>
                    <p>{{$crequest->msg}}</p>
                    <small class="sub-txt">@lang('front.t_2')</small>
                </div>
            </div>
            @endforeach
            <div class="resolved-blocks">
                <h3>Resolved</h3>
                @foreach ($solved_tickets as $key => $crequest)
                <div class="main-card with-brd issue-block">
                    <div class="card-content">
                        <div class="d-sm-flex justify-content-between">
                            <div class="ticket-id">
                                <span>@lang('front.TICETID')</span>
                                <span>#{{$crequest->id}}</span>
                            </div>
                            <div class="ticket-meta d-flex">
                                <span>{{date("D,M d, Y, g:i a",strtotime($crequest->send_date))}}</span>
                                <small>@lang('front.Resolved')</small>
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                        <h4><a href="{{url("/")}}/ticket/{{$crequest->id}}/{{$crequest->subject}}" style="color:#fff">{{$crequest->subject}}</a></h4>
                        <p>{{$crequest->msg}}</p>
                        <small class="sub-txt">@lang('front.t_3')</small>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="add_edit_modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">@lang('front.AddTicket')</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
            </button>
          </div>
          <div class="alert alert-danger alert-danger-modal" style="display:none">

          </div>
          <div class="alert alert-success alert-success-modal" style="display:none">

          </div>
          <form method="POST" action="{{ url('addticket') }}" class="form_submit_model" enctype="multipart/form-data">

            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                  <div class="mb-3">
                    <label class="form-label">@lang('front.Subject')</label>
                    <input type="text" class="form-control" name="add_subject">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="mb-3">
                    <label class="form-label">@lang('front.Message')</label>
                    <textarea class="form-control desc" rows="3" name="add_msg"></textarea>
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              @if(session()->has('locale') && session()->get('locale') =='ar')
              <button type="submit" class="btn btn-primary" style="background-color: #ea380f !important;border: 1px solid #ea380f !important;">@lang('front.AddTicket')</button>
              <a href="#" class="btn btn-link link-secondary" data-dismiss="modal">
                @lang('front.Cancel')
              </a>


              @else
              <a href="#" class="btn btn-link link-secondary" data-dismiss="modal">
                @lang('front.Cancel')
              </a>
              <button type="submit" class="btn btn-primary" style="background-color: #ea380f !important;border: 1px solid #ea380f !important;">@lang('front.AddTicket')</button>

              @endif

            </div>
          </form>
        </div>
      </div>
    </div>
</main>

@endsection
@section('footerjscontent')
<script type="text/javascript">
   $(".sec-btn").on("click",function(){
      $('#add_edit_modal').modal('show');
   });
   $(".form_submit_model").submit(function(e){

       e.preventDefault();
       var submit_form_url = $(this).attr('action');
       var $method_is = "POST";
       formData = new FormData($(this)[0]);
       $(".alert-success-modal").css("display","none");
       $(".alert-danger-modal").css("display","none");

       $.ajax({
          url: submit_form_url,
          type: $method_is,
          data: formData,
          async: false,
          dataType: 'json',
          success: function (response) {
            if(response.sucess)
            {
              $(".alert-success-modal").html(response.sucess_text);
              $(".alert-success-modal").css("display","block");
              $('#add_edit_modal').modal('hide');
              window.location.href = '{{url("/tickets")}}';
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
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
</script>
@endsection
