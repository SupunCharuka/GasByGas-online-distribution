<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GasRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.user.dashboard');
    }

    public function gasRequests(Request $request)
    {
        if ($request->ajax()) {
            $gasRequests = auth()->user()->gasRequests()->latest()->get();
            return DataTables::of($gasRequests)
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

                ->addColumn('outlet', function ($gasRequest) {
                    return $gasRequest->outlet->name;
                })
                ->addColumn('quantity', function ($gasRequest) {
                    return $gasRequest->quantity;
                })
                ->addColumn('created_at', function ($gasRequest) {
                    return $gasRequest->created_at->format('d M Y');
                })
                ->addColumn('actions', function ($gasRequest) {
                    return view('backend.user.gas-requests.action', compact('gasRequest'))->render();
                })
                ->rawColumns(['actions', 'status'])
                ->make(true);
        }
        return view('backend.user.gas-requests.index');
    }

    public function cancelRequest(GasRequest $gasRequest)
    {
        if (!$gasRequest) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gas Request not found',
                'icon' => 'error'
            ], 404);
        }

        // Ensure only pending requests can be canceled
        if ($gasRequest->status !== 'pending') {
            return response()->json([
                'status' => 'error',
                'message' => 'Only pending requests can be canceled',
                'icon' => 'error'
            ], 400);
        }

        $gasRequest->update(['status' => 'rejected']);

        return response()->json([
            'status' => 'rejected',
            'message' => 'Gas request has been successfully canceled.',
            'icon' => 'success'
        ]);
    }

    public function getToken(GasRequest $gasRequest)
    {
        
        $token = $gasRequest->token;

       
        if ($token && isset($token->token_number) && isset($token->token_issued_at)) {
            $statusClasses = [
                'active' => 'badge badge-success',
                'expired' => 'badge badge-danger',
                'used' => 'badge badge-warning',
            ];
    
            $statusClass = $statusClasses[$token->status] ?? 'badge badge-secondary';
            return response()->json([
                'success' => true,
                'token_number' => $token->token_number,
                'token_issued_at' => $token->token_issued_at->format('d M Y H:i A'),
                'status' => '<span class="' . $statusClass . '">' . ucfirst($token->status) . '</span>',
            ]);
        }

        return response()->json(['success' => false]);
    }

    
}
