<script src="/js/stripe.min.js"></script>


<fieldset>
	<legend>Payment</legend>

	<div id="add-card" class="form-row">
	    <label for="card-element">
	        Credit or debit card information
	    </label>
	    @if(isset($subscriptionOrder) && $subscriptionOrder->isStripeCostumerIdSet())
	        <div id="card-info">
	            <span>You have liked <b>{{$subscriptionOrder->card_brand}}</b> card with last 4 digits: <b>{{$subscriptionOrder->card_last_four}}</b></span>
	            <button> Change Card </button>
	        </div>
	    @endif
	
	
	    <div id="card-element">
	        <!-- a Stripe Element will be inserted here. -->
	    </div>
	
	    <!-- Used to display form errors -->
	    <div id="card-errors" role="alert"></div>
	</div>

</fieldset>

<script>
    function createForCard(){
        // Create a Stripe client
        var stripe = Stripe("{{env("STRIPE_PUBLISHABLE_KEY")}}");

        // Create an instance of Elements
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '24px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
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
        var card = elements.create('card', {style: style, hidePostalCode: true});

        // Add an instance of the card Element into the `card-element` <div>
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        $(card).change(function (event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission
        var formJQ = $('#add-card').parents('form');
        formJQ.submit(function (event) {
            event.preventDefault();

            stripe.createToken(card).then(function (result) {
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
            var form = formJQ[0];
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    }



    $(document).ready(function () {
        var cardInfoJQ = $("#card-info");

        if(cardInfoJQ.length){
            cardInfoJQ.find("button").click(function(){
                cardInfoJQ.remove();
                createForCard();
            });
        }else{
            createForCard();
        }

    });

</script>