<form action="{{ route('verification.send') }}" method="POST">
    @csrf
    <button type="submit" class="cursor-pointer bg-gray-900 px-4 rounded text-sm">
        {{ __('forms.quick_verify_action') }}
    </button>
</form>
