@extends('layouts.admin')

@section('title', 'Customers')

@section('content')
<div class="space-y-4">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold">Customers</h1>
        </div>
        <a href="{{ route('admin.customers.create') }}"
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
            Add New Customer
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="text-blue-800 uppercase bg-blue-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium">ID</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Name</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Email</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Phone</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Registered At</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($customers as $customer)
                <tr>
                    <td class="px-4 py-2">{{ $customer->id }}</td>
                    <td class="px-4 py-2">{{ $customer->name }}</td>
                    <td class="px-4 py-2">{{ $customer->email }}</td>
                    <td class="px-4 py-2">{{ $customer->phone }}</td>
                    <td class="px-4 py-2">{{ $customer->created_at->format('Y-m-d') }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('admin.customers.show', $customer) }}"
                            class="bg-gray-600 hover:bg-gray-700 text-white px-2 py-1 rounded text-sm shadow">
                            View
                            <a href="{{ route('admin.customers.edit', $customer) }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded text-sm shadow">
                                Edit
                            </a>
                            <form action="{{ route('admin.customers.destroy', $customer) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete this customer?')"
                                    class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-sm shadow">
                                    Delete
                                </button>
                            </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center px-4 py-6 text-gray-500">No customers found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        @if(method_exists($customers, 'links'))
        {{ $customers->links() }}
        @endif
    </div>
</div>
@endsection