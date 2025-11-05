@extends('layouts.admin')

@section('title', 'Edit Customer')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded shadow p-6">
    <h1 class="text-xl font-bold mb-4">Edit Customer</h1>

    <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name"
                class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                value="{{ old('name', $customer->name) }}">
            @error('name')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email"
                class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                value="{{ old('email', $customer->email) }}">
            @error('email')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" name="phone" id="phone"
                class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500 @error('phone') border-red-500 @enderror"
                value="{{ old('phone', $customer->phone) }}">
            @error('phone')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="avatar" class="block text-sm font-medium text-gray-700">Avatar</label>
            <input type="file" name="avatar" id="avatar" accept="image/*"
                class="mt-1 block w-full border-gray-300 rounded shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500 @error('avatar') border-red-500 @enderror">
            {{-- On create page, no customer exists yet, so don’t try to display image --}}
            @if($customer->avatar)
            <img src="{{ asset('storage/' . $customer->avatar) }}" class="w-24 h-24 rounded-full mt-2" alt="Current Avatar">
            @endif

            @error('avatar')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>


        <div class="flex space-x-2">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                Update
            </button>
            <a href="{{ route('admin.customers.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection