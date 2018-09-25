@extends('layouts.app')
@section('content')

<section id="content">
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
        <div class="breadcrumb"><a href="/deposit">Deposit</a> > DepositByCard</div>
         <!-- {{ print_r($_POST) }}
        {{ print_r($_GET) }} -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://js.stripe.com/v3/"></script>

        <style>
            .spacer {
                margin-bottom: 24px;
            }
            /**
             * The CSS shown here will not be introduced in the Quickstart guide, but shows
             * how you can use CSS to style your Element's container.
             */
            .StripeElement {
              background-color: white;
              padding: 10px 12px;
              border-radius: 4px;
              border: 1px solid #ccd0d2;
              box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
              -webkit-transition: box-shadow 150ms ease;
              transition: box-shadow 150ms ease;
            }
            .StripeElement--focus {
              box-shadow: 0 1px 3px 0 #cfd7df;
            }
            .StripeElement--invalid {
              border-color: #fa755a;
            }
            .StripeElement--webkit-autofill {
              background-color: #fefde5 !important;
            }
            #card-errors {
                color: #fa755a;
            }
        </style>

        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <h1>Payment Form</h1>
                <div class="spacer"></div>

                @if (session()->has('success_message'))
                    <div class="alert alert-success">
                        {{ session()->get('success_message') }}
                    </div>
                @endif

                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/depositByCard" method="POST" id="payment-form">
                    {{ csrf_field() }}
                    {{-- <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" required>
                    </div> --}}

                    <div class="form-group">
                        <label for="name_on_card">Name on Card</label>
                        <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="{{ Auth::user()->name }}" required>
                    </div>

                    <div class="row">
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                        </div> --}}

                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city">
                            </div>
                        </div> --}}

                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="province">Province</label>
                                <input type="text" class="form-control" id="province" name="province">
                            </div>
                        </div> --}}

                    </div> 

                    <div class="row">
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="postalcode">Postal Code</label>
                                <input type="text" class="form-control" id="postalcode" name="postalcode">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone">
                            </div>
                        </div> --}} 

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" step="0.01" class="form-control" id="amount" name="amount" required min="5">
                            </div>
                        </div>

                    </div>
                    
                    {{-- <button type="button" id="testCard">Use Test Card</button> --}}

                    <div class="form-group">
                        <label for="card-element">Credit Card</label>
                        <div id="card-element">
                          <!-- a Stripe Element will be inserted here. -->
                      </div>

                      <!-- Used to display form errors -->
                      <div id="card-errors" role="alert"></div>
                    </div>

                    <div class="spacer"></div>

                    <button type="submit" class="btn btn-primary">Submit Payment</button>
                </form>
                    
            </div> 
        </div>

        <script>
            (function(){
                // Create a Stripe client
                var stripe = Stripe('pk_test_ov1Rp6ksiecTl3Q8xe6aqNdJ');
                // Create an instance of Elements
                var elements = stripe.elements();
                // Custom styling can be passed to options when creating an Element.
                // (Note that this demo uses a wider set of styles than the guide below.)
                var style = {
                  base: {
                    color: '#32325d',
                    lineHeight: '18px',
                    fontFamily: '"Raleway", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                      color: '#aab7c4'
                    }
                  },
                  invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                  }
                };
                // Create an instance of the card Element
                var card = elements.create('card', {
                    style: style,
                    hidePostalCode: true
                });
                // Add an instance of the card Element into the `card-element` <div>
                card.mount('#card-element');
                // Handle real-time validation errors from the card Element.
                card.addEventListener('change', function(event) {
                  var displayError = document.getElementById('card-errors');
                  if (event.error) {
                    displayError.textContent = event.error.message;
                  } else {
                    displayError.textContent = '';
                  }
                });
                // Handle form submission
                var form = document.getElementById('payment-form');
                form.addEventListener('submit', function(event) {
                  event.preventDefault();
                  var options = {
                    name: document.getElementById('name_on_card').value,
                  }
                  stripe.createToken(card, options).then(function(result) {
                    if (result.error) {
                      // Inform the user if there was an error
                      var errorElement = document.getElementById('card-errors');
                      errorElement.textContent = result.error.message;
                    } else {
                      // Send the token to your server
                      stripeTokenHandler(result.token);
                    }
                  });
                });
                function stripeTokenHandler(token) {
                  // Insert the token ID into the form so it gets submitted to the server
                  var form = document.getElementById('payment-form');
                  var hiddenInput = document.createElement('input');
                  hiddenInput.setAttribute('type', 'hidden');
                  hiddenInput.setAttribute('name', 'stripeToken');
                  hiddenInput.setAttribute('value', token.id);
                  form.appendChild(hiddenInput);
                  // Submit the form
                  form.submit();
                }
            })();

            $('#testCard').click(function(){
                $('__privateStripeFrame3')
                    .contents()
                    .find('input[name="cardnumber"]')
                    .val('4242 4242 4242 4242');
            });

        </script>

@endsection
