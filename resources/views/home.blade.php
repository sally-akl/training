@extends('layouts.app')

@section('content')
<!-- ==== Main content ==== -->
<main class="main-content home-page">
    <div class="main-slider">
        <div class="owl-carousel owl-theme">
            <div class="item">
                <a href="#">
                    <img src="{{url('/')}}/assets/img/slider.png" alt="">
                </a>
                <div class="slider-overlay"></div>
            </div>
            <div class="item">
                <a href="#">
                    <img src="{{url('/')}}/assets/img/slider-1.jpg" alt="">
                </a>
                <div class="slider-overlay"></div>
            </div>
            <div class="item">
                <a href="#">
                    <img src="{{url('/')}}/assets/img/slider-2.jpg" alt="">
                </a>
                <div class="slider-overlay"></div>
            </div>
        </div>
    </div>

    <div class="categories">
        <div class="container">
            <div class="cat-cards">
                <div class="row">

                    @foreach (\App\Category::all() as $key => $category)
                      <div class="col-lg-3 col-md-4">
                          <div class="cat-card {{isset(request()->category) && request()->category == $category->id?'active':''}} wow fadeIn" data-wow-delay="0.25s">

                              <a href="{{url("/")}}?category={{$category->id}}">
                                  <img src="{{url($category->image)}}" alt="">
                                  <span>{{$category->title}}</span>
                                  <div class="cat-overlay"></div>
                              </a>
                          </div>
                      </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="coaches-cards">
        <div class="container">
            <div class="row">
                @php

                $query = \App\User::where("role_id",2);
                if(isset(request()->category))
                  $query = $query->where('category_id',request()->category);
                $customers = $query->orderBy("id","desc")->take(6)->get();
                @endphp
                @foreach ($customers as $key => $user)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 coach-card wow fadeInUp">
                        <img src="{{url("/")}}/assets/img/coach-bg.png" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <div class="coach-pic">
                                <img src="{{url($user->image)}}" alt="">
                            </div>
                            <h5 class="card-title">{{$user->name}}</h5>
                            <p class="card-text">{{$user->desc}}</p>
                            @php  $user_pac = $user->packages()->where("package_type","paid")->orderBy("package_price","asc")->first();  @endphp
                            @if($user_pac !== null)
                            <a href="{{url("/")}}/trainer/{{$user->id}}/{{$user->name}}">Start from {{$user_pac->package_price}} $</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="all-lnk">
                <a href="#">Show All</a>
            </div>
        </div>
    </div>
</main>
@endsection
