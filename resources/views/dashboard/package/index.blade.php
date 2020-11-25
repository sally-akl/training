@extends('dashboard.layouts.master')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">@lang('site.Packages')</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="d-flex">

    </div>
    <div class="table-responsive">

      <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
          <tr>
            <th>
               @lang('site.pack_name')
            </th>
            <th>
               @lang('site.pack_duration')
            </th>
            <th>
               @lang('site.pack_price')
            </th>
            <th>
               @lang('site.pack_type')
            </th>
            <th>
               @lang('site.trainer_name')
            </th>
            <th>
               @lang('site.admin_accept')
            </th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          	@foreach ($packages as $key => $package)
          <tr>
            <td>{{$package->package_name}}</td>
            <td>{{$package->package_duration}}  {{$package->package_duration_type}}</td>
            <td>{{$package->package_price}}$</td>
            <td>{{$package->package_type}}</td>
            <td>{{$package->user->name}}</td>
            <td>
              <form method="post" action="{{url('/dashboard/package')}}/{{$package->id}}" class="accept_form">
                {{ method_field('PUT') }}
                @csrf
                <select name="admin_accept" class="form-control">
                  <option value="">-- Select --</option>
                  <option value="1" {{$package->accepted_from_admin == 1?"selected":""}}>Accept</option>
                  <option value="2" {{$package->accepted_from_admin == 2?"selected":""}}>Reject</option>
                </select>
              </form>
            </td>
            <td class="text-right">
              <a class='btn  btn-xs' href="{{url('/dashboard/package')}}/{{$package->id}}">
    						Show
    					</a>
              <a href="#" class="btn btn-danger btn-xs delete_btn"  bt-data="{{$package->id}}">
                <i class="far fa-trash-alt"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex align-items-center">
      {{$packages->links('dashboard.vendor.pagination.default')}}
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
    var url_delete = '{{url("/dashboard/package")}}'+"/"+id;
    $.ajax({url: url_delete ,type: "DELETE", success: function(result){
            var result = JSON.parse(result);
            if(result.sucess)
            {
              window.location.href = '{{url("/dashboard/package")}}';
            }
    }});
  });
  $("select[name='admin_accept']").on("change",function(){
    $(".accept_form").submit();
  });
</script>
@endsection
