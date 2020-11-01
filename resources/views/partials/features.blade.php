<section class="bg-white border-b py-8">


    <div class="container mx-auto flex flex-wrap pt-4 pb-12">

        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Features</h1>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
        </div>

        <x-feature-card icon="expand">
            <x-slot name="title">
                OCR Data Gathering
            </x-slot>
            Data is collected by taking a screenshot of the client and parsing necessary information
            using powerful OCR technologies. This ensures complete undetectability and stability throughout dofus updates.
        </x-feature-card>

        <x-feature-card icon="mouse-pointer">
            <x-slot name="title">
                Human-like Behavior
            </x-slot>
            Simulating mouse and keyboard strokes makes the bot indistinguishable from human players.
        </x-feature-card>

        <x-feature-card icon="sync">
            <x-slot name="title">
                Regular updates
            </x-slot>
            Inkybot is under active development and will continue to be improved long after the official release.
            We play Dofus too, so we are committed to make maging with Inkybot better than maging by yourself in every way - for you and for us!
        </x-feature-card>

        <x-feature-card icon="comments">
            <x-slot name="title">
                Community
            </x-slot>
            Let's build Inkybot together! We listen and encourage suggestions on how we can improve our services. Join our Discord server now!
        </x-feature-card>

        <x-feature-card icon="code" :tags="['in development']">
            <x-slot name="title">
                Advanced API
            </x-slot>
            We are building an API to support anyone who would like to write their own maging script.
        </x-feature-card>

        <x-feature-card icon="bell" :tags="['in development']">
            <x-slot name="title">
                Notifications
            </x-slot>
            Receive notifications for special events that may occur during maging, for instance finishing an item mage.
        </x-feature-card>

    </div>

</section>
