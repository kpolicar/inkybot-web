<div class="anchor" id="ai"></div>
<section class="bg-white py-8 pb-32 border-t">

    <div class="container mx-auto px-2 pt-4 pb-2 text-gray-800">

        <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Basic Maging AI</h2>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
        </div>

        <div class="flex lg:flex-row flex-col px-6 lg:px-0">
            <i class="text-center lg:text-left fas fa-robot text-6xl lg:mr-10 mr-0 pb-3"></i>
            <div>

                <p class="text-base mt-2">
                    The simple Dofus maging AI will mage your items to the configured stats. The target is treated
                    as a <strong>limit</strong>, thus it will never attempt to go over it.
                </p>
                <p class="text-base">
                    For example, if you target vitality
                    to 390 and the current value is 362, the bot will not try to mage any further (the RA vitality rune
                    would make the stat land at 412, which is over the limit).
                </p>
                <p class="text-base mt-2">
                    Stats are <strong>prioritized</strong> by how many runes are required to reach the target.
                </p>
                <p class="text-base mt-2">
                    Once a stat reaches a certain threshold, it will change <strong>strength</strong> (from SM to PA to RA).
                </p>
                <p class="text-base mt-2">
                    You must make sure you always have <strong>enough runes</strong> for maging. If you run out of a rune,
                    the bot will warn you only after it discovers this.
                </p>
                <p class="text-base mt-2">
                    The Basic Maging AI does not yet make use of <strong>sink</strong>.
                </p>
            </div>
        </div>
    </div>
</section>
