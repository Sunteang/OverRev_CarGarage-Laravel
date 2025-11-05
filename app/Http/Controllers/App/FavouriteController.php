<?php

// app/Http/Controllers/App/FavouriteController.php
namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function toggle(Car $car)
    {
        $user = Auth::user();

        if ($user->favourites()->where('car_id', $car->id)->exists()) {
            $user->favourites()->detach($car->id);
            return back()->with('success', 'Removed from favourites');
        }

        $user->favourites()->attach($car->id);
        return back()->with('success', 'Added to favourites');
    }

    public function index()
    {
        $favourites = Auth::user()->favourites()->get();
        return view('apps.favourites', compact('favourites'));
    }
}
