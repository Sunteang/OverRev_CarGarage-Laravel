@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="min-h-screen bg-gray-50">

    <!-- Hero Banner -->
    <div class="relative h-56 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600">
        <div class="absolute inset-0 bg-black/30"></div>
    </div>

    <!-- Profile Card -->
    <div class="max-w-4xl mx-auto -mt-24 relative z-10">
        <div class="bg-white shadow-2xl rounded-2xl p-8">
            <div class="flex items-center space-x-6">
                <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('images/default-avatar.png') }}"
                    class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg transform hover:scale-105 transition duration-300">

                <div>
                    <h2 class="text-3xl font-extrabold text-gray-800">{{ $user->name }}</h2>
                    <p class="text-gray-500">{{ $user->email }}</p>
                </div>
            </div>

            <div x-data="{ tab: 'overview' }" class="mt-8">
                <!-- Tabs -->
                <div class="border-b flex space-x-8">
                    <button
                        :class="tab === 'overview' ? 'border-b-2 border-indigo-600 text-indigo-600 font-semibold' : 'text-gray-500 hover:text-gray-700'"
                        class="pb-2"
                        @click="tab = 'overview'">
                        Overview
                    </button>
                    <button
                        :class="tab === 'favourites' ? 'border-b-2 border-indigo-600 text-indigo-600 font-semibold' : 'text-gray-500 hover:text-gray-700'"
                        class="pb-2"
                        @click="tab = 'favourites'">
                        Favourites
                    </button>
                    <button
                        :class="tab === 'activity' ? 'border-b-2 border-indigo-600 text-indigo-600 font-semibold' : 'text-gray-500 hover:text-gray-700'"
                        class="pb-2"
                        @click="tab = 'activity'">
                        Activity
                    </button>
                </div>

                <!-- Tab Content -->
                <div class="mt-6">
                    <div x-show="tab === 'overview'">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Account Info</h3>
                        <div class="grid grid-cols-2 gap-6 text-gray-600">
                            <div>
                                <p class="font-semibold">Joined</p>
                                <p>{{ $user->created_at->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="font-semibold">Last Updated</p>
                                <p>{{ $user->updated_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <div x-show="tab === 'favourites'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @forelse(Auth::user()->favourites as $car)
                        <div class="group block bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden h-full flex flex-col">
                            <div class="relative w-full aspect-w-4 aspect-h-3 overflow-hidden">
                                <img src="{{ $car->thumbnail ? (Str::startsWith($car->thumbnail, ['http://','https://']) ? $car->thumbnail : asset('storage/' . $car->thumbnail)) : asset('images/default-car.png') }}"
                                    alt="{{ $car->make }} {{ $car->model }}"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                            </div>
                            <div class="p-4 flex-1 flex flex-col justify-between">
                                <div>
                                    <h5 class="text-lg md:text-xl font-semibold mb-1">{{ $car->make }} {{ $car->model }}</h5>
                                    <p class="text-gray-600 mb-2">
                                        @if($car->car_type === 'rental')
                                        ${{ $car->price_per_day }}/day
                                        @else
                                        ${{ $car->sale_price }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="col-span-4 text-center text-gray-500">No favourites yet.</p>
                        @endforelse
                    </div>

                    <div x-show="tab === 'activity'" class="text-gray-600">
                        <p>This is the activity tab. Show recent user actions here.</p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-10 flex flex-wrap gap-4">

                {{-- Admin-only button --}}
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}"
                    class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl shadow-md
                            hover:bg-emerald-700 hover:shadow-lg transition
                            transform hover:-translate-y-0.5 flex items-center gap-2">
                        Dashboard Admin
                    </a>
                @endif

                <a href="{{ route('profile.edit') }}"
                class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl shadow-md
                        hover:bg-indigo-700 hover:shadow-lg transition
                        transform hover:-translate-y-0.5">
                    Edit Profile
                </a>

                <form method="POST" action="{{ route('user.logout') }}">
                    @csrf
                    <button type="submit"
                        class="px-5 py-2.5 bg-red-500 text-white rounded-xl shadow-md
                            hover:bg-red-600 hover:shadow-lg transition
                            transform hover:-translate-y-0.5">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection