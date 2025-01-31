@extends('backend.layouts.master')
@section('title', 'Manage Permission')
@section('styles')
   
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
@endsection
@section('breadcrumb-title', 'Manage Permission')

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Manage Permission</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div>
            <div class="row">

                @can('permission.create')
                    <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
                        <livewire:admin.permission.create />
                    </div>
                @endcan

                <div class="col-sm-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Manage Permissions</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dt-responsive nowrap" id="permissions"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $permission)
                                            <tr id="permission-record-{{ $permission->id }}">
                                                <td>{{ $permission->id }}</td>
                                                <td>{{ $permission->name }}</td>
                                                <td class="text-center">
                                                    @can('permission.update')
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('admin.permission.edit', ['permission' => $permission]) }}">
                                                            <i class="fa fa-pencil"> </i>
                                                        </a>
                                                    @endcan
                                                    @can('permission.delete')
                                                        <a class="btn btn-sm delete-permission btn-danger"
                                                            data-permission="{{ $permission->id }}"
                                                            id="permission-{{ $permission->id }}" href="javascript:void(0)" title="Delete">
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
    <script src="{{ asset('js/admin/permission.js') }}"></script>
@endsection
