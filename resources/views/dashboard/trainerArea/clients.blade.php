@extends('dashboard.layouts.master')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Trainer Clients</h3>
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
            <th>Email</th>
            <th>Subscribe package</th>
            <th>Client Type</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($customers as $key => $user)
          <tr>
            <td>

              <span class="avatar avatar-xl" >
                @php   $words = explode(" ", $user->name);
                      $output= "";
                      foreach ($words as $w) {
                         $output .= $w[0];
                       }
                       echo $output;
                 @endphp
              </span>

              </td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->package_name}}</td>
              <td>
               @php  $join_date = date('Y-m-d',strtotime($user->transfer_date));   @endphp
               @if($user->package_duration_type == "day")
                 @php   $expired_date = date('Y-m-d', strtotime($join_date. ' + '.$user->package_duration.' days'));   @endphp
                 @if($expired_date < date("Y-m-d"))
                    <span>expired client </span>
                 @elseif($expired_date >= date("Y-m-d"))
                    <span>progress  client </span>
                 @endif

              @elseif($user->package_duration_type == "week")
                  @php   $expired_date = date('Y-m-d', strtotime($join_date. ' + '.$user->package_duration.' weeks'));   @endphp
                  @if($expired_date < date("Y-m-d"))
                     <span>expired client </span>
                  @elseif($expired_date >= date("Y-m-d"))
                     <span>progress  client </span>
                  @endif
              @elseif($user->package_duration_type == "month")
                   @php   $expired_date = date('Y-m-d', strtotime($join_date. ' + '.$user->package_duration.' months'));   @endphp
                   @if($expired_date < date("Y-m-d"))
                      <span>expired client </span>
                   @elseif($expired_date >= date("Y-m-d"))
                      <span>progress  client </span>
                   @endif
              @endif

              </td>
              <td>
                <a class='btn  btn-xs card-btn' href="{{url('/dashboard/clients/details')}}/{{$user->trans_id}}">
                  Details
                </a>

              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex align-items-center">
      {{$customers->links('dashboard.vendor.pagination.default')}}
    </div>
  </div>
</div>
@endsection
@section('footerjscontent')
<script type="text/javascript">

</script>
@endsection
