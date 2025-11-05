@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-screen flex">

    <!-- Left image section -->
    <div class="hidden md:block md:w-1/2">
        <img src="https://cdn1.epicgames.com/spt-assets/d27a2e7b36704160ab7b66cb4d82f839/japanese-drift-master-pn4dl.jpg"
            alt="Register Image" class="h-screen w-full object-cover">
    </div>

    <!-- Right form section -->
    <div class="w-full md:w-1/2 flex items-center justify-center bg-gray-50">
        <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-2xl">
            <h2 class="text-3xl font-bold text-gray-700 mb-6 text-center">Create Account</h2>

            @if ($errors->any())
            <div class="mb-4 text-red-600 text-center">
                {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('user.register') }}" method="POST" class="space-y-4" x-data="{ showPassword: false }">
                @csrf
                <div>
                    <label for="name" class="block text-gray-600 mb-1">Name</label>
                    <input type="text" name="name" id="name" required
                        class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="email" class="block text-gray-600 mb-1">Email</label>
                    <input type="email" name="email" id="email" required
                        class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="password" class="block text-gray-600 mb-1">Password</label>
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

                <div>
                    <label for="password_confirmation" class="block text-gray-600 mb-1">Confirm Password</label>
                    <div class="relative" x-data="{ showConfirm: false }">
                        <input :type="showConfirm ? 'text' : 'password'"
                            name="password_confirmation" id="password_confirmation" required
                            class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <button type="button" @click="showConfirm = !showConfirm"
                            class="absolute right-3 top-2.5 text-gray-500 focus:outline-none">
                            <svg x-show="!showConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="showConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.959 9.959 0 013.508-4.505m1.768-1.02A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.958 9.958 0 01-1.6 2.945M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                </div>


                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition duration-200">
                    Register
                </button>
            </form>

            <p class="mt-4 text-center text-gray-500 text-sm">
                Already have an account?
                <a href="{{ route('user.login') }}" class="text-indigo-600 hover:underline">Login</a>
            </p>
        </div>
    </div>
</div>
@endsection