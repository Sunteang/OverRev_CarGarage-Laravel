@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="min-h-screen bg-gray-100">

    <!-- Hero Banner -->
    <div class="relative h-40 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600">
        <div class="absolute inset-0 bg-black/30"></div>
    </div>

    <!-- Profile Card -->
    <div class="max-w-4xl mx-auto -mt-24 relative z-10 grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Profile Info -->
        <div class="bg-white shadow-2xl rounded-2xl p-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Profile</h2>

            <!-- Success/Error Messages -->
            @if(session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
            <div class="mb-4 text-red-600">{{ $errors->first() }}</div>
            @endif

            <!-- Update Profile Form -->
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="flex items-center space-x-4">
                    <div>
                        <label class="block mb-1">Avatar</label>
                        <input type="file" name="avatar" accept="image/*" class="w-full">
                    </div>
                    <div>
                        <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : 'https://toyotires.s3-ap-southeast-2.amazonaws.com/public/Images/blog/Thunderbolt.jpg' }}"
                            class="w-20 h-17 rounded-full object-cover border-3 border-indigo-500 shadow-lg">
                    </div>
                </div>

                <div>
                    <label class="block mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                    Save Changes
                </button>
            </form>
        </div>

        <!-- Change Password -->
        <div class="bg-white shadow-2xl rounded-2xl p-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Change Password</h2>

            <form action="{{ route('profile.password') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block mb-1">Current Password</label>
                    <input type="password" name="current_password" required
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <div>
                    <label class="block mb-1">New Password</label>
                    <input type="password" name="password" required
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <div>
                    <label class="block mb-1">Confirm New Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <button type="submit"
                    class="w-full bg-yellow-500 text-white py-2 rounded-lg hover:bg-yellow-600 transition">
                    Update Password
                </button>
            </form>
        </div>
    </div>
</div>
@endsection