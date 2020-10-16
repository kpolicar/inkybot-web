(function() {
    'use strict';

    function registerElements(elements) {
        var example = document.querySelector("#payment-form");

        var form = example.querySelector('form');
        var error = form.querySelector('.error');
        var errorMessage = error.querySelector('.message');

        function enableInputs() {
            Array.prototype.forEach.call(
                form.querySelectorAll(
                    "input[type='text'], input[type='email'], input[type='tel']"
                ),
                function(input) {
                    input.removeAttribute('disabled');
                }
            );
        }

        function disableInputs() {
            Array.prototype.forEach.call(
                form.querySelectorAll(
                    "input[type='text'], input[type='email'], input[type='tel']"
                ),
                function(input) {
                    input.setAttribute('disabled', 'true');
                }
            );
        }

        function triggerBrowserValidation() {
            // The only way to trigger HTML5 form validation UI is to fake a user submit
            // event.
            var submit = document.createElement('input');
            submit.type = 'submit';
            submit.style.display = 'none';
            form.appendChild(submit);
            submit.click();
            submit.remove();
        }

        // Listen for errors from each Element, and show error messages in the UI.
        var savedErrors = {};
        elements.forEach(function(element, idx) {
            element.on('change', function(event) {
                if (event.error) {
                    error.classList.add('visible');
                    savedErrors[idx] = event.error.message;
                    errorMessage.innerText = event.error.message;
                } else {
                    savedErrors[idx] = null;

                    // Loop over the saved errors and find the first one, if any.
                    var nextError = Object.keys(savedErrors)
                        .sort()
                        .reduce(function(maybeFoundError, key) {
                            return maybeFoundError || savedErrors[key];
                        }, null);

                    if (nextError) {
                        // Now that they've fixed the current error, show another one.
                        errorMessage.innerText = nextError;
                    } else {
                        // The user fixed the last error; no more errors.
                        error.classList.remove('visible');
                    }
                }
            });
        });

        // Listen on the form's 'submit' handler...
        form.addEventListener('submit', function(e) {
            e.preventDefault();


            if (_.find(savedErrors, error => error !== null))
                return;
            
            // Trigger HTML5 validation UI on the form if any of the inputs fail
            // validation.
            var plainInputsValid = true;
            Array.prototype.forEach.call(form.querySelectorAll('input'), function(
                input
            ) {
                if (input.checkValidity && !input.checkValidity()) {
                    plainInputsValid = false;
                    return;
                }
            });
            if (!plainInputsValid) {
                triggerBrowserValidation();
                return;
            }

            // Show a loading screen...
            example.classList.add('submitting');

            // Disable all inputs.
            disableInputs();

            // Gather additional customer data we may have collected in our form.
            var name = form.querySelector('#name');
            var email = form.querySelector('#email');
            var paymentResponse = example.querySelector('#payment-response');
            var additionalData = {
                billing_details: {
                    name: name ? name.value : undefined,
                    email: email ? email.value : undefined,
                }
            };

            var handleError = function(error) {
                example.classList.remove('submitting');
                enableInputs();
            }

            stripe.createPaymentMethod('card', elements[0], additionalData)
                .then(function(result) {

                if (result.paymentMethod) {
                    axios.post('/pay/subscribe/'+result.paymentMethod.id)
                        .then(result => {
                            example.classList.remove('submitting');
                            example.classList.add('submitted')
                            paymentResponse.innerHTML = result.data;
                        });
                    } else {
                    handleError();
                }
            }).catch(handleError);
        });
    }


    console.log('stripe loaded')

    var elements = stripe.elements({
        fonts: [
            {
                cssSrc: 'https://fonts.googleapis.com/css?family=Quicksand',
            },
        ],
        // Stripe's examples are localized to specific languages, but if
        // you wish to have Elements automatically detect your user's locale,
        // use `locale: 'auto'` instead.
        locale: 'auto',
    });

    var elementStyles = {
        base: {
            color: '#4A5568',
            fontWeight: 400,
            fontFamily: 'Source Sans Pro", sans-serif',
            fontSize: '16px',
            fontSmoothing: 'antialiased',
            iconColor: '#4A5568',

            ':focus': {
                color: '#4A5568',
            },

            '::placeholder': {
                color: '#A3B0C2',
            },

            ':focus::placeholder': {
                color: '#A0AEC0',
            },
        },
        invalid: {
            iconColor: '#9d2020',
            color: '#9d2020',
            '::placeholder': {
                color: '#be5252',
            },
        },
    };

    var elementClasses = {
        focus: 'focus',
        empty: 'empty',
        invalid: 'invalid',
    };

    var cardNumber = elements.create('cardNumber', {
        showIcon: true,
        style: elementStyles,
        classes: elementClasses,
    });
    cardNumber.mount('#card-number');

    var cardExpiry = elements.create('cardExpiry', {
        style: elementStyles,
        classes: elementClasses,
    });
    cardExpiry.mount('#card-expiry');

    var cardCvc = elements.create('cardCvc', {
        style: elementStyles,
        classes: elementClasses,
    });
    cardCvc.mount('#card-cvc');

    registerElements([cardNumber, cardExpiry, cardCvc]);
})();
