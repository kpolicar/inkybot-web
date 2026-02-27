<div class="anchor" id="works"></div>
<section class="bg-gray-100 py-8 pb-12 border-b" id="features-section">
    
    <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
        How does it work?
    </h2>
    <div class="w-full mb-4">
        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
    </div>
    <div class="flex justify-center">
    <div class="dashboard-container">
        @include('partials.setup-form')
        @include('partials.maging-table', ['showOcr' => true, 'streamHeight' => 180])
    </div>
    <div class="pl-8 pt-16 max-w-xs">
        <ul class="space-y-6 text-gray-700 text-lg">
            <li>
                <span class="font-bold text-gray-900 block">OCR Vision</span>
                Reads your game interface in real-time
            </li>
            <li>
                <span class="font-bold text-gray-900 block">Mouse Control</span>
                Interacts with the game using the mouse
            </li>
            <li>
                <span class="font-bold text-gray-900 block">Smart AI</span>
                Picks the optimal rune to maximize profit
            </li>
        </ul>
    </div>
    </div>
</section>

<div class="anchor" id="features"></div>
<section class="bg-white py-8 pb-12 border-b" id="features-section">

    <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
        {{ __('features.heading') }}
    </h2>
    <div class="w-full mb-4">
        <div class="h-1 mx-auto gradient w-40 opacity-25 my-0 py-0 rounded-t"></div>
    </div>


    <div class="flex flex-wrap mx-auto px-6">
        <div class="w-1/4 mx-auto px-3 mt-8 my-6 mb-3 z-0 cursor-zoom-in flex items-center justify-center">
            <img src="{{ asset('images/features/setup.png') }}"
                 alt="{{ __('features.setup_alt') }}"
                 id="imgSetupForm"
                 class="rounded rounded-t-none transform duration-300 scale-100">wat is this
        </div>
        <div class="w-1/2 mx-auto px-3 mt-8 my-6 mb-3 z-10 cursor-zoom-in flex items-center justify-center">
            <img src="{{ asset('images/features/client.png') }}"
                 alt="{{ __('features.client_alt') }}"
                 id="imgClientForm"
                 class="rounded rounded-t-none transform duration-300 scale-100 scale-110 shadow-2xl">
        </div>
        <div class="w-1/4 mx-auto px-3 mt-8 my-6 mb-3 z-0 cursor-zoom-in flex items-center justify-center">
            <img src="{{ asset('images/features/config.png') }}"
                 alt="{{ __('features.config_alt') }}"
                 id="imgConfigForm"
                 class="rounded rounded-t-none transform duration-300 scale-100">
        </div>
        <div class="w-full cursor-zoom-in flex justify-center pt-5 z-0 duration-300">
            <img src="{{ asset('images/features/queue.png') }}"
                 alt="{{ __('features.queue_alt') }}"
                 id="imgQueueForm"
                 class="rounded rounded-t-none w-1/4 transform translate-y-2 duration-300 shadow-2xl">
        </div>
    </div>
    <script>
        let f = document.querySelector("#features-section");
        let a = document.querySelector("#imgSetupForm");
        let b = document.querySelector("#imgClientForm");
        let c = document.querySelector("#imgConfigForm");
        let d = document.querySelector("#imgQueueForm");
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

