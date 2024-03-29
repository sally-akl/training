<ul class="navbar-nav">

  <li class="nav-item {{$controller == 'TrainerAreaController' && $action == 'profile'?'active':'' }}">
    <a class="nav-link" href='{{url("/dashboard/trainers/profile")}}' >
      <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><circle cx="12" cy="12" r="3"></circle></svg>
      </span>
      <span class="nav-link-title">
        Settings
      </span>
    </a>
  </li>
  <li class="nav-item {{$controller == 'UserAreaController' && $action == 'subscrips' ?'active':'' }}">
    <a class="nav-link" href='{{url("/dashboard/usersarea/subscrips")}}' >
      <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M9 5H7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2V7a2 2 0 0 0 -2 -2h-2"></path><rect x="9" y="3" width="6" height="4" rx="2"></rect><line x1="9" y1="12" x2="9.01" y2="12"></line><line x1="13" y1="12" x2="15" y2="12"></line><line x1="9" y1="16" x2="9.01" y2="16"></line><line x1="13" y1="16" x2="15" y2="16"></line></svg>
      </span>
      <span class="nav-link-title">
        My Subscriptions
      </span>
    </a>
  </li>
</ul>
