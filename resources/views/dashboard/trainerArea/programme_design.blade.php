@extends('dashboard.layouts.master')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Programme design</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="d-flex">

    </div>
      @php
        if($package->package_duration_type == "day")
          $days = $package->package_duration;
        elseif($package->package_duration_type == "week")
          $days = $package->package_duration * 7;
        elseif($package->package_duration_type == "month")
          $days = $package->package_duration * 30;
      @endphp

      @php $i = 1;   @endphp
      @for($day = 1;$day<=$days;$day++)

        @if($i == 1)
          <div class="row days">
        @endif
        @if($i%8 == 0 && $i !=1)
          @php $i = 1;   @endphp
          </div>
          <div class="row days">
        @endif
        <div class="col-lg-1">
          <a href='{{url("dashboard/trainers/programmes/design")}}/{{$day}}/{{$package->id}}'> Day {{$day}} </a>
        </div>
       @php $i++;   @endphp
      @endfor


  </div>
</div>



@endsection
@section('footerjscontent')
<script type="text/javascript">
</script>
@endsection
