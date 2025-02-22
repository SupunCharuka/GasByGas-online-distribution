<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ManageBusinessController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $businesses = Business::with('user')->select('businesses.*');

            return DataTables::of($businesses)
                ->addColumn('name', function ($business) {
                    return $business->user->name ?? 'N/A';
                })
                ->addColumn('email', function ($business) {
                    return $business->user->email ?? 'N/A';
                })
                ->addColumn('nic', function ($business) {
                    return $business->user->nic ?? 'N/A';
                })
                ->addColumn('phone', function ($business) {
                    return $business->user->phone ?? 'N/A';
                })
                ->addColumn('status', function ($business) {
                    $statusClasses = [
                        'pending' => 'badge badge-warning',
                        'approved' => 'badge badge-primary',
                        'rejected' => 'badge badge-danger',
                    ];

                    $statusText = ucfirst($business->status);
                    $badgeClass = $statusClasses[$business->status] ?? 'badge badge-secondary';

                    return '<span class="' . $badgeClass . '">' . $statusText . '</span>';
                })
                ->addColumn('business_details', function ($business) {
                    return '<button class="btn btn-primary btn-sm view-details" data-id="' . $business->id . '">View Details</button>';
                })
                ->addColumn('actions', function ($business) {
                    $approveButton = $business->status !== 'approved' ?
                        '<button class="btn btn-success btn-sm approve-business" data-id="' . $business->id . '">Approve</button>'
                        : '';

                    $rejectButton = $business->status !== 'rejected' ?
                        '<button class="btn btn-danger btn-sm reject-business" data-id="' . $business->id . '">Reject</button>'
                        : '';

                    $editButton = '<a href="' . route('admin.manage-business.edit', $business->id) . '" class="btn btn-warning btn-sm">Edit</a>';

                    return $approveButton . ' ' . $rejectButton . ' ' . $editButton;
                })
                ->rawColumns(['status', 'business_details', 'actions'])
                ->make(true);
        }

        return view('backend.admin.manage-business.index');
    }

    public function show($id)
    {
        $business = Business::with('user')->findOrFail($id);

        return response()->json($business);
    }

    public function approve($id)
    {
        $business = Business::findOrFail($id);
        $business->update(['status' => 'approved']);

        return response()->json(['success' => 'Business approved successfully!']);
    }

    public function reject($id)
    {
        $business = Business::findOrFail($id);
        $business->update(['status' => 'rejected']);

        return response()->json(['success' => 'Business rejected successfully!']);
    }

    public function edit(Business $business)
    {
        return view('backend.admin.manage-business.edit', compact('business'));
    }

    public function update(Request $request, Business $business)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'business_registration_number' => 'required|string|max:255|unique:businesses,business_registration_number,' . $business->id,
            'certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

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

        $business->status = 'pending';
        $business->save();

        return redirect()->route('admin.manage-business')->with('message', 'Business details updated successfully.');
    }
}
