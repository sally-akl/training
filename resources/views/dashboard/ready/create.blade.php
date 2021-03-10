@extends('dashboard.layouts.master')
@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Ready plan - @lang('site.new_add')</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="table-responsive">
      @php  $weekss=4;  @endphp
      @include("dashboard.utility.error_messages")
      <form method="POST" action="{{ url('dashboard/readyplan') }}" class="form_submit_model" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">Day</label>
                <select name="select_day" class="form-control" >
                   @php

                    @endphp
                    @for($w = 1;$w<=$weekss;$w++)
                      @php
                        $end  = 7 ;
                        $begin = 1;

                        $end_day = $w * 7;
                        $begin_day = ($end_day-7)+1;
                        $days_real = [];
                        for($j=$begin_day;$j<=$end_day;$j++)
                        {
                           $days_real[]=$j;
                        }
                      @endphp
                    <optgroup label="Week {{$w}}">
                      @for($d = $begin;$d<=$end;$d++)
                        @php  $to_day = $days_real[$d-1];  @endphp
                          <option value="{{$to_day}}">Day {{$d}}</option>
                      @endfor
                  </optgroup>
                    @endfor

                </select>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">Type</label>
                <select name="ready_type" class="form-control">
                  <option value="">@lang('site.select')</option>
                  <option value="exercises">Excercises</option>
                  <option value="food supplements" >Food supplements</option>
                  <option value="dietary meals" >Dietary meals</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="mb-3">

                <div class="exercises" style="display:none">
                  <div class="row" style="margin-top:5px;margin-bottom:30px;">
                    <div class="col-sm-12">

                      <div class="row form-group row">

                        <label class="col-sm-2 form-control-label label-sm">Plan name</label>
                        <div class="col-sm-6">
                            <input id="inputHorizontalSuccess" name= "p_name"  value="{{ request()->p_name }}"  class="form-control  form-control-success" type="text">
                        </div>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-primary p_name_search">Search</button>
                        </div>
                      </div>


                    </div>
                  </div>
                  <div class="exec_div">
                  </div>
                </div>
                <div class="food_supplements" style="display:none">
                  <div class="row" style="margin-top:5px;margin-bottom:30px;">
                    <div class="col-sm-12">

                      <div class="row form-group row">

                        <label class="col-sm-2 form-control-label label-sm">Plan name</label>
                        <div class="col-sm-6">
                            <input id="inputHorizontalSuccess" name= "p_name"  value="{{ request()->p_name }}"  class="form-control  form-control-success" type="text">
                        </div>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-primary p_name_search">Search</button>
                        </div>
                      </div>


                    </div>
                  </div>
                  <div class="suppliment_div">
                  </div>
                </div>
                <div class="dietary_meals" style="display:none">
                  <div class="row" style="margin-top:5px;margin-bottom:30px;">
                    <div class="col-sm-12">

                      <div class="row form-group row">

                        <label class="col-sm-2 form-control-label label-sm">Diet name</label>
                        <div class="col-sm-6">
                            <input id="inputHorizontalSuccess" name= "p_name"  value="{{ request()->p_name }}"  class="form-control  form-control-success" type="text">
                        </div>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-primary p_name_search">Search</button>
                        </div>
                      </div>


                    </div>
                  </div>
                  <div class="meal_div">
                  </div>
                </div>
              </div>
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
@endsection
@section('footerjscontent')
<script type="text/javascript">

  _fn = function(val,day)
  {
    $(".exercises").css("display","none");
    $(".food_supplements").css("display","none");
    $(".dietary_meals").css("display","none");

      var url = '{{url("/dashboard/readyplans/excer/get")}}';
      if(val == "food supplements")
        url = '{{url("/dashboard/readyplans/supplement/get")}}';
      if(val == "dietary meals")
        url = '{{url("/dashboard/readyplans/meals/get")}}';
      var formData = new FormData();
      formData.append('day',day);
      formData.append('programme_search',$("input[name='p_name']").val());
      $.ajax({
                url: url,
                type: "POST",
                data: formData,
                async: false,
                success: function (response) {
                  if(val == "exercises")
                  {
                    $(".exec_div").html("")
                    $(".exec_div").html(response);
                    $(".exercises").css("display","block");
                    $("input[name='selected_excercise']").off();
                    $("input[name='selected_excercise']").on("change",function(){
                      if($(this).is(":checked"))
                      {
                        var id = $(this).val();
                        var url = '{{url("/dashboard/readyplans/programmes/save")}}/excercises'+"/"+id;
                        $.ajax({url: url , success: function(result){
                        }});
                      }

                    });

                  }
                  else if(val == "food supplements"){
                    $(".suppliment_div").html("")
                    $(".suppliment_div").html(response);
                    $(".food_supplements").css("display","block");
                    $("input[name='selected_supplement']").off();
                    $("input[name='selected_supplement']").on("change",function(){
                      if($(this).is(":checked"))
                      {
                        var id = $(this).val();
                        var url = '{{url("/dashboard/readyplans/programmes/save")}}/supliment'+"/"+id;
                        $.ajax({url: url , success: function(result){
                        }});
                      }

                    });



                  }
                  else{
                    $(".meal_div").html("")
                    $(".meal_div").html(response);
                    $(".dietary_meals").css("display","block");
                    $("input[name='selected_recepies']").on("change",function(){
                      if($(this).is(":checked"))
                      {
                        var id = $(this).val();
                        var url = '{{url("/dashboard/readyplans/programmes/save")}}/recepies'+"/"+id;
                        $.ajax({url: url , success: function(result){
                        }});
                      }

                    });

                  }

                },
              error : function( data )
              {

              },
              cache: false,
              contentType: false,
              processData: false
      });


  }
  $(".p_name_search").on("click",function(){
    _fn($("select[name='ready_type']").val() , $("select[name='select_day']").val());
  });
  $("select[name='ready_type']").on("change",function(){
    _fn($(this).val() , $("select[name='select_day']").val());
  });

</script>
@endsection
