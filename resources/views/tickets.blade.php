@extends('layouts.app')

@section('content')
<!-- ==== Main content ==== -->
<main class="main-content ticket-page">
    <div class="container">
        <div class="ticket-content">
            <div class="ticket-txt">
                <div class="d-flex justify-content-between">
                    <h4>Ticket history</h4>
                    <a href="#" class="sec-btn">Raise A Ticket</a>
                </div>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea </p>
            </div>
            @foreach ($pending_tickets as $key => $crequest)
            <div class="main-card with-brd issue-block">
                <div class="card-content">
                    <div class="d-sm-flex justify-content-between">
                        <div class="ticket-id">
                            <span>TICET ID</span>
                            <span>#{{$crequest->id}}</span>
                        </div>
                        <div class="ticket-meta d-flex">
                            <span>{{date("D,M d, Y, g:i a",strtotime($crequest->send_date))}}</span>
                            @if($crequest->status == "pending")
                              <small>Pending</small>
                            @elseif($crequest->status == "in progress")
                              <small>In progress</small>
                            @endif
                            <i class="fas fa-redo-alt"></i>
                        </div>
                    </div>
                    <h4><a href="{{url("/")}}/ticket/{{$crequest->id}}/{{$crequest->subject}}" style="color:#fff">{{$crequest->subject}}</a></h4>
                    <p>{{$crequest->msg}}</p>
                    <small class="sub-txt">WE ARE LOOKING INTO your issue, hope to resolve THE ISSUE AS SOON AS POSSIBLE</small>
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
                                <span>TICET ID</span>
                                <span>#{{$crequest->id}}</span>
                            </div>
                            <div class="ticket-meta d-flex">
                                <span>{{date("D,M d, Y, g:i a",strtotime($crequest->send_date))}}</span>
                                <small>Resolved</small>
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                        <h4><a href="{{url("/")}}/ticket/{{$crequest->id}}/{{$crequest->subject}}" style="color:#fff">{{$crequest->subject}}</a></h4>
                        <p>{{$crequest->msg}}</p>
                        <small class="sub-txt">Hope YOU ARE Satisfy with the solution</small>
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
            <h5 class="modal-title">Add Ticket</h5>
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
                    <label class="form-label">Subject</label>
                    <input type="text" class="form-control" name="add_subject">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="mb-3">
                    <label class="form-label">Message</label>
                    <textarea class="form-control desc" rows="3" name="add_msg"></textarea>
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <a href="#" class="btn btn-link link-secondary" data-dismiss="modal">
                @lang('site.cancel')
              </a>
              <button type="submit" class="btn btn-primary" style="background-color: #ea380f !important;border: 1px solid #ea380f !important;">Add Ticket</button>
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
