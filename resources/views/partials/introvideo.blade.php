<section class="bg-gray-100 py-8 pb-12 border-b">
    <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Presentation</h1>
    <div class="w-full mb-4">
        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
    </div>
    <p class="w-full my-2 text-xl leading-tight text-center text-gray-800">
        Check out Inkybot in action. This timelapse video was recorded while the staff was off eating lunch.<br>
        Spend your time elsewhere, let Inkybot do it's thing. Don't let maging be frustrating.
    </p>

    <video title="EXO Maging Presentation Video"
           poster="{{ asset('images/poster_inkybot_intro.png') }}"
           class="mx-auto mt-8 my-6 rounded"
           height="1920"
           width="1080"
           preload="metadata"
           controls
           loop
           controlslist="nodownload"
           disablePictureInPicture>
        <source src="{{ asset('videos/inkybot_intro.mp4') }}" type="video/mp4" />
    </video>
</section>
