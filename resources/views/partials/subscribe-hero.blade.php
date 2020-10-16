<div class="pt-24">
    <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
        <div class="flex flex-col w-full justify-center items-start text-center md:text-left lg:py-24 pb-40 pt-5"
             style="background: url('hero.png') right bottom no-repeat; background-size: contain">
            <div class="w-full lg:w-2/5 lg:px-0 px-5">
                <div id="payment-form" class="stripe-payment-form">

                    <div class="flex flex-col lg:flex-row justify-around items-center loader">
                        <p class="text-xl my-8">Processing your payment...</p>
                        <i class="fas fa-spinner fa-spin text-6xl"></i>
                    </div>

                    <form>
                        <h1 class="my-4 text-3xl font-bold leading-tight">Purchase subscription</h1>
                        <div class="w-full mb-4">
                            <div class="h-1 mx-auto bg-white opacity-25 my-0 py-0 rounded-t"></div>
                        </div>

                        <p class="text-gray-400 text-base my-4 mb-8">
                            An issue with your card has occurred while trying to process your request.
                        </p>


                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                       id="name" name="name" type="text" placeholder="Name">
                            </div>
                            <div class="w-full md:w-1/2 pr-3">

                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                       id="email" name="email" type="email" placeholder="Email" value="{{ Auth::user()->email }}">
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 stripe-fields">
                            <div class="w-full md:w-3/5 px-3">
                                <div id="card-number" class="stripe-field"></div>
                            </div>
                            <div class="w-full md:w-1/5">
                                <div id="card-expiry" class="stripe-field"></div>
                            </div>
                            <div class="w-full md:w-1/5 px-3">
                                <div id="card-cvc" class="stripe-field"></div>
                            </div>
                        </div>

                        <input class="mx-auto lg:mx-0 hover:underline font-bold rounded my-6 py-4 px-8 shadow-lg cursor-pointer uppercase btn-color-secondary w-full"
                               type="submit" value="Pay 5€">

                        <div class="error" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
                                <path class="base" fill="#000" d="M8.5,17 C3.80557963,17 0,13.1944204 0,8.5 C0,3.80557963 3.80557963,0 8.5,0 C13.1944204,0 17,3.80557963 17,8.5 C17,13.1944204 13.1944204,17 8.5,17 Z"></path>
                                <path class="glyph" fill="#FFF" d="M8.5,7.29791847 L6.12604076,4.92395924 C5.79409512,4.59201359 5.25590488,4.59201359 4.92395924,4.92395924 C4.59201359,5.25590488 4.59201359,5.79409512 4.92395924,6.12604076 L7.29791847,8.5 L4.92395924,10.8739592 C4.59201359,11.2059049 4.59201359,11.7440951 4.92395924,12.0760408 C5.25590488,12.4079864 5.79409512,12.4079864 6.12604076,12.0760408 L8.5,9.70208153 L10.8739592,12.0760408 C11.2059049,12.4079864 11.7440951,12.4079864 12.0760408,12.0760408 C12.4079864,11.7440951 12.4079864,11.2059049 12.0760408,10.8739592 L9.70208153,8.5 L12.0760408,6.12604076 C12.4079864,5.79409512 12.4079864,5.25590488 12.0760408,4.92395924 C11.7440951,4.59201359 11.2059049,4.59201359 10.8739592,4.92395924 L8.5,7.29791847 L8.5,7.29791847 Z"></path>
                            </svg>

                            <p class="text-red-500 text italic message"></p>
                        </div>
                    </form>

                    <div id="payment-response">
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<div class="relative -mt-12 lg:-mt-24">
    <svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g transform="translate(-2.000000, 44.000000)" fill="#FFFFFF" fill-rule="nonzero">
                <path d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496" opacity="0.100000001"></path>
                <path d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z" opacity="0.100000001"></path>
                <path d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z" id="Path-4" opacity="0.200000003"></path>
            </g>
            <g transform="translate(-4.000000, 76.000000)" fill="#FFFFFF" fill-rule="nonzero">
                <path d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z"></path>
            </g>
        </g>
    </svg>
</div>
