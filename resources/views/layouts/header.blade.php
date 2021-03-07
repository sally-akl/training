<!-- ==== HEADER ==== -->
   <header>

       <!-- Main Menu -->
       <div class="main-header hs-menubar">
           <div class="container-fluid">
               <nav class="navbar navbar-expand-lg">

                   <!-- Brand -->
                   <a class="navbar-brand main-logo" href="{{url('/')}}">
                       <img src="{{url('/')}}/assets/img/logo.png" class="navbar-brand-img" alt="logo">
                   </a>

                   <!-- Toggler -->
                   <div class="menu-trigger"> <i class="fas fa-bars"></i></div>

                   <div class="collapse navbar-collapse main-menu" id="navbarCollapse">
                       <!-- Navigation -->
                       <ul class="left-menu navbar-nav mr-auto">
                           <li class="nav-item active">
                               <a class="nav-link" href="{{url('/')}}">@lang('front.Home')  </a>
                           </li>
                             @if(Auth::user())
                           <li class="nav-item">
                               <a class="nav-link" href="{{url('/')}}/my-subscription">@lang('front.MySubscription')</a>
                           </li>
                           @endif


                       </ul>
                   </div>
                     @guest
                   <div class="right-header align-self-center">
                       <div class="d-flex">
                           <div class="search-box mr-3" id="searchbox">
                               <input type="text" placeholder="{{__('front.Typetosearch')}}.." class="search_all_text">
                               <div class="search-icon">
                                   <i class="fas fa-search"></i>
                               </div>
                               <div class="cancel-icon">
                                   <i class="fas fa-times"></i>
                               </div>
                           </div>
                           <a href="{{url('/')}}/auth-customer" class="main-btn mr-3">@lang('front.Signin')</a>
                           <a href="{{url("/")}}/auth-customer-signup" class="sec-btn">@lang('front.Signup')</a>
                           <a  href="{{url('/')}}/lang/{{(session()->has('locale') && session()->get('locale') =='ar')?'en':'ar'}}" class="sec-btn lang">@lang('front.language') </a>
                       </div>
                   </div>
                     @else

                   <div class="right-header align-self-center">
                       <div class="d-flex">
                           <div class="search-box mr-3" id="searchbox">
                               <input type="text" placeholder="{{__('front.Typetosearch')}}.." class="search_all_text">
                               <div class="search-icon">
                                   <i class="fas fa-search"></i>
                               </div>
                               <div class="cancel-icon">
                                   <i class="fas fa-times"></i>
                               </div>
                           </div>
                           <div class="dropdown nt-drp show">
                               <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropNotification"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   <i class="fas fa-bell"></i>
                                   <span class="badge">4</span>
                               </a>

                               <div class="dropdown-menu notif-drop dropdown-menu-right notify_{{Auth::user()->id}}" aria-labelledby="dropNotification">
                                 @php  $notifications = \App\Notifications::where("user_id",Auth::user()->id)->where("is_send",1)->orderby("send_date","desc")->get();   @endphp
                                 @foreach($notifications as $notification)
                                 <div class="d-flex">

                                     @if($notification->send_from != null)
                                     <img src="{{url('/')}}{{\App\User::find($notification->send_from)->image}}" alt="" style="border-radius: 50%;">
                                     @else
                                     <img src="{{url('/')}}/img/admin.jpg" alt="" style="border-radius: 50%;">
                                     @endif
                                     <div class="not-det">
                                         @if($notification->send_from != null)
                                           <a href="#">Notify from {{\App\User::find($notification->send_from)->name}}</a>
                                         @else
                                         <a href="#">Notify from admin</a>
                                         @endif
                                         <p class="text-truncate">
                                             @if(preg_match('/(\.jpg|\.png|\.bmp|\.gif|\.jpeg)$/', $notification->msg))
                                               <img src="{{url('/')}}{{$notification->msg}}"/>
                                             @else
                                             {{$notification->msg}}
                                             @endif
                                         </p>
                                         <span>{{$notification->created_at}}</span>
                                     </div>
                                 </div>
                                 @endforeach
                               </div>
                           </div>



                           <div class="dropdown show prfl-drop">
                               <a class="btn btn-secondary dropdown-toggle d-flex" href="#" role="button" id="dropProfile"
                                   data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                                   <?php
                                     if(!empty(Auth::user()->image))
                                     {


                                   ?>
                                   <img class=" align-self-center" src="{{url("/")}}<?php echo  Auth::user()->image;  ?>" alt="profile image" style="border-radius: 50%;">
                                   <?php
                                     }
                                   ?>
                                   <div class="prf-name align-self-center">
                                       <span style="text-align:left;"><?php echo  Auth::user()->name;  ?></span>
                                       <small><?php echo  Auth::user()->email;  ?></small>
                                   </div>
                               </a>

                               <div class="dropdown-menu profile-drop dropdown-menu-right" aria-labelledby="dropProfile">
                                   <div class="drop-item">
                                       <a href="{{url('/')}}/edit-profile">
                                           <i class="far fa-edit"></i>
                                           <span>@lang('front.Editprofile')</span>
                                       </a>
                                   </div>
                                   <div class="drop-item">
                                       <a href="{{url('/')}}/tickets">
                                           <i class="far fa-comment-alt"></i>
                                           <span>@lang('front.Contactsupport')</span>
                                       </a>
                                   </div>
                                   <div class="drop-item log-out">
                                       <a href="#" onclick="event.preventDefault();
                                 																	 document.getElementById('logout-form').submit();">
                                           <i class="fas fa-sign-out-alt"></i>
                                           <span>@lang('front.Logout')</span>
                                       </a>
                                       <form id="logout-form" action="{{url("/")}}/signout" method="POST" style="display: none;">
                                                     @csrf
                                                   </form>
                                   </div>
                               </div>
                           </div>
                           <a  href="{{url('/')}}/lang/{{(session()->has('locale') && session()->get('locale') =='ar')?'en':'ar'}}" class="sec-btn lang">@lang('front.language') </a>

                       </div>
                   </div>
                   @endguest
               </nav>
           </div>
       </div>

       <!-- mobile menu -->
       <nav class="mobile-menu hs-navigation">
           <div class="mobile-search">
               <input type="text" placeholder="{{__('front.Typetosearch')}}" class="search_all_text">
               <div class="search-icon">
                   <i class="fas fa-search"></i>
               </div>
           </div>
           <ul class="nav-links">
               <li class="active"><a href="{{url('/')}}">@lang('front.Home')  </a></li>
                @guest
                <li><a href="{{url('/')}}/auth-customer">@lang('front.Signin')</a></li>
                <li><a href="{{url("/")}}/auth-customer-signup">@lang('front.Signup')</a></li>


              @else
              <li><a href="{{url('/')}}/my-subscription">@lang('front.MySubscription')</a></li>
              <li><a href="{{url('/')}}/edit-profile">@lang('front.EditProfile')</a></li>
              <li><a href="{{url('/')}}/tickets">@lang('front.ContactSupport')  </a></li>
              <li><a href="#" onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">@lang('front.Logout') </a>
                                          <form id="logout-form" action="{{url("/")}}/signout" method="POST" style="display: none;">
                                                        @csrf
                                                      </form>

                                        </li>

               @endguest
           </ul>
       </nav>
   </header>
