import {loadStripe} from '@stripe/stripe-js';

(async function() {
    'use strict';


    const stripe = await loadStripe(process.env.MIX_STRIPE_KEY);

    function registerElements(elements) {
        var paymentForm = document.querySelector("#payment-form");

        var form = paymentForm.querySelector('form');
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
            paymentForm.classList.add('submitting');

            // Disable all inputs.
            disableInputs();

            // Gather additional customer data we may have collected in our form.
            var name = form.querySelector('#name');
            var email = form.querySelector('#email');
            var quantity = form.querySelector('#quantity');
            var recurring = form.querySelector('#recurring');
            var queue = form.querySelector('#queue');
            var plan = form.querySelector('#plan');
            var paymentResponse = paymentForm.querySelector('#payment-response');
            var additionalData = {
                billing_details: {
                    name: name ? name.value : undefined,
                    email: email ? email.value : undefined,
                }
            };
            var couponEl = document.querySelector('#coupon');
            var couponApplyButtonEl = document.querySelector('#apply-coupon');

            var handleError = function(error) {
                paymentForm.classList.remove('submitting');
                enableInputs();
            }

            var handleErrorWithMessage = function(response) {
                handleError();
                error.classList.add('visible');
                errorMessage.innerHTML = response.error.message;
            }

            let data = {
                quantity: quantity ? quantity.value : 1,
                plan: plan.value,
                recurring: recurring.checked,
                queue: queue.checked,
                promocode: couponEl.value
            };
            stripe.createPaymentMethod('card', elements[0], additionalData)
                .then(function(result) {

                    console.log("stripe result: ", result);
                    if (result.paymentMethod) {
                        axios.post(paymentForm.getAttribute('data-handler')+'/'+result.paymentMethod.id, data)
                            .then(result => {
                                if (result.data.redirect) {
                                    window.location.href = result.data.redirect;
                                } else {
                                    paymentForm.classList.remove('submitting');
                                    paymentForm.classList.add('submitted')
                                    paymentResponse.innerHTML = result.data;
                                }
                            }).catch(error => console.log("server error: ", error));
                    } else {
                        handleError();
                    }
                }).catch(handleErrorWithMessage);

        });

        let couponEl = document.querySelector('#coupon');
        let couponApplyButtonEl = document.querySelector('#apply-coupon');

        couponEl.addEventListener('input', function (event) {
            couponEl.classList.remove('border-red-400');
            couponEl.classList.remove('text-red-600');
            couponEl.classList.remove('font-bold');
        });

        couponApplyButtonEl
            .addEventListener('click', function (event) {
                event.preventDefault();
                let handler = couponApplyButtonEl.dataset.handler;
                axios.post(handler, {promocode: couponEl.value})
                    .then(result => {
                        if (result.data) {
                            VueAppSetPromoCode(couponEl.value);
                            couponEl.classList.add('border-red-400');
                            couponEl.classList.add('text-red-600');
                            couponEl.classList.add('font-bold');
                            error.classList.remove('visible');
                        } else {
                            error.classList.add('visible');
                            errorMessage.innerHTML = couponApplyButtonEl.dataset.invalidCodeMessage;
                        }
                    })
                    .catch(message => {
                        error.classList.add('visible');
                        errorMessage.innerHTML = message;
                    });
            })
    }


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
