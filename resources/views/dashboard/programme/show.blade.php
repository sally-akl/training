@extends('dashboard.layouts.master')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">{{$programme->title}}</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="d-flex">

    </div>
    <div class="table-responsive">
      <table class="table card-table table-vcenter text-nowrap datatable">
        <tbody>

          <tr>
            <th> @lang('site.programme_title')</th><td>{{$programme->title}}</td>
          </tr>
          <tr>
            <th>@lang('site.upload_programme')</th><td>{{$programme->media_type}} </td>
          </tr>
          <tr>
            <th>@lang('site.programme_type')</th><td>{{$programme->type}}</td>
          </tr>
          <tr>
            <th>@lang('site.programme_desc')</th><td>{{$programme->desc}}</td>
          </tr>
          @if($programme->media_type != "image")
          <tr>
            <th>Video</th><td>{!! $programme->vedio !!}</td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>
@if($programme->media_type == "image")
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Programmw images</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="table-responsive">

      <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
          <tr>
            <th>
              Image
            </th>
            <th>

            </th>
          </tr>
        </thead>
        <tbody>
        	@foreach ($programme->images as $key => $image)
          <tr>
            <td><img src="{{url('/')}}{{$image->image}}" width="200" height="200"/></td>
            <td>
              <a href="#" class="btn btn-danger btn-xs delete_btn"  bt-data="{{$image->id}}">
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
@endif
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
  var url_delete = '{{url("/dashboard/programmeimage")}}'+"/"+id;
  $.ajax({url: url_delete ,type: "DELETE", success: function(result){
          var result = JSON.parse(result);
          if(result.sucess)
          {
            window.location.href = '{{url("/dashboard/programme")}}/{{$programme->id}}';
          }
  }});
});
</script>
@endsection
