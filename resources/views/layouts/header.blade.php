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
                            <input type="text" placeholder="Type to search..">
                            <div class="search-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="cancel-icon">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                        @guest
                          <a href="{{url('/')}}/auth-customer" class="main-btn mr-3">Sign in</a>
                          <a href="#" class="sec-btn">Sign up</a>
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
