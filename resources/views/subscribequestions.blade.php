@extends('layouts.app')

@section('content')

<!-- ==== Main content ==== -->
<main class="main-content profile-page">
    <div class="container">
        <div class="profile-content">
            <div class="profile-txt">
                <h4>@lang('front.subscribe_questions')</h4>

            </div>
            @include("dashboard.utility.error_messages")
            <form method="post" action="{{ url('/') }}/subscribe/add" enctype="multipart/form-data">
                @csrf

            <div class="profile-edit-info">
              @foreach($questions as $question)
                    <div class="form-group">
                        <label for="name">
                          @if(session()->has('locale') && session()->get('locale') =='ar')
                            {{$question->title_ar}}
                          @else
                            {{$question->title}}
                          @endif
                        </label>
                        <input type="text" class="form-control" id="name" name="qu_{{$question->id}}" required>

                      </div>
              @endforeach
              <input type="hidden" name="trans" value="{{$id}}" />
              <div class="form-group text-center mt-5">
                 <button type="submit" class="main-btn mr-4">@lang('front.Fill')</button>
              </div>



            </div>
              </form>
        </div>
    </div>
</main>
@endsection
@section('footerjscontent')
<script type="text/javascript">
</script>
@endsection
