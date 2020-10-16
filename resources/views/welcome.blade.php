<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inkybot - Dofus Maging Bot</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <!-- Font Awesome if you need it
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    -->
    <link rel="stylesheet" href="css/app.css">
    <!--Replace with your tailwind.sass once created-->

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">
</head>

<body class="leading-normal tracking-normal text-white gradient" style="font-family: 'Source Sans Pro', sans-serif;">

@include('partials.nav')

<x-main-hero>
    <p class="uppercase tracking-loose w-full">The Dofus 2.0 Maging bot</p>
    <h1 class="my-4 text-5xl font-bold leading-tight">Customize your items the way you want</h1>
    <p class="leading-normal text-2xl mb-8">Tell us what stats you want on your items and we'll do the rest.</p>
    <button class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded my-6 py-4 px-8 shadow-lg">Download</button>
</x-main-hero>

@include('partials.features')

@include('partials.pricing')

@include('partials.engage')

@include('partials.footer')

</body>

<script src="js/app.js"></script>

</html>
