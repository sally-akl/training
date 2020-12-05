<ul class="navbar-nav">
  <li class="nav-item {{$controller == 'DashboardController' ?'active':'' }}">
    <a class="nav-link" href='{{url("/dashboard")}}' >
      <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
      </span>
      <span class="nav-link-title">
       @lang('site.dashboard')
      </span>
    </a>
  </li>
  <li class="nav-item  dropdown  {{$controller == 'CountryController' || $controller == 'CategoryController' ?'active':'' }}">
    <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown" role="button" aria-expanded="false" >
      <span class="nav-link-icon d-md-none d-lg-inline-block"> <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="12" cy="12" r="9"></circle><line x1="3.6" y1="9" x2="20.4" y2="9"></line><line x1="3.6" y1="15" x2="20.4" y2="15"></line><path d="M11.5 3a17 17 0 0 0 0 18"></path><path d="M12.5 3a17 17 0 0 1 0 18"></path></svg>
      </span>
      <span class="nav-link-title">
        @lang('site.settings')
      </span>
    </a>
    <ul class="dropdown-menu dropdown-menu-columns  dropdown-menu-columns-2">
      <li >
        <a class="dropdown-item" href='{{url("/dashboard/category")}}'>
          @lang('site.categories')
        </a>
      </li>
    <!--  <li >
        <a class="dropdown-item" href='{{url("/dashboard/region")}}'>
          @lang('site.pacage_type')
        </a>
      </li>
    -->
      <li>
        <a class="dropdown-item" href='{{url("/dashboard/subadmin")}}'>
            @lang('site.sub_admins')
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item {{$controller == 'BookingController' && $action!='sales' ?'active':'' }}">
    <a class="nav-link" href='{{url("/dashboard/booking")}}' >
      <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
      </span>
      <span class="nav-link-title">
       @lang('site.booking')
      </span>
    </a>
  </li>
  <li class="nav-item {{$controller == 'UserController' ?'active':'' }}">
    <a class="nav-link" href='{{url("/dashboard/user")}}' >
      <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
      </span>
      <span class="nav-link-title">
       @lang('site.Users')
      </span>
    </a>
  </li>
  <li class="nav-item {{$controller == 'TrainerController' ?'active':'' }}">
    <a class="nav-link" href='{{url("/dashboard/trainer")}}' >
      <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
      </span>
      <span class="nav-link-title">
       @lang('site.Trainers')
      </span>
    </a>
  </li>
  <li class="nav-item {{$controller == 'PackageController' ?'active':'' }}">
    <a class="nav-link" href='{{url("/dashboard/package")}}' >
      <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
      </span>
      <span class="nav-link-title">
       @lang('site.Packages')
      </span>
    </a>
  </li>
  <li class="nav-item {{$controller == 'BookingController' && $action =='sales' ?'active':'' }}" >
    <a class="nav-link" href='{{url("/dashboard/sales")}}' >
      <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
      </span>
      <span class="nav-link-title">
       @lang('site.Sales')
      </span>
    </a>
  </li>
  <li class="nav-item {{$controller == 'SupportController'?'active':'' }}">
    <a class="nav-link" href='{{url("/dashboard/support")}}' >
      <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
      </span>
      <span class="nav-link-title">
       @lang('site.Support')
      </span>
    </a>
  </li>
  <li class="nav-item {{$controller == 'NotificationsController' && $action =='sales' ?'active':'' }}">
    <a class="nav-link" href='{{url("/dashboard/notifications")}}' >
      <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
      </span>
      <span class="nav-link-title">
       @lang('site.Notifications')
      </span>
    </a>
  </li>
  <li class="nav-item {{$controller == 'ProgrammeController' ?'active':'' }}">
    <a class="nav-link" href='{{url("/dashboard/programme")}}' >
      <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
      </span>
      <span class="nav-link-title">
       @lang('site.Program_design')
      </span>
    </a>
  </li>
</ul>
