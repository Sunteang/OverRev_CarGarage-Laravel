@extends('layouts.admin')

@section('title', 'Edit Car')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow space-y-6">
    <h2 class="text-2xl font-bold">Edit Car</h2>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.cars.update', $car->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Car Type -->
        <div>
            <label class="block font-medium text-gray-700">Car Type</label>
            <select name="car_type" id="car_type" class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2">
                <option value="rental" {{ old('car_type', $car->car_type) == 'rental' ? 'selected' : '' }}>Rental</option>
                <option value="sale" {{ old('car_type', $car->car_type) == 'sale' ? 'selected' : '' }}>Sale</option>
            </select>
        </div>

        <!-- Make -->
        <div>
            <label for="make" class="block font-medium text-gray-700">Make</label>
            <select name="make" id="make" class="mt-1 block w-full border-gray-300 shadow-sm px-4 py-2">
                <option value="">-- Select Make --</option>
                @php
                $makes = ['Toyota','Honda','Ford','BMW','Mercedes','Tesla','Audi','Nissan','Volkswagen'];
                @endphp
                @foreach($makes as $make)
                <option value="{{ $make }}" {{ old('make', $car->make) == $make ? 'selected' : '' }}>{{ $make }}</option>
                @endforeach
            </select>
            @error('make')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Model -->
        <div>
            <label for="model" class="block font-medium text-gray-700">Model</label>
            <input type="text" name="model" id="model" value="{{ old('model', $car->model) }}" placeholder="e.g. Corolla, Mustang"
                class="mt-1 block w-full border-gray-300 shadow-sm px-4 py-2">
            @error('model')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Year -->
        <div>
            <label for="year" class="block font-medium text-gray-700">Year</label>
            <input type="number" name="year" id="year" value="{{ old('year', $car->year) }}" placeholder="2023"
                class="mt-1 block w-full border-gray-300 shadow-sm px-4 py-2">
            @error('year')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Color -->
        <div>
            <label for="color" class="block font-medium text-gray-700">Color</label>
            <input type="text" name="color" id="color" value="{{ old('color', $car->color) }}" placeholder="Red, Blue, Black"
                class="mt-1 block w-full border-gray-300 shadow-sm px-4 py-2">
            @error('color')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Mileage -->
        <div>
            <label for="mileage" class="block font-medium text-gray-700">Mileage</label>
            <input type="number" name="mileage" id="mileage" value="{{ old('mileage', $car->mileage) }}" placeholder="e.g. 12000"
                class="mt-1 block w-full border-gray-300 shadow-sm px-4 py-2">
            @error('mileage')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Status -->
        <div>
            <label for="status" class="block font-medium text-gray-700">Status</label>
            <select name="status" id="status" class="mt-1 block w-full border-gray-300 shadow-sm px-4 py-2">
                <option value="">-- Select Status --</option>
                <option value="available" {{ old('status', $car->status) == 'available' ? 'selected' : '' }}>Available</option>
                <option value="rented" {{ old('status', $car->status) == 'rented' ? 'selected' : '' }}>Rented</option>
                <option value="sold" {{ old('status', $car->status) == 'sold' ? 'selected' : '' }}>Sold</option>
                <option value="maintenance" {{ old('status', $car->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>
            @error('status')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="3"
                class="mt-1 block w-full border-gray-300 shadow-sm px-4 py-2">{{ old('description', $car->description) }}</textarea>
            @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Rental Price -->
        <div id="rental_fields" class="{{ old('car_type', $car->car_type) == 'sale' ? 'hidden' : '' }}">
            <label for="price_per_day" class="block font-medium text-gray-700">Price per Day</label>
            <input type="number" step="0.01" name="price_per_day" value="{{ old('price_per_day', $car->price_per_day) }}"
                class="mt-1 block w-full border-gray-300 shadow-sm px-4 py-2">
            @error('price_per_day')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Sale Price -->
        <div id="sale_fields" class="{{ old('car_type', $car->car_type) != 'sale' ? 'hidden' : '' }}">
            <label for="sale_price" class="block font-medium text-gray-700">Sale Price</label>
            <input type="number" step="0.01" name="sale_price" value="{{ old('sale_price', $car->sale_price) }}"
                class="mt-1 block w-full border-gray-300 shadow-sm px-4 py-2">
            @error('sale_price')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Images -->
        <div>
            <label class="block font-medium text-gray-700">Car Images</label>
            <input type="file" name="images[]" accept="image/*" multiple class="mt-1 block w-full border-gray-300 shadow-sm px-4 py-2">
            @foreach ($car->images as $img)
            <div class="mt-2">
                <img src="{{ Str::startsWith($img->image_path, ['http://','https://']) ? $img->image_path : asset('storage/' . $img->image_path) }}"
                    alt="Car Image" class="h-24 object-cover shadow-sm border">
            </div>
            @endforeach
            @for ($i=0; $i<5; $i++)
                <input type="url" name="image_urls[]" placeholder="Or image URL" class="mt-1 block w-full border-gray-300 shadow-sm px-4 py-2">
                @endfor
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 shadow-sm">Update Car</button>
            <a href="{{ route('admin.cars.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 shadow-sm">Cancel</a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('car_type');
        const rentalFields = document.getElementById('rental_fields');
        const saleFields = document.getElementById('sale_fields');

        typeSelect.addEventListener('change', function() {
            if (this.value === 'rental') {
                rentalFields.classList.remove('hidden');
                saleFields.classList.add('hidden');
            } else {
                rentalFields.classList.add('hidden');
                saleFields.classList.remove('hidden');
            }
        });
    });
</script>
@endsection