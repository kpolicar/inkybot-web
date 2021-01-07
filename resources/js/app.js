require('./bootstrap');
require('./nav');
require('./noise');

var notifications = document.querySelectorAll("[data-hide]")
notifications.forEach(notification => {
    notification.addEventListener('click',
        () => {
            document.querySelector(notification.getAttribute('data-hide')).classList.add('hidden')
        })
})


document.addEventListener('download', () =>
    document.querySelector('#download-notification').classList.remove('hidden'))


var downloadLinks = document.querySelectorAll("a[download]:not([data-external])")
downloadLinks.forEach(downloadLink => {
    downloadLink.addEventListener('click', () => document.dispatchEvent(new Event('download')))
})

var dropdowns = document.querySelectorAll("[data-dropdown]")

dropdowns.forEach(dropdown => {
    let trigger = document.querySelector(dropdown.getAttribute('data-dropdown'));
    trigger.addEventListener('click', () => {
        if (dropdown.classList.contains('hidden'))
            dropdown.classList.remove('hidden')
        else
            dropdown.classList.add('hidden')
    })
})
