@extends('layouts.hero')

@section('title', 'Login')


@section('content')
    <x-main-hero>
        <h2 class="uppercase tracking-loose w-full">Access your account</h2>
        <div class="flex justify-center lg:justify-between">
            <h1 class="my-4 text-3xl font-bold leading-tight">Sign-in</h1>
            <i class="fas fa-sign-in-alt text-4xl p-3"></i>
        </div>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto bg-white opacity-25 my-0 py-0 rounded-t"></div>
        </div>

        <form class="w-full" method="POST" action="{{ route('login') }}">
            @csrf
            <input type="hidden" name="remember" value="1">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-xs font-bold mb-2" for="grid-password">
                        Email
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('email') border-red-500 @enderror border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                           id="grid-email" name="email" type="email" placeholder="user@example.com">
                    @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-xs font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('password') border-red-500 @enderror border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                           id="password" name="password" type="password" placeholder="******">
                    @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <button class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded py-4 px-8 shadow-lg"
                    type="submit">
                Login
            </button>
        </form>

        <p class="mt-3 text-gray-400 text-base lg:text-left text-center">
            <a href="{{ route('password.request') }}" class="text-white font-bold">Forgot password?</a>
        </p>
    </x-main-hero>
@endsection


