@extends('dashboard.layouts.master')
@section('content')
<div class="page-header">
  <div class="row align-items-center">
    <div class="col-auto">
      <ol class="breadcrumb" aria-label="breadcrumbs">
        <li class="breadcrumb-item"><a href='{{url("dashboard/trainers/clients/details")}}/{{$transaction_num}}'>Client Data</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Programme design Week{{$week}} / Days</a></li>
      </ol>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Programme design Week{{$week}} / Days</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="d-flex">

    </div>
      @php
        $end  = $week * 7 ;
        $begin = ($end-7)+1;
      @endphp

      @php $i = 1;   @endphp
      @for($day = $begin;$day<=$end;$day++)

        @if($i == 1)
          <div class="row days">
        @endif
        @if($i%8 == 0 && $i !=1)
          @php $i = 1;   @endphp
          </div>
          <div class="row days">
        @endif
        <div class="col-lg-1">
          <a href='{{url("dashboard/trainers/programmes/design")}}/{{$day}}/{{$week}}/{{$transaction_num}}/{{$package}}/{{$user_id}}'> Day {{$day}} </a>
        </div>
       @php $i++;   @endphp
      @endfor


  </div>
</div>
@endsection
