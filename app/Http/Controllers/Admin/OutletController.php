<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class OutletController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('outlet.manage'), Response::HTTP_FORBIDDEN);
        $outlets = Outlet::all();
        return view('backend.admin.outlet.index', compact('outlets'));
    }
    public function edit(Outlet $outlet)
    {
        abort_if(Gate::denies('outlet.update'), Response::HTTP_FORBIDDEN);
      
        return view('backend.admin.outlet.edit', compact('outlet'));
    }
    public function destroy(Outlet $outlet)
    {
        abort_if(Gate::denies('outlet.delete'), Response::HTTP_FORBIDDEN);
        if (!$outlet) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'outlet not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $outlet->delete();
        $json['status'] = 'deleted';
        $json['message'] = 'outlet record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $outlet;
        return response()->json($json);
    }

}
