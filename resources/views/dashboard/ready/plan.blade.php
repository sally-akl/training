@extends('dashboard.layouts.master')
@section('content')
<div class="page-header">
  <div class="row align-items-center">
    <div class="col-lg-6">
      <div class="col-auto">
        <h2 class="page-title">
            Day {{$day}} - Package ( {{\App\ReadyPlanPackage::find($transaction_num)->title}} )
        </h2>
        <ol class="breadcrumb" aria-label="breadcrumbs" style="margin-top:10px;">
          <li class="breadcrumb-item active" aria-current="page"><a href="#">Ready Plan design of Week {{$week}} / Day {{$day}}</a></li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="card-tabs">
                    <!-- Cards navigation -->
                    <ul class="nav nav-tabs">
                      <li class="nav-item"><a href="#tab-top-1" class="nav-link  {{$t == 'excercises'?'active':''}}" data-toggle="tab">Excercises</a></li>
                      <li class="nav-item"><a href="#tab-top-2" class="nav-link {{$t == 'recepies'?'active':''}}" data-toggle="tab">Diet</a></li>
                      <li class="nav-item"><a href="#tab-top-3" class="nav-link {{$t == 'supliment'?'active':''}}" data-toggle="tab">Food supplements</a></li>
                    </ul>
                    <div class="tab-content">
                      <!-- Content of card #1 -->
                      <div id="tab-top-1" class="card tab-pane  {{$t == 'excercises'?'active show':''}} ">
                        <div class="card-body">
                          <div class="card-title">Excercises</div>
                          <div class="table-responsive">

                            <table class="table card-table table-vcenter text-nowrap datatable">
                              <thead>
                                <tr>
                                  <th>Image</th>
                                  <th>
                                     @lang('site.programme_title')
                                  </th>


                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                @if(array_key_exists("excercises",$plan))
                                  @foreach ($plan["excercises"] as $key => $programme)
                                  <tr>
                                    <td>
                                        @if($programme->programme->media_type == "image")
                                          @if(count($programme->programme->images)>0)
                                            <img src="{{url('/')}}{{$programme->programme->images[0]->image}}" width="100" height="100" />
                                          @endif
                                        @else
                                        <iframe width="150" height="150" src="{{$programme->programme->vedio}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>

                                        @endif

                                   </td>
                                    <td>{{$programme->programme->title}}
                                      <div><span>Description :- </span><span>{{ substr($programme->programme->desc,0,100)}}</span></div>
                                        <div><span>@lang('site.upload_programme') :- </span><span  class="badge bg-blue">{{$programme->programme->media_type}}</span></div>
                                        <div><span>Number of sets :- </span><span  class="badge bg-azure">{{$programme->set_num}}</span></div>
                                    </td>



                                    <td class="text-right">
                                      <a href="#" class="btn  btn-xs  show_details"  bt-data="{{$programme->programme->id}}">
                                        Enter
                                      </a>
                                      <a href="#" class="btn btn-danger btn-xs delete_btn" bt-type="excer"  bt-data="{{$programme->plan_id}}">
                                       <i class="far fa-trash-alt"></i>
                                     </a>
                                    </td>

                                  </tr>
                                  @endforeach
                                @endif
                              </tbody>
                            </table>
                          </div>
                        </div>

                        <div class="card-body" style="margin-top:150px;">
                          <div class="card-title">Select more excercises</div>
                          <div class="row" style="margin-top:5px;margin-bottom:30px;">
                            <div class="col-sm-12">
                              <form action="" method="get" />
                              <div class="row form-group row">

                                <label class="col-sm-2 form-control-label label-sm">Plan name</label>
                                <div class="col-sm-6">
                                    <input id="inputHorizontalSuccess" name= "p_name"  value="{{ $programme_search }}"  class="form-control  form-control-success" type="text">
                                </div>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                              </div>

                              </form>
                            </div>
                          </div>
                          <div class="table-responsive">
                           <form method="POST" action='{{url("/dashboard/readypackage/programmes/add")}}'>
                             @csrf
                            <table class="table card-table table-vcenter text-nowrap datatable">
                              <thead>
                                <tr>
                                  <th></th>
                                  <th>Image</th>
                                  <th>
                                     @lang('site.programme_title')
                                  </th>
                                  <th>Number of sets</th>

                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                  @php
                                    
                                    if(empty($programme_search))
                                      $programme_data = \App\Programme::where("type","exercises")->whereraw("id  not IN(select programme_design_id from ready_plan where day_num='".$day."' and package_id='".$transaction_num."' and recepe_id IS NULL)")->paginate(10);
                                    else
                                      $programme_data = \App\Programme::where("type","exercises")->where('title', 'LIKE', '%'.$programme_search.'%')->whereraw("id  not IN(select programme_design_id from ready_plan where day_num='".$day."'  and package_id='".$transaction_num."' and recepe_id IS NULL)")->paginate(10);
                                  @endphp
                                  @foreach ($programme_data as $key => $programme)
                                  <tr>
                                    <td><input type="checkbox" name="selected_excercise" value="{{$programme->id}}"  /></td>
                                    <td>
                                      @if($programme->media_type == "image")
                                       @if(count($programme->images)>0)
                                         <img src="{{url('/')}}{{$programme->images[0]->image}}" width="100" height="100" />
                                       @endif
                                      @else
                                      <iframe width="150" height="150" src="{{$programme->vedio}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>

                                      @endif
                                   </td>
                                    <td>{{$programme->title}}
                                      <div><span>Description :- </span><span>{{ substr($programme->desc,0,100)}}</span></div>
                                        <div><span>@lang('site.upload_programme') :- </span><span  class="badge bg-blue">{{$programme->media_type}}</span></div>
                                        <div><span>Number of sets :- </span><span  class="badge bg-azure">{{$programme->number_of_sets}}</span></div>
                                    </td>
                                    <td><input type="text" name="selected_text_{{$programme->id}}" value="{{$programme->number_of_sets}}" class="form-control"/></td>

                                    <td>
                                      <a href="#" class="btn  btn-xs  show_details"  bt-data="{{$programme->id}}">
                                        Enter
                                      </a>
                                    </td>


                                  </tr>
                                  @endforeach
                              </tbody>
                            </table>
                            <input type="hidden" name="day_num" value="{{$day}}" />
                            <input type="hidden" name="programme_type" value="excercises" />
                            <input type="hidden" name="transaction" value="{{$transaction_num}}"/>
                            <input type="hidden" name="week" value="{{$week}}"/>
                            @if(count($programme_data)>0)
                              <button type="submit" class="btn btn-primary" style="margin-top:10px;">Add excercises</button>
                            @endif
                          </form>
                          </div>
                          <div class="card-footer d-flex align-items-center">
                            {{ $programme_data->links('dashboard.vendor.pagination.default')}}
                          </div>
                        </div>
                      </div>
                      <!-- Content of card #2 -->
                      <div id="tab-top-2" class="card tab-pane {{$t == 'recepies'?'active show':''}}">
                        <div class="card-body">
                          <div class="card-title">Diet</div>

                                      <div class="card-body">
                                        <div class="card-title">Receips</div>
                                        <div class="table-responsive">

                                          <table class="table card-table table-vcenter text-nowrap datatable">
                                            <thead>
                                              <tr>
                                                <th>
                                                  Image
                                                </th>
                                                <th>
                                                   Details
                                                </th>


                                                <th></th>
                                              </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($plan_section_receps as $key => $receps)
                                                <tr>
                                                  <td><img src="{{url('/')}}{{$receps->recepe->image}}" width="100" height="100" /></td>
                                                  <td>{{$receps->recepe->name}}
                                                      <div><span>Description :- </span><span>{{$receps->recepe->desciption}}</span></div>
                                                      @php

                                                        $Calories = 0;
                                                        $Carbs = 0;
                                                        $Protein = 0;
                                                        $Fat = 0;
                                                        foreach($receps->recepe->integrate as $k=>$sp)
                                                        {
                                                          $Calories += $sp->serving * $sp->integrate->calories ;
                                                          $Carbs += $sp->serving * $sp->integrate->carbs;
                                                          $Protein += $sp->serving * $sp->integrate->protein;
                                                          $Fat += $sp->serving * $sp->integrate->fat;

                                                        }

                                                      @endphp
                                                      <div><span class="badge bg-azure">Calories	 : {{$Calories	}}</span>   <span class="badge bg-purple">Carbs	 : {{$Carbs	}}</span>  <span class="badge bg-green">Protein	 : {{$Protein	}}</span>  <span class="badge bg-orange">Fat	 : {{$Fat}}</span></div>

                                                  </td>

                                                  <td class="text-right">
                                                    <a href="#" class="btn  btn-xs show_recep"  bt-data="{{$receps->recepe->id}}">
                                                      Enter
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-xs delete_btn"  bt-type="recep" bt-data="{{$receps->plan_id}}">
                                                     <i class="far fa-trash-alt"></i>
                                                   </a>
                                                  </td>

                                                </tr>
                                                @endforeach


                                            </tbody>
                                          </table>
                                        </div>
                                        <!--  next cart -->

                                        <div class="card-body" style="margin-top:150px;">
                                          <div class="card-title">Select more Diet</div>
                                          <div class="row" style="margin-top:5px;margin-bottom:30px;">
                                            <div class="col-sm-12">
                                              <form action="" method="get" />
                                              <div class="row form-group row">

                                                <label class="col-sm-2 form-control-label label-sm">Diet name</label>
                                                <div class="col-sm-6">
                                                    <input id="inputHorizontalSuccess" name= "recepie_name"  value="{{ $recepie_search }}"  class="form-control  form-control-success" type="text">
                                                </div>
                                                <div class="col-sm-4">
                                                    <button type="submit" class="btn btn-primary">Search</button>
                                                </div>
                                              </div>

                                              </form>
                                            </div>
                                          </div>
                                          <div class="table-responsive">
                                           <form method="POST" action='{{url("/dashboard/readypackage/programmes/add")}}'>
                                             @csrf
                                            <table class="table card-table table-vcenter text-nowrap datatable">
                                              <thead>
                                                <tr>
                                                  <th></th>
                                                  <th>
                                                    Image
                                                  </th>
                                                  <th>
                                                     Details
                                                  </th>

                                                  <th></th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                  @php
                                                   if(empty($recepie_search))
                                                     $receps_data = \App\Receips::whereraw("id  not IN(select recepe_id from ready_plan where day_num='".$day."'  and package_id='".$transaction_num."'  and  programme_design_id  IS NULL)")->paginate(10);
                                                   else
                                                    $receps_data = \App\Receips::where('name', 'LIKE', '%'.$recepie_search.'%')->whereraw("id  not IN(select recepe_id from ready_plan where day_num='".$day."'  and package_id='".$transaction_num."'  and  programme_design_id  IS NULL)")->paginate(10);
                                                  @endphp
                                                  @foreach ($receps_data as $key => $receps)
                                                  <tr>
                                                    <td><input type="checkbox" name="selected_recepies" value="{{$receps->id}}"  /></td>
                                                    <td><img src="{{url('/')}}{{$receps->image}}" width="100" height="100" /></td>
                                                    <td>{{$receps->name}}
                                                        <div><span>Description :- </span><span>{{$receps->desciption}}</span></div>
                                                        @php

                                                          $Calories = 0;
                                                          $Carbs = 0;
                                                          $Protein = 0;
                                                          $Fat = 0;
                                                          foreach($receps->integrate as $k=>$sp)
                                                          {
                                                            $Calories +=$sp->serving * $sp->integrate->calories ;
                                                            $Carbs += $sp->serving * $sp->integrate->carbs;
                                                            $Protein += $sp->serving * $sp->integrate->protein;
                                                            $Fat += $sp->serving * $sp->integrate->fat;

                                                          }

                                                        @endphp
                                                        <div><span class="badge bg-azure">Calories	 : {{$Calories	}}</span>   <span class="badge bg-purple">Carbs	 : {{$Carbs	}}</span>  <span class="badge bg-green">Protein	 : {{$Protein	}}</span>  <span class="badge bg-orange">Fat	 : {{$Fat}}</span></div>

                                                    </td>

                                                    <td class="text-right">
                                                      <a href="#" class="btn  btn-xs show_recep"  bt-data="{{$receps->id}}">
                                                        Enter
                                                      </a>
                                                    </td>

                                                  </tr>
                                                  @endforeach
                                              </tbody>
                                            </table>
                                            <input type="hidden" name="day_num" value="{{$day}}" />
                                            <input type="hidden" name="programme_type" value="recepies" />
                                            <input type="hidden" name="transaction" value="{{$transaction_num}}"/>
                                            <input type="hidden" name="week" value="{{$week}}"/>

                                            @if(count($receps_data)>0)
                                              <button type="submit" class="btn btn-primary" style="margin-top:10px;">Add Diet</button>
                                            @endif
                                          </form>
                                          </div>
                                          <div class="card-footer d-flex align-items-center">
                                            {{ $programme_data->links('dashboard.vendor.pagination.default')}}
                                          </div>
                                        </div>


                                      </div>

                        </div>
                      </div>
                      <!-- Content of card #3 -->
                      <div id="tab-top-3" class="card tab-pane {{$t == 'supliment'?'active show':''}}">
                        <div class="card-body">
                          <div class="card-title">Food supplements</div>
                          <div class="table-responsive">

                            <table class="table card-table table-vcenter text-nowrap datatable">
                              <thead>
                                <tr>
                                  <th>Image</th>
                                  <th>
                                     @lang('site.programme_title')
                                  </th>
                                  <th>

                                  </th>

                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                @if(array_key_exists("supliment",$plan))
                                  @foreach ($plan["supliment"] as $key => $programme)
                                  <tr>
                                    <td>
                                      @if($programme->programme->media_type == "image")
                                        @if(count($programme->programme->images)>0)
                                          <img src="{{url('/')}}{{$programme->programme->images[0]->image}}" width="100" height="100" />
                                        @endif
                                      @else
                                      <iframe width="150" height="150" src="{{$programme->programme->vedio}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>

                                      @endif
                                   </td>

                                    <td>{{$programme->programme->title}}
                                       <div><span>Serving size :- </span><span  class="badge bg-azure">{{$programme->suplement_serving_size}}</span></div>
                                    </td>
                                    <td>{{substr($programme->programme->desc,0,100)}}</td>
                                    <td>
                                      <a href="#" class="btn  btn-xs  show_details"  bt-data="{{$programme->programme->id}}">
                                        Enter
                                      </a>
                                      <a href="#" class="btn btn-danger btn-xs delete_btn"   bt-type="supliment" bt-data="{{$programme->plan_id}}">
                                       <i class="far fa-trash-alt"></i>
                                     </a>
                                    </td>


                                  </tr>
                                  @endforeach
                                @endif
                              </tbody>
                            </table>
                          </div>
                          <div class="card-body" style="margin-top:150px;">
                            <div class="card-title">Select more food supplements</div>
                            <div class="row" style="margin-top:5px;margin-bottom:30px;">
                              <div class="col-sm-12">
                                <form action="" method="get" />
                                <div class="row form-group row">

                                  <label class="col-sm-2 form-control-label label-sm">Supplement name</label>
                                  <div class="col-sm-6">
                                      <input id="inputHorizontalSuccess" name= "food_supliment_name"  value="{{ $suplement_search }}"  class="form-control  form-control-success" type="text">
                                  </div>
                                  <div class="col-sm-4">
                                      <button type="submit" class="btn btn-primary">Search</button>
                                  </div>
                                </div>

                                </form>
                              </div>
                            </div>
                            <div class="table-responsive">
                             <form method="POST" action='{{url("/dashboard/readypackage/programmes/add")}}'>
                               @csrf
                              <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                  <tr>
                                    <th></th>
                                    <th>Image</th>
                                    <th>
                                       @lang('site.programme_title')
                                    </th>
                                    <th>

                                    </th>
                                    <th>Serving size</th>

                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @php

                                      if(empty($suplement_search))
                                        $programme_data = \App\Programme::where("type","food supplements")->whereraw("id  not IN(select programme_design_id from  ready_plan where day_num='".$day."'  and package_id='".$transaction_num."' and recepe_id IS NULL )")->paginate(10);
                                      else
                                        $programme_data = \App\Programme::where("type","food supplements")->where('title', 'LIKE', '%'.$suplement_search.'%')->whereraw("id  not IN(select programme_design_id from  ready_plan where day_num='".$day."'  and package_id='".$transaction_num."' and recepe_id IS NULL)")->paginate(10);

                                    @endphp
                                    @foreach ($programme_data as $key => $programme)
                                    <tr>
                                      <td><input type="checkbox" name="selected_supplement" value="{{$programme->id}}"  /></td>
                                      <td>
                                          @if($programme->media_type == "image")
                                             @if(count($programme->images)>0)
                                               <img src="{{url('/')}}{{$programme->images[0]->image}}" width="100" height="100" />
                                             @endif
                                          @else
                                          <iframe width="150" height="150" src="{{$programme->vedio}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>

                                          @endif
                                     </td>
                                      <td>{{$programme->title}}
                                         <div><span>Serving size :- </span><span  class="badge bg-azure">{{$programme->serving_size}}</span></div>
                                      </td>
                                      <td>{{substr($programme->desc,0,100)}}</td>
                                      <td><input type="text" name="selected_text_serving_{{$programme->id}}" value="{{$programme->serving_size}}" class="form-control"/></td>

                                      <td>
                                        <a href="#" class="btn  btn-xs  show_details"  bt-data="{{$programme->id}}">
                                          Enter
                                        </a>

                                      </td>


                                    </tr>
                                    @endforeach
                                </tbody>
                              </table>
                              <input type="hidden" name="day_num" value="{{$day}}" />
                              <input type="hidden" name="programme_type" value="supliment" />
                              <input type="hidden" name="transaction" value="{{$transaction_num}}"/>
                              <input type="hidden" name="week" value="{{$week}}"/>
                              @if(count($programme_data)>0)
                               <button type="submit" class="btn btn-primary" style="margin-top:10px;">Add food supliment</button>
                              @endif
                            </form>
                            </div>
                            <div class="card-footer d-flex align-items-center">
                              {{ $programme_data->links('dashboard.vendor.pagination.default')}}
                            </div>
                          </div>



                        </div>
                      </div>
                    </div>
                  </div>
  </div>
</div>
<div class="modal modal-blur fade" id="show_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
        </button>
      </div>
      <div class="modal-body">
        <div class="all_content">
        </div>
      </div>
    </div>
  </div>
</div>
@include("dashboard/utility/modal_delete")
@endsection
@section('footerjscontent')
<script type="text/javascript">
$("select[name='to_transaction_type']").on("change",function(){
    var val = $(this).val();
    $(".c_tran").css("display","none");
    $(".w_tran").css("display","none");
    if(val == "same_programme")
    {
       $(".w_tran").css("display","flex");
    }
    else{
        $(".c_tran").css("display","flex");
    }
});
  $("input[name='selected_excercise']").on("change",function(){
    if($(this).is(":checked"))
    {
      var id = $(this).val();
      var url = '{{url("/dashboard/readypackage/programmes/save")}}/excercises'+"/"+id;
      $.ajax({url: url , success: function(result){
      }});
    }

  });
  $("input[name='selected_supplement']").on("change",function(){
    if($(this).is(":checked"))
    {
      var id = $(this).val();
      var url = '{{url("/dashboard/readypackage/programmes/save")}}/supliment'+"/"+id;
      $.ajax({url: url , success: function(result){
      }});
    }

  });
  $("input[name='selected_recepies']").on("change",function(){
    if($(this).is(":checked"))
    {
      var id = $(this).val();
      var url = '{{url("/dashboard/readypackage/programmes/save")}}/recepies'+"/"+id;
      $.ajax({url: url , success: function(result){
      }});
    }

  });
  $(".delete_btn").on("click",function(){
    $('#delete_modal').modal('show');
    $("input[name='delete_val']").val($(this).attr("bt-data"));
    $("input[name='type_val']").val($(this).attr("bt-type"));
    return false;
  });
  $(".delete_it_sure").on("click",function(){
    var id = $("input[name='delete_val']").val();
    var type_val = $("input[name='type_val']").val();


    var url_delete = '{{url("/dashboard/readypackage/programmes/delete")}}'+"/"+id;

    var tt = "";
    console.log(type_val);
    if(type_val == "excer")
    {
      tt = "excercises";
    }
    else if(type_val == "recep")
    {
      tt = "recepies";
      url_delete = '{{url("/dashboard/readypackage/receips/delete")}}'+"/"+id;
    }
    else{
      tt = "supliment";
    }

    $.ajax({url: url_delete , success: function(result){
            var result = JSON.parse(result);
            if(result.sucess)
            {
              window.location.href = '{{url("/dashboard/readypackage/programmes/design")}}/{{$day}}/{{$week}}/{{$transaction_num}}?type='+tt;
            }
    }});
  });
  $(".show_details").on("click",function(){
    var id = $(this).attr("bt-data");
    $.ajax({url: '{{url("/dashboard/trainers/programmes/detaills")}}'+"/"+id , success: function(result){
      $(".all_content").html("");
      $(".all_content").html(result);
      $('#show_modal').modal('show');
    }});
  });
  $(".show_recep").on("click",function(){
    var id = $(this).attr("bt-data");
    $.ajax({url: "{{ url('dashboard/trainers/receps/detaills') }}"+"/"+id , success: function(result){
      $(".all_content").html("");
      $(".all_content").html(result);
      $('#show_modal').modal('show');
    }});
  });
  $(".copy_btn").on("click",function(){
    $('#copy_modal').modal('show');
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
                      $(".alert-success-modal").html("Sucessfully copy");
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
