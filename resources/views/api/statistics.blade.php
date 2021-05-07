<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">
    <title>
        @hasSection('title')@yield('title') - @endif{{ 'Inkybot - ' . __('titles.main') }}
    </title>
</head>

<body class="leading-normal tracking-normal text-white bg-gray-100" style="font-family: 'Source Sans Pro', sans-serif;">
<main class="relative z-10 bg-gray-100">
    @can('view-statistics')
        @include('partials/statistics-today')
    @else
        @include('partials.feature-locked')
    @endcan

    <div class="pb-8 mx-8 -mt-8">
        <form action="{{ route('statistics.newsession', compact('version')) }}"
              method="POST">
            @csrf
            <button type="submit"
               class="hover:underline gradient text-white font-bold rounded py-4 px-8 shadow-lg">
                Begin new Session
            </button>
        </form>
    </div>
</main>
</body>
</html>
