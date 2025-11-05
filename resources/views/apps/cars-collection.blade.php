@extends('layouts.app')

@section('title', 'Our Cars - CarGarage')

@section('content')

{{-- Hero --}}
<section class="bg-gradient-to-r from-blue-100 to-white py-20 text-center">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Choose Your Ride</h1>
        <p class="text-gray-700 mb-6">Explore our collection of top-quality vehicles for every need and occasion.</p>
        <a href="#cars-collection" class="bg-blue-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-blue-700 transition">
            View Collection
        </a>
    </div>
</section>

{{-- Car Collection --}}
<section id="cars-collection" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($cars as $car)
            <a href="{{ route('show-detail', $car->id) }}" class="group block bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden h-full flex flex-col">

                {{-- Image with consistent aspect ratio --}}
                <div class="relative w-full aspect-w-4 aspect-h-3 overflow-hidden">
                    <img src="{{ $car->thumbnail 
                                ? (Str::startsWith($car->thumbnail, ['http://','https://']) 
                                    ? $car->thumbnail 
                                    : asset('storage/' . $car->thumbnail)) 
                                : asset('images/default-car.png') }}"
                        alt="{{ $car->make }} {{ $car->model }}"
                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">

                    @auth
                    <form action="{{ route('favourites.toggle', $car) }}" method="POST">
                        @csrf
                        <button type="submit" class="absolute top-3 right-3 p-2 rounded-full bg-white shadow hover:bg-red-100 transition">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 {{ auth()->user()->favourites->contains($car->id) ? 'text-red-500 fill-current' : 'text-gray-400' }}"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 010 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </form>
                    @endauth


                    {{-- Status Badge --}}
                    <span class="absolute top-3 left-3 px-3 py-1 text-sm rounded-full font-semibold
                        @if($car->status === 'available') bg-green-100 text-green-700
                        @elseif($car->status === 'rented') bg-yellow-100 text-yellow-800
                        @elseif($car->status === 'sold') bg-gray-100 text-gray-700
                        @else bg-red-100 text-red-700
                        @endif">
                        {{ ucfirst($car->status) }}
                    </span>
                </div>

                {{-- Card Info --}}
                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <h5 class="text-lg md:text-xl font-semibold mb-1">{{ $car->make }} {{ $car->model }}</h5>
                        <p class="text-gray-600 mb-2">
                            @if($car->car_type === 'rental')
                            ${{ $car->price_per_day }}/day
                            @else
                            ${{ $car->sale_price }}
                            @endif
                            · {{ $car->color ?? '-' }}
                        </p>
                        <div class="text-gray-500 text-sm grid grid-cols-2 gap-1">
                            <span><strong>Year:</strong> {{ $car->year }}</span>
                            <span><strong>Mileage:</strong> {{ $car->mileage ?? '-' }} km</span>
                            <span><strong>Type:</strong> {{ ucfirst($car->car_type) }}</span>
                        </div>
                    </div>

                    {{-- CTA Button --}}
                    <div class="mt-4">
                        <span class="inline-block bg-blue-600 text-white px-4 py-2 rounded-full font-semibold text-sm transition group-hover:bg-blue-700">
                            View Details &rarr;
                        </span>
                    </div>
                </div>
            </a>
            @empty
            <p class="col-span-4 text-center text-gray-500">No available cars at the moment.</p>
            @endforelse
        </div>
    </div>
</section>

@endsection