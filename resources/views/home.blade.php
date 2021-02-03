@extends('layouts.app')

@section('content')
<!-- ==== Main content ==== -->
<main class="main-content home-page">
    <div class="main-slider">
        <div class="owl-carousel owl-theme">
            @foreach(\App\Slider::orderBy("id","desc")->get() as $slider)
            <div class="item">
                <a href="#">
                    <img src="{{url('/')}}{{$slider->image}}" alt="">
                </a>
                <div class="slider-overlay"></div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="categories">
        <div class="container">
            <div class="cat-cards">
                <div class="row">

                    @foreach (\App\Category::all() as $key => $category)
                      <div class="col-lg-3 col-md-4">
                          <div class="cat-card {{isset(request()->category) && request()->category == $category->id?'active':''}} wow fadeIn" data-wow-delay="0.25s">

                              <a href="{{url("/")}}?category={{$category->id}}&search={{request()->search}}&show={{request()->show}}">
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
                if(isset(request()->category) && !empty(request()->category))
                  $query = $query->where('category_id',request()->category);
                if(isset(request()->search) && !empty(request()->search))
                  $query = $query->where('name', 'LIKE', '%'.request()->search.'%');

                if(isset(request()->show) && !empty(request()->show))
                  $customers = $query->orderBy("id","desc")->get();
                else
                  $customers = $query->orderBy("id","desc")->take(6)->get();
                @endphp
                @foreach ($customers as $key => $user)
                <div class="col-md-6 mb-4">

                    <div class="card h-100 coach-card wow fadeInUp">
                        <img src="{{url("/")}}/assets/img/coach-bg.png" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <div class="coach-pic">
                              <img src="{{url($user->image)}}" alt="" style="border-radius:50%;width: 150px;height: 150px;">
                            </div>
                            <h5 class="card-title">{{$user->name}}</h5>
                            <p class="card-text">{{$user->desc}}</p>
                            @php  $user_pac = $user->packages()->where("package_type","paid")->orderBy("package_price","asc")->first();  @endphp

                            <a href="{{url("/")}}/trainer/{{$user->id}}/{{$user->name}}">Start from
                               @if($user_pac !== null)
                               {{$user_pac->package_price}}
                               @else
                                0
                               @endif
                                $</a>

                        </div>
                    </div>

                </div>
                @endforeach

            </div>
            <div class="all-lnk">
                <a href="{{url("/")}}?category={{request()->category}}&search={{request()->search}}&show=all">Show All</a>
            </div>
        </div>
    </div>
</main>
@endsection
@section('footerjscontent')

<!-- intro slider -->
<script type="text/javascript">
    $('.main-slider .owl-carousel').owlCarousel({
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
@endsection
