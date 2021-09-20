@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
<div class="content-wrapper">
        <div class="p-3 p-md-4">
            <div class="wrapper">
                <div class="wrapper-title">
                    <span>Make Payment</span>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="panel panel-default credit-card-box">
                                        <div class="panel-body">
                                            @if (Session::has('success'))
                                                <div class="alert alert-success text-center">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                                    <p>{{ Session::get('success') }}</p>
                                                </div>
                                            @endif
                          
                                            <form role="form" action="{{ route('Dashboard.refPatient.paymentProcessRef') }}" method="post" class="require-validation"
                                                                             data-cc-on-file="false"
                                                                            data-stripe-publishable-key="pk_test_51INYObKoOaGDycyyZWMYNJoJL4pYSerbQuuhEi7u1Hi6tr6wFjmXAtWFOkIKLUSdCqhjkEfeisWJXY2FKkM31mIn00CY8C0PFi"
                                                                            id="payment-form">
                                                @csrf
                          
                                                <div class='form-row row'>
                                                    <div class='col-12 form-group required'>
                                                        <label class='control-label'>Name on Card</label> 
                                                        <input class='form-control' size='4' type='text' value="{{isset($card->cardholder_name) ? $card->cardholder_name : ''}}">
                                                    </div>
                                                </div>
                          
                                                <div class='form-row row'>
                                                    <div class='col-12 form-group required'>
                                                        <label class='control-label'>Card Number</label> <input
                                                            autocomplete='off' class='form-control card-number' size='20'
                                                            type='text' value="{{isset($card->card_no) ? $card->card_no : ''}}">
                                                    </div>
                                                </div>
                          
                                                <div class='form-row row'>
                                                    <div class='col-12 col-md-4 form-group cvc required'>
                                                        <label class='control-label'>CVC</label> <input autocomplete='off'

                         
                                                            class='form-control card-cvc' placeholder='ex. 311' size='4'
                                                            type='text' value="{{isset($card->cvv) ? $card->cvv : ''}}">
                                                    </div>
                                                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                        <label class='control-label'>Expiration Month</label> <input
                                                            class='form-control card-expiry-month' placeholder='MM' size='2'
                                                            type='text' value="{{isset($card->exp_month) ? $card->exp_month : ''}}">
                                                    </div>
                                                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                        <label class='control-label'>Expiration Year</label> <input
                                                            class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                                            type='text' value="{{isset($card->exp_year) ? $card->exp_year : ''}}">
                                                    </div>
                                                </div>
                          
                                                <div class='form-row row'>
                                                    <div class='col-md-12 error form-group hide'>
                                                        <div class='alert-danger alert'>Please correct the errors and try
                                                            again.</div>
                                                    </div>
                                                </div>
                          
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now (${{$amount}})</button>
                                                    </div>
                                                </div>
                                                  
                                            </form>
                                        </div>
                                    </div>        
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script')
<script type="text/javascript">
$(function() {
    var $form         = $(".require-validation");
  $('form.require-validation').bind('submit', function(e) {
    var $form         = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
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
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            // token contains id, last4, and card type
            var token = response['id'];
            // insert the token into the form so it gets submitted to the server
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='refPatientID' value='{{$patientRefObj_id}}'/>");
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.append("<input type='hidden' name='amount' value='{{$amount}}'/>");
            $form.get(0).submit();
        }
    }
  
});
</script>
@endsection