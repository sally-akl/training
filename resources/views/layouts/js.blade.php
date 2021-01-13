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

<!-- intro slider -->
<script type="text/javascript">
    $('.main-slider .owl-carousel').owlCarousel({
      loop: true,
      items:1,
      autoplay: true,
      autoplayHoverPause: true,
      nav: true,
    })
  </script>

<!-- Wow Animation -->
<script type="text/javascript">
    new WOW().init();
</script>
