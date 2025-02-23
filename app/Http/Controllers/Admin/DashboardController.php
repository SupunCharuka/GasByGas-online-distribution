<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GasRequest;
use App\Models\Outlet;
use App\Models\OutletStockRequest;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        if (!auth()->user()->hasRole('outlet-manager')) {
            $customerCount = User::role('user')->count();
            $businessCount = User::role('business')->count();
            $outletManagerCount = User::role('outlet-manager')->count();
            $outletCount = Outlet::count();
            $tokenCount = Token::count();
            $stockRequestCount = OutletStockRequest::count();
            return view('backend.admin.dashboard', compact('customerCount', 'businessCount', 'outletCount', 'tokenCount', 'outletManagerCount', 'stockRequestCount'));
        } else {
            $outlet = auth()->user()->outlet;
            if ($outlet) {
                $gasRequestCount = GasRequest::where('outlet_id', $outlet->id)->count();
                $tokenCount = Token::whereHas('gasRequest', function ($query) use ($outlet) {
                    $query->where('outlet_id', $outlet->id);
                })->with(['gasRequest.outlet', 'user'])->count();
            } else {
                $tokenCount = 0;
                $gasRequestCount = 0;
            }


            return view('backend.admin.dashboard', compact('tokenCount', 'gasRequestCount', 'outlet'));
        }
    }
}
