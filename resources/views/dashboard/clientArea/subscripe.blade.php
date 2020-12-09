@extends('dashboard.layouts.master')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">My Subscriptions</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="d-flex">

    </div>
    <div class="table-responsive">

      <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
          <tr>

            <th></th>
            <th>Name</th>
            <th>Trainer</th>
            <th>Subscribe package</th>
            <th>Join Date</th>
            <th>End Date</th>
            <th>Amount</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($subscrips as $key => $sub)
          <tr>
            <td>{{$sub->user->name}}</td>
              <td>{{$sub->trainer->name}}</td>
              <td>{{$sub->package->package_name}}</td>
              <td>
               @php  $join_date = date('Y-m-d',strtotime($sub->transfer_date));   @endphp
               {{$join_date}}
              </td>
              <td>
                @if($sub->package->package_duration_type == "day")
                  @php   $expired_date = date('Y-m-d', strtotime($join_date. ' + '.$sub->package->package_duration.' days'));   @endphp
                @elseif($sub->package->package_duration_type == "week")
                  @php   $expired_date = date('Y-m-d', strtotime($join_date. ' + '.$sub->package->package_duration.' weeks'));   @endphp
                @elseif($sub->package->package_duration_type == "month")
                  @php   $expired_date = date('Y-m-d', strtotime($join_date. ' + '.$sub->package->package_duration.' months'));   @endphp
                @endif
                {{$expired_date}}
              </td>
              <td>
                {{$sub->amount}}
              </td>
              <td>
                <a class='btn  btn-xs card-btn' href="{{url('/dashboard/usersarea/subscrips/details')}}/{{$sub->id}}">
                  Details
                </a>

              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex align-items-center">
      {{$subscrips->links('dashboard.vendor.pagination.default')}}
    </div>
  </div>
</div>
@endsection
@section('footerjscontent')
<script type="text/javascript">

</script>
@endsection
