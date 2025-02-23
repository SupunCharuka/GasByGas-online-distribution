@extends('backend.layouts.master')
@section('title', 'Manage Outlet')
@section('styles')
   
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
@endsection
@section('breadcrumb-title', 'Manage Outlet')

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Manage Outlet</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div>
            <div class="row">

                @can('outlet.create')
                    <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
                        <livewire:admin.outlet.create />
                    </div>
                @endcan

                <div class="col-sm-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Manage Outlet</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dt-responsive nowrap" id="outlets"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>District</th>
                                            <th>Address</th>
                                            <th>Contact Number</th>
                                            <th>Total Empty Cylinders</th>
                                            <th>Stock</th>
                                            <th>Assigned Outlet Manager</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($outlets as $outlet)
                                            <tr id="outlet-record-{{ $outlet->id }}">
                                                <td>{{ $outlet->id }}</td>
                                                <td>{{ $outlet->name }}</td>
                                                <td>{{ $outlet->district->name }}</td>
                                                <td>{{ $outlet->address }}</td>
                                                <td>{{ $outlet->contact_number }}</td>
                                                <td>{{ $outlet->total_empty_cylinders }}</td>
                                                <td>{{ $outlet->stock }}</td>
                                                <td>
                                                    @if ($outlet->users->isNotEmpty())
                                                        <span class="badge bg-success">Assigned</span>
                                                    @else
                                                        <span class="badge bg-danger">Not Assigned</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @can('outlet.update')
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('admin.outlet.edit', ['outlet' => $outlet]) }}">
                                                            <i class="fa fa-pencil"> </i>
                                                        </a>
                                                    @endcan
                                                    @can('outlet.delete')
                                                        <a class="btn btn-sm delete-outlet btn-danger"
                                                            data-outlet="{{ $outlet->id }}"
                                                            id="outlet-{{ $outlet->id }}" href="javascript:void(0)" title="Delete">
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
                                            <th>District</th>
                                            <th>Address</th>
                                            <th>Contact Number</th>
                                            <th>Total Empty Cylinders</th>
                                            <th>Stock</th>
                                            <th>Assigned Outlet Manager</th>
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
    <script src="{{ asset('js/admin/outlet.js') }}"></script>
@endsection
