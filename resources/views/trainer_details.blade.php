@extends('layouts.app')

@section('content')
<!-- ==== Main content ==== -->
<main class="main-content coach-page">
    <div class="coach-profile">
        <div class="container">
            <img src="{{url($user->image)}}" alt="">
            <span class="coach-name">{{$user->name}}</span>
            <p>{{$user->desc}}</p>
            <div class="coach-meta">
                <i class="fas fa-map-marker-alt"></i>
                <span>{{$user->city_id}}</span>
            </div>
        </div>
    </div>

    <div class="coach-packages">
        <div class="container">
            <h3 class="main-tlt mt-5 mb-3">My Packages</h3>

            @php $packages = $user->packages;   @endphp
            @foreach($packages as $package)
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
                              <a href="#" class="card-btn">Food Supplement</a>
                          </div>
                          <a href="{{url('/')}}/checkout/{{$package->package_name}}/{{$package->id}}" class="sec-card-btn">Subscribe now</a>
                      </div>
                  </div>
              </div>
            @endforeach

        </div>
    </div>
</main>
@endsection
