@extends('layouts.app')

@section('content')

<!-- ==== Main content ==== -->
<main class="main-content login-page signup-page">
    <div class="container">
        <div class="login-content">
            <div class="row">
                <div class="col-md-4">
                    <div class="login-form">
                        <h4>@lang('front.Signup')</h4>
                        @include("dashboard.utility.error_messages")
                        <form id="contact-form" class="form_submit_login" method="post" action="{{ url('/') }}/signup">
                          @csrf
                            <div class="form-group">
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="exampleInputEmail1" placeholder="{{__('front.name')}}">
                              </div>
                            <div class="form-group">
                              <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" placeholder="{{__('front.email')}}">
                            </div>
                            <div class="form-group">
                              <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" id="exampleInputEmail1" placeholder="{{__('front.phone')}}">
                            </div>
                            <div class="form-group">
                              <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="{{__('front.password')}}">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="{{__('front.Confirmpassword')}}">
                              </div>
                            <button type="submit" class="login-btn">@lang('front.Createnow')</button>
                        </form>
                        <span class="or">or</span>
                        <div class="log-or-btns">
                          <form action="{{url('/')}}/auth/google" method="get">
                            <button type="submit" class="google-btn">
                                <i class="fab fa-google"></i>
                                <span>@lang('front.LoginwithGoogle')</span>
                            </button>
                          </form>
                          <div class="signin-button" id="appleid-signin" data-color="black" data-border="true" data-type="sign in"></div>
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
@section('footerjscontent')
<style>
.signin-button > div > div > svg {
  height: 50px;
  width: 100%;
  cursor: pointer;
}
</style>

<script type="text/javascript" src="https://appleid.cdn-apple.com/appleauth/static/jsapi/appleid/1/en_US/appleid.auth.js"></script>
<script type="text/javascript">
AppleID.auth.init({
    clientId : '[CLIENT_ID]',
    scope : '[SCOPES]',
    redirectURI : '[REDIRECT_URI]',
    state : '[STATE]',
    usePopup : true //or false defaults to false
});
</script>
@endsection
