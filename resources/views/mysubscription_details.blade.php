@extends('layouts.app')
@section('content')
<!-- ==== Main content ==== -->
<main class="main-content coach-sub-page">
    <div class="container">
        <h3 class="main-tlt mb-3 pt-5">My Subscription</h3>
        <div class="main-card with-brd">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <span class="pack-name">{{$transaction->package->package_name}}</span>
                    <div class="sub-info">
                        <div class="d-flex">
                            <div class="sub-info-block">
                                <i class="fas fa-flag-checkered"></i>
                                @php  $join_date = date('m/d/Y',strtotime($transaction->transfer_date));   @endphp
                                <small>Start on {{$join_date}}</small>
                            </div>
                            <div class="sub-info-block">
                                <i class="fas fa-hourglass-half"></i>
                                <small>Expire on {{date('m/d/Y', strtotime($join_date. ' + '.$transaction->package->package_duration.' weeks'))}}</small>
                            </div>
                            <div class="sub-info-block">
                                <i class="fas fa-dollar-sign"></i>
                                <small>Price {{$transaction->package->package_price}} USD</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-content">
                <div class="d-sm-flex">
                    <img src="{{url($transaction->trainer->image)}}" alt="">
                    <div class="sub-coach">
                        <h4>{{$transaction->trainer->name}}</h4>
                        <p>{{$transaction->trainer->desc}}</p>
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
                            <small>Online</small>
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
                                        <p>{{$chat->msg}}</p>
                                        <span>{{ date("Y-m-d H:m" , strtotime($chat->created_at)) }} <small><i class="fas fa-check-double"></i></small></span>
                                    </div>
                                </div>

                                @else
                                <div class="coach-msg d-flex">
                                    <img src="{{url('/')}}{{$chat->user->image}}" class="coach-msg-img align-self-center" alt="">
                                    <div class="msg-content align-self-center">
                                        <p>{{$chat->msg}}</p>
                                        <span>{{ date("Y-m-d H:m" , strtotime($chat->created_at)) }} </span>
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
                            <input type="hidden" name="viewer_type" value="user" />
                            <input type="hidden" name="viewer_type_in" value="site" />
                            <input type="hidden" name="sender_img" value="{{$output}}" />
                            <input type="hidden" name="sender_name" value="{{$transaction->user->name}}" />
                            <input type="text" class="write_msg chat_text_box" placeholder="Type your message..." />
                            <!-- <button class="sb-btn"><i class="fas fa-paperclip"></i></button>-->
                            <button class="sb-btn"><i class="far fa-file-image"></i></button>
                            <button class="snd-btn send_btn"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="coach-tab">
                      <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Exercises Program</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Nutrition Program</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Supplements Program</a>
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
                                    <span class="align-self-center">Select week :</span>
                                    <select class="custom-select week_excercise" class="align-self-center ">
                                      @for($day = 1;$day<=$days;$day++)
                                        <option value="{{$day}}">Week {{$day}}</option>
                                      @endfor
                                    </select>
                                </div>
                                <div class="select-day d-flex">
                                    <span class="align-self-center">Select day :</span>
                                    <select class="custom-select day_excercise" class="align-self-center ">
                                        <option value="1">Day 1</option>
                                        <option value="2">Day 2</option>
                                        <option value="3">Day 3</option>
                                        <option value="4">Day 4</option>
                                        <option value="5">Day 5</option>
                                        <option value="6">Day 6</option>
                                        <option value="7">Day 7</option>
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
                                        <img src="{{url('/')}}/img/download.png" alt="">
                                      @endif

                                        <div class="exer-desc"  data-toggle="modal" data-target="#exerModal_{{$programme->programme->id}}">
                                            <span>{{$programme->programme->title}}</span>
                                            <small>{{$programme->set_num}}</small>
                                            <p>{{$programme->programme->desc}}</p>
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
                                                              <div>{!! $programme->programme->vedio !!}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal-exer-info">
                                                        <div class="d-flex justify-content-between">
                                                            <h4>{{$programme->programme->title}}</h4>
                                                            <span>{{$programme->set_num}}</span>
                                                        </div>
                                                        <p>{{$programme->programme->desc}}</p>
                                                        <div class="text-center mt-4">
                                                            <button type="button" class="main-btn py-2">Complete</button>
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
                                    <span class="align-self-center">Select week :</span>
                                    <select class="custom-select week_programme" class="align-self-center ">
                                        @for($day = 1;$day<=$days;$day++)
                                          <option value="{{$day}}">Week {{$day}}</option>
                                        @endfor
                                      </select>
                                </div>
                                <div class="select-day d-flex">
                                    <span class="align-self-center">Select day :</span>
                                    <select class="custom-select day_programme" class="align-self-center ">
                                      <option value="1">Day 1</option>
                                      <option value="2">Day 2</option>
                                      <option value="3">Day 3</option>
                                      <option value="4">Day 4</option>
                                      <option value="5">Day 5</option>
                                      <option value="6">Day 6</option>
                                      <option value="7">Day 7</option>
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
                                            <small>Calories</small>
                                        </div>
                                        <div class="meals-block"  data-toggle="modal" data-target="#mealModal_{{$receps->recepe->id}}">
                                            <span>{{$receps->recepe->name}}</span>
                                            <small>{{$receps->recepe->desciption}}</small>
                                        </div>
                                        <div class="meal-stats">
                                            <div class="d-flex">
                                                <div class="meal-stat-item">
                                                    <span>Protien</span>
                                                    <small>{{$Protein}}g</small>
                                                </div>
                                                <div class="meal-stat-item">
                                                    <span>Carbs</span>
                                                    <small>{{$Carbs}}g</small>
                                                </div>
                                                <div class="meal-stat-item">
                                                    <span>Fat</span>
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

                                                            <small class="calories">{{$Calories}} cal</small>
                                                            <small class="calories">{{$Carbs}}g carbs </small>
                                                            <small class="calories">{{$Protein}}g protien</small>
                                                            <small class="calories"> {{$Fat}}g fat</small>
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
                                                                <h4>{{$sp->programme->title}}</h4>
                                                                <p>{{$sp->programme->desc}}</p>
                                                                <div class="d-flex justify-content-between">

                                                                    <small class="calories">{{ $sp->serving * $sp->integrate->calories	}} cal</small>
                                                                    <small class="calories">{{ $sp->serving * $sp->integrate->carbs	}}g carbs </small>
                                                                    <small class="calories">{{ $sp->serving * $sp->integrate->protein	}}g protien</small>
                                                                    <small class="calories"> {{$sp->serving * $sp->integrate->fat	}}g fat</small>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    @endforeach
                                                    <div class="text-center mt-4">
                                                        <button type="button" class="main-btn py-2">Complete</button>
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
                                <span class="align-self-center">Select week :</span>
                                <select class="custom-select week_suppliment"  class="align-self-center ">
                                  @for($day = 1;$day<=$days;$day++)
                                    <option value="{{$day}}">Week {{$day}}</option>
                                  @endfor
                                </select>
                            </div>
                            <div class="select-day d-flex">
                                <span class="align-self-center">Select day :</span>
                                <select class="custom-select day_suppliment" class="align-self-center ">
                                  <option value="1">Day 1</option>
                                  <option value="2">Day 2</option>
                                  <option value="3">Day 3</option>
                                  <option value="4">Day 4</option>
                                  <option value="5">Day 5</option>
                                  <option value="6">Day 6</option>
                                  <option value="7">Day 7</option>
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
                                            <span>{{$programme->programme->title}}</span>
                                            <small>{{$programme->suplement_serving_size}}</small>
                                            <p>{{$programme->programme->desc}}</p>
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
                                                            <h4>{{$programme->programme->title}}</h4>
                                                            <span>{{$programme->suplement_serving_size}}</span>
                                                        </div>
                                                        <p>{{$programme->programme->desc}}</p>
                                                        <div class="text-center mt-4">
                                                            <button type="button" class="main-btn py-2">Complete</button>
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


  $(".day_excercise").on("change",function(){
    var val = $(this).val();
    var url = '{{url("/get/excercies")}}'+"/"+val+"/"+$("input[name='trans']").val();
    $.ajax({url: url , success: function(result){
        $(".exercices").html("");
        $(".exercices").html(result);
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

</script>
@endsection
