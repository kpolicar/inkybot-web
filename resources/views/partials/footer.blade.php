<footer class="bg-white">
    <div class="container mx-auto  px-8">

        <div class="w-full flex flex-col md:flex-row justify-center items-center py-6 pb-3">

            <a class="text-gray-800 no-underline hover:no-underline font-bold text-2xl lg:text-4xl px-3"  href="#">
                <svg class="h-8 fill-current inline" xmlns="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34 34">
                    <rect class="fill-current" x="0" y="31" width="31" height="3" transform="matrix(1,0,0,1,0,0)" />
                    <path transform="translate(3 0)" d="M 25.875 0.0625 C 7.531 0.0625 8.78125 11.4375 8.78125 11.4375 C 8.2290994 12.246696 7.6995693 13.046426 7.25 13.84375 C 7.2192731 13.898245 7.1865288 13.94563 7.15625 14 L 4 14 A 1.0001 1.0001 0 0 0 3.90625 14 A 1.001098 1.001098 0 0 0 3.5 15.90625 L 3 16 C 1.343 16 0 17.344 0 19 L 0 23 C 0 24.656 1.343 26 3 26 L 13 26 C 14.657 26 16 24.656 16 23 L 16 19 C 16 17.344 14.657 16 13 16 L 12.46875 15.875 A 1.0001 1.0001 0 0 0 12 14 L 8.78125 14 C 9.3768313 12.98664 10.046844 11.978044 10.8125 10.96875 C 10.850157 10.925536 10.924518 10.804345 10.96875 10.75 C 11.312321 10.305889 11.682667 9.871631 12.0625 9.4375 C 12.206935 9.262417 12.364614 9.0972071 12.53125 8.90625 C 14.065329 7.2428175 15.90652 5.6997788 18.0625 4.40625 C 16.2125 6.10525 13.15425 9.5635 11.65625 12.1875 C 14.10025 12.4015 17.5465 11.016 19.9375 9 C 19.3975 8.939 16.875 8.48475 16.125 7.84375 C 17.563 7.95975 19.95325 7.97425 20.90625 7.90625 C 22.84525 6.47025 25.063 3.0785 25.875 0.0625 z"/>
                </svg> INKYBOT
            </a>
            <p class="text-gray-700 px-3 text-center md:text-right border-r-0 border-b md:border-r md:border-b-0">
                {{ __('messages.copyright', ['year' => now()->format('Y')]) }}<br>
                <a href="{{ route('terms') }}" class="text-gray-600 hover:underline">
                    {{ __('common.terms') }}
                </a><br>
            </p>
            <p class="text-gray-700 px-3 text-center md:text-left">
                {{ __('messages.dofus_trademark') }}<br>
                {{ __('messages.affiliation') }}
            </p>
        </div>
    </div>


</footer>
