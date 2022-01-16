<form id="form-container" method="post" action="/charge">
    <!-- Tap element will be here -->
    <div id="element-container"></div>
    <div id="error-handler" role="alert"></div>
    <div id="success" style=" display: none;;position: relative;float: left;">
        Success! Your token is <span id="token"></span>
    </div>
    <!-- Tap pay button -->
    <button id="tap-btn">Submit</button>
</form>
<script src="https://secure.gosell.io/js/sdk/tap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.4/bluebird.min.js"></script>

<script>
    var tap = Tapjsli('{{env('TAP_PK')}}');

    var elements = tap.elements({});

    var style = {
        base: {
            color: '#535353',
            lineHeight: '18px',
            fontFamily: 'sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: 'rgba(0, 0, 0, 0.26)',
                fontSize:'15px'
            }
        },
        invalid: {
            color: 'red'
        }
    };
    // input labels/placeholders
    var labels = {
        cardNumber:"Card Number",
        expirationDate:"MM/YY",
        cvv:"CVV",
        cardHolder:"Card Holder Name"
    };
    //payment options
    var paymentOptions = {
        currencyCode:["KWD","USD","SAR"],
        labels : labels,
        TextDirection:'ltr'
    }
    //create element, pass style and payment options
    var card = elements.create('card', {style: style},paymentOptions);
    //mount element
    card.mount('#element-container');
    //card change event listener
    card.addEventListener('change', function(event) {
        if(event.loaded){
            console.log("UI loaded :"+event.loaded);
            console.log("current currency is :"+card.getCurrency())
        }
        var displayError = document.getElementById('error-handler');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    var form = document.getElementById('form-container');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        tap.createToken(card).then(function(result) {
            console.log(result);
            if (result.error) {
                // Inform the user if there was an error
                var errorElement = document.getElementById('error-handler');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server
                 errorElement = document.getElementById('success');
                errorElement.style.display = "block";
                var tokenElement = document.getElementById('token');
                tokenElement.textContent = result.id;
                tapTokenHandler(result.id)

            }
        });
    });

    function tapTokenHandler(token) {
        console.log('appendChild111');
        console.log(token+'token');
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('form-container');

        form.append("<input type='hidden' name='tapToken' value='" + token + "'>");
        // var hiddenInput = document.createElement('input');
        // hiddenInput.setAttribute('type', 'hidden');
        // hiddenInput.setAttribute('name', 'tapToken');
        // hiddenInput.setAttribute('value', token.id);
        // form.appendChild(hiddenInput);
        console.log('appendChild222');

        // Submit the form
        form.submit();
    }

    card.addEventListener('change', function(event) {
        if(event.BIN){
            console.log(event.BIN)
        }
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
</script>



