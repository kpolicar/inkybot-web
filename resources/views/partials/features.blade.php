<section class="bg-white border-b py-8">


    <div class="container mx-auto flex flex-wrap pt-4 pb-12">

        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Features</h1>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
        </div>

        <x-feature-card>
            <x-slot name="title">
                OCR Data Gathering
            </x-slot>
            Data is collected by taking a screenshot of the client and parsing necessary information
            using powerful OCR technologies.
        </x-feature-card>

        <x-feature-card>
            <x-slot name="title">
                Human-like Behavior
            </x-slot>
            Simulating mouse and keyboard strokes makes Inkybot indistinguishable from humans.
        </x-feature-card>

        <x-feature-card>
            <x-slot name="title">
                Easy to use
            </x-slot>
            The client was made to feel like you instantly could set it up. It's easy to understand and use even for new botters.
        </x-feature-card>

        <x-feature-card>
            <x-slot name="title">
                Community
            </x-slot>
            Our staff is actively developing Inkybot and we listen to your suggestions.
        </x-feature-card>

        <x-feature-card :tags="['in development']">
            <x-slot name="title">
                Notifications
            </x-slot>
            Our bot will notify you when completing a mage.
        </x-feature-card>

        <x-feature-card :tags="['in development']">
            <x-slot name="title">
                Advanced API
            </x-slot>
            Our API is a developer's dream and caters to scripters. We take active input from all scripters for it!
        </x-feature-card>

    </div>

</section>
