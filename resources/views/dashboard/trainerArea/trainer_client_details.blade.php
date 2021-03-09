@extends('layouts.app')
@section('content')
<style>

</style>
<!-- food -->
<div class="modal fade exer-modal" id="add_new_recep_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body" style="background-color: #2c2b2a !important;color:#fff;">
              <form method="POST" action='{{url("/dashboard/trainers/programmes/add")}}' class="form_submit_recepe_model">
                @csrf
                <div class="row" style="padding: 15px;">
                  <div class="col-lg-2" style="font-size: 14px;font-weight: bold;margin-top: 6px;">
                    Add New Recepe
                  </div>
                  <div class="col-lg-8">
                      <div class="row form-group">
                        <div class="col-sm-8">
                            <input id="inputHorizontalSuccess" name= "p_recepe_name"  value=""  class="form-control  form-control-success" type="text">
                        </div>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-primary search_recep_btn" style="background-color: #ea380f;border: 1px solid #ea380f;">Search</button>
                        </div>
                      </div>
                  </div>
                  <div class="col-lg-2">
                    <button type="submit" class="btn btn-primary" style="background-color: #ea380f;border: 1px solid #ea380f;">Add Recepe</button>
                  </div>
                </dv>
              </div>

              <div class="row">
                <div class="col-lg-2 col-sm-12  col-md-2">
                  <!-- Sidebar -->
                  <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
                      <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
                      <!-- Bootstrap List Group -->
                      <ul class="list-group">

                          <!-- Menu with submenu -->
                          <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                              <div class="d-flex w-100 justify-content-start align-items-center">
                                  <span class="menu-collapsed">Sort Calories</span>
                                  <span class="submenu-icon ml-auto"></span>
                              </div>
                          </a>
                          <!-- Submenu content -->
                          <div id='submenu1' class="collapse sidebar-submenu">

                              <div  class="list-group-item list-group-item-action bg-dark text-white">
                                <input type="checkbox" name="rec_filter_type[]" value="calor_asc" class="checks_filter_recp" /><span class="menu-collapsed">Low to high Calories</span>
                              </div>

                              <div  class="list-group-item list-group-item-action bg-dark text-white">
                                <input type="checkbox" name="rec_filter_type[]" value="calor_desc" class="checks_filter_recp" /><span class="menu-collapsed">High to low Calories</span>
                              </div>


                          </div>
                          <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                              <div class="d-flex w-100 justify-content-start align-items-center">

                                  <span class="menu-collapsed">Sort portein</span>
                                  <span class="submenu-icon ml-auto"></span>
                              </div>
                          </a>
                          <!-- Submenu content -->
                          <div id='submenu2' class="collapse sidebar-submenu">

                              <div  class="list-group-item list-group-item-action bg-dark text-white">
                                <input type="checkbox" name="rec_filter_type[]" value="port_asc" class="checks_filter_recp" /><span class="menu-collapsed">Low to high </span>
                              </div>
                              <div  class="list-group-item list-group-item-action bg-dark text-white">
                                <input type="checkbox" name="rec_filter_type[]" value="port_desc" class="checks_filter_recp" /><span class="menu-collapsed">High to low </span>
                              </div>

                          </div>

                          <a href="#submenu3" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                              <div class="d-flex w-100 justify-content-start align-items-center">

                                  <span class="menu-collapsed">Sort Carbohydrates</span>
                                  <span class="submenu-icon ml-auto"></span>
                              </div>
                          </a>
                          <!-- Submenu content -->
                          <div id='submenu3' class="collapse sidebar-submenu">
                              <div  class="list-group-item list-group-item-action bg-dark text-white">
                                <input type="checkbox" name="rec_filter_type[]" value="carb_asc" class="checks_filter_recp" /><span class="menu-collapsed">Low to high </span>
                              </div>
                              <div  class="list-group-item list-group-item-action bg-dark text-white">
                                <input type="checkbox" name="rec_filter_type[]" value="carb_desc" class="checks_filter_recp" /><span class="menu-collapsed">High to low </span>
                              </div>
                          </div>

                          <a href="#submenu4" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                              <div class="d-flex w-100 justify-content-start align-items-center">

                                  <span class="menu-collapsed">Sort fats</span>
                                  <span class="submenu-icon ml-auto"></span>
                              </div>
                          </a>
                          <!-- Submenu content -->
                          <div id='submenu4' class="collapse sidebar-submenu">
                            <div  class="list-group-item list-group-item-action bg-dark text-white">
                              <input type="checkbox" name="rec_filter_type[]" value="fats_asc" class="checks_filter_recp" /><span class="menu-collapsed">Low to high </span>
                            </div>
                            <div  class="list-group-item list-group-item-action bg-dark text-white">
                              <input type="checkbox" name="rec_filter_type[]" value="fats_desc" class="checks_filter_recp" /><span class="menu-collapsed">High to low </span>
                            </div>
                          </div>
                      </ul><!-- List Group END-->
                  </div><!-- sidebar-container END -->
                </div>
                <div class="col-lg-10 col-sm-12  col-md-10 search_recp_area">

                </div>
              </div>

           </form>
        </div>
    </div>
</div>
</div>

<!--  -->



<!-- suppliment -->
<div class="modal fade exer-modal" id="add_new_suppliment_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body" style="background-color: #2c2b2a !important;color:#fff;">
              <form method="POST" action='{{url("/dashboard/trainers/programmes/add")}}' class="form_submit_suppliment_model">
                @csrf
                <div class="row" style="padding: 15px;">
                  <div class="col-lg-2" style="font-size: 14px;font-weight: bold;margin-top: 6px;">
                    Add New Supplement
                  </div>
                  <div class="col-lg-8">
                      <div class="row form-group">
                        <div class="col-sm-8">
                            <input id="inputHorizontalSuccess" name= "p_sub_name"  value=""  class="form-control  form-control-success" type="text">
                        </div>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-primary search_sup_btn" style="background-color: #ea380f;border: 1px solid #ea380f;">Search</button>
                        </div>
                      </div>
                  </div>
                  <div class="col-lg-2">
                    <button type="submit" class="btn btn-primary" style="background-color: #ea380f;border: 1px solid #ea380f;">Add Supplement</button>
                  </div>
                </dv>
              </div>

              <div class="row">

                <div class="col-lg-12 col-sm-12  col-md-12 search_suppliment_area">

                </div>
              </div>

           </form>
        </div>
    </div>
</div>
</div>
<!-- suppliment -->

<div class="modal fade exer-modal" id="add_new_excercise_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body" style="background-color: #2c2b2a !important;color:#fff;">
              <form method="POST" action='{{url("/dashboard/trainers/programmes/add")}}' class="form_submit_excersice_model">
                @csrf
                <div class="row" style="padding: 15px;">
                  <div class="col-lg-2" style="font-size: 14px;font-weight: bold;margin-top: 6px;">
                    Add New Excercises
                  </div>
                  <div class="col-lg-8">
                      <div class="row form-group">
                        <div class="col-sm-8">
                            <input id="inputHorizontalSuccess" name= "p_name"  value=""  class="form-control  form-control-success" type="text">
                        </div>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-primary search_ext_btn" style="background-color: #ea380f;border: 1px solid #ea380f;">Search</button>
                        </div>
                      </div>
                  </div>
                  <div class="col-lg-2">
                    <button type="submit" class="btn btn-primary" style="background-color: #ea380f;border: 1px solid #ea380f;">Add Excercises</button>
                  </div>
                </dv>
              </div>

              <div class="row">
                <div class="col-lg-2 col-sm-12  col-md-2">
                  <!-- Sidebar -->
                  <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
                      <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
                      <!-- Bootstrap List Group -->
                      <ul class="list-group">

                          <!-- Menu with submenu -->
                          <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                              <div class="d-flex w-100 justify-content-start align-items-center">
                                  <span class="menu-collapsed">Exercise Type</span>
                                  <span class="submenu-icon ml-auto"></span>
                              </div>
                          </a>
                          <!-- Submenu content -->
                          <div id='submenu1' class="collapse sidebar-submenu">
                            @foreach(\App\Muscles::where("type","exercisetype")->get() as $filter)
                              <div  class="list-group-item list-group-item-action bg-dark text-white">
                                <input type="checkbox" name="exerc_filter_type[]" value="exercisetype_{{$filter->id}}" class="checks_filter" /><span class="menu-collapsed">{{$filter->title}}</span>
                              </div>
                            @endforeach

                          </div>
                          <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                              <div class="d-flex w-100 justify-content-start align-items-center">

                                  <span class="menu-collapsed">Equipment</span>
                                  <span class="submenu-icon ml-auto"></span>
                              </div>
                          </a>
                          <!-- Submenu content -->
                          <div id='submenu2' class="collapse sidebar-submenu">
                            @foreach(\App\Muscles::where("type","equipment")->get() as $filter)
                              <div  class="list-group-item list-group-item-action bg-dark text-white">
                                <input type="checkbox" name="exerc_filter_type[]" value="equipment_{{$filter->id}}" class="checks_filter" /><span class="menu-collapsed">{{$filter->title}}</span>
                              </div>
                            @endforeach
                          </div>

                          <a href="#submenu3" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                              <div class="d-flex w-100 justify-content-start align-items-center">

                                  <span class="menu-collapsed">Mechanics Type</span>
                                  <span class="submenu-icon ml-auto"></span>
                              </div>
                          </a>
                          <!-- Submenu content -->
                          <div id='submenu3' class="collapse sidebar-submenu">
                            @foreach(\App\Muscles::where("type","mechanicstype")->get() as $filter)
                              <div  class="list-group-item list-group-item-action bg-dark text-white">
                                <input type="checkbox" name="exerc_filter_type[]" value="mechanicstype_{{$filter->id}}" class="checks_filter" /><span class="menu-collapsed">{{$filter->title}}</span>
                              </div>
                            @endforeach
                          </div>

                          <a href="#submenu4" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                              <div class="d-flex w-100 justify-content-start align-items-center">

                                  <span class="menu-collapsed">Level</span>
                                  <span class="submenu-icon ml-auto"></span>
                              </div>
                          </a>
                          <!-- Submenu content -->
                          <div id='submenu4' class="collapse sidebar-submenu">
                            @foreach(\App\Muscles::where("type","level")->get() as $filter)
                              <div  class="list-group-item list-group-item-action bg-dark text-white">
                                <input type="checkbox" name="exerc_filter_type[]" value="level_{{$filter->id}}" class="checks_filter" /><span class="menu-collapsed">{{$filter->title}}</span>
                              </div>
                            @endforeach
                          </div>

                          <a href="#submenu5" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                              <div class="d-flex w-100 justify-content-start align-items-center">

                                  <span class="menu-collapsed">Muscles</span>
                                  <span class="submenu-icon ml-auto"></span>
                              </div>
                          </a>
                          <!-- Submenu content -->
                          <div id='submenu5' class="collapse sidebar-submenu">
                            @foreach(\App\Muscles::where("type","muscles")->get() as $filter)
                              <div  class="list-group-item list-group-item-action bg-dark text-white">
                                <input type="checkbox" name="exerc_filter_type[]" value="Muscles_{{$filter->id}}" class="checks_filter" /><span class="menu-collapsed">{{$filter->title}}</span>
                              </div>
                            @endforeach
                          </div>
                      </ul><!-- List Group END-->
                  </div><!-- sidebar-container END -->
                </div>
                <div class="col-lg-10 col-sm-12  col-md-10 search_excercise_area">

                </div>
              </div>

           </form>
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

<div class="modal modal-blur fade" id="copy_modal" tabindex="-1" role="dialog" aria-hidden="true">
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
        <form action="{{ url('dashboard/trainers/programmes/copyday') }}" method="post" class="form_submit_model">

          <div class="row">

            <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Copy Type</label>
                  <select name="to_transaction_type" class="form-control">
                      <option value="">Select</option>
                      <option value="same_programme">Same Plan</option>
                      <option value="other_programme">Other Plan</option>
                  </select>
                </div>

            </div>
          </div>
          <div class="row c_tran" style="display:none">

            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">Copy to transaction</label>
                <select name="to_transaction" class="form-control">
                  @php  $trans_to = \App\Transactions::where("id","!=",$transaction->id)->get();  @endphp
                  @foreach($trans_to as $t_to)
                    <option value="{{$t_to->id}}">{{$t_to->transaction_num}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="row w_tran" style="display:none">
              <div class="col-lg-6">
                <div class="mb-3 " >
                  <label class="form-label">Day</label>
                  <select name="select_day" class="form-control" >
                     @php
                        //$days = \App\Transactions::find($transaction->id)->package->package_duration *  7;
                        $weekss = \App\Transactions::find($transaction->id)->package->package_duration ;
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
          </div>

          <input type="hidden" name="transaction_copy_num" value="{{$transaction->id}}" />
          <input type="hidden" name="copy_type" value="day" />
          <input type="hidden" name="copy_programme_type" value="" />
          <input type="hidden" name="day_num" class="day_num_excercises" value="" />
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>

    </div>
  </div>
</div>
<!-- ==== Main content ==== -->
<main class="main-content coach-sub-page">
    <div class="container">
        <h3 class="main-tlt mb-3 pt-5"></h3>
        <div class="main-card with-brd">
            <div class="card-header">
                <div class="d-flex justify-content-between" style="color:#fff;">
                  Client details -
                   @if($transaction->user != null)

                    {{$transaction->user->name}}

                  @endif
                </div>
            </div>
            <div class="card-content coach_div_st">
                <div class="d-sm-flex">
                    <img src="{{url($transaction->trainer->image)}}" alt="">
                    <div class="sub-coach" style="width:35%;margin-right: 20px;">

                      <table class="table card-table table-vcenter text-nowrap datatable">
                        <tbody>
                            <tr>
                              <td> @lang('site.transfer_num')</td>
                              <td>
                              {{$transaction->transaction_num}}
                              </td>
                            </tr>

                          <tr>
                            <td>Name</td>
                            <td>
                              @if($transaction->user != null)
                                  <span>
                                  {{$transaction->user->name}}
                                  </span>

                              @endif
                            </td>
                          </tr>
                          <tr>
                            <td>Email</td>
                            <td>
                              @if($transaction->user != null)
                                  <span>
                                  {{$transaction->user->email}}
                                  </span>

                              @endif
                            </td>
                          </tr>

                        </tbody>
                      </table>

                    </div>
                    <div class="sub-coach" style="width:50%;">
                      <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable">
                          <tbody>


                            <tr>
                              <td>Phone</td>
                              <td>
                                @if($transaction->user != null)
                                    <span>
                                    {{$transaction->user->phone}}
                                    </span>

                                @endif
                              </td>
                            </tr>
                            <tr>
                              <td>Subscribe package</td>
                              <td>
                                @if($transaction->package != null)
                                  <span>
                                  {{$transaction->package->package_name}}
                                  </span>

                                @endif
                              </td>
                            </tr>
                            <tr>
                              <td>Client Type</td>
                              <td style="color: #ea380f;">
                                @php  $join_date = date('Y-m-d',strtotime($transaction->transfer_date));   @endphp
                                @if($transaction->package->package_duration_type == "day")
                                  @php   $expired_date = date('Y-m-d', strtotime($join_date. ' + '.$transaction->package->package_duration.' days'));   @endphp
                                  @if($expired_date < date("Y-m-d"))
                                     <span>expired client </span>
                                  @elseif($expired_date >= date("Y-m-d"))
                                     <span>progress  client </span>
                                  @endif

                               @elseif($transaction->package->package_duration_type == "week")
                                   @php   $expired_date = date('Y-m-d', strtotime($join_date. ' + '.$transaction->package->package_duration.' weeks'));   @endphp
                                   @if($expired_date < date("Y-m-d"))
                                      <span>expired client </span>
                                   @elseif($expired_date >= date("Y-m-d"))
                                      <span>progress  client </span>
                                   @endif
                               @elseif($transaction->package->package_duration_type == "month")
                                    @php   $expired_date = date('Y-m-d', strtotime($join_date. ' + '.$transaction->package->package_duration.' months'));   @endphp
                                    @if($expired_date < date("Y-m-d"))
                                       <span>expired client </span>
                                    @elseif($expired_date >= date("Y-m-d"))
                                       <span>progress  client </span>
                                    @endif
                               @endif
                              </td>
                            </tr>
                            <tr>
                              <td>Join date</td>
                              <td>
                                <span>
                                  {{$join_date}}
                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>Expire date</td>
                              <td>
                                <span>
                                  {{$expired_date}}
                                </span>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        @php   $words = explode(" ", $transaction->user->name);
              $output= "";
              foreach ($words as $w) {
                 $output .= $w[0];
               }

         @endphp
        <div class="row">
            <div class="col-lg-6">
                <div class="coach-chat">
                    <div class="chat-content">
                        <div class="chat-bar d-flex justify-content-between">
                            <span>{{$transaction->trainer->name}}</span>
                            <small></small>
                        </div>
                        <div class="chat-msgs d-flex">
                          @php  $main_chat_cls = "chat_".$transaction->trainer->id."_".$transaction->user->id;  @endphp
                            <div class="chat-msgs-content align-self-end w-100 {{$main_chat_cls}} chat-messages">
                                <!--<div class="time-divider">
                                    <span>Today</span>
                                </div>
                              -->
                             @php  $chats = \App\Chat::whereraw("((from_user ='".$transaction->trainer->id."'  and  to_user='".$transaction->user->id."') or (from_user ='".$transaction->user->id."'  and to_user='".$transaction->trainer->id."'))")->where("booking_id",$transaction->id)->orderby("created_at","asc")->get();  @endphp


                              @foreach($chats as $chat)
                              @if($chat->from_user != $transaction->trainer->id)
                                <div class="user-msg">
                                    <div class="msg-content">
                                        @if($chat->msg_type == "text")
                                          <p>{{$chat->msg}}</p>
                                        @else
                                          <img src="{{url('/')}}{{$chat->msg}}" alt="" class="chat_img_press">
                                        @endif
                                        <span>{{ date("Y-m-d H:i" , strtotime($chat->created_at)) }} <small><i class="fas fa-check-double"></i></small></span>
                                    </div>
                                </div>

                                @else
                                <div class="coach-msg d-flex">
                                    <img src="{{url('/')}}{{$chat->user->image}}" class="coach-msg-img align-self-center" alt="">
                                    <div class="msg-content align-self-center">
                                       @if($chat->msg_type == "text")
                                        <p>{{$chat->msg}}</p>
                                       @else
                                        <img src="{{url('/')}}{{$chat->msg}}" alt="" class="chat_img_press">
                                       @endif
                                        <span>{{ date("Y-m-d H:i" , strtotime($chat->created_at)) }} </span>
                                    </div>
                                </div>

                                @endif

                              @endforeach

                            </div>
                        </div>
                        <div class="chat-send d-flex">
                            <input type="hidden" name="sender" value="{{$transaction->trainer->id}}" />
                            <input type="hidden" name="receiver" value="{{$transaction->user->id}}" />
                            <input type="hidden" name="booking" value="{{$transaction->id}}" />
                            <input type="hidden" name="submit_form_url" value="{{ url('dashboard/chat/save') }}" />
                            <input type="hidden" name="submit_form_img_url" value="{{ url('chat/image/save') }}" />
                            <input type="hidden" name="main_img_url" value="{{ url('/') }}" />
                            <input type="hidden" name="viewer_type" value="trainer" />
                            <input type="hidden" name="viewer_type_in" value="front" />
                            <input type="hidden" name="sender_img" value="{{url('/')}}{{$transaction->trainer->image}}" />
                            <input type="hidden" name="sender_name" value="{{$transaction->trainer->name}}" />
                            <input type="hidden" name="selected_date_is" value="{{date('Y-m-d H:i')}}" />
                            <input type="text" class="write_msg chat_text_box" placeholder="Type your message..." />
                            <!-- <button class="sb-btn"><i class="fas fa-paperclip"></i></button>-->
                            <button class="sb-btn image_upload_click"><i class="far fa-file-image"></i></button>

                           <!--  <div class="custom-file">
                                <input type="file" name="attachment_img"   class="custom-file-input attachment_img" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" >
                                <label class="custom-file-label" for="inputGroupFile01"><i class="far fa-file-image"></i></label>
                            </div>
                          -->
                            <button class="snd-btn send_btn"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div>
                <input type="file" name="attachment_img"   class="custom-file-input attachment_img" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" >

            </div>
            <div class="col-lg-6">
                <div class="coach-tab">
                      <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">@lang('front.ExercisesProgram')</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">@lang('front.NutritionProgram')</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">@lang('front.SupplementsProgram')</a>
                        </li>
                      </ul>
                      @php
                        if($transaction->package->package_duration_type == "day")
                          $days = $transaction->package->package_duration;
                        elseif($transaction->package->package_duration_type == "week")
                          $days = $transaction->package->package_duration ;
                        elseif($transaction->package->package_duration_type == "month")
                          $days = $transaction->package->package_duration * 30;
                      @endphp
                      <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="exer-program">
                                <div class="select-week d-flex">
                                    <span class="align-self-center">@lang('front.Selectweek') :</span>
                                    <select class="custom-select week_excercise" class="align-self-center ">
                                      @for($day = 1;$day<=$days;$day++)
                                        <option value="{{$day}}">@lang('front.Week') {{$day}}</option>
                                      @endfor
                                    </select>
                                </div>
                                <div class="select-day d-flex">
                                    <span class="align-self-center">@lang('front.Selectday') :</span>
                                    <select class="custom-select day_excercise" class="align-self-center ">
                                        <option value="1">@lang('front.Day') 1</option>
                                        <option value="2">@lang('front.Day') 2</option>
                                        <option value="3">@lang('front.Day') 3</option>
                                        <option value="4">@lang('front.Day') 4</option>
                                        <option value="5">@lang('front.Day') 5</option>
                                        <option value="6">@lang('front.Day') 6</option>
                                        <option value="7">@lang('front.Day') 7</option>
                                      </select>
                                </div>
                                <div class="row" style="margin-bottom: 20px;">
                                  <div class="col-lg-6">
                                     <a href="#" class="sec-btn lang add_new_excercise_modal" style="border-radius: 0px;">Add new</a>
                                     <a href="#" class="sec-btn lang copy_btn" data-pr="exercises" style="border-radius: 0px;background-color: #2c2b2a;">Copy</a>
                                  </div>
                                </div>
                                <div class="exercices">

                                  @php
                                  $plan_data = \App\Plan::selectraw("package_user_plan.* , package_user_plan.id as plan_id")->join("programm_designs","programm_designs.id","package_user_plan.programme_design_id")
                                                          ->whereraw("(programm_designs.type = 'exercises')")
                                                          ->where("package_user_plan.package_id",$transaction->package->id)
                                                          ->where("package_user_plan.day_num",1)
                                                          ->where("package_user_plan.transaction_id",$transaction->id)
                                                          ->get();
                                  @endphp
                                  @foreach ($plan_data as $key => $programme)
                                    <div class="exer-block d-flex">
                                      @if(count($programme->programme->images)>0 && $programme->programme->media_type == "image")
                                        <img src="{{url('/')}}{{$programme->programme->images[0]->image}}" alt="">
                                      @endif

                                      @if($programme->programme->media_type != "image")
                                      <iframe width="170" height="200" src="{{$programme->vedio}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" {{(session()->has('locale') && session()->get('locale') =='ar')?'style=margin-left:23px;margin-right:19px;':'style=margin-right:20px'}}></iframe>

                                      @endif

                                        <div class="exer-desc"  data-toggle="modal" data-target="#exerModal_{{$programme->programme->id}}">
                                            <span>{{$programme->programme->title}}
                                              <span style="float: right;"><a href="#" class="btn btn-danger btn-xs delete_btn" bt-type="excer"  bt-data="{{$programme->plan_id}}">
                                             <i class="far fa-trash-alt"></i>
                                           </a></span>
                                         </span>
                                            @php  $complete_ex = \App\CompleteExcercies::where("programme_id",$programme->programme->id)->where("user_id",Auth::user()->id)->where("day_num",1)->first();  @endphp
                                            @if(isset($complete_ex->programme_id))
                                             <small class="set_num_{{$programme->programme->id}}" style="color:green">{{$programme->set_num}}</small>
                                            @else
                                             <small class="set_num_{{$programme->programme->id}}" >{{$programme->set_num}}</small>
                                            @endif
                                            <p>{{(session()->has('locale') && session()->get('locale') =='ar')?$programme->programme->desc_ar:$programme->programme->desc}}</p>
                                        </div>
                                    </div>

                                    <!-- Exersice Modal -->
                                    <div class="modal fade exer-modal" id="exerModal_{{$programme->programme->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="modal-slider">
                                                        <div class="owl-carousel owl-theme">
                                                            @if(count($programme->programme->images)>0)
                                                             @foreach($programme->programme->images as $img)
                                                              <div class="item">
                                                                  <a href="#">
                                                                      <img src="{{url('/')}}/{{$img->image}}" alt="">
                                                                  </a>
                                                                  <div class="slider-overlay"></div>
                                                              </div>
                                                             @endforeach
                                                             @endif
                                                             @if($programme->programme->media_type !='image')
                                                              <div>  <iframe width="800" height="310"  src="{{$programme->programme->vedio}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal-exer-info">
                                                        <div class="d-flex justify-content-between">
                                                            <h4>{{(session()->has('locale') && session()->get('locale') =='ar')?$programme->programme->title_ar:$programme->programme->title}}</h4>
                                                            @if(isset($complete_ex->programme_id))
                                                            <span style="color:green">{{$programme->set_num}}</span>
                                                            @else
                                                             <span>{{$programme->set_num}}</span>
                                                            @endif
                                                        </div>
                                                        <p>{{(session()->has('locale') && session()->get('locale') =='ar')?$programme->programme->desc_ar:$programme->programme->desc}}</p>
                                                        <div class="text-center mt-4">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="nutr-program">
                                <div class="select-week d-flex">
                                    <span class="align-self-center">@lang('front.Selectweek') :</span>
                                    <select class="custom-select week_programme" class="align-self-center ">
                                        @for($day = 1;$day<=$days;$day++)
                                          <option value="{{$day}}">@lang('front.Week') {{$day}}</option>
                                        @endfor
                                      </select>
                                </div>
                                <div class="select-day d-flex">
                                    <span class="align-self-center">@lang('front.Selectday') :</span>
                                    <select class="custom-select day_programme" class="align-self-center ">
                                      <option value="1">@lang('front.Day') 1</option>
                                      <option value="2">@lang('front.Day') 2</option>
                                      <option value="3">@lang('front.Day') 3</option>
                                      <option value="4">@lang('front.Day') 4</option>
                                      <option value="5">@lang('front.Day') 5</option>
                                      <option value="6">@lang('front.Day') 6</option>
                                      <option value="7">@lang('front.Day') 7</option>
                                    </select>
                                </div>
                                <div class="row" style="margin-bottom: 20px;">
                                  <div class="col-lg-6">
                                     <a href="#" class="sec-btn lang add_new_recep_modal" style="border-radius: 0px;">Add new</a>
                                     <a href="#" class="sec-btn lang copy_btn" data-pr="dietary meals" style="border-radius: 0px;background-color: #2c2b2a;">Copy</a>
                                  </div>
                                </div>
                                @php
                                 $plan_receps = \App\Plan::selectraw("package_user_plan.* , package_user_plan.id as plan_id")->join("receips","receips.id","package_user_plan.recepe_id")
                                                    ->where("package_user_plan.package_id",$transaction->package->id)
                                                    ->where("package_user_plan.day_num",1)
                                                    ->where("package_user_plan.transaction_id",$transaction->id)
                                                    ->get();

                                @endphp
                                <div class="nutrition">

                                    @foreach ($plan_receps as $key => $receps)
                                    <div class="nutr-block d-flex">
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
                                        <div class="calories-block">
                                            <span style="font-size: 52px;">{{$Calories}}</span>
                                            <small>@lang('front.Calories')</small>
                                        </div>
                                        <div class="meals-block"  data-toggle="modal" data-target="#mealModal_{{$receps->recepe->id}}">
                                            <span>{{$receps->recepe->name}}</span>
                                            <small>{{$receps->recepe->desciption}}</small>
                                        </div>
                                        <div class="meal-stats">
                                            <div class="d-flex">
                                                <div class="meal-stat-item">
                                                    <span>@lang('front.Protien')</span>
                                                    <small>{{$Protein}}g</small>
                                                </div>
                                                <div class="meal-stat-item">
                                                    <span>@lang('front.Carbs')</span>
                                                    <small>{{$Carbs}}g</small>
                                                </div>
                                                <div class="meal-stat-item">
                                                    <span>@lang('front.Fat')</span>
                                                    <small>{{$Fat}}g</small>
                                                </div>
                                                <div class="meal-stat-item">
                                                    <span><a href="#" class="btn btn-danger btn-xs delete_btn"  bt-type="recep" bt-data="{{$receps->plan_id}}">
                                                     <i class="far fa-trash-alt"></i>
                                                   </a></span>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Meal Modal -->
                                    <div class="modal fade meal-modal" id="mealModal_{{$receps->recepe->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="modal-txt">
                                                        <h2>{{$receps->recepe->name}}</h2>
                                                    </div>
                                                    <div class="meal-sum">
                                                        <div class="d-flex justify-content-between">

                                                            <small class="calories">{{$Calories}} @lang('front.cal')</small>
                                                            <small class="calories">{{$Carbs}}g @lang('front.Carbs')  </small>
                                                            <small class="calories">{{$Protein}}g @lang('front.Protien')</small>
                                                            <small class="calories"> {{$Fat}}g @lang('front.Fat')</small>
                                                        </div>
                                                        <p>{{$receps->recepe->desciption}}</p>
                                                    </div>
                                                    @foreach($receps->recepe->integrate as $k=>$sp)
                                                    <div class="meal-items">
                                                        <div class="meal-item d-flex">
                                                          @if(count($sp->programme->images)>0)
                                                            <img src="{{url('/')}}{{$sp->programme->images[0]->image}}" alt="">
                                                          @endif
                                                            <div class="meal-item-content">
                                                                <h4>{{(session()->has('locale') && session()->get('locale') =='ar')?$sp->programme->title_ar:$sp->programme->title}}</h4>
                                                                <p>{{(session()->has('locale') && session()->get('locale') =='ar')?$sp->programme->desc_ar:$sp->programme->desc}}</p>
                                                                <div class="d-flex justify-content-between">

                                                                    <small class="calories">{{ $sp->serving * $sp->integrate->calories	}} @lang('front.cal')</small>
                                                                    <small class="calories">{{ $sp->serving * $sp->integrate->carbs	}}g @lang('front.Carbs')  </small>
                                                                    <small class="calories">{{ $sp->serving * $sp->integrate->protein	}}g @lang('front.Protien')</small>
                                                                    <small class="calories"> {{$sp->serving * $sp->integrate->fat	}}g @lang('front.Fat')</small>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    @endforeach
                                                    <div class="text-center mt-4">
                                                      <!--  <button type="button" class="main-btn py-2">Complete</button> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="select-week d-flex">
                                <span class="align-self-center">@lang('front.Selectweek') :</span>
                                <select class="custom-select week_suppliment"  class="align-self-center ">
                                  @for($day = 1;$day<=$days;$day++)
                                    <option value="{{$day}}">@lang('front.Week') {{$day}}</option>
                                  @endfor
                                </select>
                            </div>
                            <div class="select-day d-flex">
                                <span class="align-self-center">Select day :</span>
                                <select class="custom-select day_suppliment" class="align-self-center ">
                                  <option value="1">@lang('front.Day') 1</option>
                                  <option value="2">@lang('front.Day') 2</option>
                                  <option value="3">@lang('front.Day') 3</option>
                                  <option value="4">@lang('front.Day') 4</option>
                                  <option value="5">@lang('front.Day') 5</option>
                                  <option value="6">@lang('front.Day') 6</option>
                                  <option value="7">@lang('front.Day') 7</option>
                                </select>
                            </div>
                            <div class="row" style="margin-bottom: 20px;">
                              <div class="col-lg-6">
                                 <a href="#" class="sec-btn lang add_new_suppliment_modal" style="border-radius: 0px;">Add new</a>
                                 <a href="#" class="sec-btn lang copy_btn" data-pr="food supplements" style="border-radius: 0px;background-color: #2c2b2a;">Copy</a>
                              </div>
                            </div>
                            <div class="supplement-program">
                                <div class="spplements">
                                  @php
                                  $plan_data = \App\Plan::selectraw("package_user_plan.* , package_user_plan.id as plan_id")->join("programm_designs","programm_designs.id","package_user_plan.programme_design_id")
                                                          ->whereraw("(programm_designs.type = 'food supplements')")
                                                          ->where("package_user_plan.package_id",$transaction->package->id)
                                                          ->where("package_user_plan.day_num",1)
                                                          ->where("package_user_plan.transaction_id",$transaction->id)
                                                          ->get();
                                  @endphp
                                  @foreach ($plan_data as $key => $programme)
                                    <div class="supp-block d-flex">
                                      @if(count($programme->programme->images)>0)
                                        <img src="{{url('/')}}{{$programme->programme->images[0]->image}}" alt="">
                                      @endif
                                        <div class="exer-desc"  data-toggle="modal" data-target="#supplimentexerModal_{{$programme->programme->id}}">
                                            <span>{{(session()->has('locale') && session()->get('locale') =='ar')?$programme->programme->title_ar:$programme->programme->title}}
                                            <span style="float: right;">  <a href="#" class="btn btn-danger btn-xs delete_btn"   bt-type="supliment" bt-data="{{$programme->plan_id}}">
                                               <i class="far fa-trash-alt"></i>
                                             </a>
                                             </span>
                                            </span>
                                            <small>{{$programme->suplement_serving_size}}</small>
                                            <p>{{(session()->has('locale') && session()->get('locale') =='ar')?$programme->programme->desc_ar:$programme->programme->desc}}</p>
                                        </div>
                                    </div>

                                    <!-- Exersice Modal -->
                                    <div class="modal fade exer-modal" id="supplimentexerModal_{{$programme->programme->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="modal-slider">
                                                        <div class="owl-carousel owl-theme">
                                                            @if(count($programme->programme->images)>0)
                                                             @foreach($programme->programme->images as $img)
                                                              <div class="item">
                                                                  <a href="#">
                                                                      <img src="{{url('/')}}/{{$img->image}}" alt="">
                                                                  </a>
                                                                  <div class="slider-overlay"></div>
                                                              </div>
                                                             @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal-exer-info">
                                                        <div class="d-flex justify-content-between">
                                                            <h4>{{(session()->has('locale') && session()->get('locale') =='ar')?$programme->programme->title_ar:$programme->programme->title}}</h4>
                                                            <span>{{$programme->suplement_serving_size}}</span>
                                                        </div>
                                                        <p>{{(session()->has('locale') && session()->get('locale') =='ar')?$programme->programme->desc_ar:$programme->programme->desc}}</p>
                                                        <div class="text-center mt-4">
                                                          <!--  <button type="button" class="main-btn py-2">Complete</button> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  @endforeach


                                </div>
                            </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="trans" value="{{$transaction->id}}"/>

    <div class="modal fade exer-modal" id="chat_modal_img" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body chat_modal_img_body">
                   <img src="" class="chat_modal_img_body_render" />
                </div>
            </div>
        </div>
    </div>
</main>
@include("dashboard/utility/modal_delete")
@endsection
@section('footerjscontent')

<script src="{{ asset('js/socket.io.min.js') }}"></script>
<script src="{{ asset('js/chat.js') }}"></script>

<!-- intro slider -->
<script type="text/javascript">
    $('.exer-modal .owl-carousel').owlCarousel({
      loop: true,
      items:1,
      autoplay: true,
      autoplayHoverPause: true,
      nav: true,
    })
</script>

<!-- Wow Animation -->
<script type="text/javascript">
    new WOW().init();
</script>

<script type="text/javascript">
  $(".week_excercise").on("change",function(){
    var val = $(this).val();
    var url = '{{url("/get/weekday")}}'+"/"+val;
    $.ajax({url: url , success: function(result){
        $(".day_excercise").html("");
        $(".day_excercise").append(result);
    }});
  });
  $(".week_programme").on("change",function(){
    var val = $(this).val();
    var url = '{{url("/get/weekday")}}'+"/"+val;
    $.ajax({url: url , success: function(result){
        $(".day_programme").html("");
        $(".day_programme").append(result);
    }});
  });
  $(".week_suppliment").on("change",function(){
    var val = $(this).val();
    var url = '{{url("/get/weekday")}}'+"/"+val;
    $.ajax({url: url , success: function(result){
        $(".day_suppliment").html("");
        $(".day_suppliment").append(result);
    }});
  });


  var completeForm = function(){
    $(".complete_ex_form").off();
    $(".complete_ex_form").submit(function(e){

        e.preventDefault();
        var submit_form_url = $(this).attr('action');
        var $method_is = "POST";
        var formData = new FormData($(this)[0]);
        formData.append('day_num',$(".day_excercise").val());
        $.ajax({
            url: submit_form_url,
            type: $method_is,
            data: formData,
            async: false,
            dataType: 'json',
            success: function (response) {
               $(".set_num_"+formData.get("pr_id")).css("color","green");
               $('#exerModal_'+formData.get("pr_id")).modal('hide');
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
  }
  completeForm();

var   _delete = function()
  {
    $(".delete_btn").off();
    $(".delete_btn").on("click",function(){
      $('#delete_modal').modal('show');
      $("input[name='delete_val']").val($(this).attr("bt-data"));
      $("input[name='type_val']").val($(this).attr("bt-type"));
      return false;
    });
    $(".delete_it_sure").off();
    $(".delete_it_sure").on("click",function(){
      var id = $("input[name='delete_val']").val();
      var type_val = $("input[name='type_val']").val();


      var url_delete = '{{url("/dashboard/trainers/programmes/delete")}}'+"/"+id;

      var tt = "";
      console.log(type_val);
      if(type_val == "excer")
      {
        tt = "excercises";
      }
      else if(type_val == "recep")
      {
        tt = "recepies";
        url_delete = '{{url("/dashboard/trainers/receips/delete")}}'+"/"+id;
      }
      else{
        tt = "supliment";
      }

      $.ajax({url: url_delete , success: function(result){
              var result = JSON.parse(result);
              if(result.sucess)
              {
                window.location.href = '{{url("/dashboard/trainersarea/clients/details/")}}/{{$transaction->id}}';
              }
      }});
    });
  }
  _delete();

  $(".day_excercise").on("change",function(){
    var val = $(this).val();
    var url = '{{url("/dashboard/trainersarea/get/excercies")}}'+"/"+val+"/"+$("input[name='trans']").val();
    $.ajax({url: url , success: function(result){
        $(".exercices").html("");
        $(".exercices").html(result);
        _delete();
        completeForm();
        $('.exer-modal .owl-carousel').owlCarousel({
          loop: true,
          items:1,
          autoplay: true,
          autoplayHoverPause: true,
          nav: true,
        })
    }});
  });
  $(".day_programme").on("change",function(){
    var val = $(this).val();
    var url = '{{url("/dashboard/trainersarea/get/food")}}'+"/"+val+"/"+$("input[name='trans']").val();
    $.ajax({url: url , success: function(result){
        $(".nutrition").html("");
        $(".nutrition").html(result);
        _delete();
    }});
  });
  $(".day_suppliment").on("change",function(){
    var val = $(this).val();
    var url = '{{url("/dashboard/trainersarea/get/suppliment")}}'+"/"+val+"/"+$("input[name='trans']").val();
    $.ajax({url: url , success: function(result){
        $(".spplements").html("");
        $(".spplements").html(result);
        _delete();
        $('.exer-modal .owl-carousel').owlCarousel({
          loop: true,
          items:1,
          autoplay: true,
          autoplayHoverPause: true,
          nav: true,
        })
    }});
  });
  $(".image_upload_click").on("click",function(){
     $('.attachment_img').trigger('click');
  });
  $(".chat_img_press").off();
  $(".chat_img_press").on("click",function(){
    $(".chat_modal_img_body_render").attr("src",$(this).attr("src"));
    $('#chat_modal_img').modal('show');
  });
  $(".copy_btn").on("click",function(){
    $(".day_num_excercises").val($(".day_excercise").val());
    $("input[name='copy_programme_type']").val($(this).attr("data-pr"));
    $('#copy_modal').modal('show');
  });
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
  _aftersearch = function(response)
  {
    $(".search_excercise_area").html("")
    $(".search_excercise_area").html(response);
    $("input[name='selected_excercise']").off(0);
    $("input[name='selected_excercise']").on("change",function(){
      if($(this).is(":checked"))
      {
        var id = $(this).val();
        var url = '{{url("/dashboard/trainers/programmes/save")}}/excercises'+"/"+id;
        $.ajax({url: url , success: function(result){
        }});
      }

    });
    $(".show_details").off();
    $(".show_details").on("click",function(){
      var id = $(this).attr("bt-data");
      $.ajax({url: '{{url("/dashboard/trainers/programmes/detaills")}}'+"/"+id , success: function(result){
        $(".all_content").html("");
        $(".all_content").html(result);
        $('#show_modal').modal('show');
      }});
    });
  }
  _aftersupplimentsearch = function(response)
  {
    $(".search_suppliment_area").html("")
    $(".search_suppliment_area").html(response);
    $("input[name='selected_supplement']").off();
    $("input[name='selected_supplement']").on("change",function(){
      if($(this).is(":checked"))
      {
        var id = $(this).val();
        var url = '{{url("/dashboard/trainers/programmes/save")}}/supliment'+"/"+id;
        $.ajax({url: url , success: function(result){
        }});
      }

    });
    $(".show_details").off();
    $(".show_details").on("click",function(){
      var id = $(this).attr("bt-data");
      $.ajax({url: '{{url("/dashboard/trainers/programmes/detaills")}}'+"/"+id , success: function(result){
        $(".all_content").html("");
        $(".all_content").html(result);
        $('#show_modal').modal('show');
      }});
    });
  }
  _afterrecepsearch = function(response)
  {
    $(".search_recp_area").html("")
    $(".search_recp_area").html(response);
    $("input[name='selected_recepies']").off();
    $("input[name='selected_recepies']").on("change",function(){
      if($(this).is(":checked"))
      {
        var id = $(this).val();
        var url = '{{url("/dashboard/trainers/programmes/save")}}/recepies'+"/"+id;
        $.ajax({url: url , success: function(result){
        }});
      }

    });
    $(".show_recep").off();
    $(".show_recep").on("click",function(){
      var id = $(this).attr("bt-data");
      $.ajax({url: "{{ url('dashboard/trainers/receps/detaills') }}"+"/"+id , success: function(result){
        $(".all_content").html("");
        $(".all_content").html(result);
        $('#show_modal').modal('show');
      }});
    });
  }
  $(".search_sup_btn").on("click",function(){
    var formData = new FormData();

    formData.append('package_num','{{$transaction->package->id}}');
    formData.append('user_num','{{Auth::user()->id}}');
    formData.append('transaction','{{$transaction->id}}');
    formData.append('day_num',$(".day_suppliment").val());
    formData.append('week',$(".week_suppliment").val());
    formData.append('programme_search',$("input[name='p_sub_name']").val());
    $.ajax({
              url: '{{url("/dashboard/trainersarea/suppliment/get")}}',
              type: "POST",
              data: formData,
              async: false,
              success: function (response) {
                _aftersupplimentsearch(response);
              },
            error : function( data )
            {

            },
            cache: false,
            contentType: false,
            processData: false
    });
  });
  $(".add_new_suppliment_modal").on("click",function(){
      var formData = new FormData();

      formData.append('package_num','{{$transaction->package->id}}');
      formData.append('user_num','{{Auth::user()->id}}');
      formData.append('transaction','{{$transaction->id}}');
      formData.append('day_num',$(".day_suppliment").val());
      formData.append('week',$(".week_suppliment").val());
      formData.append('programme_search',$("input[name='p_sub_name']").val());
      $.ajax({
                url: '{{url("/dashboard/trainersarea/suppliment/get")}}',
                type: "POST",
                data: formData,
                async: false,
                success: function (response) {
                  _aftersupplimentsearch(response);
                },
              error : function( data )
              {

              },
              cache: false,
              contentType: false,
              processData: false
      });
      $('#add_new_suppliment_modal').modal('show');
  });
  var ex_select_checkbox = [];
  var recp_select_checkbox = [];

  $(".search_recep_btn").on("click",function(){
    var formData = new FormData();

    formData.append('package_num','{{$transaction->package->id}}');
    formData.append('user_num','{{Auth::user()->id}}');
    formData.append('transaction','{{$transaction->id}}');
    formData.append('day_num',$(".day_programme").val());
    formData.append('week',$(".week_programme").val());
    formData.append('programme_search',$("input[name='p_recepe_name']").val());
    formData.append('programme_filter',JSON.stringify(recp_select_checkbox));
    $.ajax({
              url: '{{url("/dashboard/trainersarea/recepe/get")}}',
              type: "POST",
              data: formData,
              async: false,
              success: function (response) {
                _afterrecepsearch(response);
              },
            error : function( data )
            {

            },
            cache: false,
            contentType: false,
            processData: false
    });
  });
  $("input[name='rec_filter_type[]']").on("change",function(){
     if($(this).is(':checked'))
     {
       recp_select_checkbox.push($(this).val());
     }
     else{
       const index = recp_select_checkbox.indexOf($(this).val());
        if (index > -1) {
          recp_select_checkbox.splice(index, 1);
        }
     }
     formData = new FormData();

     formData.append('package_num','{{$transaction->package->id}}');
     formData.append('user_num','{{Auth::user()->id}}');
     formData.append('transaction','{{$transaction->id}}');
     formData.append('day_num',$(".day_programme").val());
     formData.append('week',$(".week_programme").val());
     formData.append('programme_search',$("input[name='p_recepe_name']").val());
     formData.append('programme_filter',JSON.stringify(recp_select_checkbox));
     $.ajax({
               url: '{{url("/dashboard/trainersarea/recepe/get")}}',
               type: "POST",
               data: formData,
               async: false,
               success: function (response) {
                 _afterrecepsearch(response);
               },
             error : function( data )
             {

             },
             cache: false,
             contentType: false,
             processData: false
     });

  });

  $(".add_new_recep_modal").on("click",function(){
    var formData = new FormData();

    formData.append('package_num','{{$transaction->package->id}}');
    formData.append('user_num','{{Auth::user()->id}}');
    formData.append('transaction','{{$transaction->id}}');
    formData.append('day_num',$(".day_programme").val());
    formData.append('week',$(".week_programme").val());
    formData.append('programme_search',$("input[name='p_recepe_name']").val());
    $.ajax({
              url: '{{url("/dashboard/trainersarea/recepe/get")}}',
              type: "POST",
              data: formData,
              async: false,
              success: function (response) {
                recp_select_checkbox = [];
                _afterrecepsearch(response);
              },
            error : function( data )
            {

            },
            cache: false,
            contentType: false,
            processData: false
    });
    $('#add_new_recep_modal').modal('show');
  });

  $(".add_new_excercise_modal").on("click",function(){
    var formData = new FormData();

    formData.append('package_num','{{$transaction->package->id}}');
    formData.append('user_num','{{Auth::user()->id}}');
    formData.append('transaction','{{$transaction->id}}');
    formData.append('day_num',$(".day_excercise").val());
    formData.append('week',$(".week_excercise").val());
    formData.append('programme_search',$("input[name='p_name']").val());
    $.ajax({
              url: '{{url("/dashboard/trainersarea/programmes/get")}}',
              type: "POST",
              data: formData,
              async: false,
              success: function (response) {
                ex_select_checkbox = [];
                _aftersearch(response);
              },
            error : function( data )
            {

            },
            cache: false,
            contentType: false,
            processData: false
    });
    $('#add_new_excercise_modal').modal('show');
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
  $(".show_details").off();
  $(".show_details").on("click",function(){
    var id = $(this).attr("bt-data");
    $.ajax({url: '{{url("/dashboard/trainers/programmes/detaills")}}'+"/"+id , success: function(result){
      $(".all_content").html("");
      $(".all_content").html(result);
      $('#show_modal').modal('show');
    }});
  });
  $(".search_ext_btn").on("click",function(){

     formData = new FormData();
     formData.append('package_num','{{$transaction->package->id}}');
     formData.append('user_num','{{Auth::user()->id}}');
     formData.append('transaction','{{$transaction->id}}');
     formData.append('day_num',$(".day_excercise").val());
     formData.append('week',$(".week_excercise").val());
     formData.append('programme_search',$("input[name='p_name']").val());
     formData.append('programme_filter',JSON.stringify(ex_select_checkbox));
     $.ajax({
               url: '{{url("/dashboard/trainersarea/programmes/get")}}',
               type: "POST",
               data: formData,
               async: false,
               success: function (response) {
                 _aftersearch(response);
               },
             error : function( data )
             {

             },
             cache: false,
             contentType: false,
             processData: false
     });
     console.log(ex_select_checkbox);
  });


  $("input[name='exerc_filter_type[]']").on("change",function(){
     if($(this).is(':checked'))
     {
       ex_select_checkbox.push($(this).val());
     }
     else{
       const index = ex_select_checkbox.indexOf($(this).val());
        if (index > -1) {
          ex_select_checkbox.splice(index, 1);
        }
     }
     formData = new FormData();

     formData.append('package_num','{{$transaction->package->id}}');
     formData.append('user_num','{{Auth::user()->id}}');
     formData.append('transaction','{{$transaction->id}}');
     formData.append('day_num',$(".day_excercise").val());
     formData.append('week',$(".week_excercise").val());
     formData.append('programme_search',$("input[name='p_name']").val());
     formData.append('programme_filter',JSON.stringify(ex_select_checkbox));
     $.ajax({
               url: '{{url("/dashboard/trainersarea/programmes/get")}}',
               type: "POST",
               data: formData,
               async: false,
               success: function (response) {
                 _aftersearch(response);
               },
             error : function( data )
             {

             },
             cache: false,
             contentType: false,
             processData: false
     });

  });
  $(".form_submit_recepe_model").submit(function(e){

        e.preventDefault();
        var submit_form_url = $(this).attr('action');
        var $method_is = "POST";
        var formData = new FormData($(this)[0]);
        $(".alert-success-modal").css("display","none");
        $(".alert-danger-modal").css("display","none");

          $.ajax({
                    url: submit_form_url,
                    type: $method_is,
                    data: formData,
                    async: false,

                    success: function (response) {
                    window.location.href = '{{url("/dashboard/trainersarea/clients/details/")}}/{{$transaction->id}}';
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

  $(".form_submit_suppliment_model").submit(function(e){

        e.preventDefault();
        var submit_form_url = $(this).attr('action');
        var $method_is = "POST";
        var formData = new FormData($(this)[0]);
        $(".alert-success-modal").css("display","none");
        $(".alert-danger-modal").css("display","none");

          $.ajax({
                    url: submit_form_url,
                    type: $method_is,
                    data: formData,
                    async: false,

                    success: function (response) {
                    window.location.href = '{{url("/dashboard/trainersarea/clients/details/")}}/{{$transaction->id}}';
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
  $(".form_submit_excersice_model").submit(function(e){

      e.preventDefault();
      var submit_form_url = $(this).attr('action');
      var $method_is = "POST";
      var formData = new FormData($(this)[0]);
      $(".alert-success-modal").css("display","none");
      $(".alert-danger-modal").css("display","none");

        $.ajax({
                  url: submit_form_url,
                  type: $method_is,
                  data: formData,
                  async: false,

                  success: function (response) {
                  window.location.href = '{{url("/dashboard/trainersarea/clients/details/")}}/{{$transaction->id}}';
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

  // Hide submenus
$('#body-row .collapse').collapse('hide');

// Collapse/Expand icon
$('#collapse-icon').addClass('fa-angle-double-left');

// Collapse click
$('[data-toggle=sidebar-colapse]').click(function() {
    SidebarCollapse();
});

function SidebarCollapse () {
    $('.menu-collapsed').toggleClass('d-none');
    $('.sidebar-submenu').toggleClass('d-none');
    $('.submenu-icon').toggleClass('d-none');
    $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');

    // Treating d-flex/d-none on separators with title
    var SeparatorTitle = $('.sidebar-separator-title');
    if ( SeparatorTitle.hasClass('d-flex') ) {
        SeparatorTitle.removeClass('d-flex');
    } else {
        SeparatorTitle.addClass('d-flex');
    }

    // Collapse/Expand icon
    $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
}
</script>
@endsection
