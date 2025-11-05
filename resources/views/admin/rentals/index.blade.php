@extends('layouts.admin')

@section('title', 'Rentals Management')

@section('content')
<div class="space-y-4">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">Rentals Management</h1>
        <a href="{{ route('admin.rentals.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Add New Rental</a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="text-blue-800 uppercase bg-blue-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium">ID</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Car</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Customer</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Rent Date</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Return Date</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Price</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($rentals as $rental)
                <tr>
                    <td class="px-4 py-2">{{ $rental->id }}</td>
                    <td class="px-4 py-2">{{ $rental->car->make }} {{ $rental->car->model }}</td>
                    <td class="px-4 py-2">{{ $rental->customer_name }}</td>
                    <td class="px-4 py-2">{{ $rental->rent_date->format('Y-m-d') }}</td>
                    <td class="px-4 py-2">{{ $rental->return_date?->format('Y-m-d') ?? '-' }}</td>
                    <td class="px-4 py-2">${{ number_format($rental->price, 2) }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('admin.rentals.show', $rental) }}" class="bg-gray-600 hover:bg-gray-700 text-white px-2 py-1 rounded text-sm">View</a>
                        <a href="{{ route('admin.rentals.edit', $rental) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded text-sm">Edit</a>
                        <form action="{{ route('admin.rentals.destroy', $rental) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this rental?')" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center px-4 py-6 text-gray-500">No rentals found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        @if(method_exists($rentals, 'links'))
        {{ $rentals->links() }}
        @endif
    </div>
</div>
@endsection