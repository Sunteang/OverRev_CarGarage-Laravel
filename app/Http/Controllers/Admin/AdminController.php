<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Models\Rental;
use App\Models\Sale;
use App\Models\User;

class AdminController extends Controller
{
    // List admins (Blade)
    public function index()
    {
        $admins = Admin::paginate(10);
        return view('admin.admins.index', compact('admins'));
    }

    // Show create form
    public function create()
    {
        return view('admin.admins.create');
    }

    // Store new admin
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:tbl_admins,username',
            'password' => 'required|string|min:6',
        ]);

        Admin::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin created successfully.');
    }

    // Show edit form
    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }

    // Update admin
    public function update(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:tbl_admins,username,' . $admin->id,
            'password' => 'nullable|string|min:6',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $admin->update($validated);

        return redirect()->route('admin.admins.index')->with('success', 'Admin updated successfully.');
    }

    // Delete admin
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admin.admins.index')->with('success', 'Admin deleted successfully.');
    }
}
