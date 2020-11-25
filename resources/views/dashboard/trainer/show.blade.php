@extends('dashboard.layouts.master')
@section('content')
<div class="page-header">
  <div class="row align-items-center">
    <div class="col-auto">
      <h2 class="page-title">
        Profile
      </h2>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-4">
    <div class="card">
        <div class="card-body text-center">
          <h2 class="mb-3">{{$user->transactions()->sum("amount")}}$</h2>
          <p class="mb-4">
            Total Trainer Sales
          </p>
        </div>
    </div>

    <div class="card">
        <div class="card-body text-center">
          <h2 class="mb-3">{{$user->transactions()->sum("amount") - $user->withdraws()->where("is_execute",1)->sum("withdrw_amount")}}$</h2>
          <p class="mb-4">
            Current Balance
          </p>
        </div>
    </div>
    <div class="card">
        <div class="card-body text-center">
          <h2 class="mb-3">{{ $user->withdraws()->where("is_execute",0)->sum("withdrw_amount")}}$</h2>
          <p class="mb-4">
          Outstanding  Balance
          </p>
        </div>
    </div>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">My Profile</h3>
                </div>
                <div class="card-body">
                  <form>
                    <div class="row mb-3">
                      <div class="col-auto">
                        <span class="avatar avatar-lg" style="background-image: url({{url($user->image)}})"></span>
                      </div>
                      <div class="col">
                        <div class="mb-2">
                          <label class="form-label">{{$user->name}}</label>
                          <label class="form-label">  {{$user->email}}</label>
                        </div>
                      </div>
                    </div>
                    <div class="mb-2">
                      <label class="form-label">  {{$user->desc}}</label>

                    </div>

                  </form>
                </div>
              </div>
  </div>
  <div class="col-lg-8">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">@lang('site.booking')</h3>

      </div>
      <div class="card-body border-bottom py-3">
        <div class="d-flex">

        </div>
        <div class="table-responsive">

          <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
              <tr>

                <th>
                   @lang('site.transfer_num')
                </th>
                <th>
                   @lang('site.trainer_name')
                </th>
                <th>
                   @lang('site.client_name')
                </th>
                <th>
                   @lang('site.pack_name')
                </th>
                <th>
                   @lang('site.date_start')
                </th>
                <th>
                   @lang('site.date_end')
                </th>
                <th>
                   @lang('site.amount')
                </th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              	@foreach ($transactions as $key => $transaction)
              <tr>
                <td>
                {{$transaction->transaction_num}}
                </td>
                <td>
                  @if($transaction->trainer != null)
                      <span>
                      {{$transaction->trainer->name}}
                    </span>
                  @endif
                </td>
                <td>
                  @if($transaction->user != null)
                      <span>
                      {{$transaction->user->name}}
                      </span>

                  @endif
                </td>
                <td>
                  @if($transaction->package != null)
                    <span>
                    {{$transaction->package->package_name}}
                    </span>

                  @endif
                </td>
                <td>
                  @php  $join_date = date('Y-m-d',strtotime($transaction->transfer_date));   @endphp
                  {{$join_date}}
                </td>
                <td>
                  @if($transaction->package != null)
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
                  @endif
                </td>
                <td>{{$transaction->amount}}$</td>
                <td class="text-right">
                  <a class='btn  btn-xs' href="{{url('/dashboard/booking')}}/{{$transaction->id}}">
                    Show
                  </a>

                </td>

              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer d-flex align-items-center">
          {{$transactions->links('dashboard.vendor.pagination.default')}}
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">@lang('site.trainer_withdrow')</h3>

      </div>
      <div class="card-body border-bottom py-3">
        <div class="d-flex">

        </div>
        <div class="table-responsive">

          <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
              <tr>

                <th>
                   @lang('site.withdrow_num')
                </th>
                <th>
                   @lang('site.withdrow_amount')
                </th>
                <th>
                   @lang('site.created_at')
                </th>
                <th>
                   @lang('site.is_execute')
                </th>
                <th>
                   @lang('site.execute_date')
                </th>

                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($withdraws as $key => $withd)
              <tr>
                <td>
                {{$withd->withdrw_num}}
                </td>
                <td>
                {{$withd->withdrw_amount}} $
                </td>
                <td>
                  {{ date("Y-m-d",strtotime($withd->created_at))}}
                </td>
                <td>
                  @if($withd->is_execute == 0)
                    <span class="badge bg-red">No</span>
                  @else
                    <span class="badge bg-green">Yes</span>
                  @endif
                </td>
                <td>
                {{ date("Y-m-d",strtotime($withd->execute_date))}}
                </td>


              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer d-flex align-items-center">
          {{$withdraws->links('dashboard.vendor.pagination.default')}}
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">@lang('site.sales_earning')</h3>

      </div>
      <div class="card-body border-bottom py-3">
        <div class="d-flex">

        </div>
        <div class="table-responsive">

          <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
              <tr>

                <th>
                   @lang('site.month')
                </th>
                <th>
                   @lang('site.sales')
                </th>
                <th>
                   @lang('site.earning')
                </th>


                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($sales_with_months as $key => $sales)
              <tr>
                <td>
                {{$sales->month}} {{$sales->year}}
                </td>
                <td>
                {{$sales->count}} Sales
                </td>
                <td>
                {{$sales->total}}$
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      </div>
    </div>

  </div>
</div>
@endsection
@section('footerjscontent')
<script type="text/javascript">
</script>
@endsection
