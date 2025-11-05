<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('apps.cars-collection', compact('cars'));
    }

    public function show($id)
    {
        $car = Car::findOrFail($id);
        return view('apps.show-detail', compact('car'));
    }
}
