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
                        <div class="flex justify-between items-end">
                            <h1 class="mb-4 text-3xl font-bold leading-tight w-100">Purchase subscription</h1>

                            <svg class="my-4 text-gray-300 fill-current" fill-rule="evenodd" xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 0 119 26"><path d="M113 26H6c-3.314 0-6-2.686-6-6V6c0-3.314 2.686-6 6-6h107c3.314 0 6 2.686 6 6v14c0 3.314-2.686 6-6 6zM11.128 8.892H8.571v7.241h1.347v-2.6h1.21c1.474 0 2.526-.947 2.526-2.315 0-1.368-1.052-2.326-2.526-2.326zm5.915 1.853c-1.589 0-2.715 1.136-2.715 2.757 0 1.61 1.126 2.757 2.715 2.757s2.705-1.147 2.705-2.757c0-1.621-1.116-2.757-2.705-2.757zm9.893.126l-1.063 3.578-1.063-3.578h-1.22l-1.063 3.578-1.063-3.578h-1.347l1.81 5.262h1.21l1.063-3.578 1.074 3.578h1.21l1.799-5.262zm4.316-.126c-1.505 0-2.599 1.126-2.599 2.715 0 1.641 1.115 2.799 2.704 2.799.589 0 1.189-.137 1.789-.41v-1.127c-.547.316-1.084.495-1.568.495-.884 0-1.515-.547-1.6-1.347h3.568c.021-.179.021-.347.021-.495 0-1.546-.937-2.63-2.315-2.63zm6.472.052c-.147-.042-.294-.052-.442-.052-.452 0-.915.231-1.294.652v-.526h-1.347v5.262h1.347v-3.515c.347-.442.821-.684 1.263-.684.158 0 .326.021.473.063zm3.084-.052c-1.505 0-2.599 1.126-2.599 2.715 0 1.641 1.115 2.799 2.704 2.799.59 0 1.19-.137 1.789-.41v-1.127c-.547.316-1.083.495-1.568.495-.883 0-1.515-.547-1.599-1.347h3.567c.021-.179.021-.347.021-.495 0-1.546-.936-2.63-2.315-2.63zm8.104-2.179h-1.358v2.663c-.41-.316-.873-.484-1.336-.484-1.4 0-2.378 1.136-2.378 2.757 0 1.62.978 2.757 2.378 2.757.463 0 .926-.168 1.336-.495v.369h1.358zm6.778 2.179c-.452 0-.916.168-1.336.484V8.566h-1.347v7.567h1.347v-.369c.42.327.884.495 1.336.495 1.41 0 2.378-1.137 2.378-2.757 0-1.621-.968-2.757-2.378-2.757zm6.62.126l-1.273 3.452-1.263-3.452h-1.379l2.01 5.072-1.01 2.494H60.7l2.989-7.566zm10.799-.583c.863 0 1.96.264 2.824.731V8.344c-.941-.375-1.881-.519-2.822-.519-2.303 0-3.838 1.203-3.838 3.213 0 3.143 4.316 2.633 4.316 3.988 0 .525-.456.695-1.089.695-.941 0-2.155-.389-3.108-.907v2.711c1.056.454 2.126.644 3.105.644 2.361 0 3.988-1.166 3.988-3.21 0-3.386-4.341-2.778-4.341-4.056 0-.443.37-.615.965-.615zm9.071-2.274h-2.156l-.002-2.466-2.772.59-.013 9.109c0 1.681 1.265 2.922 2.95 2.922.928 0 1.614-.168 1.992-.376v-2.311c-.363.145-2.155.666-2.155-1.007v-4.04h2.156zm6.095.001c-.378-.136-1.705-.384-2.37.838l-.178-.839h-2.455v9.952h2.838v-6.747c.671-.881 1.804-.711 2.165-.594zm3.724-3.785l-2.85.606v2.313l2.85-.606zm0 3.784h-2.85v9.952h2.85zm6.126-.189c-1.113 0-1.832.524-2.224.89l-.148-.701h-2.5l.001 13.254 2.839-.604.006-3.213c.408.299 1.015.718 2.009.718 2.031 0 3.889-1.634 3.889-5.242 0-3.306-1.878-5.102-3.872-5.102zm8.924 0c-2.701 0-4.345 2.296-4.345 5.188 0 3.424 1.938 5.156 4.704 5.156 1.357 0 2.376-.308 3.147-.736v-2.287c-.774.39-1.662.628-2.789.628-1.107 0-2.082-.392-2.209-1.723h5.559c.013-.153.038-.748.038-1.023 0-2.908-1.408-5.203-4.105-5.203zm-.018 2.315c.697 0 1.437.537 1.437 1.815h-2.936c0-1.279.789-1.815 1.499-1.815zm-9.585 5.521c-.666 0-1.063-.24-1.339-.539l-.017-4.219c.296-.325.705-.563 1.356-.563 1.039 0 1.754 1.164 1.754 2.649 0 1.529-.704 2.672-1.754 2.672zm-42.04-.56c-.368 0-.737-.158-1.052-.473v-2.252c.315-.316.684-.474 1.052-.474.758 0 1.284.653 1.284 1.6 0 .947-.526 1.599-1.284 1.599zm-8.893 0c-.769 0-1.295-.652-1.295-1.599s.526-1.6 1.295-1.6c.368 0 .736.158 1.041.474v2.252c-.305.315-.673.473-1.041.473zm-5.757-3.315c.599 0 1.031.495 1.073 1.211h-2.294c.063-.726.568-1.211 1.221-1.211zm-9.557 0c.6 0 1.032.495 1.074 1.211h-2.295c.064-.726.569-1.211 1.221-1.211zm-14.156 3.347c-.789 0-1.336-.663-1.336-1.631s.547-1.631 1.336-1.631c.779 0 1.326.663 1.326 1.631s-.547 1.631-1.326 1.631zm-6.104-2.694H9.918V9.987h1.021c.779 0 1.326.495 1.326 1.231 0 .726-.547 1.221-1.326 1.221z"/></svg>
                        </div>
                        <div class="w-full mb-4">
                            <div class="h-1 mx-auto bg-white opacity-25 my-0 py-0 rounded-t"></div>
                        </div>

                        <p class="text-gray-400 text-base mt-4 text-left my-4">
                            You are about to purchase 1 month of subscription on Inkybot. <br>
                            After completing the purchase, you will be subscribed until <strong>{{ Auth::user()->ExtendedSubscriptionDate()->format('d/m/Y') }}</strong>.<br>
                            We thank you for your support!
                        </p>
                        <div class="w-full mb-4">
                            <div class="h-1 mx-auto bg-white opacity-25 my-0 py-0 rounded-t"></div>
                        </div>

                        <div class="flex justify-between mb-4 text-xl">
                            <p class="font-bold">Item:</p>
                            <p class="text-lg">1 month subscription</p>
                        </div>
                        <div class="flex justify-between my-4 text-xl">
                            <p class="font-bold">Price:</p>
                            <p class="text-lg">5.00 €</p>
                        </div>


                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                       id="name" name="name" type="text" placeholder="Name" required>
                            </div>
                            <div class="w-full md:w-1/2 pr-3">

                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                       id="email" name="email" type="email" placeholder="Email" value="{{ Auth::user()->email }}" required>
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

                        <div class="error" role="alert">
                            <p class="text-red-500 text italic message"></p>
                        </div>

                        <button class="mx-auto lg:mx-0 hover:underline font-bold rounded mt-2 py-4 px-8 shadow-lg cursor-pointer uppercase btn-color-secondary w-full"
                                type="submit">
                            Pay 5€
                        </button>


                        <div class="flex items-center">

                            <i class="fas fa-info-circle text-5xl px-4 py-3"></i>

                            <div>
                                <p class="text-gray-400 text-base mt-4 text-left">
                                    We do not support recurrent payments - you will have to renew your subscription manually each month.
                                </p>
                                <p class="text-gray-400 text-base text-left font-bold">
                                    Your payment information is not saved.
                                </p>
                            </div>
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
