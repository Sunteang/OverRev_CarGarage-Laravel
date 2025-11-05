<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\Car;
use Illuminate\Http\Request;

class AdminRentalController extends Controller
{
    // List rentals for Blade dashboard
    public function index()
    {
        $rentals = Rental::with('car')->paginate(10);
        return view('admin.rentals.index', compact('rentals'));
    }

    // Show create form
    public function create()
    {
        $cars = Car::where('status', 'available')->get();
        return view('admin.rentals.create', compact('cars'));
    }

    // Store new rental
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:tbl_cars,id',
            'customer_name' => 'required|string|max:255',
            'rent_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:rent_date',
            'price' => 'required|numeric',
        ]);

        Rental::create($validated);

        return redirect()->route('admin.rentals.index')->with('success', 'Rental created successfully.');
    }

    // Show edit form
    public function edit(Rental $rental)
    {
        $cars = Car::where('status', 'available')->orWhere('id', $rental->car_id)->get();
        return view('admin.rentals.edit', compact('rental', 'cars'));
    }

    // Update rental
    public function update(Request $request, Rental $rental)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:tbl_cars,id',
            'customer_name' => 'required|string|max:255',
            'rent_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:rent_date',
            'price' => 'required|numeric',
        ]);

        $rental->update($validated);

        return redirect()->route('admin.rentals.index')->with('success', 'Rental updated successfully.');
    }

    // Show rental details
    public function show(Rental $rental)
    {
        return view('admin.rentals.show', compact('rental'));
    }

    // Delete rental
    public function destroy(Rental $rental)
    {
        $rental->delete();
        return redirect()->route('admin.rentals.index')->with('success', 'Rental deleted successfully.');
    }
}
