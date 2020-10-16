require('./bootstrap');
require('./nav');

var notification = document.querySelector("#notification-close")
if (notification)
    notification.addEventListener('click', ()=> document.querySelector("#notification").style.display = "none")

