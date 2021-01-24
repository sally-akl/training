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
                            <span class="pack-name">{{$package->package_name}}</span>
                            @if($package->package_type !="free")
                             <span class="pack-price"><small>{{$package->package_price}}$ </small> Per  {{$package->package_duration}}{{$package->package_duration_type}}</span>
                             @else
                              <span class="pack-price"><small>Free</small></span>
                            @endif
                        </div>
                    </div>
                    <div class="card-content">
                        <p>{{$package->package_desc}}</p>
                        <div class="card-btns d-flex justify-content-between">
                            <div>
                                <a href="#" class="card-btn">Exercises Program</a>
                                <a href="#" class="card-btn">Nutrition Program</a>
                                <a href="#" class="card-btn">Nutrition Program</a>
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
                                Subscription Total
                              <span>$ {{$package->package_price}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Discount
                              <span>$ 0</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Estimated Tax
                              <span>$ 0</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <small class="mt-3"></small>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center pt-2">
                                <b>Order Total</b>
                              <span><b>$ {{$package->package_price}}</b></span>
                            </li>
                          </ul>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="pay-info">
            <h3>Payment methods</h3>
            <div class="pay-info-content">
                <ul class="list-unstyled">
                    <li><a class="d-flex justify-content-between" href="#">
                        <img class="align-self-center" src="{{url('/')}}/assets/img/dash/Pay-1.svg" alt="">
                        <i class="fas fa-caret-right align-self-center"></i>
                    </a></li>
                    <li><a class="d-flex justify-content-between" href="#">
                        <img class="align-self-center" src="{{url('/')}}/assets/img/dash/Pay-2.svg" alt="">
                        <i class="fas fa-caret-right align-self-center"></i>
                    </a></li>
                    <li><a class="d-flex justify-content-between" href="#">
                        <img class="align-self-center" src="{{url('/')}}/assets/img/dash/Pay-3.svg" alt="">
                        <i class="fas fa-caret-right align-self-center"></i>
                    </a></li>
                    <li><a class="d-flex justify-content-between" href="#">
                        <span class="align-self-center">
                            <img src="{{url('/')}}/assets/img/dash/Pay-4.svg" alt="">
                            Pay
                        </span>
                        <i class="fas fa-caret-right align-self-center"></i>
                    </a></li>

                </ul>
            </div>
        </div>
    </div>
</main>
@endsection
