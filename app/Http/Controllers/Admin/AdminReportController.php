<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Support\Facades\DB;

class AdminReportController extends Controller
{
    public function index()
    {
        $totalCars = Car::count();
        $totalRentals = Rental::count();

        return view('admin.reports.index', compact('totalCars', 'totalRentals'));
    }
}
