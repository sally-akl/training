@extends('layouts.app')

@section('content')
<!-- ==== Main content ==== -->
<main class="main-content checkout-page">
    <div class="container pt-5">
        <div class="row">
            <div class="col-lg-9">
                <div class="main-card with-brd">
                    <div class="card-header">
                        <div class="d-flex">
                            <span class="pack-name">{{(session()->has('locale') && session()->get('locale') =='ar')?$package->package_name_ar:$package->package_name}}</span>
                            @if($package->package_type !="free")
                             <span class="pack-price"><small>{{$package->package_price}}$ </small> @lang('front.Per')   {{$package->package_duration}}{{$package->package_duration_type}}</span>
                             @else
                              <span class="pack-price"><small>{{(session()->has('locale') && session()->get('locale') =='ar')?'مجانا':'Free'}}</small></span>
                            @endif
                        </div>
                    </div>
                    <div class="card-content">
                        <p>{{(session()->has('locale') && session()->get('locale') =='ar')?$package->package_desc_ar:$package->package_desc}}</p>
                        <div class="card-btns d-flex justify-content-between">
                            <div>
                                <a href="#" class="card-btn">@lang('front.ExercisesProgram')</a>
                                <a href="#" class="card-btn">@lang('front.NutritionProgram')</a>
                                <a href="#" class="card-btn">@lang('front.FoodSupplement')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
              @if($package->package_type !="free")
                <div class="main-card with-brd check-card">
                    <div class="card-content">
                        <ul class="list-group p-0">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang('front.SubscriptionTotal')
                              <span>$ {{$package->package_price}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                 @lang('front.Discount')
                              <span>$ 0</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                 @lang('front.EstimatedTax')
                              <span>$ 0</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <small class="mt-3"></small>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center pt-2">
                                <b>@lang('front.OrderTotal') </b>
                              <span><b>$ {{$package->package_price}}</b></span>
                            </li>
                          </ul>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="pay-info">
          @include("dashboard.utility.error_messages")
          @if($package->package_type !="free")
            <h3>@lang('front.Paymentmethods')</h3>
            <div class="pay-info-content">
                <ul class="list-unstyled">
                    <li>
                      <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('paypal') !!}" >
                        {{ csrf_field() }}
                        <input type="hidden" name="pac" value="{{$package->id}}" />
                        <input type="hidden" name="pay_type" value="paypal" />
                          <a class="d-flex justify-content-between paypal_press" href="#">
                            <img class="align-self-center" src="{{url('/')}}/assets/img/dash/Pay-1.svg" alt="">
                            <i class="fas fa-caret-right align-self-center"></i>
                          </a>
                      </form>
                  </li>
                    <li><a class="d-flex justify-content-between" href="{{url('/')}}/payment/visa/{{$package->id}}">
                        <img class="align-self-center" src="{{url('/')}}/assets/img/dash/pay-2.svg" alt="">
                        <i class="fas fa-caret-right align-self-center"></i>
                    </a></li>
                    <li><a class="d-flex justify-content-between" href="{{url('/')}}/payment/mastercard/{{$package->id}}">
                        <img class="align-self-center" src="{{url('/')}}/assets/img/dash/pay-3.svg" alt="">
                        <i class="fas fa-caret-right align-self-center"></i>
                    </a></li>
                    <li><a class="d-flex justify-content-between" href="#">
                        <span class="align-self-center">
                            <img src="{{url('/')}}/assets/img/dash/pay-4.svg" alt="">
                            Pay
                        </span>
                        <i class="fas fa-caret-right align-self-center"></i>
                    </a></li>

                </ul>
            </div>
            @else
            <div class="pay-info-content">
              <ul class="list-unstyled">
                <li><a class="d-flex justify-content-between" href="{{url('/')}}/payment/free/{{$package->id}}">
                    <span class="align-self-center">
                        Continous
                    </span>
                    <i class="fas fa-caret-right align-self-center"></i>
                </a></li>
              </ul>
            </div>
            @endif
        </div>
    </div>
</main>
@endsection
@section('footerjscontent')
<script type="text/javascript">
  $(".paypal_press").on("click",function(){
    $("#payment-form").submit();
  });
</script>
@endsection
