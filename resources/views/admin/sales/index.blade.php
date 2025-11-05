@extends('layouts.admin')

@section('title', 'Sales Management')

@section('content')
<div class="space-y-4">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">Sales Management</h1>
        <a href="{{ route('admin.sales.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Add New Sale</a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="text-blue-800 uppercase bg-blue-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium">ID</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Car</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Buyer</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Price</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Sale Date</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($sales as $sale)
                <tr>
                    <td class="px-4 py-2">{{ $sale->id }}</td>
                    <td class="px-4 py-2">{{ $sale->car->make }} {{ $sale->car->model }}</td>
                    <td class="px-4 py-2">{{ $sale->buyer_name }}</td>
                    <td class="px-4 py-2">${{ number_format($sale->price, 2) }}</td>
                    <td class="px-4 py-2">{{ $sale->sale_date->format('Y-m-d') }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('admin.sales.show', $sale) }}" class="bg-gray-600 hover:bg-gray-700 text-white px-2 py-1 rounded text-sm">View</a>
                        <a href="{{ route('admin.sales.edit', $sale) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded text-sm">Edit</a>
                        <form action="{{ route('admin.sales.destroy', $sale) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this sale?')" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center px-4 py-6 text-gray-500">No sales found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        @if(method_exists($sales, 'links'))
        {{ $sales->links() }}
        @endif
    </div>
</div>
@endsection