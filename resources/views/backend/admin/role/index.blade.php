@extends('backend.layouts.master')
@section('title', 'Roles')
@section('styles')

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/select2.css') }}">
@endsection
@section('breadcrumb-title', 'Roles')

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Manage Roles</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div>
            <div class="row">
                @can('role.create')
                    <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
                        <div>
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                            <div class="card shadow md:grid md:grid-cols-3 md:gap-1">
                                <div class="card-header px-4 py-4 md:col-span-1 flex justify-between">
                                    <h5 class="text-xl font-bold text-gray-900"> {{ __('Create Role') }}</h5>
                                </div>
                                <div class="md:mt-0 md:col-span-2">
                                    <form action="{{ route('admin.role.store') }}" enctype="multipart/form-data" method="post">
                                        @csrf
                                        <div class="px-4 py-4 bg-white sm:p-6">
                                            <div class="grid grid-cols-6 gap-6">
                                                <div class="col-span-6 sm:col-span-4">
                                                    <x-label for="name" value="{{ __('Role Name') }}" />
                                                    <x-input name="name" id="role-name" type="text"
                                                        class="mt-1 block w-full" value="{{ old('name') }}" />
                                                </div>

                                                <div class="col-span-6 sm:col-span-4">
                                                    <label class="block font-medium text-sm form-label" for="permissions">
                                                        Permissions
                                                    </label>
                                                  
                                                        <select
                                                            class="single-select-placeholder js-states select2-hidden-accessible select2 form-control"
                                                            id="permissions" name="permissions[]" multiple="multiple">
                                                            @foreach ($permissions as $permission)
                                                                <option value="{{ $permission->id }}"
                                                                    {{ in_array($permission->id, old('permissions', [])) ? 'selected' : '' }}>
                                                                    {{ $permission->name }}</option>
                                                            @endforeach
                                                        </select>
                                               

                                                </div>

                                            </div>
                                        </div>
                                        <div
                                            class="flex items-center justify-end px-4 py-3 text-right sm:px-6  sm:rounded-bl-md sm:rounded-br-md">
                                            <x-button>
                                                {{ __('Submit') }}
                                            </x-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                @endcan
                <div class="col-sm-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Manage Roles</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dt-responsive nowrap" id="roles"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $key => $role)
                                            <tr id="role-record-{{ $role->id }}">
                                                <td>{{ $role->id }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td class="text-center">
                                                    @can('role.update')
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('admin.role.edit', ['role' => $role]) }}" title="Edit">
                                                            <i class="fa fa-pencil"> </i>
                                                        </a>
                                                    @endcan
                                                    @can('role.delete')
                                                        <a class="btn btn-sm delete-role btn-danger"
                                                            data-role="{{ $role->id }}" id="role-{{ $role->id }}"
                                                            href="javascript:void(0)"  title="Delete">
                                                            <i class="fa fa-trash"> </i>
                                                        </a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

    <script src="{{ asset('assets/backend/js/datatable/datatables/jquery.dataTables.1.10.24.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/admin/role.js') }}"></script>
    <script src="{{ asset('assets/backend/js/select2/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#permissions').select2();
        });
    </script>
@endsection
