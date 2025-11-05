@extends('layouts.admin')

@section('title', 'Reports')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold">Reports</h1>
        <p class="text-gray-600">View summarized reports about cars, rentals, and revenue.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-blue-600 text-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold">Total Cars</h3>
            <p class="text-3xl font-bold mt-2">{{ $totalCars }}</p>
        </div>

        <div class="bg-green-600 text-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold">Total Rentals</h3>
            <p class="text-3xl font-bold mt-2">{{ $totalRentals }}</p>
        </div>
    </div>

    {{-- Placeholder for charts or tables --}}
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-500">Charts and detailed reports coming soon...</p>
    </div>
</div>
@endsection