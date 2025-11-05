@extends('layouts.admin')

@section('title', 'Sale Details')

@section('content')
<div class="container mx-auto p-6 space-y-8">

    <div class="flex justify-between items-center">
        <h1 class="text-4xl font-bold">{{ $sale->car->make }} {{ $sale->car->model }}</h1>
        <div class="flex gap-3">
            <a href="{{ route('admin.sales.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-2 rounded-full font-semibold transition">Back</a>
            <a href="{{ route('admin.sales.edit', $sale) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-full font-semibold transition">Edit Sale</a>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-10">

        <div class="space-y-4">
            <p><span class="font-semibold">Car:</span> {{ $sale->car->make }} {{ $sale->car->model }} ({{ $sale->car->year }})</p>
            <p><span class="font-semibold">Buyer:</span> {{ $sale->buyer_name }}</p>
            <p><span class="font-semibold">Price:</span> ${{ number_format($sale->price, 2) }}</p>
            <p><span class="font-semibold">Sale Date:</span> {{ $sale->sale_date->format('Y-m-d') }}</p>
        </div>

        <div class="space-y-4">
            <p><span class="font-semibold">Car Details:</span></p>
            <p>Color: {{ $sale->car->color }}</p>
            <p>Mileage: {{ $sale->car->mileage }}</p>
            <p>Status: <span class="px-3 py-1 rounded-full text-sm font-semibold
                {{ $sale->car->status === 'available' ? 'bg-green-100 text-green-800' :
                   ($sale->car->status === 'rented' ? 'bg-yellow-100 text-yellow-800' :
                   ($sale->car->status === 'sold' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                    {{ ucfirst($sale->car->status) }}
                </span></p>
        </div>
    </div>

    {{-- Gallery --}}
    <div x-data="{ main: 0 }" class="space-y-4">
        <h2 class="text-2xl font-bold">Images</h2>

        <div class="rounded-xl shadow-lg overflow-hidden">
            <template x-for="(img, index) in {{ $sale->car->images->take(5)->toJson() }}" :key="index">
                <img x-show="main === index"
                    :src="img.image_path.startsWith('http') ? img.image_path : '{{ asset('storage') }}/' + img.image_path"
                    class="w-full h-80 object-contain rounded-xl transition-all duration-300">
            </template>
        </div>

        <div class="flex gap-3 mt-2 justify-center">
            <template x-for="(img, index) in {{ $sale->car->images->take(5)->toJson() }}" :key="index">
                <img @click="main = index"
                    :src="img.image_path.startsWith('http') ? img.image_path : '{{ asset('storage') }}/' + img.image_path"
                    class="w-20 h-20 object-contain rounded-lg cursor-pointer border-2"
                    :class="main === index ? 'border-yellow-500' : 'border-transparent'">
            </template>
        </div>
    </div>
</div>
@endsection