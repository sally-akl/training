@extends('dashboard.layouts.master')
@section('content')
@if(count($readyplans)==0)
<div class="empty">
  <div class="empty-icon">
    <img src="{{url('/')}}/img/illustrations/undraw_printing_invoices_5r4r.svg" height="128" class="mb-4"  alt="">
  </div>
  <p class="empty-title h3">@lang('site.no_result')</p>
  <p class="empty-subtitle text-muted">
    @lang('site.add_new_records')
  </p>
  <div class="empty-action">
    <a href="{{ url('dashboard/readyplan/create') }}" class="btn btn-primary add_btn">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
      @lang('site.new_add')
    </a>
  </div>
</div>
@else
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Ready plan and diet</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="d-flex">
      <a href="{{ url('dashboard/readyplan/create') }}" class="btn btn-primary add_btn">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
        @lang('site.new_add')
      </a>
    </div>

    <div class="table-responsive">
      @include("dashboard.utility.sucess_message")
      <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
          <tr>
            <th>
               Day
            </th>
            <th>
              Program  Title
            </th>
            <th>
              Recepe Title
            </th>
            <th>Number of sets</th>
            <th>Serving size</th>

            <th></th>
          </tr>
        </thead>
        <tbody>
        	@foreach ($readyplans as $key => $plan)
          <tr>
            <td>
               {{$plan->day_num}}

            </td>
            <td>
              @if($plan->programme !=null)
                {{$plan->programme->title}}
              @endif
            </td>
            <td>
              @if($plan->recepe !=null)
                {{$plan->recepe->name}}
              @endif
            </td>
            <td>{{$plan->set_num}}</td>
            <td>{{$plan->suplement_serving_size}}</td>

            <td class="text-right">
    					<a href="#" class="btn btn-danger btn-xs delete_btn"  bt-data="{{$plan->id}}">
    						<i class="far fa-trash-alt"></i>
    					</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex align-items-center">
      {{$readyplans->links('dashboard.vendor.pagination.default')}}
    </div>
  </div>
</div>
@endif
@include("dashboard/utility/modal_delete")
@endsection
@section('footerjscontent')
<script type="text/javascript">

  $(".delete_btn").on("click",function(){
    $('#delete_modal').modal('show');
    $("input[name='delete_val']").val($(this).attr("bt-data"));
    return false;
  });
  $(".delete_it_sure").on("click",function(){
    var id = $("input[name='delete_val']").val();
    var url_delete = '{{url("/dashboard/readyplan")}}'+"/"+id;
    $.ajax({url: url_delete ,type: "DELETE", success: function(result){
            var result = JSON.parse(result);
            if(result.sucess)
            {
              window.location.href = '{{url("/dashboard/readyplan")}}';
            }
    }});
  });
</script>
@endsection
