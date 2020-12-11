require('./bootstrap');
require('./nav');

var notifications = document.querySelectorAll("[data-hide]")
notifications.forEach(notification => {
    notification.addEventListener('click',
        () => {
            document.querySelector(notification.getAttribute('data-hide')).classList.add('hidden')
        })
})


document.addEventListener('download', () =>
    document.querySelector('#download-notification').classList.remove('hidden'))


var downloadLinks = document.querySelectorAll("a[download]")
downloadLinks.forEach(downloadLink => {
    downloadLink.addEventListener('click', () => document.dispatchEvent(new Event('download')))
})
