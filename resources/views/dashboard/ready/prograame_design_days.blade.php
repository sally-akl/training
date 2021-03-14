@extends('dashboard.layouts.master')
@section('content')
<div class="page-header">
  <div class="row align-items-center">
    <div class="col-auto">
      <ol class="breadcrumb" aria-label="breadcrumbs">
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Ready Plan design Week{{$week}} / Days</a></li>
      </ol>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Ready Plan design Week{{$week}} / Days</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="d-flex">

    </div>
      @php
        $end  = 7 ;
        $begin = 1;

        $end_day = $week * 7;
        $begin_day = ($end_day-7)+1;
        $days_real = [];
        for($j=$begin_day;$j<=$end_day;$j++)
        {
           $days_real[]=$j;
        }
      @endphp

      @php $i = 1;   @endphp
      @for($day = $begin;$day<=$end;$day++)

        @php  $to_day = $days_real[$day-1];  @endphp
        @if($i == 1)
          <div class="row days">
        @endif
        @if($i%8 == 0 && $i !=1)
          @php $i = 1;   @endphp
          </div>
          <div class="row days">
        @endif
        <div class="col-lg-1">
          <a href='{{url("dashboard/readypackage/programmes/design")}}/{{$to_day}}/{{$week}}/{{$transaction_num}}'> Day {{$day}} </a>
        </div>
       @php $i++;   @endphp
      @endfor


  </div>
</div>
@endsection
@section('footerjscontent')
@endsection
