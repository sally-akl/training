@extends('layouts.app')

@section('content')
<!-- ==== Main content ==== -->
<main class="main-content ticket-page">
    <div class="container">
        <div class="ticket-content">
            <div class="main-card with-brd issue-block">
                <div class="card-content">
                    <div class="d-sm-flex justify-content-between">
                        <div class="ticket-id">
                            <span>TICET ID</span>
                            <span>#{{$ticket->id}}</span>
                        </div>
                        <div class="ticket-meta d-flex">
                            <span>{{date("D,M d, Y, g:i a",strtotime($ticket->send_date))}}</span>
                            @if($ticket->status == "pending")
                              <small>Pending</small>
                            @elseif($ticket->status == "in progress")
                              <small>In progress</small>
                            @else
                              <small>Resolved</small>
                            @endif
                            <i class="fas fa-redo-alt"></i>
                        </div>
                    </div>
                    <h4>{{$ticket->subject}}</h4>
                    <p>{{$ticket->msg}}</p>
                </div>
            </div>
            <div class="answer-blocks">
                <h3>Answer</h3>
                @foreach($ticket->messages as $message)
                <div class="main-card answer-block">
                    <div class="card-content">
                        <div class="d-sm-flex justify-content-between">
                            <div class="user">
                                @if($message->user->id != Auth::user()->id)
                                <span>Customer support</span>
                                @else
                                <span>You</span>
                                @endif
                            </div>
                            <div class="ticket-meta">
                                <span>{{date("D,M d, Y, g:i a",strtotime($message->send_date))}}</span>
                            </div>
                        </div>
                        <p>{{$message->msg}}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @if($ticket->status == "pending" || $ticket->status == "in progress")
            <div style="margin-bottom:5px;">
              @include("dashboard.utility.error_messages")
            </div>
            <div class="answer-send d-flex">

               <form method="post" action="{{ url('/') }}/savemessage" style="width: 100%;display: flex!important;">
                   @csrf
                <input type="text" name="message" class="write_msg" placeholder="Type your message..." />
                <input type="hidden" name="id" value="{{$ticket->id}}" />
                <input type="hidden" name="subject" value="{{$ticket->subject}}" />
                <button class="snd-btn" type="submit"><i class="fas fa-paper-plane"></i></button>
               </form>

            </div>

            @endif
        </div>
    </div>
</main>
@endsection
@section('footerjscontent')
<script type="text/javascript">
</script>
@endsection
