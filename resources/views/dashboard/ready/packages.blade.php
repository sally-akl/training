@extends('dashboard.layouts.master')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Ready plan</h3>
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
               Title
            </th>
            <th>
               Weeks#
            </th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        	@foreach ($readyplanspackages as $key => $package)
          <tr>
            <td>{{$package->title}}</td>
            <td>{{$package->weeks}} </td>

            <td class="text-right">
              <a class='btn btn-info btn-xs edit_btn' bt-data="{{$package->id}}">
    						<i class="far fa-edit"></i>
    					</a>
              <a href="#" class="btn btn-danger btn-xs delete_btn"  bt-data="{{$package->id}}">
                <i class="far fa-trash-alt"></i>
              </a>
              <a class='btn btn-info btn-xs'  href="{{ url('dashboard/readypackage/weeks') }}/{{$package->id}}">
    						Plans
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
      <form method="POST" action="{{ url('dashboard/readyplanpackage') }}" class="form_submit_model">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title">
          </div>
          <div class="mb-3">
            <label class="form-label">Title Ar</label>
            <input type="text" class="form-control" name="title_ar">
          </div>
          <div class="mb-3">
            <label class="form-label">Number of weeks</label>
            <input type="number" class="form-control" name="weeks">
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
    $(".form_submit_model").attr("action",'{{url("/dashboard/readyplanpackage")}}');
    return false;
});
$(".delete_btn").on("click",function(){
  $('#delete_modal').modal('show');
  $("input[name='delete_val']").val($(this).attr("bt-data"));
  return false;
});
$(".delete_it_sure").on("click",function(){
  var id = $("input[name='delete_val']").val();
  var url_delete = '{{url("/dashboard/readyplanpackage")}}'+"/"+id;
  $.ajax({url: url_delete ,type: "DELETE", success: function(result){
          var result = JSON.parse(result);
          if(result.sucess)
            window.location.href = '{{url("/dashboard/readyplanpackage")}}';
  }});
});
var _sucess = function(response)
{
  if(response.sucess)
  {
    $(".alert-success-modal").html(response.sucess_text);
    $(".alert-success-modal").css("display","block");
    $('#add_edit_modal').modal('hide');
    $("input[name='method_type']").val("add");
    window.location.href = '{{url("/dashboard/readyplanpackage")}}';
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
$(".edit_btn").on("click",function()
{
    var id = $(this).attr("bt-data");
    var url_edit = '{{url("/dashboard/readyplanpackage")}}'+"/"+id;
    $(".form_submit_model").attr("action",url_edit);
    $.ajax({
        url: '{{url("/dashboard/readyplanpackage")}}'+"/"+id+"/edit",
        type: 'GET',
        dataType: 'json',
        success: function (response) {
          $("input[name='title']").val(response.title);
          $("input[name='title_ar']").val(response.title_ar);
          $("input[name='weeks']").val(response.weeks);
          $("input[name='method_type']").val("edit");
          $('#add_edit_modal').modal('show');
        },
    });

      return false;
});
$(".form_submit_model").submit(function(e){

    e.preventDefault();
    var submit_form_url = $(this).attr('action');
    var $method_is = "POST";
    var formData = new FormData($(this)[0]);
    $(".alert-success-modal").css("display","none");
    $(".alert-danger-modal").css("display","none");

    if(formData.get("method_type") == "edit")
    {
        $method_is = "PUT";
        var data = {
           title : $("input[name='title']").val(),
           title_ar : $("input[name='title_ar']").val(),
           weeks : $("input[name='weeks']").val(),

        };
        $.ajax({
            type: $method_is,
            url: submit_form_url,
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify(data),
            success: function (response) {
              _sucess(response);
            },
          error : function( data )
          {

          },
        });
    }
    else {
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

    }

      return false;
});
$("select[name='package_type']").on("change",function(){
    var val = $(this).val();
    if(val =="free")
    {
      $(".prce_part").css("display","none");
    }
    else{
      $(".prce_part").css("display","block");
    }
})
</script>
@endsection
