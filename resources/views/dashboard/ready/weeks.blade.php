@extends('dashboard.layouts.master')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Ready Plan design</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="d-flex">

    </div>
      @php
        $package = \App\ReadyPlanPackage::find($id);
        $days = $package->weeks;
      @endphp

      @php $i = 1;   @endphp
      @for($day = 1;$day<=$days;$day++)

        @if($i == 1)
          <div class="row days">
        @endif
        @if($i%9 == 0 && $i !=1)
          @php $i = 1;   @endphp
          </div>
          <div class="row days">
        @endif
        <div class="col-lg-1">
          <a href='{{url("dashboard/readypackage/days")}}/{{$day}}/{{$package->id}}'> Week {{$day}} </a>
        </div>
       @php $i++;   @endphp
      @endfor


  </div>
</div>
@endsection
@section('footerjscontent')
@endsection
