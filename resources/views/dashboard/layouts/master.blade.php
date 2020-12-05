<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-alpha.7
* @link https://github.com/tabler/tabler
* Copyright 2018-2019 The Tabler Authors
* Copyright 2018-2019 codecalm.net Paweł Kuna
* Licensed under MIT (https://tabler.io/license)
-->
<html lang="en">
  <head>
      @include('dashboard.layouts.css')
    <style>
      body {
      	display: none;
      }
    </style>
  </head>
  <body class="antialiased">
    <div class="page">
      @include('dashboard.layouts.header')
      <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar navbar-light">
            <div class="container-xl">
              @if(Auth::user())
                @if(Auth::user()->role->name=="admin")
                   @include('dashboard.layouts.menu')
                @elseif(Auth::user()->role->name=="Trainer")
                    @include('dashboard.layouts.trainer_menu')
                @endif
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="content">
        <div class="container-xl justify-content-center">
          @yield('content')
        </div>
          @include('dashboard.layouts.footer')
      </div>
    </div>
    @include('dashboard.layouts.js')
    <script type="text/javascript">
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    </script>
    @yield('footerjscontent')
  </body>
</html>
