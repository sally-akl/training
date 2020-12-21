@extends('dashboard.layouts.master')
@section('content')
<div class="page-header">
  <div class="row align-items-center">
    <div class="col-auto">
      <ol class="breadcrumb" aria-label="breadcrumbs">
        <li class="breadcrumb-item"><a href='{{url("dashboard/trainers/clients/details")}}/{{$transaction_num}}'>Client Data</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Programme design Week{{$week}} / Days</a></li>
      </ol>
    </div>
  </div>
</div>
<div class="modal modal-blur fade" id="show_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Copy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger alert-danger-modal" style="display:none">
        </div>
        <div class="alert alert-success alert-success-modal" style="display:none">
        </div>
        <form action="{{ url('dashboard/trainers/programmes/copyweek') }}" method="post" class="form_submit_model">
          <div class="row">

            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">Copy to transaction</label>
                <select name="to_transaction" class="form-control">
                  @php  $trans_to = \App\Transactions::where("id","!=",$transaction_num)->get();  @endphp
                  @foreach($trans_to as $t_to)
                    <option value="{{$t_to->id}}">{{$t_to->transaction_num}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <input type="hidden" name="transaction_copy_num" value="{{$transaction_num}}" />
          <input type="hidden" name="copy_type" value="week" />
          <input type="hidden" name="week_num" value="{{$week}}" />
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>

    </div>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Programme design Week{{$week}} / Days</h3>
    <button type="button" class="btn btn-primary copy_btn">Copy Programme design  Week{{$week}}</button>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="d-flex">

    </div>
      @php
        $end  = $week * 7 ;
        $begin = ($end-7)+1;
      @endphp

      @php $i = 1;   @endphp
      @for($day = $begin;$day<=$end;$day++)

        @if($i == 1)
          <div class="row days">
        @endif
        @if($i%8 == 0 && $i !=1)
          @php $i = 1;   @endphp
          </div>
          <div class="row days">
        @endif
        <div class="col-lg-1">
          <a href='{{url("dashboard/trainers/programmes/design")}}/{{$day}}/{{$week}}/{{$transaction_num}}/{{$package}}/{{$user_id}}'> Day {{$day}} </a>
        </div>
       @php $i++;   @endphp
      @endfor


  </div>
</div>
@endsection
@section('footerjscontent')
<script type="text/javascript">
$(".copy_btn").on("click",function(){
  $('#show_modal').modal('show');
});
$(".form_submit_model").submit(function(e){

    e.preventDefault();
    var submit_form_url = $(this).attr('action');
    var $method_is = "POST";
    formData = new FormData($(this)[0]);
    $(".alert-success-modal").css("display","none");
    $(".alert-danger-modal").css("display","none");
    $.ajax({
                url: submit_form_url,
                type: $method_is,
                data: formData,
                async: false,
                dataType: 'json',
                success: function (response) {
                  if(response.sucess)
                  {
                    $(".alert-success-modal").html("تم نسخ الاسبوع بنجاح");
                    $(".alert-success-modal").css("display","block");
                  }
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
