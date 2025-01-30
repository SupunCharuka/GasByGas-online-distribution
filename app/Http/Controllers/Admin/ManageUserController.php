<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ManageUserController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('manage-user.manage'), Response::HTTP_FORBIDDEN);
        if ($request->wantsJson()) {
            $users = User::with('roles')
                ->whereRelation('roles', 'name', '<>', 'admin')
                ->orWhereDoesntHave('roles');
            return DataTables::eloquent($users)
                ->addColumn('roles', function ($user) {
                    $roles = '';
                    foreach ($user->roles as $key => $item) {
                        $roles =  ucfirst($item->name);
                    }
                    return $roles;
                })
                ->addColumn('actions', function ($user) {
                    return view('backend.admin.manage-user.includes.actions', compact('user'))->render();
                })
                ->rawColumns(['actions', 'roles'])
                ->make();
        }
        return view('backend.admin.manage-user.index');
    }

    public function create(User $user)
    {
        abort_if(Gate::denies('manage-user.create'), Response::HTTP_FORBIDDEN);

        return view('backend.admin.manage-user.create');
    }
    public function edit(User $user)
    {
        abort_if(Gate::denies('manage-user.update'), Response::HTTP_FORBIDDEN);
        $user->load('roles');
        return view('backend.admin.manage-user.edit', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('manage-user.delete'), Response::HTTP_FORBIDDEN);
        if (!$user) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'user not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $user->delete();
        $json['status'] = 'deleted';
        $json['message'] = 'user record deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $user;
        return response()->json($json);
    }

    public function resetPassword(User $user)
    {
        abort_if(Gate::denies('manage-user.reset-password'), Response::HTTP_FORBIDDEN);
        return view('backend.admin.manage-user.reset-password', compact('user'));
    }

    public function suspendUser(User $user)
    {
        abort_if(Gate::denies('manage-user.suspend'), Response::HTTP_FORBIDDEN);

        $wasSuspended = !is_null($user->suspended_at); //  user was suspended
        $user->suspended_at = $wasSuspended ? null : now();
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => $user->suspended_at ? 'User suspended successfully' : 'User unsuspend successfully',
        ]);
    }

}
