@extends('layouts.admin')

@section('title', 'Repairs Management')

@section('content')
<div class="space-y-4">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">Repairs Management</h1>
        <a href="{{ route('admin.repairs.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Add New Repair</a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="text-blue-800 uppercase bg-blue-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium">ID</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Car</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Description</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Cost</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Repair Date</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Status</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($repairs as $repair)
                <tr>
                    <td class="px-4 py-2">{{ $repair->id }}</td>
                    <td class="px-4 py-2">{{ $repair->car->make }} {{ $repair->car->model }} ({{ $repair->car->year }})</td>
                    <td class="px-4 py-2">{{ $repair->description ?? '—' }}</td>
                    <td class="px-4 py-2">${{ number_format($repair->cost, 2) }}</td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($repair->repair_date)->format('Y-m-d') }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded text-sm
                            @if($repair->status == 'pending') bg-yellow-100 text-yellow-700
                            @elseif($repair->status == 'in_progress') bg-blue-100 text-blue-700
                            @elseif($repair->status == 'completed') bg-green-100 text-green-700
                            @elseif($repair->status == 'cancelled') bg-red-100 text-red-700
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $repair->status)) }}
                        </span>
                    </td>

                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('admin.repairs.show', $repair) }}" class="bg-gray-600 hover:bg-gray-700 text-white px-2 py-1 rounded text-sm">View</a>
                        <a href="{{ route('admin.repairs.edit', $repair) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded text-sm">Edit</a>
                        <form action="{{ route('admin.repairs.destroy', $repair) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this repair?')" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center px-4 py-6 text-gray-500">No repairs found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        @if(method_exists($repairs, 'links'))
        {{ $repairs->links() }}
        @endif
    </div>
</div>
@endsection