<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
    window.OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
        OneSignal.init({
            appId: "6a923a4c-c816-44f1-a098-67dbd40ac9cf",
        });


        @auth

        @if(\Session::get('logged_in'))
        OneSignal.isPushNotificationsEnabled(function(isEnabled) {
            if (!isEnabled) return;

            OneSignal.push(function () {
                OneSignal.setExternalUserId({{ Auth::user()->id }});
            });
        });
        @endif

        OneSignal.on('subscriptionChange', function(isSubscribed) {
            if (!isSubscribed) return;

            OneSignal.push(function () {
                OneSignal.setExternalUserId({{ Auth::user()->id }});
            });
        });
        @endauth
    });
</script>

