@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex">

    <!-- Left image section -->
    <div class="hidden md:block md:w-1/2">
        <img src="https://i.pinimg.com/736x/45/9f/01/459f017c3f8b518351c3a5eca3567d0e.jpg"
            alt="Login Image" class="h-screen w-full object-cover">
    </div>

    <!-- Right form section -->
    <div class="w-full md:w-1/2 flex items-center justify-center bg-gray-50">
        <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-2xl" x-data="{ showPassword: false }">
            <h1 class="text-3xl font-bold mb-6 text-center text-gray-700">Login</h1>

            @if ($errors->any())
            <div class="mb-4 text-red-600 text-center">
                {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('user.login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block mb-1 text-gray-600">Email</label>
                    <input type="email" name="email" id="email" required
                        class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="password" class="block mb-1 text-gray-600">Password</label>
                    <div class="relative">
                        <input :type="showPassword ? 'text' : 'password'" name="password" id="password" required
                            class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute right-3 top-2.5 text-gray-500 focus:outline-none">
                            <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.959 9.959 0 013.508-4.505m1.768-1.02A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.958 9.958 0 01-1.6 2.945M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition duration-200">
                    Login
                </button>
            </form>

            <p class="mt-4 text-center text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('user.register') }}" class="text-indigo-600 hover:underline">Register</a>
            </p>
        </div>
    </div>
</div>
@endsection