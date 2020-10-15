require('./bootstrap');
require('./nav');

document.querySelector("#notification-close").addEventListener('click', function () {
    document.querySelector("#notification").style.display = "none";
})

