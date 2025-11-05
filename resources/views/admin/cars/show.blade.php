@extends('layouts.admin')

@section('title', 'Car Details')

@section('content')
<div class="container mx-auto p-6 space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center">
        <h1 class="text-4xl font-bold text-gray-800">{{ $car->make }} {{ $car->model }}</h1>
        <div class="flex gap-3">
            <a href="{{ route('admin.cars.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-2 rounded-full font-semibold transition">Back</a>
            <a href="{{ route('admin.cars.edit', $car) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-full font-semibold transition">Edit Car</a>
        </div>
    </div>

    {{-- Main Info & Description --}}
    <div class="grid lg:grid-cols-2 gap-10">

        {{-- Left: Info --}}
        <div class="space-y-4">
            <p><span class="font-semibold">Make:</span> {{ $car->make }}</p>
            <p><span class="font-semibold">Model:</span> {{ $car->model }}</p>
            <p><span class="font-semibold">Year:</span> {{ $car->year }}</p>
            <p><span class="font-semibold">Color:</span> {{ $car->color ?? '-' }}</p>
            <p><span class="font-semibold">Mileage:</span> {{ $car->mileage ?? '-' }} km</p>
            <p>
                <span class="font-semibold">Status:</span>
                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ 
                    $car->status === 'available' ? 'bg-green-100 text-green-800' :
                    ($car->status === 'rented' ? 'bg-yellow-100 text-yellow-800' :
                    ($car->status === 'sold' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                    {{ ucfirst($car->status) }}
                </span>
            </p>
            <p>
                <span class="font-semibold">Type:</span>
                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $car->car_type === 'sale' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                    {{ ucfirst($car->car_type) }}
                </span>
            </p>
            @if($car->car_type === 'sale')
            <p><span class="font-semibold">Sale Price:</span> ${{ number_format($car->sale_price, 2) }}</p>
            @else
            <p><span class="font-semibold">Price per Day:</span> ${{ number_format($car->price_per_day, 2) }}</p>
            @endif
        </div>

        {{-- Right: Description --}}
        <div>
            <p class="font-semibold mb-2">Description</p>
            <p class="bg-gray-50 p-4 rounded-xl border">{{ $car->description ?? 'No description available.' }}</p>
        </div>
    </div>

    {{-- Image Gallery --}}
    <div x-data="{ main: 0 }" class="space-y-4">
        <h2 class="text-2xl font-bold">Images</h2>

        <div class="rounded-xl shadow-lg overflow-hidden">
            <template x-for="(img, index) in {{ $car->images->take(5)->toJson() }}" :key="index">
                <img x-show="main === index"
                    :src="img.image_path.startsWith('http') ? img.image_path : '{{ asset('storage') }}/' + img.image_path"
                    class="w-full h-96 object-contain rounded-xl transition-all duration-300">
            </template>
        </div>

        <div class="flex gap-3 mt-2 justify-center">
            <template x-for="(img, index) in {{ $car->images->take(5)->toJson() }}" :key="index">
                <img @click="main = index"
                    :src="img.image_path.startsWith('http') ? img.image_path : '{{ asset('storage') }}/' + img.image_path"
                    class="w-20 h-20 object-contain rounded-lg cursor-pointer border-2"
                    :class="main === index ? 'border-yellow-500' : 'border-transparent'">
            </template>
        </div>
    </div>
</div>
@endsection