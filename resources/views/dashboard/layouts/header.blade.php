<header class="navbar navbar-expand-md navbar-light">
  <div class="container-xl">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a href="." class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pr-0 pr-md-3">
      <img src="{{url('/')}}/assets/img/logo.png"  style="width: 140px;height: 40px;"/>
    </a>
    <div class="navbar-nav flex-row order-md-last">

      @if(isset(Auth::user()->id) && Auth::user()->role->name=="Trainer")
        <div class="nav-item dropdown d-none d-md-flex mr-3">
          <a href="#" class="nav-link px-0" data-toggle="dropdown" tabindex="-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
            <span class="badge bg-red"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-card" style="height: 325px;overflow-y: scroll;width: 350px;">
            <div class="card">
              <div class="card-body notify_{{Auth::user()->id}}">
                @php  $notifications = \App\Notifications::orderBy("id","desc")->whereraw('send_from is not null')->where("user_id",Auth::user()->id)->orderby("send_date","desc")->get();  @endphp
                @foreach($notifications as $notify)
                  @if(preg_match('/(\.jpg|\.png|\.bmp|\.gif|\.jpeg)$/', $notify->msg))
                     <div class="row" style="margin-bottom: 10px;color: beige;padding: 6px;">@if($notify->send_from != null)<div class="col-md-6">{{\App\User::find($notify->send_from)->name}}</div>@endif<div class="col-md-6"><img src="{{url('/')}}{{$notify->msg}}"/></div></div>
                  @else
                   <div class="row" style="margin-bottom: 10px;color: beige;;padding: 6px;">@if($notify->send_from != null)<div class="col-md-6">{{\App\User::find($notify->send_from)->name}}</div> @endif<div class="col-md-6">  {{$notify->msg}}</div></div>
                  @endif
                @endforeach
              </div>
            </div>
          </div>
        </div>
      @endif
      <div class="nav-item dropdown">
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-toggle="dropdown">
          @if(isset(Auth::user()->id) &&  Auth::user()->role->name=="Trainer")
          <span class="avatar" style="background-image: url({{url(\App\User::find(Auth::user()->id)->image)}})"></span>
          @endif
          @if(isset(Auth::user()->id))
          <div class="d-none d-xl-block pl-2">

            <div>
              {{Auth::user()->name}}
            </div>

            <div class="mt-1 small text-muted">{{Auth::user()->role->name}}</div>
          </div>
            @endif
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a style="color:#000 !important;" class="dropdown-item" href="#" onclick="event.preventDefault();
    																	 document.getElementById('logout-form').submit();">
                            @lang('site.logout')
                                       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                               											@csrf
                               										</form>
          </a>
        </div>
      </div>
    </div>
  </div>
</header>
