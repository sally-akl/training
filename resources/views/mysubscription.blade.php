@extends('layouts.app')

@section('content')
<!-- ==== Main content ==== -->
<main class="main-content subscription-page">
    <div class="container">
        <h3 class="main-tlt mb-3 pt-5">@lang('front.MySubscription')</h3>
        @foreach ($bookings as $key => $transaction)
        <div class="main-card with-brd">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <span class="pack-name align-self-center"><a href="{{url('/')}}/my-subscription/details/{{$transaction->id}}" style="color:#fff">{{(session()->has('locale') && session()->get('locale') =='ar')?$transaction->package->package_name_ar:$transaction->package->package_name}}</a></span>
                    <div class="sub-info align-self-center">
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
                            @if($transaction->package->package_type !="free")
                              <div class="sub-info-block">
                                  <i class="fas fa-dollar-sign"></i>
                                  <small>@lang('front.Price') {{$transaction->package->package_price}} USD</small>
                              </div>
                            @else
                              <div class="sub-info-block">
                                  <i class="fas fa-dollar-sign"></i>
                                  <small>Free</small>
                              </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-content">
                <div class="d-flex">
                    <img src="{{url($transaction->trainer->image)}}" alt="">
                    <div class="sub-coach">
                        <h4>{{(session()->has('locale') && session()->get('locale') =='ar')?$transaction->trainer->name_ar:$transaction->trainer->name}}</h4>
                        <p>{{(session()->has('locale') && session()->get('locale') =='ar')?$transaction->trainer->description_ar:$transaction->trainer->desc}}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</main>
@endsection
