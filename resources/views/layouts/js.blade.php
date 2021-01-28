<!-- ============== Resources JS ============== -->
<!-- JQuery -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

<!-- Main -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('assets/js/popper.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<!-- FontAwesome -->
<script src="{{ asset('assets/js/all.min.js') }}"></script>

<!-- scroll Animation -->
<script src="{{ asset('assets/js/wow.min.js') }}"></script>

<!-- Owl Carousel -->
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>

<script type="text/javascript">
  $('.search_all_text').bind("enterKey",function(e){
     window.location.href = '{{url("/")}}?category={{request()->category}}&show={{request()->show}}&search='+$(this).val();
  });
  $('.search_all_text').keyup(function(e){
      if(e.keyCode == 13)
      {
          $(this).trigger("enterKey");
      }
  });
</script>
