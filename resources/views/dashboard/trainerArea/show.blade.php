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
          <a href="#" class="btn btn-primary add_btn">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
            Add withdrow request
          </a>

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
                  @if($withd->execute_date == null)
                     <span></span>
                  @else
                    {{ date("Y-m-d",strtotime($withd->execute_date))}}
                  @endif
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

<div class="modal modal-blur fade" id="add_edit_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add withdrow request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
        </button>
      </div>
      <div class="alert alert-danger alert-danger-modal" style="display:none">

      </div>
      <div class="alert alert-success alert-success-modal" style="display:none">

      </div>
      <form method="POST" action='{{url("/dashboard/trainers/withdraw/add")}}' class="form_submit_model">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Amount</label>
            <input type="text" class="form-control" name="amount">
          </div>

          <input type="hidden" name="method_type" value="add" />
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-link link-secondary" data-dismiss="modal">
            @lang('site.cancel')
          </a>
          <button type="submit" class="btn btn-primary">+ {{ __('site.save') }} </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('footerjscontent')
<script type="text/javascript">
var _sucess = function(response)
{
  if(response.sucess)
  {
    $(".alert-success-modal").html(response.sucess_text);
    $(".alert-success-modal").css("display","block");
    $('#add_edit_modal').modal('hide');
    $("input[name='method_type']").val("add");
    window.location.href = '{{url("/dashboard/trainers")}}';
  }
  else
  {
    var $error_text = "";
    var errors = response.errors;

    $.each(errors, function (key, value) {
      $error_text +=value+"<br>";
    });

    $(".alert-danger-modal").html($error_text);
    $(".alert-danger-modal").css("display","block");

  }

}
$(".add_btn").on("click",function(){
    $("input[name='method_type']").val("add");
    $(".form_submit_model").attr("action",'{{url("/dashboard/trainers/withdraw/add")}}');
    $('#add_edit_modal').modal('show');
    return false;
});
$(".form_submit_model").submit(function(e){

    e.preventDefault();
    var submit_form_url = $(this).attr('action');
    var $method_is = "POST";
    var formData = new FormData($(this)[0]);
    $(".alert-success-modal").css("display","none");
    $(".alert-danger-modal").css("display","none");

    $.ajax({
            url: submit_form_url,
            type: $method_is,
            data: formData,
            async: false,
            dataType: 'json',
            success: function (response) {
              _sucess(response);
            },
            error : function( data )
            {

            },
            cache: false,
            contentType: false,
            processData: false
    });
    return false;
});
</script>
@endsection
