@extends('layouts.admin')

@section('title', 'Cars Management')

@section('content')
<div class="space-y-4">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">Cars Management</h1>
        <a href="{{ route('admin.cars.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Add New Car</a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="text-blue-800 uppercase bg-blue-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium">ID</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Make</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Model</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Year</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Color</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Price</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Status</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($cars as $car)
                <tr>
                    <td class="px-4 py-2">{{ $car->id }}</td>
                    <td class="px-4 py-2">{{ $car->make }}</td>
                    <td class="px-4 py-2">{{ $car->model }}</td>
                    <td class="px-4 py-2">{{ $car->year }}</td>
                    <td class="px-4 py-2">{{ $car->color }}</td>
                    <td class="px-4 py-2">
                        @if($car->car_type === 'sale')
                        ${{ number_format($car->sale_price, 2) }} (Sale)
                        @else
                        ${{ number_format($car->price_per_day, 2) }}/day
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ ucfirst($car->status) }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('admin.cars.show', $car) }}" class="bg-gray-600 hover:bg-gray-700 text-white px-2 py-1 rounded text-sm">View</a>

                        <a href="{{ route('admin.cars.edit', $car) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded text-sm">Edit</a>

                        <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this car?');">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center px-4 py-6 text-gray-500">No cars found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        @if(method_exists($cars, 'links'))
        {{ $cars->links() }}
        @endif
    </div>
</div>
@endsection