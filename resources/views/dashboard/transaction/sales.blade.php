@extends('dashboard.layouts.master')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">@lang('site.sales')</h3>
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
            <th>
              @lang('site.trainer_name')
            </th>

            <th>
              @lang('site.total')
            </th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          	@foreach ($transactions as $key => $transaction)
          <tr>
            <td>
              @if($transaction->trainer != null)
                  <span>
                  {{$transaction->trainer->name}}
                </span>
              @endif
            </td>
            <td>
             {{$transaction->total}}$
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
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
      <form method="GET" action="{{ url('dashboard/sales') }}" >
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">@lang('site.trainer_name')</label>
            <select class="form-control" name="trainer">
              <option value="">@lang('site.select')</option>
              @foreach(\App\User::where("role_id",2)->get() as $customer)
               <option value="{{$customer->id}}">{{$customer->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">@lang('site.from')</label>
            <input type="date" class="form-control" name="from">
          </div>
          <div class="mb-3">
            <label class="form-label">@lang('site.to')</label>
            <input type="date" class="form-control" name="to">
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
