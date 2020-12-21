@extends('dashboard.layouts.master')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Client Data - {{$transaction->user->name}}</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="d-flex">

    </div>
    <div class="table-responsive">
      <table class="table card-table table-vcenter text-nowrap datatable">
        <tbody>

          <tr>
            <tr>
              <th> @lang('site.transfer_num')</th><td>
              {{$transaction->transaction_num}}
              </td>
            </tr>
          </tr>
          <tr>
            <th>Name</th>
            <td>
              @if($transaction->user != null)
                  <span>
                  {{$transaction->user->name}}
                  </span>

              @endif
            </td>
          </tr>
          <tr>
            <th>Email</th>
            <td>
              @if($transaction->user != null)
                  <span>
                  {{$transaction->user->email}}
                  </span>

              @endif
            </td>
          </tr>
          <tr>
            <th>Subscribe package</th>
            <td>
              @if($transaction->package != null)
                <span>
                {{$transaction->package->package_name}}
                </span>

              @endif
            </td>
          </tr>
          <tr>
            <th>Client Type</th>
            <td>
              @php  $join_date = date('Y-m-d',strtotime($transaction->transfer_date));   @endphp
              @if($transaction->package->package_duration_type == "day")
                @php   $expired_date = date('Y-m-d', strtotime($join_date. ' + '.$transaction->package->package_duration.' days'));   @endphp
                @if($expired_date < date("Y-m-d"))
                   <span>expired client </span>
                @elseif($expired_date >= date("Y-m-d"))
                   <span>progress  client </span>
                @endif

             @elseif($transaction->package->package_duration_type == "week")
                 @php   $expired_date = date('Y-m-d', strtotime($join_date. ' + '.$transaction->package->package_duration.' weeks'));   @endphp
                 @if($expired_date < date("Y-m-d"))
                    <span>expired client </span>
                 @elseif($expired_date >= date("Y-m-d"))
                    <span>progress  client </span>
                 @endif
             @elseif($transaction->package->package_duration_type == "month")
                  @php   $expired_date = date('Y-m-d', strtotime($join_date. ' + '.$transaction->package->package_duration.' months'));   @endphp
                  @if($expired_date < date("Y-m-d"))
                     <span>expired client </span>
                  @elseif($expired_date >= date("Y-m-d"))
                     <span>progress  client </span>
                  @endif
             @endif
            </td>
          </tr>
          <tr>
            <th>Join date</th>
            <td>
              <span>
                {{$join_date}}
              </span>
            </td>
          </tr>
          <tr>
            <th>Expire date</th>
            <td>
              <span>
                {{$expired_date}}
              </span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Trainer chat</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="d-flex">

    </div>
    <div class="card">
      <div class="row g-0">
        <div class="col-12 col-lg-12 col-xl-12">
          <div class="py-2 px-4 border-bottom d-none d-lg-block">
            <div class="d-flex align-items-center py-1">
              <div class="position-relative">
                <img src="{{url('/')}}{{$transaction->trainer->image}}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
              </div>
              <div class="flex-grow-1 pl-3">
                <strong>{{$transaction->trainer->name}}</strong>
                <div class="text-muted small is_typing" style="display:none"><em>Typing...</em></div>

              </div>
              <div>

              </div>
            </div>
          </div>

          <div class="position-relative">
            @php  $main_chat_cls = "chat_".$transaction->trainer->id."_".$transaction->user->id;  @endphp
            <div class="chat-messages p-4 {{$main_chat_cls}}">
             @php  $chats = \App\Chat::whereraw("(from_user ='".$transaction->trainer->id."'  and  to_user='".$transaction->user->id."') or (from_user ='".$transaction->user->id."'  and to_user='".$transaction->trainer->id."')")->where("booking_id",$transaction->id)->orderby("created_at","asc")->get();  @endphp
              @foreach($chats as $chat)
                @if($chat->from_user == $transaction->trainer->id)
                <div class="chat-message-left pb-4">
                  <div>
                    <img src="{{url('/')}}{{$chat->user->image}}" class="rounded-circle mr-1" alt="{{$chat->user->name}}" width="40" height="40">
                    <div class="text-muted small text-nowrap mt-2">{{ date("Y-m-d H:m" , strtotime($chat->created_at)) }}</div>
                  </div>
                  <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                    <div class="font-weight-bold mb-1">{{$chat->user->name}}</div>
                    {{$chat->msg}}
                  </div>
                </div>
                @else
                <div class="chat-message-right pb-4">
                  <div>
                    <span class="avatar avatar-xl" style="width: 3rem;height: 3rem;font-size: 1rem;">
                      @php   $words = explode(" ", $chat->user->name);
                            $output= "";
                            foreach ($words as $w) {
                               $output .= $w[0];
                             }
                             echo $output;
                       @endphp
                    </span>
                    <div class="text-muted small text-nowrap mt-2">{{ date("Y-m-d H:m" , strtotime($chat->created_at)) }}</div>
                  </div>
                  <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                    <div class="font-weight-bold mb-1">{{$chat->user->name}}</div>
                    {{$chat->msg}}
                  </div>
                </div>

                @endif


              @endforeach

            </div>
          </div>
          <div class="flex-grow-0 py-3 px-4 border-top">
          <div class="input-group">
            <input type="hidden" name="sender" value="{{$transaction->trainer->id}}" />
            <input type="hidden" name="receiver" value="{{$transaction->user->id}}" />
            <input type="hidden" name="booking" value="{{$transaction->id}}" />
            <input type="hidden" name="submit_form_url" value="{{ url('dashboard/chat/save') }}" />
            <input type="hidden" name="viewer_type" value="trainer" />
            <input type="hidden" name="sender_img" value="{{url('/')}}{{$transaction->trainer->image}}" />
            <input type="hidden" name="sender_name" value="{{$transaction->trainer->name}}" />
            <input type="text" class="form-control chat_text_box" placeholder="Type your message">
            <button class="btn btn-info"><i class="fa fa-paperclip attachment" aria-hidden="true"></i></button>
            <button class="btn btn-primary send_btn">Send</button>
          </div>

        </div>



        </div>
      </div>
    </div>

  </div>
</div>
<div class="modal modal-blur fade" id="show_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Copy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger alert-danger-modal" style="display:none">
        </div>
        <div class="alert alert-success alert-success-modal" style="display:none">
        </div>
        <form action="{{ url('dashboard/trainers/programmes/copy') }}" method="post" class="form_submit_model">
          <div class="row">

            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">Copy to transaction</label>
                <select name="to_transaction" class="form-control">
                  @php  $trans_to = \App\Transactions::where("id","!=",$transaction->id)->get();  @endphp
                  @foreach($trans_to as $t_to)
                    <option value="{{$t_to->id}}">{{$t_to->transaction_num}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <input type="hidden" name="transaction_copy_num" value="{{$transaction->id}}" />
          <input type="hidden" name="copy_type" value="programme" />
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>

    </div>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Programme design ({{$transaction->package->package_duration_type}})s</h3>
    <button type="button" class="btn btn-primary copy_btn">Copy Programme design</button>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="d-flex">

    </div>
      @php
        if($transaction->package->package_duration_type == "day")
          $days = $transaction->package->package_duration;
        elseif($transaction->package->package_duration_type == "week")
          $days = $transaction->package->package_duration ;
        elseif($transaction->package->package_duration_type == "month")
          $days = $transaction->package->package_duration * 30;
      @endphp

      @php $i = 1;   @endphp
      @for($day = 1;$day<=$days;$day++)

        @if($i == 1)
          <div class="row days">
        @endif
        @if($i%9 == 0 && $i !=1)
          @php $i = 1;   @endphp
          </div>
          <div class="row days">
        @endif
        <div class="col-lg-1">
          <a href='{{url("dashboard/trainers/programmes/days")}}/{{$day}}/{{$transaction->id}}/{{$transaction->package->id}}/{{$transaction->user->id}}'> Week {{$day}} </a>
        </div>
       @php $i++;   @endphp
      @endfor


  </div>
</div>
@endsection
@section('footerjscontent')
@if(Auth::user()->role->name=="Trainer")
<script src="{{ asset('js/socket.io.min.js') }}"></script>
<script src="{{ asset('js/chat.js') }}"></script>
@endif
<script type="text/javascript">
$(".copy_btn").on("click",function(){
  $('#show_modal').modal('show');
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
                    $(".alert-success-modal").html("تم نسخ البرنامج بنجاح");
                    $(".alert-success-modal").css("display","block");
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
</script>
@endsection
