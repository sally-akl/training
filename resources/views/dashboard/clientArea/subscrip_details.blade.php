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
            <tr>
              <th>Subscribe package</th><td>
              {{$transaction->package->package_name}}
              </td>
            </tr>
          </tr>
          <tr>
            <tr>
              <th>Start date</th><td>
                @php  $join_date = date('Y-m-d',strtotime($transaction->transfer_date));   @endphp
                {{$join_date}}
              </td>
            </tr>
          </tr>
          <tr>
            <tr>
              <th>Expire date</th><td>
                @if($transaction->package->package_duration_type == "day")
                  @php   $expired_date = date('Y-m-d', strtotime($join_date. ' + '.$transaction->package->package_duration.' days'));   @endphp
                @elseif($transaction->package->package_duration_type == "week")
                  @php   $expired_date = date('Y-m-d', strtotime($join_date. ' + '.$transaction->package->package_duration.' weeks'));   @endphp
                @elseif($transaction->package->package_duration_type == "month")
                  @php   $expired_date = date('Y-m-d', strtotime($join_date. ' + '.$transaction->package->package_duration.' months'));   @endphp
                @endif
                {{$expired_date}}
              </td>
            </tr>
          </tr>
          <tr>
            <th>Trainer Name</th>
            <td>
              @if($transaction->trainer != null)
                  <span>
                  {{$transaction->trainer->name}}
                  </span>

              @endif
            </td>
          </tr>
          <tr>
            <th>Trainer Email</th>
            <td>
              @if($transaction->trainer != null)
                  <span>
                  {{$transaction->trainer->email}}
                  </span>

              @endif
            </td>
          </tr>
          <tr>
            <th>Trainer Description</th>
            <td>
              @if($transaction->trainer != null)
                  <span>
                  {{$transaction->trainer->desc}}
                  </span>

              @endif
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">User chat</h3>
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
                <span class="avatar avatar-xl" style="width: 3rem;height: 3rem;font-size: 1rem;">
                  @php   $words = explode(" ", $transaction->user->name);
                        $output= "";
                        foreach ($words as $w) {
                           $output .= $w[0];
                         }
                         echo $output;
                   @endphp
                </span>
              </div>
              <div class="flex-grow-1 pl-3">
                <strong>{{$transaction->user->name}}</strong>
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
                @if($chat->from_user == $transaction->user->id)
                <div class="chat-message-left pb-4">
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
                @else
                <div class="chat-message-right pb-4">
                  <div>
                  <img src="{{url('/')}}{{$chat->user->image}}" class="rounded-circle mr-1" alt="{{$chat->user->name}}" width="40" height="40">
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
            <input type="hidden" name="sender" value="{{$transaction->user->id}}" />
            <input type="hidden" name="receiver" value="{{$transaction->trainer->id}}" />
            <input type="hidden" name="booking" value="{{$transaction->id}}" />
            <input type="hidden" name="submit_form_url" value="{{ url('dashboard/chat/save') }}" />
            <input type="hidden" name="viewer_type" value="user" />
            <input type="hidden" name="sender_img" value="{{$output}}" />
            <input type="hidden" name="sender_name" value="{{$transaction->user->name}}" />
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
@endsection
@section('footerjscontent')
@if(Auth::user()->role->name=="user")
<script src="{{ asset('js/socket.io.min.js') }}"></script>
<script src="{{ asset('js/chat.js') }}"></script>
@endif
<script type="text/javascript">
</script>
@endsection
