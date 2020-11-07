<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
    window.OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
        OneSignal.init({
            appId: "6a923a4c-c816-44f1-a098-67dbd40ac9cf",
        });

        @auth
        OneSignal.on('subscriptionChange', function(isSubscribed) {
            if (isSubscribed) {
                // The user is subscribed
                //   Either the user subscribed for the first time
                //   Or the user was subscribed -> unsubscribed -> subscribed
                OneSignal.push(function () {
                    OneSignal.setExternalUserId({{ Auth::user()->id }});
                });
            }
        });
        @endauth
    });
</script>

