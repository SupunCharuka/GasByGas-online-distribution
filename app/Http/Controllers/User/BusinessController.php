<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    public function edit()
    {
        return view('backend.user.update-business', ['business' => Auth::user()->business]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'business_registration_number' => 'required|string|max:255|unique:businesses,business_registration_number,' . Auth::user()->business->id,
            'certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $business = Auth::user()->business;
        $business->business_name = $request->business_name;
        $business->business_registration_number = $request->business_registration_number;

        if ($request->hasFile('certificate_file')) {
            // Delete old file if exists
            if ($business->certificate_file) {
                Storage::disk('public')->delete($business->certificate_file);
            }

            // Store new file
            $certificatePath = $request->file('certificate_file')->store('business_certificates', 'public');
            $business->certificate_file = $certificatePath;
        }
        $business->status = 'pending'; // Reset status to pending after update
        $business->save();

        return redirect()->route('user.dashboard')->with('success', 'Business details updated successfully. Awaiting approval.');
    }
}
