<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Repair;
use App\Models\Car;
use Illuminate\Http\Request;

class AdminRepairController extends Controller
{
    // List repairs for Blade dashboard
    public function index()
    {
        $repairs = Repair::with('car')->paginate(10);
        return view('admin.repairs.index', compact('repairs'));
    }

    // Show create form
    public function create()
    {
        $cars = Car::all();
        return view('admin.repairs.create', compact('cars'));
    }

    // Store new repair
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:tbl_cars,id',
            'description' => 'nullable|string',
            'cost' => 'required|numeric',
            'repair_date' => 'required|date',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
        ]);

        Repair::create($validated);

        return redirect()->route('admin.repairs.index')->with('success', 'Repair added successfully.');
    }

    // Show edit form
    public function edit(Repair $repair)
    {
        $cars = Car::all();
        return view('admin.repairs.edit', compact('repair', 'cars'));
    }

    // Update repair
    public function update(Request $request, Repair $repair)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:tbl_cars,id',
            'description' => 'nullable|string',
            'cost' => 'required|numeric',
            'repair_date' => 'required|date',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
        ]);

        $repair->update($validated);

        return redirect()->route('admin.repairs.index')->with('success', 'Repair updated successfully.');
    }

    // Show repair details
    public function show(Repair $repair)
    {
        return view('admin.repairs.show', compact('repair'));
    }

    // Delete repair
    public function destroy(Repair $repair)
    {
        $repair->delete();
        return redirect()->route('admin.repairs.index')->with('success', 'Repair deleted successfully.');
    }
}
