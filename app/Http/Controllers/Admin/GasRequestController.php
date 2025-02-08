<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GasRequest;
use App\Models\Token;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class GasRequestController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user->outlet_id) {
            abort(403, 'You are not assigned to any outlet.');
        }

        if ($request->ajax()) {

            $gasRequests = GasRequest::where('outlet_id', $user->outlet_id)->with('outlet')->latest();

            return DataTables::of($gasRequests)
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('token', function ($row) {
                    return $row->token ? 'Issued' : 'Not Issued';
                })
                ->addColumn('status', function ($gasRequest) {
                    $statusClasses = [
                        'pending' => 'badge badge-warning',
                        'scheduled' => 'badge badge-primary',
                        'cancelled' => 'badge badge-danger',
                        'completed' => 'badge badge-success',
                    ];

                    $statusText = ucfirst($gasRequest->status);
                    $badgeClass = $statusClasses[$gasRequest->status] ?? 'badge badge-secondary';

                    return '<span class="' . $badgeClass . '">' . $statusText . '</span>';
                })
                ->addColumn('quantity', function ($row) {
                    return $row->quantity;
                })
                ->addColumn('customer', function ($row) {
                    return $row->user ? $row->user->name : 'N/A';
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at ? Carbon::parse($row->created_at)->format('Y-m-d') : 'N/A';
                })
                ->addColumn('expected_pickup_date', function ($row) {
                    return $row->expected_pickup_date ? Carbon::parse($row->expected_pickup_date)->format('Y-m-d') : 'N/A';
                })
                ->addColumn('actions', function ($row) {
                    $buttons = '';
                    if ($row->token) {
                        $buttons .= '
                            <a href="' . route('admin.tokens.show', $row->id) . '" class="btn btn-primary btn-sm">View Token</a>
                        ';
                    }
                    if ($row->status == 'pending') {
                        $buttons .= '
                            <button class="btn btn-success btn-sm approve-btn" data-id="' . $row->id . '">Approve</button>
                            <button class="btn btn-danger btn-sm reject-btn" data-id="' . $row->id . '">Reject</button>
                        ';
                    } elseif ($row->status == 'scheduled') {
                        $buttons .= '
                            <button class="btn btn-danger btn-sm reject-btn" data-id="' . $row->id . '">Reject</button>
                        ';
                    } elseif ($row->status == 'cancelled') {
                        $buttons .= '
                           <button class="btn btn-success btn-sm approve-btn" data-id="' . $row->id . '">Approve</button>
                        ';
                    }
                    return $buttons;
                })
                ->rawColumns(['actions', 'status'])
                ->make(true);
        }

        return view('backend.admin.gas-requests.index');
    }

    public function updateStatus(Request $request, GasRequest $gasRequest)
    {
        $gasRequest->status = $request->status;
        $gasRequest->save();

        if ($gasRequest->status === 'scheduled') {

            $tokenNumber = Str::uuid();

            $gasRequest->update([
                'expected_pickup_date' => now()->addWeeks(2),
            ]);

            // Create a new token
            Token::updateOrCreate(
                ['gas_request_id' => $gasRequest->id],
                [
                    'user_id' => $gasRequest->user_id,
                    'token_number' => $tokenNumber,
                    'token_issued_at' => now(),
                    'status' => 'active',
                ]
            );
            return response()->json(['message' => 'Status updated and token generated successfully!']);
        }
        return response()->json(['message' => 'Status updated!']);
    }
}
