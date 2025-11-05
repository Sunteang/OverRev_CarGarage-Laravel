@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome -->
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Welcome, {{ $admin->username }}</h1>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-blue-600 text-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold">Total Cars</h3>
            <p class="text-3xl font-bold mt-2">{{ $totalCars }}</p>
        </div>
        <div class="bg-green-600 text-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold">Active Rentals</h3>
            <p class="text-3xl font-bold mt-2">{{ $activeRentals }}</p>
        </div>
        <div class="bg-yellow-500 text-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold">Total Sales</h3>
            <p class="text-3xl font-bold mt-2">{{ $totalSales }}</p>
        </div>
        <div class="bg-purple-600 text-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold">Customers</h3>
            <p class="text-3xl font-bold mt-2">{{ $totalCustomers }}</p>
        </div>
    </div>

    <!-- Recent Rentals -->
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold">Recent Rentals</h3>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Rental ID</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Customer</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Car</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Start Date</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">End Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($recentRentals as $rental)
                <tr>
                    <td class="px-4 py-2">{{ $rental->id }}</td>
                    <td class="px-4 py-2">{{ $rental->customer_name }}</td>
                    <td class="px-4 py-2">{{ $rental->car->make ?? '-' }} {{ $rental->car->model ?? '' }}</td>
                    <td class="px-4 py-2">{{ $rental->rent_date }}</td>
                    <td class="px-4 py-2">{{ $rental->return_date ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-2 text-center text-gray-500">No recent rentals.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Recent Sales -->
    <div class="bg-white rounded-lg shadow overflow-x-auto mt-6">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold">Recent Sales</h3>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Sale ID</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Buyer</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Car</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Price</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($recentSales as $sale)
                <tr>
                    <td class="px-4 py-2">{{ $sale->id }}</td>
                    <td class="px-4 py-2">{{ $sale->buyer_name }}</td>
                    <td class="px-4 py-2">{{ $sale->car->make ?? '-' }} {{ $sale->car->model ?? '' }}</td>
                    <td class="px-4 py-2">${{ number_format($sale->price, 2) }}</td>
                    <td class="px-4 py-2">{{ $sale->sale_date }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-2 text-center text-gray-500">No recent sales.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection