@extends('layouts.admin')

@section('title', 'Add New Customer')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded shadow p-6">
    <h1 class="text-xl font-bold mb-4">Add New Customer</h1>

    <form action="{{ route('admin.customers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name"
                class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                value="{{ old('name') }}">
            @error('name')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email"
                class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                value="{{ old('email') }}">
            @error('email')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" name="phone" id="phone"
                class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500 @error('phone') border-red-500 @enderror"
                value="{{ old('phone') }}">
            @error('phone')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="avatar" class="block text-sm font-medium text-gray-700">Avatar</label>
            <input type="file" name="avatar" id="avatar" accept="image/*"
                class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500 @error('avatar') border-red-500 @enderror">
            @if(isset($customer) && $customer->avatar)
            <img src="{{ asset('storage/'.$customer->avatar) }}" class="w-24 h-24 rounded-full mt-2" alt="Avatar">
            @endif
            @error('avatar')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex space-x-2">
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
                Save
            </button>
            <a href="{{ route('admin.customers.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection