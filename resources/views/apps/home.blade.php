@extends('layouts.app')

@section('title', 'Home - CarGarage')

@section('content')

{{-- Hero Section --}}
<section class="bg-gradient-to-r from-blue-100 to-white py-20" x-data="heroCarousel()" x-init="init()">
    <div class="container mx-auto flex flex-col lg:flex-row items-center justify-between px-4">

        {{-- Left Text --}}
        <div class="lg:w-1/2 text-center lg:text-left">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Drive Your Dream Car</h1>
            <p class="text-gray-600 mb-6">Choose from a wide selection of vehicles at unbeatable prices. Fast booking, reliable service, and unmatched value.</p>
            <a href="{{ route('cars-collection') }}" class="bg-yellow-400 text-black font-semibold px-6 py-3 rounded-lg hover:bg-yellow-500 transition">Book Now</a>
        </div>

        {{-- Right Carousel Images --}}
        <div class="lg:w-1/2 mt-8 lg:mt-0 relative h-96">
            <template x-for="(car, index) in cars" :key="index">
                <img
                    :src="car.thumbnail"
                    :alt="car.make + ' ' + car.model"
                    x-show="currentIndex === index"
                    x-transition:enter="transition-opacity duration-1000"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity duration-1000"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="absolute top-0 left-0 w-full h-full object-cover rounded-lg shadow-lg">
            </template>
        </div>

    </div>
</section>

<script>
    function heroCarousel() {
        return {
            currentIndex: 0,
            cars: [{
                    make: 'Nissan',
                    model: 'GT-R R34',
                    thumbnail: 'https://wallpapercrafter.com/desktop/132728-Nissan-Skyline-GT-R-R34-Nissan-Skyline-Nissan-Japanese-cars-JDM-car-vehicle-white-cars-sports-car-corrugated-iron-outdoors.jpg'
                },
                {
                    make: 'Toyota',
                    model: 'Supra MK4',
                    thumbnail: 'https://www.hdwallpapers.in/download/toyota_supra_tan_mk4_jdm_hd_jdm-HD.jpg'
                },
                {
                    make: 'Mazda',
                    model: 'RX-7 FD',
                    thumbnail: 'https://s3.us-east-2.amazonaws.com/prod.mm.com/cache/9a/83/9a83ab6ba654abbce40c6c702cee9d68.jpg'
                },
                {
                    make: 'Mitsubishi',
                    model: 'Lancer Evolution VI',
                    thumbnail: 'https://wallup.net/wp-content/uploads/2016/03/12/170538-Mitsubishi_Lancer_Evolution_IX-Mitsubishi_Lancer-JDM.jpg'
                }
            ],
            next() {
                this.currentIndex = (this.currentIndex + 1) % this.cars.length;
            },
            prev() {
                this.currentIndex = (this.currentIndex - 1 + this.cars.length) % this.cars.length;
            },
            init() {
                setInterval(() => {
                    this.next()
                }, 5000); // auto-switch every 5 seconds
            }
        }
    }
</script>


{{-- Features Section --}}
<section class="py-20 bg-gray-50 text-center">
    <h2 class="text-3xl font-bold mb-12">Why Choose Us?</h2>
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 px-4">
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
            <i class="fas fa-car text-4xl text-indigo-600 mb-4"></i>
            <h3 class="font-semibold text-xl mb-2">Wide Vehicle Range</h3>
            <p class="text-gray-600">From economy to luxury – we have something for every journey.</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
            <i class="fas fa-clock text-4xl text-indigo-600 mb-4"></i>
            <h3 class="font-semibold text-xl mb-2">24/7 Service</h3>
            <p class="text-gray-600">Our support team is always ready to assist you – day or night.</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
            <i class="fas fa-thumbs-up text-4xl text-indigo-600 mb-4"></i>
            <h3 class="font-semibold text-xl mb-2">Trusted by Thousands</h3>
            <p class="text-gray-600">We’ve served thousands of happy customers with top-rated service.</p>
        </div>
    </div>
</section>

{{-- Testimonials --}}
<section class="py-20 bg-gray-100 text-center">
    <h2 class="text-3xl font-bold mb-12">What Our Customers Say</h2>
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 px-4">
        @forelse($testimonials as $testimonial)
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
            <img src="{{ $testimonial->avatar 
          ? asset('storage/'.$testimonial->avatar) 
          : 'https://via.placeholder.com/150' }}"
                class="w-24 h-24 mx-auto rounded-full mb-4"
                alt="{{ $testimonial->customer->name }}">
            <p class="italic text-gray-700 mb-2">"{{ $testimonial->message }}"</p>
            <span class="text-gray-500">- {{ $testimonial->customer->name }}</span>
        </div>
        @empty
        <p class="col-span-3 text-gray-500">No testimonials yet.</p>
        @endforelse

    </div>
    <h3 class="text-2xl font-bold mb-6">Leave a Testimonial</h3>

    <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto space-y-4">
        @csrf

        <div>
            <textarea name="message" rows="4" placeholder="Write your testimonial..."
                class="w-full border rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                required>{{ old('message') }}</textarea>
            @error('message')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
            Submit
        </button>
    </form>
</section>

{{-- Popular Rental Deals --}}
<section class="py-20 text-center">
    <h2 class="text-3xl font-bold mb-12">Most Popular Car Rental Deals</h2>
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-6 px-4">
        @forelse($popularCars as $car)
        <div class="bg-white rounded-lg shadow hover:shadow-lg transition flex flex-col">
            <img src="{{ $car->thumbnail
                        ? (Str::startsWith($car->thumbnail, ['http://','https://']) 
                            ? $car->thumbnail 
                            : asset('storage/' . $car->thumbnail))
                        : asset('images/default-car.png') }}"
                class="rounded-t-lg object-cover h-48 w-full"
                alt="{{ $car->make }} {{ $car->model }}">
            <div class="p-4 flex-1 flex flex-col justify-between">
                <div>
                    <h5 class="font-semibold text-lg">{{ $car->make }} {{ $car->model }}</h5>
                    <p class="text-gray-600">
                        @if($car->car_type === 'rental')
                        ${{ $car->price_per_day }}/day
                        @else
                        ${{ $car->sale_price }}
                        @endif
                    </p>
                </div>
                <a href="{{ route('show-detail', $car->id) }}"
                    class="mt-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                    Check Details &rarr;
                </a>
            </div>
        </div>
        @empty
        <p class="col-span-4 text-gray-500">No cars available at the moment.</p>
        @endforelse
    </div>
    <a href="{{ route('cars-collection') }}" class="mt-6 inline-block bg-gray-200 px-6 py-2 rounded hover:bg-gray-300 transition">Show All Vehicles</a>
</section>

{{-- App Download Section --}}
<section class="py-20 bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
    <div class="container mx-auto flex flex-col lg:flex-row items-center justify-between px-4">
        <div class="lg:w-1/2 text-center lg:text-left mb-8 lg:mb-0">
            <h2 class="text-3xl font-bold mb-4">Download Carrental App for Free</h2>
            <p class="mb-6">Find your dream car, book it, and enjoy your ride!</p>
            <div class="flex justify-center lg:justify-start space-x-4">
                <a href="#" class="bg-white text-indigo-600 font-semibold px-4 py-2 rounded hover:bg-gray-100 transition">App Store</a>
                <a href="#" class="bg-white text-indigo-600 font-semibold px-4 py-2 rounded hover:bg-gray-100 transition">Google Play</a>
            </div>
        </div>
        <div class="lg:w-1/2">
            <img src="https://www.jdmbuysell.com/wp-content/uploads/2022/05/S13_jdmbuysell_Revision-2-1.png" class="mx-auto" alt="App Preview">
        </div>
    </div>
</section>

@endsection