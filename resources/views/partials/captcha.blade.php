@production
    @push('head')
        <script src="https://www.google.com/recaptcha/api.js?hl={{ LaravelLocalization::getCurrentLocale() }}" async defer></script>
        <script>
            function onFormSubmit(token) {
                document.getElementById("{{ $formElementId }}").submit();
            }
        </script>
    @endpush
@endproduction
