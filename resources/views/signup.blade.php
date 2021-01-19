@extends('layouts.app')

@section('content')

<!-- ==== Main content ==== -->
<main class="main-content login-page signup-page">
    <div class="container">
        <div class="login-content">
            <div class="row">
                <div class="col-md-4">
                    <div class="login-form">
                        <h4>Sign up</h4>
                        @include("dashboard.utility.error_messages")
                        <form id="contact-form" class="form_submit_login" method="post" action="{{ url('/') }}/signup">
                          @csrf
                            <div class="form-group">
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="exampleInputEmail1" placeholder="Your Name">
                              </div>
                            <div class="form-group">
                              <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" placeholder="Email">
                            </div>
                            <div class="form-group">
                              <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="Confirm password">
                              </div>
                            <button type="submit" class="login-btn">Create now</button>
                        </form>
                        <span class="or">or</span>
                        <div class="log-or-btns">
                            <button type="submit" class="google-btn">
                                <i class="fab fa-google"></i>
                                <span>Login with Google</span>
                            </button>
                            <button type="submit" class="apple-btn">
                                <i class="fab fa-apple"></i>
                                <span>Login with Apple</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="login-img">
                        <img src="{{url('/')}}/assets/img/signup-bg.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
