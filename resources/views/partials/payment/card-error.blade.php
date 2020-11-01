<div class="flex justify-between items-end my-4">
    <h3 class="text-3xl font-bold leading-tight align-middle">Payment failed: Card Error</h3>
    <i class="fas fa-times-circle text-5xl"></i>
</div>
<div class="w-full mb-4">
    <div class="h-1 mx-auto bg-white opacity-25 my-0 py-0 rounded-t"></div>
</div>
<p class="text-gray-400 text-base mt-4">
    An issue with your card has occurred while trying to process your request.
</p>

@if ($code = $exception->getDeclineCode())
<p class="text-gray-200 text-sm mt-5">
    <strong>Error code:</strong> <i>{{ $code }}</i>
</p>
@endif

@if ($message = $exception->getMessage())
<h4 class="text-gray-200 text-sm font-bold">
    Error message:
</h4>
<p class="text-gray-200 text-sm">
    {{ $message }}
</p>
@endif
