<!DOCTYPE html>
<!--[if IE 7]><html class="no-js ie7 oldie" lang="en-US"><![endif]-->
<!--[if IE 8]><html class="no-js ie8 oldie" lang="en-US"><![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en-US"  {{(session()->has('locale') && session()->get('locale') =='ar')?'dir=rtl':''}} >
<!--<![endif]-->

<head>
  @include('layouts.css')

</head>

<body>

    @include('layouts.header')
    @yield('content')
    @include('layouts.footer')
    @include('layouts.js')
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
