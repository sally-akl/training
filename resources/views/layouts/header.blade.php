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
                            <a class="nav-link" href="{{url('/')}}"> Home </a>
                        </li>
                        @if(Auth::user())
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}/my-subscription"> My Subscription </a>
                        </li>
                        @endif
                    </ul>
                </div>

                <div class="right-header align-self-center">
                    <div class="d-flex">
                        <div class="search-box mr-3" id="searchbox">
                            <input type="text" placeholder="Type to search.." class="search_all_text">
                            <div class="search-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="cancel-icon">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                        @guest
                          <a href="{{url('/')}}/auth-customer" class="main-btn mr-3">Sign in</a>
                          <a href="{{url("/")}}/auth-customer-signup" class="sec-btn">Sign up</a>
                        @else
                          <div class="dropdown nt-drp show">
                              <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropNotification"
                                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-bell"></i>
                                  <span class="badge">4</span>
                              </a>

                              <div class="dropdown-menu notif-drop dropdown-menu-right" aria-labelledby="dropNotification">
                                  <div class="d-flex">
                                      <img src="assets/img/coach-4.png" alt="">
                                      <div class="not-det">
                                          <a href="#">Notification Title</a>
                                          <p class="text-truncate">
                                              Lorem ipsum dolor sit amet, consectetur adipiscing
                                          </p>
                                          <span>09:35 AM</span>
                                      </div>
                                  </div>
                                  <div class="d-flex">
                                      <img src="assets/img/coach-5.png" alt="">
                                      <div class="not-det">
                                          <a href="#">Notification Title</a>
                                          <p class="text-truncate">
                                              Lorem ipsum dolor sit amet, consectetur adipiscing
                                          </p>
                                          <span>09:35 AM</span>
                                      </div>
                                  </div>
                                  <div class="d-flex">
                                      <img src="assets/img/coach-6.png" alt="">
                                      <div class="not-det">
                                          <a href="#">Notification Title</a>
                                          <p class="text-truncate">
                                              Lorem ipsum dolor sit amet, consectetur adipiscing
                                          </p>
                                          <span>09:35 AM</span>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="dropdown show prfl-drop">
                              <a class="btn btn-secondary dropdown-toggle d-flex" href="#" role="button" id="dropProfile"
                                  data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">


                                  <img class=" align-self-center" src="{{url("/")}}<?php echo  Auth::user()->image;  ?>" alt="profile image">

                                  <div class="prf-name align-self-center">
                                      <span><?php echo  Auth::user()->name;  ?></span>
                                      <small><?php echo  Auth::user()->email;  ?></small>
                                  </div>
                              </a>

                              <div class="dropdown-menu profile-drop dropdown-menu-right" aria-labelledby="dropProfile">
                                  <div class="drop-item">
                                      <a href="{{url('/')}}/edit-profile">
                                          <i class="far fa-edit"></i>
                                          <span>Edit profile</span>
                                      </a>
                                  </div>
                                  <div class="drop-item">
                                      <a href="{{url('/')}}/tickets">
                                          <i class="far fa-comment-alt"></i>
                                          <span>Contact support</span>
                                      </a>
                                  </div>
                                  <div class="drop-item log-out">
                                      <a href="#" onclick="event.preventDefault();
                                																	 document.getElementById('logout-form').submit();">
                                          <i class="fas fa-sign-out-alt"></i>
                                          <span>Logout</span>

                                          <form id="logout-form" action="{{url("/")}}/signout" method="POST" style="display: none;">
                                  											@csrf
                                  										</form>
                                      </a>
                                  </div>
                              </div>
                          </div>
                        @endguest

                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- mobile menu -->
    <nav class="mobile-menu hs-navigation">
        <ul class="nav-links">
            <li class="active"><a href="#"> Home </a></li>
            <li><a href="#"> My Subscription</a></li>
        </ul>
    </nav>
</header>
