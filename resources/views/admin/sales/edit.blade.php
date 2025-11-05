@extends('layouts.admin')

@section('title', 'Edit Sale')

@section('content')
<div class="bg-white p-6 rounded shadow space-y-6">
    <h2 class="text-2xl font-bold">Edit Sale: {{ $sale->car->make }} {{ $sale->car->model }}</h2>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 px-4 py-2 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.sales.update', $sale) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium text-gray-700">Car</label>
            <select name="car_id" class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2">
                @foreach($cars as $car)
                <option value="{{ $car->id }}" {{ old('car_id', $sale->car_id) == $car->id ? 'selected' : '' }}>
                    {{ $car->make }} {{ $car->model }} ({{ $car->year }})
                </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium text-gray-700">Buyer Name</label>
            <input type="text" name="buyer_name" value="{{ old('buyer_name', $sale->buyer_name) }}" class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2">
        </div>

        <div>
            <label class="block font-medium text-gray-700">Price</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $sale->price) }}" class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2">
        </div>

        <div>
            <label class="block font-medium text-gray-700">Sale Date</label>
            <input type="date" name="sale_date" value="{{ old('sale_date', $sale->sale_date->format('Y-m-d')) }}" class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2">
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Update Sale</button>
            <a href="{{ route('admin.sales.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection