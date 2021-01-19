@extends('layouts.app')

@section('content')

<!-- ==== Main content ==== -->
<main class="main-content login-page">
    <div class="container">
        <div class="login-content">
            <div class="row">
                <div class="col-lg-4">
                    <div class="login-form">
                        <h4>Login</h4>
                        <div class="alert alert-danger alert-danger-modal" style="display:none">
                        </div>
                        <div class="alert alert-success alert-success-modal" style="display:none">
                        </div>
                        <form id="contact-form" class="form_submit_login" method="post" action="{{ url('signin') }}">
                          @csrf
                            <div class="form-group">
                              <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email address">
                            </div>
                            <div class="form-group">
                              <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <a href="#">Reset password</a>
                            <button type="submit" class="login-btn">Login</button>
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
                <div class="col-lg-8">
                    <div class="login-img">
                        <img src="{{url('/')}}/assets/img/login-bg.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('footerjscontent')
<script type="text/javascript">

_prepareform = function(form , sucess_modal , fail_modal)
{
  var submit_form_url = form.attr('action');
  var $method_is = "POST";
  var formData = new FormData(form[0]);
  $(sucess_modal).css("display","none");
  $(fail_modal).css("display","none");
  $.ajax({
      url: submit_form_url,
      type: $method_is,
      data: formData,
      async: false,
      dataType: 'json',
      success: function (response) {
        if(response.sucess)
        {
          window.location.href = '{{url("/")}}';
        }
        else
        {
          var $error_text = "";
          var errors = response.errors;

          $.each(errors, function (key, value) {
            $error_text +=value+"<br>";
          });

          $(fail_modal).html($error_text);
          $(fail_modal).css("display","block");

        }
      },
      error : function( data )
      {

      },
      cache: false,
      contentType: false,
      processData: false
  });


}
$(".form_submit_login").submit(function(e){

    e.preventDefault();
    _prepareform($(this) ,".alert-success-modal" ,  ".alert-danger-modal");
    return false;
});
</script>
@endsection
