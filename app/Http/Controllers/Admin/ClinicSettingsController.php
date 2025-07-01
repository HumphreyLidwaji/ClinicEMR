<?php
//app/Http/Controllers/Admin/ClinicSettingsController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClinicSetting;
use Illuminate\Http\Request;

class ClinicSettingsController extends Controller
{
    public function index()
    {
        $settings = ClinicSetting::all()->pluck('value', 'key');
        return view('admin.clinic_settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $fields = [
            'clinic_name',
            'clinic_email',
            'clinic_phone',
            'clinic_address',
            'moh_code',
            'hospital_code',
        ];

        foreach ($fields as $field) {
            ClinicSetting::setValue($field, $request->input($field));
        }

        // Optional: handle logo
        if ($request->hasFile('clinic_logo')) {
            $logoPath = $request->file('clinic_logo')->store('logos', 'public');
            ClinicSetting::setValue('clinic_logo', $logoPath);
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
