@extends('dashboard.layouts.master')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">@lang('site.Support')</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="d-flex">

    </div>
    <div class="table-responsive">
  @include("dashboard.utility.sucess_message")
      <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
          <tr>
            <th>
               @lang('site.client_name')
            </th>
            <th>
               Subject
            </th>
            <th>
               @lang('site.msg')
            </th>
            <th>
               @lang('site.send_date')
            </th>
            <th>
               @lang('site.status')
            </th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          	@foreach ($client_requests as $key => $crequest)
          <tr>
            <td>
              @if(date("Y-m-d",strtotime($crequest->send_date)) >= date('Y-m-d',strtotime("last Monday")) &&  date("Y-m-d",strtotime($crequest->send_date)) <= date('Y-m-d'))
                   <span class="badge bg-azure">New</span>
              @endif
               @if($crequest->user != null)
                 {{$crequest->user->name}}
               @endif
            </td>
            <td>{{$crequest->subject}}</td>
            <td>{{$crequest->msg}}</td>
            <td>{{date("Y-m-d",strtotime($crequest->send_date))}}</td>
            <td>
              <form method="post" action="{{url('/dashboard/support')}}/{{$crequest->id}}" class="accept_form">
                {{ method_field('PUT') }}
                @csrf
                <select name="status" class="form-control">
                  <option value="">-- Select --</option>
                  <option value="pending" {{$crequest->status == "pending"?"selected":""}}>Pending</option>
                  <option value="in progress" {{$crequest->status == "in progress"?"selected":""}}>In progress</option>
                  <option value="resolved" {{$crequest->status == "resolved"?"selected":""}}>Resolved</option>
                </select>
              </form>
            </td>
            <td class="text-right">
              <a class='btn  btn-xs' href="{{url('/dashboard/support')}}/{{$crequest->id}}">
    						Enter
    					</a>
              <a href="#" class="btn btn-danger btn-xs delete_btn"  bt-data="{{$crequest->id}}">
                <i class="far fa-trash-alt"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex align-items-center">
      {{$client_requests->links('dashboard.vendor.pagination.default')}}
    </div>
  </div>
</div>
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
    var url_delete = '{{url("/dashboard/support")}}'+"/"+id;
    $.ajax({url: url_delete ,type: "DELETE", success: function(result){
            var result = JSON.parse(result);
            if(result.sucess)
            {
              window.location.href = '{{url("/dashboard/support")}}';
            }
    }});
  });
  $("select[name='status']").on("change",function(){
    $(this).parent("form").submit();
  });
</script>
@endsection
