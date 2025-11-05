<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{

    // Show settings form
    public function settings()
    {
        $settings = Setting::first(); // returns null if no row exists
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'contact_email' => 'required|email',
        ]);

        $settings = \App\Models\Setting::firstOrCreate([]);
        $settings->update($validated);

        return back()->with('success', 'Settings updated successfully.');
    }
}
