<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use App\Models\Sale;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function show()
    {
        $admin = Auth::guard('admin')->user();

        $totalCars = Car::count();
        $totalCustomers = Customer::count(); // fix here
        $totalSales = Sale::count();

        $activeRentals = Rental::whereNull('return_date')
            ->orWhere('return_date', '>=', now())
            ->count();

        $recentRentals = Rental::with('car')->latest()->take(5)->get();
        $recentSales = Sale::with('car')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'admin',
            'totalCars',
            'totalCustomers',
            'totalSales',
            'activeRentals',
            'recentRentals',
            'recentSales'
        ));
    }
}
