<aside id="download-notification" class="text-white pr-6 py-4 border-0 rounded-lg bg-black fixed bottom-0 left-0 right-0 top-0 mx-2 md:mx-auto m-auto text-center w-auto z-10 hidden" style="opacity: 0.85; height: fit-content; width: fit-content">
    <span class="inline-block align-middle mx-5 mr-8 font-bold">
        <i class="fas fa-key mr-3 mx-1 text-lg"></i>Your download has started. You will need to unzip the compressed file using the password <strong class="text-gray-500">"{{ $download_password }}"</strong>
  </span>
    <button id="download-notification-close" data-hide="#download-notification" class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">
        <span>×</span>
    </button>
</aside>
