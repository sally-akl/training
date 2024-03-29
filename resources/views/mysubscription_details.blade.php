@extends('layouts.app')
@section('content')
<style>

</style>
<!-- ==== Main content ==== -->
<main class="main-content coach-sub-page">
    <div class="container">
        <h3 class="main-tlt mb-3 pt-5">@lang('front.MySubscription')</h3>
        <div class="main-card with-brd">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <span class="pack-name">{{(session()->has('locale') && session()->get('locale') =='ar')?$transaction->package->package_name_ar:$transaction->package->package_name}}</span>
                    <div class="sub-info">
                        <div class="d-flex">
                            <div class="sub-info-block">
                                <i class="fas fa-flag-checkered"></i>
                                @php  $join_date = date('m/d/Y',strtotime($transaction->transfer_date));   @endphp
                                <small>@lang('front.Starton') {{$join_date}}</small>
                            </div>
                            <div class="sub-info-block">
                                <i class="fas fa-hourglass-half"></i>
                                <small>@lang('front.Expireon') {{date('m/d/Y', strtotime($join_date. ' + '.$transaction->package->package_duration.' weeks'))}}</small>
                            </div>
                            <div class="sub-info-block">
                                <i class="fas fa-dollar-sign"></i>
                                <small>@lang('front.Price') {{$transaction->package->package_price}} USD</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-content">
                <div class="d-sm-flex">
                    <img src="{{url($transaction->trainer->image)}}" alt="">
                    <div class="sub-coach">
                        <h4>{{(session()->has('locale') && session()->get('locale') =='ar')?$transaction->trainer->name_ar:$transaction->trainer->name}}</h4>
                        <p>{{(session()->has('locale') && session()->get('locale') =='ar')?$transaction->trainer->description_ar:$transaction->trainer->desc}}</p>
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
                            <span>{{(session()->has('locale') && session()->get('locale') =='ar')?$transaction->trainer->name_ar:$transaction->trainer->name}}</span>
                            <small></small>
                        </div>
                        <div class="chat-msgs d-flex">
                            @php  $main_chat_cls = "chat_".$transaction->trainer->id."_".$transaction->user->id;  @endphp
                            <div class="chat-msgs-content align-self-end w-100 {{$main_chat_cls}} chat-messages">
                                <!--<div class="time-divider">
                                    <span>Today</span>
                                </div>
                              -->
                              @php  $chats = \App\Chat::whereraw("((from_user ='".$transaction->trainer->id."'  and  to_user='".$transaction->user->id."') or (from_user ='".$transaction->user->id."'  and to_user='".$transaction->trainer->id."'))")->where("booking_id",$transaction->id)->orderby("created_at","asc")->get();


                               @endphp
                              @foreach($chats as $chat)
                                @if($chat->from_user == $transaction->user->id)
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
                            <input type="hidden" name="sender" value="{{$transaction->user->id}}" />
                            <input type="hidden" name="receiver" value="{{$transaction->trainer->id}}" />
                            <input type="hidden" name="booking" value="{{$transaction->id}}" />
                            <input type="hidden" name="submit_form_url" value="{{ url('dashboard/chat/save') }}" />
                            <input type="hidden" name="submit_form_img_url" value="{{ url('chat/image/save') }}" />
                            <input type="hidden" name="main_img_url" value="{{ url('/') }}" />
                            <input type="hidden" name="viewer_type" value="user" />
                            <input type="hidden" name="viewer_type_in" value="site" />
                            <input type="hidden" name="sender_img" value="{{$output}}" />
                            <input type="hidden" name="sender_name" value="{{$transaction->user->name}}" />
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
                        <li class="nav-item" role="presentation"{{(session()->has('locale') && session()->get('locale') =='ar')?'style=margin-right:-42px':''}}>
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
                                <div class="exercices">
                                  @php
                                  $plan_data = \App\Plan::join("programm_designs","programm_designs.id","package_user_plan.programme_design_id")
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
                                            <span>{{(session()->has('locale') && session()->get('locale') =='ar')?$programme->programme->title_ar:$programme->programme->title}}</span>
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
                                                            <form action="{{url('/')}}/add/excercise/complete" method="post" class="complete_ex_form">
                                                              <input type="hidden" name="pr_id" value="{{$programme->programme->id}}"/>

                                                              <button type="submit" class="main-btn py-2 excercise_complete">Complete</button>
                                                            </form>
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
                                @php
                                 $plan_receps = \App\Plan::join("receips","receips.id","package_user_plan.recepe_id")
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
                                            <span>{{$Calories}}</span>
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
                            <div class="supplement-program">
                                <div class="spplements">
                                  @php
                                  $plan_data = \App\Plan::join("programm_designs","programm_designs.id","package_user_plan.programme_design_id")
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
                                            <span>{{(session()->has('locale') && session()->get('locale') =='ar')?$programme->programme->title_ar:$programme->programme->title}}</span>
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
@endsection
@section('footerjscontent')
@if(Auth::user()->role->name=="user")
<script src="{{ asset('js/socket.io.min.js') }}"></script>
<script src="{{ asset('js/chat.js') }}"></script>
@endif
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


  $(".day_excercise").on("change",function(){
    var val = $(this).val();
    var url = '{{url("/get/excercies")}}'+"/"+val+"/"+$("input[name='trans']").val();
    $.ajax({url: url , success: function(result){
        $(".exercices").html("");
        $(".exercices").html(result);
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
    var url = '{{url("/get/food")}}'+"/"+val+"/"+$("input[name='trans']").val();
    $.ajax({url: url , success: function(result){
        $(".nutrition").html("");
        $(".nutrition").html(result);
    }});
  });
  $(".day_suppliment").on("change",function(){
    var val = $(this).val();
    var url = '{{url("/get/suppliment")}}'+"/"+val+"/"+$("input[name='trans']").val();
    $.ajax({url: url , success: function(result){
        $(".spplements").html("");
        $(".spplements").html(result);
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
</script>
@endsection
