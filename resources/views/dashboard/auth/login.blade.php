@extends('dashboard.layouts.loginLayout')
@section('logincontent')
	@include("dashboard.utility.error_messages")
<form class="card card-md"  method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
  @csrf
  <div class="card-body">

    <h2 class="mb-5 text-center">@lang('site.login')</h2>
    <div class="mb-3">
      <label class="form-label"> @lang('site.email')</label>
      <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email') }}" autocomplete="off">
    </div>
    <div class="mb-2">
      <label class="form-label">
        @lang('site.password')
      </label>
      <div class="input-group input-group-flat">
        <input type="password"  name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"  placeholder="{{ __('Password') }}" >
      </div>
    </div>
    <div class="form-footer">
      <button type="submit" class="btn btn-primary btn-block">@lang('site.signin')</button>
    </div>
  </div>
</form>
@endsection
