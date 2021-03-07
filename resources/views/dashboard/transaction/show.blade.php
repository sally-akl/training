@extends('dashboard.layouts.master')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">@lang('site.booking#'){{$transaction->transaction_num}}</h3>
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
            <th> @lang('site.trainer_name')</th>
            <td>
              @if($transaction->trainer != null)
                <span>
                {{$transaction->trainer->name}}
              </span>
            @endif</td>
          </tr>
          <tr>
            <th>@lang('site.client_name')</th>
            <td>
              @if($transaction->user != null)
                  <span>
                  {{$transaction->user->name}}
                  </span>

              @endif
            </td>
          </tr>
          <tr>
            <th>@lang('site.pack_name')</th>
            <td>
              @if($transaction->package != null)
                <span>
                {{$transaction->package->package_name}}
                </span>

              @endif
            </td>
          </tr>
          <tr>
            <th> @lang('site.date_start')</th><td>@php  $join_date = date('Y-m-d',strtotime($transaction->transfer_date));   @endphp
            {{$join_date}}</td>
          </tr>
          <tr>
            <th>@lang('site.date_end')</th><td>  @if($transaction->package != null)
                @if($transaction->package->package_duration_type == "day")
                  <span>
                    {{date('Y-m-d', strtotime($join_date. ' + '.$transaction->package->package_duration.' days'))}}
                  </span>
                @elseif($transaction->package->package_duration_type == "week")
                  <span>
                    {{date('Y-m-d', strtotime($join_date. ' + '.$transaction->package->package_duration.' weeks'))}}
                  </span>
                @elseif($transaction->package->package_duration_type == "month")
                  <span>
                      {{date('Y-m-d', strtotime($join_date. ' + '.$transaction->package->package_duration.' months'))}}
                  </span>
                @endif
              @endif</td>
          </tr>
          <tr>
            <th> @lang('site.amount')</th><td>{{$transaction->amount}}$</td>
          </tr>
          <tr>
            <th> @lang('site.payment_method')</th><td>{{$transaction->transfer_payment_type	}}</td>
          </tr>
          <tr>
            <th> @lang('site.is_payable')</th>
            <td>
              @if($transaction->is_payable == 1)
                Yes
              @else
                No
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
    <h3 class="card-title">@lang('site.package_details')</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="d-flex">

    </div>
    <div class="table-responsive">
      <table class="table card-table table-vcenter text-nowrap datatable">
        <tbody>

          <tr>
            <th> @lang('site.pack_name')</th><td>{{$transaction->package->package_name}}</td>
          </tr>
          <tr>
            <th>@lang('site.pack_duration')</th><td>{{$transaction->package->package_duration}}  {{$transaction->package->package_duration_type}}</td>
          </tr>
          <tr>
            <th>@lang('site.pack_price')</th><td>{{$transaction->package->package_price}}$</td>
          </tr>
          <tr>
            <th> @lang('site.pack_type')</th><td>{{$transaction->package->package_type}}</td>
          </tr>
          <tr>
            <th>@lang('site.trainer_name')</th><td>{{$transaction->package->user->name}}</td>
          </tr>
          <tr>
            <th> @lang('site.pack_desc')</th><td>{{$transaction->package->package_desc}}</td>
          </tr>
          <tr>
            <th> @lang('site.pack_quest')</th><td>{{$transaction->package->package_questionaire	}}</td>
          </tr>
          <tr>
            <th> @lang('site.pack_status')</th><td>{{$transaction->package->package_status	}}</td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="row">
   <div class="col-lg-6">
     <div class="card">
       <div class="card-header">
         <h3 class="card-title">@lang('site.trainer_details')</h3>
       </div>
       <div class="card-body text-center">
         <div class="mb-3">
           <span class="avatar avatar-xl" style="background-image: url({{url($transaction->trainer->image)}})"></span>
         </div>
         <div class="card-title mb-1">{{$transaction->trainer->name}}</div>
         <div class="text-muted">{{$transaction->trainer->email}}</div>
         <div class="text-muted">{{$transaction->trainer->desc}}</div>
       </div>
     </div>
   </div>
   <div class="col-lg-6">
     <div class="card">
       <div class="card-header">
         <h3 class="card-title">@lang('site.user_details')</h3>
       </div>
       <div class="card-body text-center">
         <div class="mb-3">
           <span class="avatar avatar-xl">
             @php   $words = explode(" ", $transaction->user->name);
                   $output= "";
                   foreach ($words as $w) {
                      $output .= $w[0];
                    }
                    echo $output;
              @endphp

           </span>
         </div>
         <div class="card-title mb-1">{{$transaction->user->name}}</div>
         <div class="text-muted">{{$transaction->user->email}}</div>
       </div>
     </div>
   </div>
</div>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">@lang('site.booking_chat') @lang('site.between')   {{$transaction->trainer->name}} and  {{$transaction->user->name}}</h3>
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
             @php  $chats = \App\Chat::whereraw("((from_user ='".$transaction->trainer->id."'  and  to_user='".$transaction->user->id."') or (from_user ='".$transaction->user->id."'  and to_user='".$transaction->trainer->id."'))")->where("booking_id",$transaction->id)->orderby("created_at","asc")->get();  @endphp
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



        </div>
      </div>
    </div>

  </div>
</div>

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Plan design</h3>
                </div>
                <div class="card-body border-bottom py-3">

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
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
 var calendarEl = document.getElementById('calendar');
 var calendar = new FullCalendar.Calendar(calendarEl, {
   headerToolbar: {
     left: 'prev,next today',
     center: 'title',
     right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
   },
   initialDate: '{{date("Y-m-d")}}',
   navLinks: true, // can click day/week names to navigate views
   businessHours: true, // display business hours
   editable: true,
   selectable: true,
   eventSources: [
     {
         url: '{{ url("dashboard/bookings/programme") }}/{{$transaction->id}}',
         method: 'POST',
         extraParams: {
             "_token": "{{ csrf_token() }}",
             "ptype":"exercises"
         },
         failure: function() {
           alert('there was an error while fetching events!');
         },
      },
      {
          url: '{{ url("dashboard/bookings/programme") }}/{{$transaction->id}}',
          method: 'POST',
          extraParams: {
              "_token": "{{ csrf_token() }}",
              "ptype":"dietary meals"
          },
          failure: function() {
            alert('there was an error while fetching events!');
          },
          color: 'red',
          textColor: 'white'
       },
       {
           url: '{{ url("dashboard/bookings/programme") }}/{{$transaction->id}}',
           method: 'POST',
           extraParams: {
               "_token": "{{ csrf_token() }}",
               "ptype":"food supplements"
           },
           failure: function() {
             alert('there was an error while fetching events!');
           },
           color: 'green',
           textColor: 'white'
        },
]

 });

 calendar.render();
});
</script>
@endsection
