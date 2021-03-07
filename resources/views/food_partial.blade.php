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
                        <small class="calories">{{$Carbs}}g @lang('front.Carbs') </small>
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
                                <small class="calories">{{ $sp->serving * $sp->integrate->carbs	}}g @lang('front.Carbs') </small>
                                <small class="calories">{{ $sp->serving * $sp->integrate->protein	}}g @lang('front.Protien')</small>
                                <small class="calories"> {{$sp->serving * $sp->integrate->fat	}}g @lang('front.Fat')</small>
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
