<div class="anchor" id="pricing"></div>
<section class="bg-gray-100 py-8 pb-12">

    <div class="container mx-auto px-2 pt-4 pb-2 text-gray-800">

        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Pricing</h1>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
        </div>
        <p class="w-full my-2 text-xl leading-tight text-center text-gray-800">
            Inkybot pricing follows a typical monthly subscription based model.<br>
            We do not support recurring payments, the customer must repurchase
            subscription manually each month.<br>
            Thank you for your support.
        </p>

        <div class="flex flex-col sm:flex-row justify-center pt-12 my-12 sm:my-4">

            <div class="flex flex-col w-5/6 lg:w-1/3 xl:w-1/4 mx-auto lg:mx-0 rounded-none lg:rounded-l-lg bg-white mt-4">
                <div class="flex-1 bg-white text-gray-600 rounded-t rounded-b-none overflow-hidden shadow">
                    <div class="w-full p-8 text-3xl font-bold text-center border-b-4 border-gray-500">
                        Free trial
                    </div>
                    <ul class="w-full text-center text-sm">
                        <li class="border-b py-4">15 minute use</li>
                        <li class="border-b py-4">Simple maging</li>
                    </ul>
                </div>
                <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6">
                    <div class="w-full pt-6 text-3xl text-gray-600 font-bold text-center leading-none mb-2">
                        €0
                    </div>
                    <div class="flex items-center justify-center">
                        <a href="{{ asset($download_asset) }}"
                           download
                            class="inline-block mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded my-6 py-4 px-8 shadow-lg">Download</a>
                    </div>
                </div>
            </div>
            <div class="flex flex-col w-5/6 lg:w-1/3 xl:w-1/4 mx-auto lg:mx-0 rounded-lg bg-white mt-4 sm:-mt-6 shadow-lg z-10">
                <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
                    <div class="w-full p-8 text-3xl font-bold text-center">Subscription</div>
                    <div class="h-1 w-full gradient my-0 py-0 rounded-t"></div>
                    <ul class="w-full text-center text-sm">
                        <li class="border-b py-4">Unlimited use</li>
                        <li class="border-b py-4">Maging with sink</li>
                        <li class="border-b py-4">Exomaging</li>
                        <li class="border-b py-4"><strike>Overmaging</strike>*</li>
                        <li class="border-b py-4"><strike>Magus leveling</strike>*</li>
                    </ul>
                </div>
                <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6">
                    <div class="w-full pt-6 text-3xl font-bold text-center leading-none mb-2">
                        <span class="text-base text-gray-600">€<strike>6.00</strike><br></span>
                        €4 <small class="text-sm">/ month</small>
                    </div>
                    <div class="flex items-center justify-center">
                        @auth
                            <a href="{{ route('subscribe') }}"
                               class="inline-block mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded my-6 py-4 px-8 shadow-lg">
                                Purchase
                            </a>
                        @else
                            <a href="{{ route('register') }}"
                               class="inline-block mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded my-6 py-4 px-8 shadow-lg">
                                Sign up
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

        </div>
    </div>

    <p class="w-full my-2 leading-tight text-center text-gray-800">* Features are under active development and have not yet been made available</p>


</section>
