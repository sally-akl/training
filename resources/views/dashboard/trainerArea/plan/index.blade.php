@extends('dashboard.layouts.master')
@section('content')
<div class="page-header">
  <div class="row align-items-center">
    <div class="col-auto">
      <h2 class="page-title">
          Day {{$day}} - Package ( {{\App\Package::find($package)->package_name}} )
      </h2>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="card-tabs">
                    <!-- Cards navigation -->
                    <ul class="nav nav-tabs">
                      <li class="nav-item"><a href="#tab-top-1" class="nav-link active" data-toggle="tab">Excercises</a></li>
                      <li class="nav-item"><a href="#tab-top-2" class="nav-link" data-toggle="tab">Recepies</a></li>
                      <li class="nav-item"><a href="#tab-top-3" class="nav-link" data-toggle="tab">Food supplements</a></li>
                    </ul>
                    <div class="tab-content">
                      <!-- Content of card #1 -->
                      <div id="tab-top-1" class="card tab-pane active show">
                        <div class="card-body">
                          <div class="card-title">Excercises</div>
                          <div class="table-responsive">

                            <table class="table card-table table-vcenter text-nowrap datatable">
                              <thead>
                                <tr>
                                  <th>
                                     @lang('site.programme_title')
                                  </th>
                                  <th>
                                     @lang('site.programme_type')
                                  </th>
                                  <th>
                                     @lang('site.upload_programme')
                                  </th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                @if(array_key_exists("excercises",$plan))
                                  @foreach ($plan["excercises"] as $key => $programme)
                                  <tr>
                                    <td>{{$programme->programme->title}}</td>
                                    <td>{{$programme->programme->type}}</td>
                                    <td>{{$programme->programme->media_type}}</td>
                                    <td class="text-right">
                                      <a href="{{ url('dashboard/trainers/programmes/detaills') }}/{{$programme->programme->id}}" class="btn  btn-xs "  bt-data="{{$programme->id}}">
                                        Details
                                      </a>
                                      <a href="#" class="btn btn-danger btn-xs delete_btn" bt-type="excer"  bt-data="{{$day}}-{{$package}}-{{$user_id}}-{{$programme->programme->id}}">
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

                        <div class="card-body">
                          <div class="card-title">Select more excercises</div>
                          <div class="table-responsive">
                           <form method="POST" action='{{url("/dashboard/trainers/programmes/add")}}'>
                             @csrf
                            <table class="table card-table table-vcenter text-nowrap datatable">
                              <thead>
                                <tr>
                                  <th></th>
                                  <th>
                                     @lang('site.programme_title')
                                  </th>
                                  <th>
                                     @lang('site.programme_type')
                                  </th>
                                  <th>
                                     @lang('site.upload_programme')
                                  </th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                  @php  $programme_data = \App\Programme::where("type","exercises")->whereraw("id  not IN(select programme_design_id from package_user_plan where day_num='".$day."' and package_id='".$package."' and recepe_id IS NULL and section_id  IS NULL)")->paginate(10); @endphp
                                  @foreach ($programme_data as $key => $programme)
                                  <tr>
                                    <td><input type="checkbox" name="selected_excercise" value="{{$programme->id}}"  /></td>
                                    <td>{{$programme->title}}</td>
                                    <td>{{$programme->type}}</td>
                                    <td>{{$programme->media_type}}</td>

                                  </tr>
                                  @endforeach
                              </tbody>
                            </table>
                            <input type="hidden" name="day_num" value="{{$day}}" />
                            <input type="hidden" name="package_num" value="{{$package}}" />
                            <input type="hidden" name="user_num" value="{{$user_id}}" />
                            <input type="hidden" name="programme_type" value="excercises" />
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
                      <div id="tab-top-2" class="card tab-pane">
                        <div class="card-body">
                          <div class="card-title">Recepies</div>
                              <div class="card-tabs">
                                  <!-- Cards navigation -->
                                  <ul class="nav nav-tabs">
                                    @foreach(\App\Section::all() as $k=>$section)
                                      <li class="nav-item"><a href="#{{$section->section_name}}" class="nav-link {{$k==0?'active':''}}" data-toggle="tab">{{$section->section_name}}</a></li>
                                    @endforeach
                                  </ul>
                                  <div class="tab-content">
                                    <!-- Content of card #1 -->
                                    @foreach(\App\Section::all() as $k=>$section)
                                    <div id="{{$section->section_name}}" class="card tab-pane {{$k==0?'active':''}} show">
                                      <div class="card-body">
                                        <div class="card-title">{{$section->section_name}} Receips</div>
                                        <div class="table-responsive">

                                          <table class="table card-table table-vcenter text-nowrap datatable">
                                            <thead>
                                              <tr>
                                                <th>
                                                  Image
                                                </th>
                                                <th>
                                                   Title
                                                </th>
                                                <th>
                                                   Description
                                                </th>

                                                <th></th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                                @if(array_key_exists($section->id,$plan_section_receps))
                                                @foreach ($plan_section_receps[$section->id] as $key => $receps)
                                                <tr>
                                                  <td><img src="{{url('/')}}{{$receps->recepe->image}}" width="100" height="100" /></td>
                                                  <td>{{$receps->recepe->name}}</td>
                                                  <td>{{$receps->recepe->desciption}}</td>
                                                  <td class="text-right">
                                                    <a href="{{ url('dashboard/trainers/receps/detaills') }}/{{$receps->recepe->id}}" class="btn  btn-xs "  bt-data="{{$receps->recepe->id}}">
                                                      Details
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-xs delete_btn"  bt-type="recep" bt-data="{{$day}}-{{$package}}-{{$user_id}}-{{$receps->recepe->id}}-{{$section->id}}">
                                                     <i class="far fa-trash-alt"></i>
                                                   </a>
                                                  </td>

                                                </tr>
                                                @endforeach
                                                @endif

                                            </tbody>
                                          </table>
                                        </div>
                                        <!--  next cart -->

                                        <div class="card-body">
                                          <div class="card-title">Select more recepies</div>
                                          <div class="table-responsive">
                                           <form method="POST" action='{{url("/dashboard/trainers/programmes/add")}}'>
                                             @csrf
                                            <table class="table card-table table-vcenter text-nowrap datatable">
                                              <thead>
                                                <tr>
                                                  <th></th>
                                                  <th>
                                                    Image
                                                  </th>
                                                  <th>
                                                     Title
                                                  </th>
                                                  <th>
                                                     Description
                                                  </th>
                                                  <th></th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                  @php  $receps_data = \App\Receips::whereraw("id  not IN(select recepe_id from package_user_plan where day_num='".$day."' and package_id='".$package."' and section_id='".$section->id."' and  programme_design_id  IS NULL)")->paginate(10); @endphp
                                                  @foreach ($receps_data as $key => $receps)
                                                  <tr>
                                                    <td><input type="checkbox" name="selected_recepies" value="{{$receps->id}}"  /></td>
                                                    <td><img src="{{url('/')}}{{$receps->image}}" width="100" height="100" /></td>
                                                    <td>{{$receps->name}}</td>
                                                    <td>{{$receps->desciption}}</td>
                                                    <td class="text-right">
                                                      <a href="{{ url('dashboard/trainers/receps/detaills') }}/{{$receps->id}}" class="btn  btn-xs "  bt-data="{{$receps->id}}">
                                                        Details
                                                      </a>
                                                    </td>

                                                  </tr>
                                                  @endforeach
                                              </tbody>
                                            </table>
                                            <input type="hidden" name="day_num" value="{{$day}}" />
                                            <input type="hidden" name="package_num" value="{{$package}}" />
                                            <input type="hidden" name="user_num" value="{{$user_id}}" />
                                            <input type="hidden" name="programme_type" value="recepies" />
                                            <input type="hidden" name="section_val" value="{{$section->id}}" />
                                            @if(count($receps_data)>0)
                                              <button type="submit" class="btn btn-primary" style="margin-top:10px;">Add recepies</button>
                                            @endif
                                          </form>
                                          </div>
                                          <div class="card-footer d-flex align-items-center">
                                            {{ $programme_data->links('dashboard.vendor.pagination.default')}}
                                          </div>
                                        </div>


                                      </div>
                                    </div>
                                    @endforeach
                                  </div>
                          </div>

                        </div>
                      </div>
                      <!-- Content of card #3 -->
                      <div id="tab-top-3" class="card tab-pane">
                        <div class="card-body">
                          <div class="card-title">Food supplements</div>
                          <div class="table-responsive">

                            <table class="table card-table table-vcenter text-nowrap datatable">
                              <thead>
                                <tr>
                                  <th>
                                     @lang('site.programme_title')
                                  </th>
                                  <th>
                                     @lang('site.programme_type')
                                  </th>

                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                @if(array_key_exists("supliment",$plan))
                                  @foreach ($plan["supliment"] as $key => $programme)
                                  <tr>
                                    <td>{{$programme->programme->title}}</td>
                                    <td>{{$programme->programme->type}}</td>

                                    <td class="text-right">
                                      <a href="{{ url('dashboard/trainers/programmes/detaills') }}/{{$programme->programme->id}}" class="btn  btn-xs "  bt-data="{{$programme->id}}">
                                        Details
                                      </a>
                                      <a href="#" class="btn btn-danger btn-xs delete_btn"   bt-type="supliment" bt-data="{{$day}}-{{$package}}-{{$user_id}}-{{$programme->programme->id}}">
                                       <i class="far fa-trash-alt"></i>
                                     </a>
                                    </td>

                                  </tr>
                                  @endforeach
                                @endif
                              </tbody>
                            </table>
                          </div>
                          <div class="card-body">
                            <div class="card-title">Select more food supplements</div>
                            <div class="table-responsive">
                             <form method="POST" action='{{url("/dashboard/trainers/programmes/add")}}'>
                               @csrf
                              <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                  <tr>
                                    <th></th>
                                    <th>
                                       @lang('site.programme_title')
                                    </th>
                                    <th>
                                       @lang('site.programme_type')
                                    </th>

                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @php  $programme_data = \App\Programme::where("type","food supplements")->whereraw("id  not IN(select programme_design_id from package_user_plan where day_num='".$day."' and package_id='".$package."' and recepe_id IS NULL and section_id  IS NULL)")->paginate(10); @endphp
                                    @foreach ($programme_data as $key => $programme)
                                    <tr>
                                      <td><input type="checkbox" name="selected_supplement" value="{{$programme->id}}"  /></td>
                                      <td>{{$programme->title}}</td>
                                      <td>{{$programme->type}}</td>


                                    </tr>
                                    @endforeach
                                </tbody>
                              </table>
                              <input type="hidden" name="day_num" value="{{$day}}" />
                              <input type="hidden" name="package_num" value="{{$package}}" />
                              <input type="hidden" name="user_num" value="{{$user_id}}" />
                              <input type="hidden" name="programme_type" value="supliment" />
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
@include("dashboard/utility/modal_delete")
@endsection
@section('footerjscontent')
<script type="text/javascript">
  $("input[name='selected_excercise']").on("change",function(){
    if($(this).is(":checked"))
    {
      var id = $(this).val();
      var url = '{{url("/dashboard/trainers/programmes/save")}}/excercises'+"/"+id;
      $.ajax({url: url , success: function(result){
      }});
    }

  });
  $("input[name='selected_supplement']").on("change",function(){
    if($(this).is(":checked"))
    {
      var id = $(this).val();
      var url = '{{url("/dashboard/trainers/programmes/save")}}/supliment'+"/"+id;
      $.ajax({url: url , success: function(result){
      }});
    }

  });
  $("input[name='selected_recepies']").on("change",function(){
    if($(this).is(":checked"))
    {
      var id = $(this).val();
      var url = '{{url("/dashboard/trainers/programmes/save")}}/recepies'+"/"+id;
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
    id =  id.split("-");
    var  day = id[0];
    var  package_id = id[1];
    var  user_id = id[2];
    var programme_id = id[3];


    var url_delete = '{{url("/dashboard/trainers/programmes/delete")}}'+"/"+day+"/"+package_id+"/"+programme_id+"/"+user_id;
    if(type_val == "recep")
    {
      var section = id[4];
      url_delete = '{{url("/dashboard/trainers/receips/delete")}}'+"/"+day+"/"+package_id+"/"+programme_id+"/"+section+"/"+user_id;
    }


    $.ajax({url: url_delete , success: function(result){
            var result = JSON.parse(result);
            if(result.sucess)
            {
              window.location.href = '{{url("/dashboard/trainers/programmes/design")}}/{{$day}}/{{$package}}/{{$user_id}}';
            }
    }});
  });
</script>
@endsection
