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
        @lang('site.booking_chat') @lang('site.between')   {{$transaction->trainer->name}} and  {{$transaction->user->name}}
    </div>
                <ul class="list-group card-list-group">
                  <li class="list-group-item py-4">
                    @foreach($transaction->chats as $chat)
                    <div class="d-flex">
                      <div>
                        @if(!empty($chat->user->image))
                        <span class="avatar mr-3" style="background-image: url({{url($chat->user->image)}})"></span>
                        @else
                         <span class="avatar mr-3">
                           @php   $words = explode(" ", $chat->user->name);
                               $output= "";
                               foreach ($words as $w) {
                                  $output .= $w[0];
                                }
                                echo $output;
                          @endphp</span>
                        @endif
                      </div>
                      <div class="flex-fill">
                        <div>
                          <small class="float-right text-muted">{{$chat->created_at}}</small>
                          <h4>{{$chat->user->name}}</h4>
                        </div>
                        <div>
                          {{$chat->msg}}
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </li>
                </ul>
              </div>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">@lang('site.programme_calendar')</h3>
                </div>
                <div class="card-body border-bottom py-3">

                    <div id='calendar'></div>

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
