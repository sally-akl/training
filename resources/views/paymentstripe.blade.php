@extends('layouts.app')

@section('content')

<!-- ==== Main content ==== -->
<main class="main-content profile-page">
    <div class="container">
        <div class="profile-content">
            <div class="profile-txt">
                <h4>Pay with
                  @if($type == "visa")
                    <span>Visa</span>
                  @else
                    <span>Mastercard</span>
                  @endif
                </h4>
            </div>
            @include("dashboard.utility.error_messages")
            <form  method="POST" id="payment-form" role="form" action="{!!route('pay.stripe')!!}"  class="require-validation form-horizontal" data-cc-on-file="false"
                                                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
                @csrf

            <div class="profile-edit-info">

              <div class="form-group required">
                <label for="name">Name on Card</label>
                <input class='form-control' size='4' type='text'>
              </div>

              <div class="form-group required">
                <label for="name">Card Number</label>
                <input autocomplete='off' class='form-control card-number' size='20' type='text' name="card_no">
              </div>
              <div class="form-group required">
                <label for="Email">CVV</label>
                <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text' name="cvvNumber">
              </div>
              <div class="form-group required">
                <label for="Email">Expiration Month</label>
                <input class='form-control card-expiry-month' placeholder='MM' size='4' type='text' name="ccExpiryMonth">
              </div>
              <div class="form-group required">
                <label for="Email">Expiration Year</label>
                <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text' name="ccExpiryYear">
              </div>
              @php  $package = \App\Package::find($id); @endphp

              <input type="hidden" name="pakage_name" value="{{$package->package_name}}" />
              <input type="hidden" name="package_id" value="{{$package->id}}" />
              <input type="hidden" name="amount" value="{{$package->package_price}}" />
              <input type="hidden" name="pay_type" value="{{$type}}" />



              <div class="form-group text-center mt-5">
                <button type="submit" class="main-btn mr-4">Pay</button>
              </div>

            </div>
              </form>
        </div>
    </div>
</main>
@endsection
@section('footerjscontent')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
$(function() {
    var $form         = $(".require-validation");
  $('form.require-validation').bind('submit', function(e) {
        var $form         = $(".require-validation");
        var inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', ');
        var $inputs       = $form.find('.required').find(inputSelector);
        var $errorMessage = $form.find('div.error');
        var valid         = true;
        $errorMessage.addClass('hide');

        $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorMessage.removeClass('hide');
        e.preventDefault();
      }
    });

    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-number').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeResponseHandler);
    }

  });

  function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error').removeClass('hide').find('.alert').text(response.error.message);
        } else {
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});
</script>
@endsection
