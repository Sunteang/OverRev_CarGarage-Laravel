@extends('layouts.app')

@section('title', 'About - CarGarage')

@section('content')

{{-- Hero Section --}}
<section class="bg-gradient-to-r from-blue-100 to-white py-20">
    <div class="container mx-auto flex flex-col lg:flex-row items-center justify-between px-4">
        <div class="lg:w-1/2 text-center lg:text-left">
            <h1 class="text-4xl md:text-5xl font-bold text-blue-600 mb-6">About CarRental</h1>
            <p class="text-gray-700 mb-6">
                Empowering your journeys with a modern fleet, unbeatable prices, and customer-first service.
                We're more than a rental — we’re your driving partner.
            </p>
            <a href="{{ route('cars-collection') }}" class="bg-blue-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-blue-700 transition">
                Browse Our Cars
            </a>
        </div>
        <div class="lg:w-1/2 mt-8 lg:mt-0">
            <img src="https://www.jdmbuysell.com/wp-content/uploads/2022/05/S13_jdmbuysell_Revision-2-1.png" alt="Car Collection" class="rounded-xl mx-auto">
        </div>
    </div>
</section>

{{-- Info Cards --}}
<section class="py-20 bg-gray-50">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 px-4">
        <div class="bg-white rounded-xl shadow p-8 text-center hover:shadow-lg transition">
            <div class="text-blue-600 text-4xl mb-4"><i class="fas fa-bullseye"></i></div>
            <h4 class="font-bold text-xl mb-2">Our Mission</h4>
            <p>To offer dependable, budget-friendly car rentals tailored for comfort, safety, and convenience — anytime, anywhere.</p>
        </div>
        <div class="bg-white rounded-xl shadow p-8 text-center hover:shadow-lg transition">
            <div class="text-blue-600 text-4xl mb-4"><i class="fas fa-star"></i></div>
            <h4 class="font-bold text-xl mb-2">Why Choose Us</h4>
            <p>Modern vehicles, transparent pricing, instant booking, and 24/7 support — everything you need in one place.</p>
        </div>
        <div class="bg-white rounded-xl shadow p-8 text-center hover:shadow-lg transition">
            <div class="text-blue-600 text-4xl mb-4"><i class="fas fa-handshake"></i></div>
            <h4 class="font-bold text-xl mb-2">Our Values</h4>
            <p>We believe in integrity, innovation, and an unwavering commitment to customer satisfaction at every turn.</p>
        </div>
    </div>
</section>

@endsection