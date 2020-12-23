/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/stripe.js":
/*!********************************!*\
  !*** ./resources/js/stripe.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function () {
  'use strict';

  function registerElements(elements) {
    var example = document.querySelector("#payment-form");
    var form = example.querySelector('form');
    var error = form.querySelector('.error');
    var errorMessage = error.querySelector('.message');

    function enableInputs() {
      Array.prototype.forEach.call(form.querySelectorAll("input[type='text'], input[type='email'], input[type='tel']"), function (input) {
        input.removeAttribute('disabled');
      });
    }

    function disableInputs() {
      Array.prototype.forEach.call(form.querySelectorAll("input[type='text'], input[type='email'], input[type='tel']"), function (input) {
        input.setAttribute('disabled', 'true');
      });
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
    } // Listen for errors from each Element, and show error messages in the UI.


    var savedErrors = {};
    elements.forEach(function (element, idx) {
      element.on('change', function (event) {
        if (event.error) {
          error.classList.add('visible');
          savedErrors[idx] = event.error.message;
          errorMessage.innerText = event.error.message;
        } else {
          savedErrors[idx] = null; // Loop over the saved errors and find the first one, if any.

          var nextError = Object.keys(savedErrors).sort().reduce(function (maybeFoundError, key) {
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
    }); // Listen on the form's 'submit' handler...

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      if (_.find(savedErrors, function (error) {
        return error !== null;
      })) return; // Trigger HTML5 validation UI on the form if any of the inputs fail
      // validation.

      var plainInputsValid = true;
      Array.prototype.forEach.call(form.querySelectorAll('input'), function (input) {
        if (input.checkValidity && !input.checkValidity()) {
          plainInputsValid = false;
          return;
        }
      });

      if (!plainInputsValid) {
        triggerBrowserValidation();
        return;
      } // Show a loading screen...


      example.classList.add('submitting'); // Disable all inputs.

      disableInputs(); // Gather additional customer data we may have collected in our form.

      var name = form.querySelector('#name');
      var email = form.querySelector('#email');
      var paymentResponse = example.querySelector('#payment-response');
      var additionalData = {
        billing_details: {
          name: name ? name.value : undefined,
          email: email ? email.value : undefined
        }
      };

      var handleError = function handleError(error) {
        example.classList.remove('submitting');
        enableInputs();
      };

      stripe.createPaymentMethod('card', elements[0], additionalData).then(function (result) {
        console.log("stripe result: " + result);

        if (result.paymentMethod) {
          axios.post('/pay/subscribe/' + result.paymentMethod.id).then(function (result) {
            if (result.data.redirect) {
              window.location.href = result.data.redirect;
            } else {
              example.classList.remove('submitting');
              example.classList.add('submitted');
              paymentResponse.innerHTML = result.data;
            }
          })["catch"](function (error) {
            return console.log("server error: " + error);
          });
        } else {
          handleError();
        }
      })["catch"](handleError);
    });
  }

  var elements = stripe.elements({
    fonts: [{
      cssSrc: 'https://fonts.googleapis.com/css?family=Quicksand'
    }],
    // Stripe's examples are localized to specific languages, but if
    // you wish to have Elements automatically detect your user's locale,
    // use `locale: 'auto'` instead.
    locale: 'auto'
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
        color: '#4A5568'
      },
      '::placeholder': {
        color: '#A3B0C2'
      },
      ':focus::placeholder': {
        color: '#A0AEC0'
      }
    },
    invalid: {
      iconColor: '#9d2020',
      color: '#9d2020',
      '::placeholder': {
        color: '#be5252'
      }
    }
  };
  var elementClasses = {
    focus: 'focus',
    empty: 'empty',
    invalid: 'invalid'
  };
  var cardNumber = elements.create('cardNumber', {
    showIcon: true,
    style: elementStyles,
    classes: elementClasses
  });
  cardNumber.mount('#card-number');
  var cardExpiry = elements.create('cardExpiry', {
    style: elementStyles,
    classes: elementClasses
  });
  cardExpiry.mount('#card-expiry');
  var cardCvc = elements.create('cardCvc', {
    style: elementStyles,
    classes: elementClasses
  });
  cardCvc.mount('#card-cvc');
  registerElements([cardNumber, cardExpiry, cardCvc]);
})();

/***/ }),

/***/ 1:
/*!**************************************!*\
  !*** multi ./resources/js/stripe.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! A:\Projects\PhpstormProjects\inkybot-server\resources\js\stripe.js */"./resources/js/stripe.js");


/***/ })

/******/ });