@extends('layouts.app')

@section('title', 'Contact - CarGarage')

@section('content')

{{-- Contact Hero --}}
<section class="bg-gradient-to-r from-yellow-100 to-white py-20">
    <div class="container mx-auto flex flex-col lg:flex-row items-center justify-between px-4">
        <div class="lg:w-1/2 text-center lg:text-left">
            <h1 class="text-4xl md:text-5xl font-bold text-yellow-600 mb-6">Contact Us</h1>
            <p class="text-gray-700 mb-6">Have a question or need help? Get in touch with us and we’ll respond as soon as possible.</p>
        </div>
        <div class="lg:w-1/2 mt-8 lg:mt-0">
            <img src="https://www.pngmart.com/files/22/Honda-Jdm-PNG-HD.png" alt="Contact Image" class="rounded-xl mx-auto">
        </div>
    </div>
</section>

{{-- Contact Form --}}
<section class="py-16 bg-gray-50">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 px-4">
        <form action="#" method="POST" class="bg-white rounded-xl shadow p-8 space-y-4">
            @csrf
            <div>
                <label for="name" class="block font-semibold mb-1">Name</label>
                <input type="text" name="name" id="name" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
            </div>
            <div>
                <label for="email" class="block font-semibold mb-1">Email</label>
                <input type="email" name="email" id="email" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
            </div>
            <div>
                <label for="message" class="block font-semibold mb-1">Message</label>
                <textarea name="message" id="message" rows="5" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-yellow-400" required></textarea>
            </div>
            <button type="submit" class="bg-yellow-400 text-black px-6 py-3 rounded-full font-semibold hover:bg-yellow-500 transition">Send Message</button>
        </form>

        {{-- Contact Info --}}
        <div class="bg-white rounded-xl shadow p-8 space-y-4 flex flex-col justify-center">
            <h5 class="text-xl font-bold mb-4">Get in Touch</h5>
            <p><strong>Address:</strong> VengSreng Street, Phnom Penh</p>
            <p><strong>Email:</strong> info@cargarage.com</p>
            <p><strong>Phone:</strong> +1 (123) 456-7890</p>
            <div class="flex space-x-4 mt-4">
                <a href="#" class="text-blue-600 text-xl hover:text-yellow-500 transition"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-blue-600 text-xl hover:text-yellow-500 transition"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-blue-600 text-xl hover:text-yellow-500 transition"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</section>

@endsection