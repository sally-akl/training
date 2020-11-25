@extends('dashboard.layouts.master')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">{{$package->package_name}}</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="d-flex">

    </div>
    <div class="table-responsive">
      <table class="table card-table table-vcenter text-nowrap datatable">
        <tbody>

          <tr>
            <th> @lang('site.pack_name')</th><td>{{$package->package_name}}</td>
          </tr>
          <tr>
            <th>@lang('site.pack_duration')</th><td>{{$package->package_duration}}  {{$package->package_duration_type}}</td>
          </tr>
          <tr>
            <th>@lang('site.pack_price')</th><td>{{$package->package_price}}$</td>
          </tr>
          <tr>
            <th> @lang('site.pack_type')</th><td>{{$package->package_type}}</td>
          </tr>
          <tr>
            <th>@lang('site.trainer_name')</th><td>{{$package->user->name}}</td>
          </tr>
          <tr>
            <th> @lang('site.pack_desc')</th><td>{{$package->package_desc}}</td>
          </tr>
          <tr>
            <th> @lang('site.pack_quest')</th><td>{{$package->package_questionaire	}}</td>
          </tr>
          <tr>
            <th> @lang('site.admin_accept')</th><td>
              @if($package->accepted_from_admin == 1)
                Accept
              @elseif($package->accepted_from_admin == 2)
                Reject
              @endif
            </td>
          </tr>
          <tr>
            <th> @lang('site.pack_status')</th><td>{{$package->package_status	}}</td>
          </tr>


        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
