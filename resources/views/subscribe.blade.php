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

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('pk_test_51HcdZLDl3uJ5ENdaQX6KQHq8Ap4g4k7gWkdikvPfqw6U2lbnHuERwib5LOUpY0ZQ9IqbxTIvMVDPctHKAYdWkilM00qF8JOnAe');
    </script>
</head>

<body class="leading-normal tracking-normal text-white bg-white" style="font-family: 'Source Sans Pro', sans-serif;">

<div class="gradient">
    @include('partials.nav')

    @include('partials.subscribe-hero')
</div>
</body>

<script src="js/app.js"></script>

</html>
