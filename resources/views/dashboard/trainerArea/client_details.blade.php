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

              </div>
              <div>

              </div>
            </div>
          </div>

          <div class="position-relative">
            <div class="chat-messages p-4">
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
            <input type="text" class="form-control" placeholder="Type your message">
            <button class="btn btn-primary">Send</button>
          </div>
        </div>



        </div>
      </div>
    </div>

  </div>
</div>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Programme design</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="d-flex">

    </div>
      @php
        if($transaction->package->package_duration_type == "day")
          $days = $transaction->package->package_duration;
        elseif($transaction->package->package_duration_type == "week")
          $days = $transaction->package->package_duration * 7;
        elseif($transaction->package->package_duration_type == "month")
          $days = $transaction->package->package_duration * 30;
      @endphp

      @php $i = 1;   @endphp
      @for($day = 1;$day<=$days;$day++)

        @if($i == 1)
          <div class="row days">
        @endif
        @if($i%8 == 0 && $i !=1)
          @php $i = 1;   @endphp
          </div>
          <div class="row days">
        @endif
        <div class="col-lg-1">
          <a href='{{url("dashboard/trainers/programmes/design")}}/{{$day}}/{{$transaction->package->id}}/{{$transaction->user->id}}'> Day {{$day}} </a>
        </div>
       @php $i++;   @endphp
      @endfor


  </div>
</div>
@endsection
@section('footerjscontent')
<script type="text/javascript">
</script>
@endsection
