<nav class="bg-white shadow fixed w-full z-50">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ route('home') }}" class="flex items-center space-x-2 font-bold text-xl text-indigo-600">
            <img src="https://png.pngtree.com/png-vector/20250117/ourmid/pngtree-gtr-drifting-car-jdm-modification-illustration-cars-simple-backgrounds-japanese-vector-png-image_15230219.png" class="w-8" alt="Logo">
            CarGarage
        </a>

        <div class="hidden md:flex items-center space-x-6">
            <a href="{{ route('home') }}" class="hover:text-indigo-600 {{ Request::is('/') ? 'text-indigo-600 font-semibold' : '' }}">Home</a>
            <a href="{{ route('cars-collection') }}" class="hover:text-indigo-600 {{ Request::is('cars-collection') ? 'text-indigo-600 font-semibold' : '' }}">Cars</a>
            <a href="{{ route('about') }}" class="hover:text-indigo-600 {{ Request::is('about') ? 'text-indigo-600 font-semibold' : '' }}">About</a>
            <a href="{{ route('contact') }}" class="hover:text-indigo-600 {{ Request::is('contact') ? 'text-indigo-600 font-semibold' : '' }}">Contact</a>

            <div class="ml-4 relative" x-data="{ open: false }">
                @auth
                <!-- Profile Button for logged-in users -->
                <button @click="open = true" class="w-10 h-10 rounded-full overflow-hidden border-2 border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <img class="w-full h-full object-cover"
                        src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://toyotires.s3-ap-southeast-2.amazonaws.com/public/Images/blog/Thunderbolt.jpg' }}"
                        alt="{{ Auth::user()->name }}">

                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md overflow-hidden z-10">
                    <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                    <form method="POST" action="{{ route('user.logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-red-500 hover:bg-red-100">Logout</button>
                    </form>
                </div>
                @endauth

                @guest
                <!-- Guest Button: Login / Signup -->
                <a href="{{ route('user.login') }}" class="text-indigo-600 font-semibold">Login</a>
                @endguest
            </div>

        </div>

        <button class="md:hidden" id="mobile-menu-button">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <div class="md:hidden hidden px-4 pb-4" id="mobile-menu">
        <a href="{{ route('home') }}" class="block py-2 {{ Request::is('/') ? 'text-indigo-600 font-semibold' : '' }}">Home</a>
        <a href="{{ route('cars-collection') }}" class="block py-2 {{ Request::is('cars-collection') ? 'text-indigo-600 font-semibold' : '' }}">Cars</a>
        <a href="{{ route('about') }}" class="block py-2 {{ Request::is('about') ? 'text-indigo-600 font-semibold' : '' }}">About</a>
        <a href="{{ route('contact') }}" class="block py-2 {{ Request::is('contact') ? 'text-indigo-600 font-semibold' : '' }}">Contact</a>
    </div>
</nav>