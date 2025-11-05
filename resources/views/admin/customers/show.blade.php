@extends('layouts.admin')

@section('title', 'Customer Details')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-lg space-y-6">

    <!-- Header -->
    <div class="flex justify-between items-center border-b pb-4">
        <h2 class="text-3xl font-bold text-gray-800">{{ $customer->name }}</h2>
        <div class="space-x-2">
            <a href="{{ route('admin.customers.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg shadow-sm font-medium">
                Back
            </a>
            <a href="{{ route('admin.customers.edit', $customer) }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm font-medium">
                Edit Customer
            </a>
        </div>
    </div>

    <!-- Customer Info -->
    <div class="grid md:grid-cols-2 gap-6">
        <div class="space-y-4">
            <p><span class="font-semibold text-gray-700">Name:</span> {{ $customer->name }}</p>
            <p><span class="font-semibold text-gray-700">Email:</span> {{ $customer->email }}</p>
            <p><span class="font-semibold text-gray-700">Phone:</span> {{ $customer->phone ?? '-' }}</p>
            <p><span class="font-semibold text-gray-700">Address:</span> {{ $customer->address ?? '-' }}</p>
            <p><span class="font-semibold text-gray-700">Registered At:</span> {{ $customer->created_at->format('Y-m-d') }}</p>
        </div>

        <div class="flex flex-col items-center">
            <p class="font-semibold text-gray-700 mb-2">Avatar</p>
            @if($customer->avatar)
            <img src="{{ asset('storage/' . $customer->avatar) }}"
                alt="Avatar"
                class="w-48 h-48 rounded-full object-cover shadow-lg">
            @else
            <div class="w-48 h-48 flex items-center justify-center bg-gray-100 rounded-full shadow-lg text-gray-400">
                No Avatar
            </div>
            @endif
        </div>
    </div>

    <!-- Customer Testimonials (if any) -->
    @if($customer->testimonials->count() > 0)
    <div>
        <h3 class="font-bold text-lg mb-4">Testimonials</h3>
        <div class="space-y-3">
            @foreach($customer->testimonials as $testimonial)
            <div class="bg-gray-50 p-4 rounded-lg border">
                <p class="text-gray-700">{{ $testimonial->content }}</p>
                <p class="text-sm text-gray-500 mt-1">Posted on {{ $testimonial->created_at->format('Y-m-d') }}</p>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection