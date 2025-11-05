<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Car;
use Illuminate\Http\Request;

class AdminSaleController extends Controller
{
    // List sales for Blade dashboard
    public function index()
    {
        $sales = Sale::with('car')->paginate(10);
        return view('admin.sales.index', compact('sales'));
    }

    // Show create form
    public function create()
    {
        $cars = Car::where('status', 'available')->get();
        return view('admin.sales.create', compact('cars'));
    }

    // Store new sale
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:tbl_cars,id',
            'buyer_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'sale_date' => 'required|date',
        ]);

        Sale::create($validated);

        return redirect()->route('admin.sales.index')->with('success', 'Sale created successfully.');
    }

    // Show edit form
    public function edit(Sale $sale)
    {
        $cars = Car::where('status', 'available')->orWhere('id', $sale->car_id)->get();
        return view('admin.sales.edit', compact('sale', 'cars'));
    }

    // Update sale
    public function update(Request $request, Sale $sale)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:tbl_cars,id',
            'buyer_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'sale_date' => 'required|date',
        ]);

        $sale->update($validated);

        return redirect()->route('admin.sales.index')->with('success', 'Sale updated successfully.');
    }

    // Show sale details
    public function show(Sale $sale)
    {
        return view('admin.sales.show', compact('sale'));
    }

    // Delete sale
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('admin.sales.index')->with('success', 'Sale deleted successfully.');
    }
}
