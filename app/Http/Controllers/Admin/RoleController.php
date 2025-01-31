<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('role.manage'), Response::HTTP_FORBIDDEN);
        $roles = Role::get();
        $permissions = Permission::get();
        return view('backend.admin.role.index', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('role.store'), Response::HTTP_FORBIDDEN);
        $request->validate([
            'name' => ['string', 'required','unique:roles,name'],
            'permissions.*' => ['integer'],
            'permissions' => ['required', 'array'],
        ]);

        $validPermissions = Permission::whereIn('id', $request->input('permissions', []))->pluck('id')->toArray();

        if (count($request->input('permissions')) !== count($validPermissions)) {
            return redirect()->route('admin.role')->withErrors(['permissions' => 'Invalid permission IDs provided.']);
        }

        $role = Role::create(['guard_name' => 'web', 'name' => $request->input('name')]);
        $role->syncPermissions($validPermissions);

        return redirect()->route('admin.role')->with('message', 'Role created successfully');
    }

    public function edit(Role $role)
    {
        abort_if(Gate::denies('role.update'), Response::HTTP_FORBIDDEN);
        $permissions = Permission::pluck('name', 'id');
        $role->load('permissions');
        return view('backend.admin.role.edit', compact('permissions', 'role'));
    }

    public function update(Request $request, Role $role)
    {
        abort_if(Gate::denies('role.update'), Response::HTTP_FORBIDDEN);
        $request->validate([
            'name' => ['string', 'required',Rule::unique('roles', 'name')->ignore($role->id, 'id')],
            'permissions.*' => ['integer'],
            'permissions' => ['required', 'array'],
        ]);


        $validPermissions = Permission::whereIn('id', $request->input('permissions', []))->pluck('id')->toArray();

        if (count($request->input('permissions')) !== count($validPermissions)) {
            return redirect()->route('admin.role.edit', $role->id)->withErrors(['permissions' => 'Invalid permission IDs provided.']);
        }

        $role->update([
            'name' => $request->input('name'),
        ]);

        $role->syncPermissions($validPermissions);

        return redirect()->route('admin.role')->with('message', 'Role updated successfully');
    }

    public function destroy(Role $role)
    {
        abort_if(Gate::denies('role.delete'), Response::HTTP_FORBIDDEN);
        if (!$role) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'role not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $role->delete();
        $json['status'] = 'deleted';
        $json['message'] = 'role record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $role;
        return response()->json($json);
    }
}
