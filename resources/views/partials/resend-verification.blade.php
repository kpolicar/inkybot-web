<form action="{{ route('verification.send') }}" method="POST">
    @csrf
    <input type="submit" value="Resend" class="cursor-pointer bg-gray-900 px-4 rounded text-sm" />
</form>
