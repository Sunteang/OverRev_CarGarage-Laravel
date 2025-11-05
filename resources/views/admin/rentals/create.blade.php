@extends('layouts.admin')

@section('title', 'Add Rental')

@section('content')
<div class="bg-white p-6 rounded shadow space-y-6">
    <h2 class="text-2xl font-bold">Add New Rental</h2>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 px-4 py-2 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.rentals.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium text-gray-700">Car</label>
            <select name="car_id" class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2">
                <option value="">-- Select Car --</option>
                @foreach($cars as $car)
                <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>
                    {{ $car->make }} {{ $car->model }} ({{ $car->year }})
                </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium text-gray-700">Customer Name</label>
            <input type="text" name="customer_name" value="{{ old('customer_name') }}" class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2">
        </div>

        <div>
            <label class="block font-medium text-gray-700">Rent Date</label>
            <input type="date" name="rent_date" value="{{ old('rent_date') }}" class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2">
        </div>

        <div>
            <label class="block font-medium text-gray-700">Return Date</label>
            <input type="date" name="return_date" value="{{ old('return_date') }}" class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2">
        </div>

        <div>
            <label class="block font-medium text-gray-700">Price</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2">
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Add Rental</button>
            <a href="{{ route('admin.rentals.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection