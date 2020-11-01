<div class="flex justify-between items-end my-4">
    <h3 class="text-3xl font-bold leading-tight align-middle">Incomplete payment</h3>
    <i class="fas fa-exclamation-circle text-5xl"></i>
</div>
<div class="w-full mb-4">
    <div class="h-1 mx-auto bg-white opacity-25 my-0 py-0 rounded-t"></div>
</div>
<p class="text-gray-400 text-base mt-4">
    Your subscription has not yet been processed due to incomplete payment. If you have been prompted for 3D Secure 2
    authentication, please complete the process.
</p>
<p class="text-gray-200 text-sm mt-5">
    <strong>Status:</strong> <i>{{ $exception->payment->status }}</i>
</p>

@if ($message = $exception->getMessage())
<h4 class="text-gray-200 text-sm font-bold">
    Message:
</h4>
<p class="text-gray-200 text-sm">
    {{ $message }}
</p>
@endif
