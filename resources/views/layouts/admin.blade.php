<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CarGarage Admin')</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="icon" href="https://png.pngtree.com/png-vector/20250117/ourmid/pngtree-gtr-drifting-car-jdm-modification-illustration-cars-simple-backgrounds-japanese-vector-png-image_15230219.png" type="image/png">
    @vite('resources/css/app.css')
</head>

@if (session('success'))
<div
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 5000)"
    class="fixed top-4 right-4 bg-green-600 text-white px-4 py-3 rounded shadow-lg transition ease-in-out duration-500 z-9999"
    x-transition:enter="transform ease-out duration-300 transition"
    x-transition:enter-start="translate-y-[-20px] opacity-0"
    x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transform ease-in duration-300 transition"
    x-transition:leave-start="translate-y-0 opacity-100"
    x-transition:leave-end="translate-y-[-20px] opacity-0">
    {{ session('success') }}
</div>
@endif

<body class="flex h-screen bg-gray-50 font-sans text-gray-800">

    @include('partials.admin.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- HEADER -->
        <header class="flex items-center justify-between bg-white shadow px-6 py-4">

            <!-- Search Bar -->
            <div class="flex-1 mx-6">
                <input
                    type="text"
                    placeholder="Search..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- User Menu -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <img src="{{ Auth::user()->avatar ?? 'https://toyotires.s3-ap-southeast-2.amazonaws.com/public/Images/blog/Thunderbolt.jpg' }}" alt="User Avatar" class="w-10 h-10 rounded-full">
                    <span class="hidden sm:block text-gray-700">{{ Auth::user()->name ?? 'Admin' }}</span>
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md overflow-hidden z-10">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-red-500 hover:bg-red-100">Logout</button>
                    </form>
                </div>
            </div>
        </header>

        <!-- MAIN CONTENT -->
        <main class="flex-1 overflow-auto p-6">
            @yield('content')
        </main>
    </div>

    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>