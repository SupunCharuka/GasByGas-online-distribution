@extends('backend.layouts.master')
@section('title', 'Outlet Stock Request')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
@endsection
@section('breadcrumb-title', 'Outlet Stock Request')

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active"> Outlet Stock Request</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div>
            <div class="row">
                <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
                    <livewire:admin.outlet-stock-request.create />
                </div>
                <div class="col-sm-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Outlet Stock Request</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dt-responsive nowrap"
                                    id="outlet_stock_requests" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Empty Cylinders</th>
                                            <th>Filled Cylinders</th>
                                            <th>Requested Cylinders</th>
                                            <th>Requested At</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Empty Cylinders</th>
                                            <th>Filled Cylinders</th>
                                            <th>Requested Cylinders</th>
                                            <th>Requested At</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
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
    <script src="{{ asset('js/admin/outlet-stock-requests.js') }}"></script>
@endsection
