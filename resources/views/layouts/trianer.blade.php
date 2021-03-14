<!DOCTYPE html>
<!--[if IE 7]><html class="no-js ie7 oldie" lang="en-US"><![endif]-->
<!--[if IE 8]><html class="no-js ie8 oldie" lang="en-US"><![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en-US"  {{(session()->has('locale') && session()->get('locale') =='ar')?'dir=rtl':''}} >
<!--<![endif]-->

<head>
  @include('layouts.css')
  <link rel="stylesheet" href="{{ asset('css/tabler.min.css') }}" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <style>
    .navbar-light , .dropdown-menu-card , .dropdown-menu-card .card
    {
      background-color: #1f1f1f !important;
    }
    .navbar-nav a , .d-none .text-muted{
      color:#fff !important;
    }
    .footer{
      border-top: none !important;
      background-color: #1f1f1f !important;
      padding: none;
      color: #fff !important;
      margin-bottom: 0px !important;
      margin-top:0px !important;
    }

  </style>
</head>

<body>

    @include('dashboard.layouts.header')
    <div class="navbar-expand-md">
      <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
          <div class="container-xl">
            @include('dashboard.layouts.trainer_menu')
          </div>
        </div>
      </div>
    </div>
    @yield('content')
    @include('layouts.footer')
    @include('layouts.js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
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
