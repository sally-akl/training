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
            $days = \App\ReadyPlanPackage::find($pac_plan)->weeks;
          @endphp
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="exer-program">
                    <div class="select-week d-flex">
                        <span class="align-self-center">@lang('front.Selectweek') :</span>
                        <select class="custom-select week_ready_excercise" class="align-self-center ">
                          @for($day = 1;$day<=$days;$day++)
                            <option value="{{$day}}">@lang('front.Week') {{$day}}</option>
                          @endfor
                        </select>
                    </div>
                    <div class="select-day d-flex">
                        <span class="align-self-center">@lang('front.Selectday') :</span>
                        <select class="custom-select day_ready_excercise" class="align-self-center ">
                            <option value="0">Select</option>
                            <option value="1" {{$daynum == 1?"selected":""}}>@lang('front.Day') 1</option>
                            <option value="2" {{$daynum == 2?"selected":""}}>@lang('front.Day') 2</option>
                            <option value="3" {{$daynum == 3?"selected":""}}>@lang('front.Day') 3</option>
                            <option value="4" {{$daynum == 4?"selected":""}}>@lang('front.Day') 4</option>
                            <option value="5" {{$daynum == 5?"selected":""}}>@lang('front.Day') 5</option>
                            <option value="6" {{$daynum == 6?"selected":""}}>@lang('front.Day') 6</option>
                            <option value="7" {{$daynum == 7?"selected":""}}>@lang('front.Day') 7</option>
                          </select>
                    </div>
                    <div class="exercices">

                      @php
                      $plan_data = \App\ReadyPlan::selectraw("ready_plan.* , ready_plan.id as plan_id")->join("programm_designs","programm_designs.id","ready_plan.programme_design_id")
                                              ->whereraw("(programm_designs.type = 'exercises')")
                                              ->where("ready_plan.package_id",$pac_plan)
                                              ->where("ready_plan.day_num",$daynum)
                                              ->get();
                      @endphp
                      @foreach ($plan_data as $key => $programme)
                        <div class="exer-block d-flex">
                          @if(count($programme->programme->images)>0 && $programme->programme->media_type == "image")
                            <img src="{{url('/')}}{{$programme->programme->images[0]->image}}" alt="">
                          @endif

                          @if($programme->programme->media_type != "image")
                          <iframe width="170" height="200" src="{{$programme->programme->vedio}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" {{(session()->has('locale') && session()->get('locale') =='ar')?'style=margin-left:23px;margin-right:19px;':'style=margin-right:20px'}}></iframe>

                          @endif

                            <div class="exer-desc">
                                <span>{{$programme->programme->title}}</span>
                                @php  $complete_ex = \App\CompleteExcercies::where("programme_id",$programme->programme->id)->where("user_id",Auth::user()->id)->where("day_num",1)->first();  @endphp
                                @if(isset($complete_ex->programme_id))
                                 <small class="set_num_{{$programme->programme->id}}" style="color:green">{{$programme->set_num}}</small>
                                @else
                                 <small class="set_num_{{$programme->programme->id}}" >{{$programme->set_num}}</small>
                                @endif
                                <p>{{(session()->has('locale') && session()->get('locale') =='ar')?$programme->programme->desc_ar:$programme->programme->desc}}</p>
                            </div>
                        </div>
                      @endforeach

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="nutr-program">
                    @php
                     $plan_receps = \App\ReadyPlan::selectraw("ready_plan.* , ready_plan.id as plan_id")->join("receips","receips.id","ready_plan.recepe_id")
                                        ->where("ready_plan.package_id",$pac_plan)
                                        ->where("ready_plan.day_num",$daynum)
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
                            <div class="meals-block">
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
                        @endforeach


                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="supplement-program">
                    <div class="spplements">
                      @php
                      $plan_data = \App\ReadyPlan::selectraw("ready_plan.* , ready_plan.id as plan_id")->join("programm_designs","programm_designs.id","ready_plan.programme_design_id")
                                              ->whereraw("(programm_designs.type = 'food supplements')")
                                              ->where("ready_plan.package_id",$pac_plan)
                                              ->where("ready_plan.day_num",$daynum)
                                              ->get();
                      @endphp
                      @foreach ($plan_data as $key => $programme)
                        <div class="supp-block d-flex">
                          @if(count($programme->programme->images)>0)
                            <img src="{{url('/')}}{{$programme->programme->images[0]->image}}" alt="">
                          @endif
                            <div class="exer-desc"  data-toggle="modal" data-target="#supplimentexerModal_{{$programme->programme->id}}">
                                <span>{{(session()->has('locale') && session()->get('locale') =='ar')?$programme->programme->title_ar:$programme->programme->title}}
                                </span>
                                <small>{{$programme->suplement_serving_size}}</small>
                                <p>{{(session()->has('locale') && session()->get('locale') =='ar')?$programme->programme->desc_ar:$programme->programme->desc}}</p>
                            </div>
                        </div>
                      @endforeach
                    </div>
                </div>
            </div>
          </div>
    </div>
