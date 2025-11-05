@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-4">Settings</h1>
    <p class="text-gray-600 mb-6">Update admin settings and preferences.</p>

    <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="site_name" class="block text-gray-700 font-medium mb-2">Site Name</label>
            <input
                type="text"
                id="site_name"
                name="site_name"
                value="{{ old('site_name', $settings->site_name ?? '') }}"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="contact_email" class="block text-gray-700 font-medium mb-2">Contact Email</label>
            <input
                type="email"
                id="contact_email"
                name="contact_email"
                value="{{ old('contact_email', $settings->contact_email ?? '') }}"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <button
            type="submit"
            class="bg-blue-600 text-white font-semibold px-6 py-2 rounded-md hover:bg-blue-700 transition">
            Save Settings
        </button>
    </form>
</div>
@endsection