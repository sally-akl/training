@extends('dashboard.layouts.master')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Trainer Clients</h3>
    <div class="search">
         <button type="button" class="btn search_btn"><i class="fa fa-search" aria-hidden="true"></i> {{ __('site.search') }} </button>
    </div>
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
            <th>Phone</th>
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
              <td>{{$user->phone}}</td>
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
                <a class='btn  btn-xs card-btn' href="{{url('/dashboard/trainersarea/clients/details')}}/{{$user->trans_id}}">
                  Enter
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
<div class="modal modal-blur fade" id="serach_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">@lang('site.search')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
        </button>
      </div>
      <form method="GET" action="{{ url('dashboard/trainers/clients') }}" >
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email">
          </div>

            <div class="mb-3">
              <label class="form-label">Client Status</label>
              <select name="client_status" class="form-control">
                <option value="expired">expired client</option>
                <option value="progress">progress  client </option>
              </select>
            </div>

        </div>
        <input type="hidden" name="search" value="search" />
        <div class="modal-footer">
          <a href="#" class="btn btn-link link-secondary" data-dismiss="modal">
            @lang('site.cancel')
          </a>
          <button type="submit" class="btn btn-primary">{{ __('site.search') }} </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('footerjscontent')
<script type="text/javascript">
$(".search_btn").on("click",function(){
    $('#serach_modal').modal('show');
    return false;
});
</script>
@endsection
