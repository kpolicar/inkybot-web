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

    <div class="pb-8 mx-8">
        <form action="{{ route('statistics.newsession', compact('version')) }}"
              class="flex justify-around items-start text-sm"
              method="GET">
            @csrf
            <div class="w-full">
                <input type="text"
                       name="label"
                       maxlength="50"
                       class="w-full bg-gray-200 text-gray-700 border @error('label') border-red-500 @enderror border-gray-200 rounded py-4 px-4 focus:outline-none focus:bg-gray-100 focus:border-gray-500"
                       placeholder="{{ __('profile.statistics_new_session_label') }}">
                @error('label')
                    <small class="text-red-500 text-xs italic">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <button type="submit"
               class="w-full hover:underline gradient text-white font-bold rounded py-4 px-6 shadow-lg ml-4">
                {{ __('profile.statistics_new_session') }}
            </button>
        </form>
        @error('default')
        <small class="text-red-500 text-xs italic">
            {{ $message }}
        </small>
        @enderror
    </div>
</main>
</body>
</html>
