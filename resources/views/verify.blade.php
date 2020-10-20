<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify Email - Inkybot - Dofus Maging Bot</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <!-- Font Awesome if you need it
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!--Replace with your tailwind.sass once created-->

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">
</head>

<body class="leading-normal tracking-normal text-white bg-white" style="font-family: 'Source Sans Pro', sans-serif;">

<div class="gradient">
    @include('partials.nav')

    <x-main-hero>
        <h2 class="uppercase tracking-loose w-full">Protect your account</h2>
        <div class="flex justify-between">
            <h1 class="my-4 text-3xl font-bold leading-tight">Verify your email address</h1>
            <i class="fas fa-user-shield text-4xl p-3"></i>
        </div>

        <div class="w-full mb-4">
            <div class="h-1 mx-auto bg-white opacity-25 my-0 py-0 rounded-t"></div>
        </div>

        @if (!session('status'))
        <p>
            You will be sent an email at <strong>{{ Auth::user()->email }}</strong>.
        </p>
        <p>
            In order to complete verification, click the highlighted link in the email.
        </p>

        <form action="{{ route('verification.send') }}" method="POST">
            @csrf
            <button class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded py-4 px-8 mt-8 shadow-lg"
                    type="submit">
                Send verification email
            </button>
        </form>

        @else
            <p>
                You have been sent an email at <strong>{{ Auth::user()->email }}</strong>.
            </p>
            <p>
                In order to complete verification, click the highlighted link in the email.
            </p>
            <a href="{{ route('profile') }}" class="inline-block mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded py-4 px-8 mt-8 shadow-lg">
                Back to profile
            </a>
        @endif

        <p class="text-gray-400 text-sm mt-4">
            In the case that you have tried to resend the verification email multiple times, and have still not received
            an email from us, please contact us directly at
            <a href="mailto:support@inkybot.me" class="font-bold">support@inkybot.me</a>
        </p>


    </x-main-hero>

</div>

</body>

<script src="{{ asset('js/app.js') }}"></script>

</html>
