@extends('layouts.app')

@section('title', $car->make . ' ' . $car->model)
@section('page-title', $car->make . ' ' . $car->model)

@section('content')
<div class="container mx-auto px-4 py-12">

    {{-- Back button --}}
    <div class="mb-6">
        <a href="{{ route('cars-collection') }}"
            class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-2 rounded-full font-semibold hover:bg-blue-700 transition">
            &larr; Back to Collection
        </a>
    </div>

    <div class="flex flex-col lg:flex-row gap-10">

        {{-- Left: Images --}}
        <div class="lg:w-1/2">
            @if($car->images->count() > 0)
            <div x-data="{ main: 0 }" class="space-y-4">
                {{-- Main Image --}}
                <div class="rounded-xl shadow-lg overflow-hidden">
                    <template x-for="(img, index) in {{ $car->images->take(5)->toJson() }}" :key="index">
                        <img x-show="main === index"
                            :src="img.image_path.startsWith('http') ? img.image_path : '{{ asset('storage') }}/' + img.image_path"
                            :alt="'{{ $car->make }} {{ $car->model }}'"
                            class="w-full h-96 object-cover rounded-xl shadow-lg transition-all duration-300">
                    </template>
                </div>

                {{-- Thumbnails --}}
                <div class="flex gap-3 mt-2 justify-center">
                    <template x-for="(img, index) in {{ $car->images->take(5)->toJson() }}" :key="index">
                        <img @click="main = index"
                            :src="img.image_path.startsWith('http') ? img.image_path : '{{ asset('storage') }}/' + img.image_path"
                            :alt="'{{ $car->make }} {{ $car->model }}'"
                            class="w-20 h-20 object-cover rounded-lg cursor-pointer border-2"
                            :class="main === index ? 'border-yellow-500' : 'border-transparent'">
                    </template>
                </div>
            </div>
            @else
            <img src="{{ asset('images/default-car.png') }}" alt="No image"
                class="rounded-xl shadow-lg w-full h-96 object-cover">
            @endif
        </div>


        {{-- Right: Details --}}
        <div class="lg:w-1/2 flex flex-col justify-between space-y-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-4xl font-bold text-gray-800">{{ $car->make }} {{ $car->model }}</h1>
                    @if($car->car_type === 'rental')
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">Rental</span>
                    @else
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">For Sale</span>
                    @endif
                </div>
                <p class="text-gray-600 mt-2">{{ $car->description ?? 'No description available.' }}</p>
            </div>

            <div class="grid grid-cols-2 gap-4 text-gray-700 text-lg">
                @if($car->car_type === 'rental')
                <p><span class="font-semibold">Price per Day:</span> ${{ $car->price_per_day }}</p>
                @else
                <p><span class="font-semibold">Sale Price:</span> ${{ $car->sale_price }}</p>
                @endif
                <p><span class="font-semibold">Color:</span> {{ $car->color ?? '-' }}</p>
                <p><span class="font-semibold">Year:</span> {{ $car->year }}</p>
                <p><span class="font-semibold">Mileage:</span> {{ $car->mileage ?? '-' }} km</p>
                <p><span class="font-semibold">Seats:</span> {{ $car->seats ?? '-' }}</p>
                <p><span class="font-semibold">Status:</span>
                    <span class="capitalize px-2 py-1 rounded-full text-sm
                        @if($car->status === 'available') bg-green-100 text-green-700
                        @elseif($car->status === 'rented') bg-yellow-100 text-yellow-800
                        @elseif($car->status === 'sold') bg-gray-100 text-gray-700
                        @else bg-red-100 text-red-700
                        @endif">
                        {{ $car->status }}
                    </span>
                </p>
            </div>

            <div class="mt-4 flex items-center gap-4">

                {{-- Book Now --}}
                <a href="#"
                    class="inline-block bg-yellow-500 text-black px-8 py-3 rounded-full font-semibold hover:bg-yellow-600 transition text-lg">
                    Book Now
                </a>

                {{-- Favourite Button --}}
                @auth
                <form action="{{ route('favourites.toggle', $car) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="p-3 rounded-full bg-white shadow hover:bg-red-100 transition flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 {{ auth()->user()->favourites->contains($car->id) ? 'text-red-500 fill-current' : 'text-gray-400' }}"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 010 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button>
                </form>
                @endauth

            </div>

        </div>

    </div>
</div>
@endsection