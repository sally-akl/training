@extends('layouts.app')

@section('content')
<!-- ==== Main content ==== -->
<main class="main-content coach-page">
  <div class="coach-profile">
      <div class="container">
      </div>
  </div>
    <div class="coach-packages">
        <div class="container">
            <h3 class="main-tlt mt-5 mb-3">Login</h3>
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">

                    <div class="alert alert-danger alert-danger-modal" style="display:none">
                    </div>
                    <div class="alert alert-success alert-success-modal" style="display:none">
                    </div>
                     <form id="contact-form" class="form_submit_login" method="post" action="{{ url('signin') }}">
                       @csrf
                        <div class="form-group">
                            <input name="email" type="text" class="form-control" placeholder="Email address">
                        </div>
                        <div class="form-group">
                            <input name="password" type="password" class="form-control" placeholder="Password">
                        </div>

                        <button class="btn btn-main" name="submit" type="submit">Login</button>
                    </form>
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
