@extends('backend.layouts.master')
@section('title', 'My Gas Requests')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
@endsection


@section('breadcrumb-title', 'My Gas Requests')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">My Gas Requests</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div>
            <div class="row">
                <div class="col-sm-12">
                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Gas Requests for {{ auth()->user()->outlet->name }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dt-responsive nowrap" id="gas_requests"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Token</th>
                                            <th>Outlet</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                            <th>Requested At</th>
                                            <th>Expected Pickup Date</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Token</th>
                                            <th>Outlet</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                            <th>Requested At</th>
                                            <th>Expected Pickup Date</th>
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
    <script src="{{ asset('js/admin/gas-requests.js') }}"></script>
@endsection
