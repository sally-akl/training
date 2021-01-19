@extends('layouts.app')

@section('content')
<!-- ==== Main content ==== -->
<main class="main-content ticket-page">
    <div class="container">
        <div class="ticket-content">
            <div class="ticket-txt">
                <div class="d-flex justify-content-between">
                    <h4>Ticket history</h4>
                    <a href="#" class="sec-btn">Raise A Ticket</a>
                </div>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea </p>
            </div>
            @foreach ($pending_tickets as $key => $crequest)
            <div class="main-card with-brd issue-block">
                <div class="card-content">
                    <div class="d-sm-flex justify-content-between">
                        <div class="ticket-id">
                            <span>TICET ID</span>
                            <span>#{{$crequest->id}}</span>
                        </div>
                        <div class="ticket-meta d-flex">
                            <span>{{date("D,M d, Y, g:i a",strtotime($crequest->send_date))}}</span>
                            @if($crequest->status == "pending")
                              <small>Pending</small>
                            @elseif($crequest->status == "in progress")
                              <small>In progress</small>
                            @endif
                            <i class="fas fa-redo-alt"></i>
                        </div>
                    </div>
                    <h4><a href="{{url("/")}}/ticket/{{$crequest->id}}/{{$crequest->subject}}" style="color:#fff">{{$crequest->subject}}</a></h4>
                    <p>{{$crequest->msg}}</p>
                    <small class="sub-txt">WE ARE LOOKING INTO your issue, hope to resolve THE ISSUE AS SOON AS POSSIBLE</small>
                </div>
            </div>
            @endforeach
            <div class="resolved-blocks">
                <h3>Resolved</h3>
                @foreach ($solved_tickets as $key => $crequest)
                <div class="main-card with-brd issue-block">
                    <div class="card-content">
                        <div class="d-sm-flex justify-content-between">
                            <div class="ticket-id">
                                <span>TICET ID</span>
                                <span>#{{$crequest->id}}</span>
                            </div>
                            <div class="ticket-meta d-flex">
                                <span>{{date("D,M d, Y, g:i a",strtotime($crequest->send_date))}}</span>
                                <small>Resolved</small>
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                        <h4><a href="{{url("/")}}/ticket/{{$crequest->id}}/{{$crequest->subject}}" style="color:#fff">{{$crequest->subject}}</a></h4>
                        <p>{{$crequest->msg}}</p>
                        <small class="sub-txt">Hope YOU ARE Satisfy with the solution</small>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </div>
</main>

@endsection
@section('footerjscontent')
<script type="text/javascript">
</script>
@endsection
