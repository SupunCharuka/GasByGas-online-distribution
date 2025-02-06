<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GasRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class GasRequestController extends Controller
{
 
    public function index(Request $request)
    {

        $user = Auth::user();

        if (!$user->outlet_id) {
            abort(403, 'You are not assigned to any outlet.');
        }

  

        if ($request->ajax()) {

            $gasRequests = GasRequest::where('outlet_id', $user->outlet_id)->with('outlet')->select('gas_requests.*');

            return DataTables::of($gasRequests)
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('token', function ($row) {
                    return $row->token;
                })
                ->addColumn('status', function ($gasRequest) {
                    $statusClasses = [
                        'pending' => 'badge badge-warning',
                        'accepted' => 'badge badge-success',
                        'rejected' => 'badge badge-danger',

                    ];

                    $statusText = ucfirst($gasRequest->status);
                    $badgeClass = $statusClasses[$gasRequest->status] ?? 'badge badge-secondary';

                    return '<span class="' . $badgeClass . '">' . $statusText . '</span>';
                })
                ->addColumn('quantity', function ($row) {
                    return $row->quantity;
                })
                ->addColumn('outlet', function ($row) {
                    return $row->outlet ? $row->outlet->name : 'N/A';
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at ? Carbon::parse($row->created_at)->format('Y-m-d') : 'N/A';
                })
                ->addColumn('expected_pickup_date', function ($row) {
                    return $row->expected_pickup_date ? Carbon::parse($row->expected_pickup_date)->format('Y-m-d') : 'N/A';
                })
                ->addColumn('actions', function ($row) {
                    return '
                        <button class="btn btn-success btn-sm approve-btn" data-id="' . $row->id . '">Approve</button>
                        <button class="btn btn-danger btn-sm reject-btn" data-id="' . $row->id . '">Reject</button>
                    ';
                })
                ->rawColumns(['actions', 'status'])
                ->make(true);
        }

        return view('backend.admin.gas-requests.index');
    }

    public function updateStatus(Request $request,GasRequest $gasRequest)
    {
        $gasRequest->status = $request->status;
        $gasRequest->save();

        return response()->json(['message' => 'Status updated successfully!']);
    }
}
