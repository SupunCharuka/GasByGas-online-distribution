<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OutletStockRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class OutletStockRequestController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user->outlet_id) {
            abort(403, 'You are not assigned to any outlet.');
        }

        if ($request->ajax()) {

            $stockRequests = OutletStockRequest::where('outlet_id', $user->outlet_id);

            return DataTables::of($stockRequests)
                ->addColumn('action', function ($row) {
                    $buttons = '';
                    if ($row->status === 'pending') {
                        $buttons .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm reject-request" data-id="' . $row->id . '" title="Reject"><i class="fas fa-times-circle"></i></a>
                                     <a href="' . route('admin.outlet-stock-request.edit', $row->id) . '" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></a>';
                    }

                    if ($row->status === 'approved') {
                        $buttons .= '<a href="javascript:void(0)" class="btn btn-success btn-sm complete-request" data-id="' . $row->id . '" title="Approve"><i class="fas fa-check-circle"></i></a>
                                     ';
                    }
                    return $buttons;
                })
                ->addColumn('status', function ($row) {
                    $statusClasses = [
                        'pending' => 'badge badge-warning',
                        'approved' => 'badge badge-primary',
                        'rejected' => 'badge badge-danger',
                        'completed' => 'badge badge-success',
                    ];

                    $statusText = ucfirst($row->status);
                    $badgeClass = $statusClasses[$row->status] ?? 'badge badge-secondary';

                    return '<span class="' . $badgeClass . '">' . $statusText . '</span>';
                })
                ->addColumn('requested_at', function ($row) {
                    return $row->created_at->format('Y-m-d H:i:s');
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('backend.admin.outlet-stock-request.index');
    }

    public function complete(OutletStockRequest $outletStockRequest)
    {
        try {
            $outlet = $outletStockRequest->outlet;

            $outletStockRequest->status = 'completed';
            $outletStockRequest->save();

            $outlet->stock += $outletStockRequest->requested_cylinders;
            $outlet->save();

            return response()->json(['success' => true, 'message' => 'Stock request completed successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!'], 500);
        }
    }

    public function reject(OutletStockRequest $outletStockRequest)
    {

        try {
            $outletStockRequest->status = 'rejected';
            $outletStockRequest->save();

            return response()->json(['success' => true, 'message' => 'Stock request rejected successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!'], 500);
        }
    }

    public function edit(OutletStockRequest $stockRequest)
    {
        return view('backend.admin.outlet-stock-request.edit', compact('stockRequest'));
    }

    public function adminIndex(Request $request)
    {


        if ($request->ajax()) {

            $stockRequests = OutletStockRequest::query();

            return DataTables::of($stockRequests)
                ->addColumn('action', function ($row) {
                    $buttons = '';
                    if ($row->status === 'pending') {
                        $buttons .= '<a href="javascript:void(0)" class="btn btn-success btn-sm approve-request" data-id="' . $row->id . '" title="Approve"><i class="fas fa-check-circle"></i></a>
                                     <a href="javascript:void(0)" class="btn btn-danger btn-sm reject-request" data-id="' . $row->id . '" title="Reject"><i class="fas fa-times-circle"></i></a>
                                     <a href="' . route('admin.outlet-stock-request.edit', $row->id) . '" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></a>';
                    }
                    if ($row->status === 'approved' || $row->status === 'rejected') {
                        $buttons .= '<a href="' . route('admin.outlet-stock-request.edit', $row->id) . '" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></a>';
                    }
                    return $buttons;
                })
                ->addColumn('status', function ($row) {
                    $statusClasses = [
                        'pending' => 'badge badge-warning',
                        'approved' => 'badge badge-primary',
                        'rejected' => 'badge badge-danger',
                        'completed' => 'badge badge-success',
                    ];

                    $statusText = ucfirst($row->status);
                    $badgeClass = $statusClasses[$row->status] ?? 'badge badge-secondary';

                    return '<span class="' . $badgeClass . '">' . $statusText . '</span>';
                })
                ->addColumn('requested_at', function ($row) {
                    return $row->created_at->format('Y-m-d H:i');
                })
                ->addColumn('outlet_name', function ($row) {
                    return $row->outlet->name;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('backend.admin.outlet-stock-request.admin-index');
    }

    public function approve(OutletStockRequest $outletStockRequest)
    {
        try {
            $outletStockRequest->status = 'approved';
            $outletStockRequest->save();

            return response()->json(['success' => true, 'message' => 'Stock request approved successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!'], 500);
        }
    }
}
