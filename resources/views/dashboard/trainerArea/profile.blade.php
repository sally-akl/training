@extends('dashboard.layouts.master')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">{{$user->name}}  Profile</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="d-flex">

    </div>
    <div class="table-responsive">
      @include("dashboard.utility.sucess_message")
      <form method="POST" action="{{ url('dashboard/trainers') }}/profile/edit" class="form_submit_model" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">@lang('site.name')</label>
                <input type="text" class="form-control" name="name" value="{{$user->name}}">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">@lang('site.email')</label>
                <input type="email" class="form-control" name="email" value="{{$user->email}}">
              </div>
            </div>
          </div>
          <div class="row password_div">
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">@lang('site.password')</label>
                <input type="password" class="form-control" name="password">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">@lang('site.title')</label>
                <input type="text" class="form-control" name="city_id" value="{{$user->email}}">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">@lang('site.category_name')</label>
                <select name="category_id" class="form-control">
                  <option value="">@lang('site.select')</option>
                  @foreach(\App\Category::all() as $category)
                    <option value="{{$category->id}}" {{$user->category_id == $category->id?"selected":"" }}>{{$category->title}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">@lang('site.profile_img')</label>
                <input type="file" class="form-control" name="profile_img"  id="profile_img">

              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                  <img src="{{url('/')}}{{$user->image}}" class="img_profile"  width="100" height="100"/>
              </div>
            </div>
          </div>

          <div class="col-lg-12">
            <div class="mb-3">
              <label class="form-label">@lang('site.desc')</label>
              <textarea class="form-control user_body" rows="3" name="user_body">{{$user->desc}}</textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">+ {{ __('site.save') }} </button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Trainer packages</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="d-flex">
      <a href="#" class="btn btn-primary add_btn">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
        @lang('site.new_add')
      </a>
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
               Package status
            </th>
            <th>
               @lang('site.admin_accept')
            </th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        	@foreach ($user->packages as $key => $package)
          <tr>
            <td>{{$package->package_name}}</td>
            <td>{{$package->package_duration}}  {{$package->package_duration_type}}</td>
            <td>{{$package->package_price}}$</td>
            <td>{{$package->package_type}}</td>
            <td>{{$package->user->name}}</td>
            <td>{{$package->package_status}}</td>
            <td>
              @if($package->accepted_from_admin == 1)
                <span>Accept</span>
              @elseif($package->accepted_from_admin == 2)
                <span>Reject</span>
              @endif
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
  </div>
</div>
@include("dashboard/utility/modal_delete")
<div class="modal modal-blur fade" id="add_edit_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">@lang('site.new_add')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
        </button>
      </div>
      <div class="alert alert-danger alert-danger-modal" style="display:none">

      </div>
      <div class="alert alert-success alert-success-modal" style="display:none">

      </div>
      <form method="POST" action="{{ url('dashboard/package') }}" class="form_submit_model">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">@lang('site.pack_name')</label>
            <input type="text" class="form-control" name="package_name">
          </div>
          <div class="mb-3">
            <label class="form-label">@lang('site.pack_duration')</label>
            <input type="number" class="form-control" name="package_duration">
          </div>
          <div class="mb-3">
            <label class="form-label">Duration type</label>
            <select name="package_duration_type" class="form-control">
              <option value="">@lang('site.select')</option>
              <option value="days" >Days</option>
              <option value="weeks">Weeks</option>
              <option value="months">Months</option>
            </select>
          </div>

          <input type="hidden" name="method_type" value="add" />
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">+ {{ __('site.save') }} </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('footerjscontent')
<script type="text/javascript">
$(".add_btn").on("click",function(){
    $('#add_edit_modal').modal('show');
    $("input[name='method_type']").val("add");
    $(".form_submit_model").attr("action",'{{url("/dashboard/package")}}');
    return false;
});
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
            window.location.href = '{{url("/dashboard/trainers/profile")}}';
  }});
});
</script>
@endsection
