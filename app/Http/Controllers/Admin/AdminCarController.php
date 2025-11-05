<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\CarImage;
use Illuminate\Support\Facades\Storage;

class AdminCarController extends Controller
{
    // List cars for Blade dashboard
    public function index()
    {
        $cars = Car::paginate(10); // paginate for table
        return view('admin.cars.index', compact('cars'));
    }

    // Show create form
    public function create()
    {
        return view('admin.cars.create');
    }

    // Store new car from Blade form
    public function store(Request $request)
    {
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:50',
            'mileage' => 'nullable|integer',
            'status' => 'required|in:available,rented,sold,maintenance',
            'car_type' => 'required|in:rental,sale',
            'price_per_day' => 'nullable|numeric',
            'sale_price' => 'nullable|numeric',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_urls.*' => 'nullable|url',
        ]);

        $car = Car::create($validated);

        // Save images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('cars', 'public');
                $car->images()->create(['image_path' => $path]);
            }
        }

        if ($request->filled('image_urls')) {
            foreach ($request->image_urls as $url) {
                if (!empty($url)) {
                    $car->images()->create(['image_path' => $url]);
                }
            }
        }

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car added successfully.');
    }



    // Show edit form
    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    // Update car from Blade form
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:50',
            'mileage' => 'nullable|integer',
            'status' => 'required|in:available,rented,sold,maintenance',
            'car_type' => 'required|in:rental,sale',
            'price_per_day' => 'nullable|numeric',
            'sale_price' => 'nullable|numeric',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_urls.*' => 'nullable|url',
        ]);

        $car->update($validated);

        // Clear old images if you want to replace instead of append
        $car->images()->delete();

        // Handle multiple file uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('cars', 'public');
                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => $path
                ]);
            }
        }

        // Handle multiple URLs
        if ($request->filled('image_urls')) {
            foreach ($request->image_urls as $url) {
                if (!empty($url)) {
                    CarImage::create([
                        'car_id' => $car->id,
                        'image_path' => $url
                    ]);
                }
            }
        }

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car updated successfully.');
    }

    // Show single car details
    public function show(Car $car)
    {
        return view('admin.cars.show', compact('car'));
    }

    // Delete car
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('admin.cars.index')->with('success', 'Car deleted successfully.');
    }
}
