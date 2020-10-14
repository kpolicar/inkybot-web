<div id="notification" class="text-white pr-6 py-4 border-0 rounded-lg m-2 bg-black fixed bottom-0 w-auto z-10 opacity-75">
  <span class="text-xl inline-block mr-5 align-middle">
    <i class="fas fa-bell" />
  </span>
    <span class="inline-block align-middle mr-8 font-bold">
        {{ $message }}
        @if($action)
            <br>
            @include($action)
        @endif
  </span>
    <button id="notification-close" class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">
        <span>×</span>
    </button>
</div>

