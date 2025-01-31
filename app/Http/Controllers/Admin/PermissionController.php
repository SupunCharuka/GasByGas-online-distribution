<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('permission.manage'), Response::HTTP_FORBIDDEN);
        $permissions = Permission::all();
        return view('backend.admin.permission.index', compact('permissions'));
    }
    public function edit(Permission $permission)
    {
        abort_if(Gate::denies('permission.update'), Response::HTTP_FORBIDDEN);
        $permission->load('roles');
        return view('backend.admin.permission.edit', compact('permission'));
    }
    public function destroy(Permission $permission)
    {
        abort_if(Gate::denies('permission.delete'), Response::HTTP_FORBIDDEN);
        if (!$permission) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'permission not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $permission->delete();
        $json['status'] = 'deleted';
        $json['message'] = 'permission record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $permission;
        return response()->json($json);
    }
}
