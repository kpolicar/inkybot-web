@php($formElementId="login-form")
@include('partials/captcha', compact('formElementId'))

<form class="w-full" method="POST" action="{{  \LaravelLocalization::localizeURL('/login') }}" id="{{ $formElementId }}">
    @csrf
    <input type="hidden" name="remember" value="1">
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-3/5 px-3">
            <label class="block uppercase tracking-wide text-xs font-bold mb-2" for="grid-password">
                {{ __('forms.email') }}
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('email') border-red-500 @enderror border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                   id="grid-email" name="email" type="email" placeholder="{{ __('forms.email_example') }}">
            @error('email')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full md:w-2/5 px-3">
            <label class="block uppercase tracking-wide text-xs font-bold mb-2" for="password">
                {{ __('forms.password') }}
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('password') border-red-500 @enderror border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                   id="password" name="password" type="password" placeholder="******">
            @error('password')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
    </div>

    @error('g-recaptcha-response')
        <p class="text-red-700 text-xs italic">{{ $message }}</p>
    @enderror

    <button class="g-recaptcha mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded py-4 px-8 shadow-lg"
            data-sitekey="{{ config('captcha.sitekey') }}" data-callback="onFormSubmit" data-badge="bottomleft">
        {{ __('forms.login_form_submit') }}
    </button>
</form>
