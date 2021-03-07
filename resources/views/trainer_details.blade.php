@extends('layouts.app')

@section('content')
<!-- ==== Main content ==== -->
<main class="main-content coach-page">
    <div class="coach-profile">
        <div class="container">
            <img src="{{url($user->image)}}" alt="" style="border-radius: 50%;">
            <span class="coach-name">{{(session()->has('locale') && session()->get('locale') =='ar')?$user->name_ar:$user->name}}</span>
            <p>{{(session()->has('locale') && session()->get('locale') =='ar')?$user->description_ar:$user->desc}}</p>
            <div class="coach-meta">
                <i class="fas fa-map-marker-alt"></i>
                <span>{{(session()->has('locale') && session()->get('locale') =='ar')?$user->city_ar:$user->city_id}}</span>
            </div>
        </div>
    </div>

    <div class="coach-packages">
        <div class="container">
            <h3 class="main-tlt mt-5 mb-3">@lang('front.MyPackages')</h3>

            @php $packages = $user->packages;   @endphp
            @foreach($packages as $package)
              <div class="main-card with-brd">
                  <div class="card-header">
                      <div class="d-flex">
                          <span class="pack-name">{{(session()->has('locale') && session()->get('locale') =='ar')?$package->package_name_ar:$package->package_name}}</span>
                          @if($package->package_type !="free")
                           <span class="pack-price"><small>{{$package->package_price}}$ </small>@lang('front.Per')   {{$package->package_duration}}{{$package->package_duration_type}}</span>
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
                          <a href="{{url('/')}}/checkout/{{$package->package_name}}/{{$package->id}}" class="sec-card-btn">@lang('front.Subscribenow')</a>
                      </div>
                  </div>
              </div>
            @endforeach

        </div>
    </div>
</main>
@endsection
