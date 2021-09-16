@extends('layouts.app')

@push('head')
    <meta property="og:video" content="{{ asset('videos/inkybot_intro.mp4') }}" />
    <meta property="og:video:width" content="1920">
    <meta property="og:video:height" content="1080">
@endpush

@section('hero')
    <x-main-hero>
        <h1 class="uppercase tracking-loose w-full">{{ __('messages.category') }}</h1>
        <h2 class="my-4 text-5xl font-bold leading-tight">{{ __('messages.heading') }}</h2>
        <p class="leading-normal text-2xl mb-8">{{ __('messages.subheading') }}</p>
        <p class="leading-normal uppercase text-sm pb-2">
            {!! __('common.compatible', ['version' => $gameVersion]) !!}
        </p>
        <a href="{{ route('download') }}"
           data-download
           rel="nofollow"
           class="inline-block mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded py-4 px-8 shadow-lg">
            {{ __('common.download') }}
        </a>
        <p class="my-2">
            <a href="{{ route('install') }}" class="text-gray-300 font-bold hover:underline">
                {{ __('messages.install_instructions') }}
            </a>
        </p>
    </x-main-hero>
@endsection

@section('content')
    @include('partials.features')

    <div class="anchor" id="features"></div>
    <section class="bg-gray-100 py-8 pb-12 border-b" id="features-section">
        <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
            Features
        </h2>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto gradient w-40 opacity-25 my-0 py-0 rounded-t"></div>
        </div>


        <div class="flex flex-wrap mx-auto px-6">
            <div class="w-1/4 mx-auto px-3 mt-8 my-6 mb-3 z-0 cursor-zoom-in flex items-center justify-center">
                <img src="{{ asset('images/features/setup.png') }}"
                     alt="Setup form for Alliance Gloursonne"
                     id="what1"
                     class="rounded rounded-t-none transform duration-300 scale-100">
                {{--<video title="{{ __('presentation.video_alt') }}"
                       id="what1"
                       poster="{{ asset('images/poster_inkybot_intro.png') }}"
                       class="rounded transform duration-300 scale-100 border-r border-l"
                       height="1920"
                       width="1080"
                       preload="metadata"
                       muted
                       controlslist="nodownload"
                       disablePictureInPicture>
                    <source src="{{ asset('videos/inkybot_intro.mp4') }}" type="video/mp4" />
                </video>--}}
            </div>
            <div class="w-1/2 mx-auto px-3 mt-8 my-6 mb-3 z-10 cursor-zoom-in flex items-center justify-center">
                <img src="{{ asset('images/features/client.png') }}"
                     alt="Preview of the Inkybot client with a successful MP exotic mage of Alliance Gloursonne"
                     id="what2"
                     class="rounded rounded-t-none transform duration-300 scale-100 scale-110 shadow-2xl">
                {{--<video title="{{ __('presentation.video_alt') }}"
                       id="what2"
                       poster="{{ asset('images/poster_inkybot_intro.png') }}"
                       class="rounded transform duration-300 scale-100 scale-110 shadow-2xl border-l border-r"
                       height="1920"
                       width="1080"
                       preload="metadata"
                       autoplay
                       muted
                       controlslist="nodownload"
                       disablePictureInPicture>
                    <source src="{{ asset('videos/inkybot_intro.mp4') }}" type="video/mp4" />
                </video>--}}
            </div>
            <div class="w-1/4 mx-auto px-3 mt-8 my-6 mb-3 z-0 cursor-zoom-in flex items-center justify-center">
                <img src="{{ asset('images/features/config.png') }}"
                     alt="Configuration form for Alliance Gloursonne"
                     id="what3"
                     class="rounded rounded-t-none transform duration-300 scale-100">

                {{--<video title="{{ __('presentation.video_alt') }}"
                       id="what3"
                       poster="{{ asset('images/poster_inkybot_intro.png') }}"
                       class="rounded transform duration-300 scale-100 border-l border-r"
                       height="1920"
                       width="1080"
                       preload="metadata"
                       muted
                       controlslist="nodownload"
                       disablePictureInPicture>
                    <source src="{{ asset('videos/inkybot_intro.mp4') }}" type="video/mp4" />
                </video>--}}
            </div>
            <div class="w-full cursor-zoom-in flex justify-center pt-5 z-0 duration-300">
                <img src="{{ asset('images/features/queue.png') }}"
                     alt="The maging queue with 3 items ready to be maged"
                     id="what4"
                     class="rounded rounded-t-none w-1/4 transform translate-y-2 duration-300 shadow-2xl">
            </div>
        </div>
        <script>
            let f = document.querySelector("#features-section");
            let a = document.querySelector("#what1");
            let b = document.querySelector("#what2");
            let c = document.querySelector("#what3");
            let d = document.querySelector("#what4");
            a.addEventListener('mouseover', function () {
                this.classList.add('scale-110')
                this.classList.add('shadow-2xl')
                this.parentNode.classList.add('z-20')
                // this.play();
                // b.pause();
                // c.pause();
                b.classList.remove('scale-110')
                b.classList.remove('shadow-2xl')
                b.parentNode.classList.remove('z-20')
                c.classList.remove('scale-110')
                c.classList.remove('shadow-2xl')
                c.parentNode.classList.remove('z-20')
                d.classList.remove('translate-y-2')
                d.classList.remove('opacity-100')
                d.classList.add('opacity-0')
                d.classList.add('xl:-translate-y-40')
                d.classList.add('-translate-y-16')
                d.classList.add('sm:-translate-y-20')
                d.classList.add('md:-translate-y-32')
                d.classList.add('lg:-translate-y-40')
                d.classList.remove('shadow-2xl')
                d.parentNode.classList.add('xl:-my-40')
                d.parentNode.classList.add('-my-16')
                d.parentNode.classList.add('sm:-my-20')
                d.parentNode.classList.add('md:-my-32')
                d.parentNode.classList.add('lg:-my-40')
            })
            b.addEventListener('mouseover', function () {
                this.classList.add('scale-110')
                this.classList.add('shadow-2xl')
                this.parentNode.classList.add('z-20')
                // this.play();
                // a.pause();
                // c.pause();
                a.classList.remove('scale-110')
                a.parentNode.classList.remove('z-20')
                a.classList.remove('shadow-2xl')
                c.classList.remove('scale-110')
                c.classList.remove('shadow-2xl')
                c.parentNode.classList.remove('z-20')
                d.classList.add('translate-y-2')
                d.classList.add('opacity-100')
                d.classList.remove('opacity-0')
                d.classList.remove('xl:-translate-y-40')
                d.classList.remove('-translate-y-16')
                d.classList.remove('sm:-translate-y-20')
                d.classList.remove('md:-translate-y-32')
                d.classList.remove('lg:-translate-y-40')
                d.classList.add('shadow-2xl')
                d.parentNode.classList.remove('xl:-my-40')
                d.parentNode.classList.remove('-my-16')
                d.parentNode.classList.remove('sm:-my-20')
                d.parentNode.classList.remove('md:-my-32')
                d.parentNode.classList.remove('lg:-my-40')
            })
            f.addEventListener('mouseleave', function () {
                b.classList.add('scale-110')
                b.classList.add('shadow-2xl')
                b.parentNode.classList.add('z-20')
                // this.play();
                // a.pause();
                // c.pause();
                a.classList.remove('scale-110')
                a.parentNode.classList.remove('z-20')
                a.classList.remove('shadow-2xl')
                c.classList.remove('scale-110')
                c.classList.remove('shadow-2xl')
                c.parentNode.classList.remove('z-20')
                d.classList.add('translate-y-2')
                d.classList.add('opacity-100')
                d.classList.remove('opacity-0')
                d.classList.add('shadow-2xl')
                d.classList.remove('xl:-translate-y-40')
                d.classList.remove('-translate-y-16')
                d.classList.remove('sm:-translate-y-20')
                d.classList.remove('md:-translate-y-32')
                d.classList.remove('lg:-translate-y-40')
                d.parentNode.classList.remove('xl:-my-40')
                d.parentNode.classList.remove('-my-16')
                d.parentNode.classList.remove('sm:-my-20')
                d.parentNode.classList.remove('md:-my-32')
                d.parentNode.classList.remove('lg:-my-40')
            })
            c.addEventListener('mouseover', function () {
                this.classList.add('scale-110')
                this.classList.add('shadow-2xl')
                this.parentNode.classList.add('z-20')
                // this.play();
                // a.pause();
                // b.pause();
                a.classList.remove('scale-110')
                a.classList.remove('shadow-2xl')
                a.parentNode.classList.remove('z-20')
                b.classList.remove('scale-110')
                b.classList.remove('shadow-2xl')
                b.parentNode.classList.remove('z-20')
                d.classList.remove('translate-y-2')
                d.classList.remove('opacity-100')
                d.classList.add('opacity-0')
                d.classList.add('xl:-translate-y-40')
                d.classList.add('-translate-y-16')
                d.classList.add('sm:-translate-y-20')
                d.classList.add('md:-translate-y-32')
                d.classList.add('lg:-translate-y-40')
                d.classList.remove('shadow-2xl')
                d.parentNode.classList.add('xl:-my-40')
                d.parentNode.classList.add('-my-16')
                d.parentNode.classList.add('sm:-my-20')
                d.parentNode.classList.add('md:-my-32')
                d.parentNode.classList.add('lg:-my-40')
            })
        </script>
    </section>

    @include('partials.introvideo')
    @include('partials.pricing')
@endsection
