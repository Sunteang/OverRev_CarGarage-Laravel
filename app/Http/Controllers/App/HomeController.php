<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        // Featured / Hero car
        $heroCar = Car::latest()->first();

        // Popular cars (top 4 by bookings or latest)
        $popularCars = Car::latest()->take(4)->get();

        // Latest 3 testimonials
        $testimonials = Testimonial::with('customer')->latest()->take(3)->get();

        return view('apps.home', compact('heroCar', 'popularCars', 'testimonials'));
    }
}
