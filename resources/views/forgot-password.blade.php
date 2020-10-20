<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password - Inkybot - Dofus Maging Bot</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">
</head>

<body class="leading-normal tracking-normal text-white bg-white" style="font-family: 'Source Sans Pro', sans-serif;">

<div class="gradient">
    @include('partials.nav')

    <x-main-hero>
        <h2 class="uppercase tracking-loose w-full">Recover your account</h2>
        <div class="flex justify-between">
            <h1 class="my-4 text-3xl font-bold leading-tight">Password recovery</h1>
            <i class="fas fa-user-lock text-4xl p-3"></i>
        </div>

        <div class="w-full mb-4">
            <div class="h-1 mx-auto bg-white opacity-25 my-0 py-0 rounded-t"></div>
        </div>

        @if (!session('status'))
            <form class="w-full max-w-lg" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-xs font-bold mb-2" for="email">
                            Email
                        </label>

                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('email') border-red-500 @enderror border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                               id="email" name="email" type="email" placeholder="user@example.com">
                        @error('email')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <button class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded py-4 px-8 shadow-lg"
                        type="submit">
                    Reset password
                </button>
            </form>
        @else
            <p class="my-4 font-medium text-sm">
                We have sent you an email to reset your password. Please follow the instructions described in the message.
            </p>
        @endif

    </x-main-hero>

</div>

</body>

<script src="{{ asset('js/app.js') }}"></script>

</html>
