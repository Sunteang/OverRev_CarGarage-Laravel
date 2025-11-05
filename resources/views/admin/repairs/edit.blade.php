@extends('layouts.admin')

@section('title', 'Edit Repair')

@section('content')
<div class="bg-white p-6 rounded shadow space-y-6">
    <h2 class="text-2xl font-bold">Edit Repair: {{ $repair->car->make }} {{ $repair->car->model }}</h2>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 px-4 py-2 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.repairs.update', $repair) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium text-gray-700">Car</label>
            <select name="car_id" class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2">
                @foreach($cars as $car)
                <option value="{{ $car->id }}" {{ old('car_id', $repair->car_id) == $car->id ? 'selected' : '' }}>
                    {{ $car->make }} {{ $car->model }} ({{ $car->year }})
                </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium text-gray-700">Description</label>
            <textarea name="description" class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2">{{ old('description', $repair->description) }}</textarea>
        </div>

        <div>
            <label class="block font-medium text-gray-700">Cost</label>
            <input type="number" step="0.01" name="cost" value="{{ old('cost', $repair->cost) }}" class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2">
        </div>

        <div>
            <label class="block font-medium text-gray-700">Repair Date</label>
            <input type="date" name="repair_date" value="{{ old('repair_date', \Carbon\Carbon::parse($repair->repair_date)->format('Y-m-d')) }}" class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2">
        </div>

        <div>
            <label class="block font-medium text-gray-700">Status</label>
            <select name="status" class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2">
                <option value="pending" {{ old('status', $repair->status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ old('status', $repair->status ?? '') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ old('status', $repair->status ?? '') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ old('status', $repair->status ?? '') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Update Repair</button>
            <a href="{{ route('admin.repairs.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection