@extends('backend.layouts.master')
@section('title', auth()->user()->getRoleNames()->first() ?? 'Admin')
@section('styles')
@endsection

@section('breadcrumb-title', 'Dashboard')
@section('breadcrumb-items')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')

    <div class="row">

        @if (!auth()->user()->hasRole('outlet-manager'))
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">
                        <h5>Customers</h5>
                        <p class="fs-3 fw-bold">{{ $customerCount }}</p>
                    </div>

                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <h5>Businesses</h5>
                        <p class="fs-3 fw-bold">{{ $businessCount }}</p>
                    </div>

                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <h5>Outlet Managers</h5>
                        <p class="fs-3 fw-bold">{{ $outletManagerCount }}</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body">
                        <h5>Outlets</h5>
                        <p class="fs-3 fw-bold">{{ $outletCount }}</p>
                    </div>

                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-secondary text-white mb-4">
                    <div class="card-body">
                        <h5>Tokens</h5>
                        <p class="fs-3 fw-bold">{{ $tokenCount }}</p>
                    </div>

                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <h5>Stock Requests</h5>
                        <p class="fs-3 fw-bold">{{ $stockRequestCount }}</p>
                    </div>

                </div>
            </div>
        @else
            @if (auth()->user()->outlet)
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="card bg-info text-white mb-4">
                            <div class="card-body">
                                <h5>Outlet Details</h5>
                                <p><strong>Name:</strong> {{ $outlet->name }}</p>
                                <p><strong>District:</strong> {{ $outlet->district->name ?? 'N/A' }}</p>
                                <p><strong>Phone Number:</strong> {{ $outlet->contact_number ?? 'N/A' }}</p>
                                <p><strong>Address:</strong> {{ $outlet->address ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="card bg-dark text-white mb-4">
                            <div class="card-body">
                                <h5>Outlet Details</h5>
                                <p><strong>Status:</strong> Not assigned to any outlet</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <h5>Gas Requests</h5>
                        <p class="fs-3 fw-bold">{{ $gasRequestCount }}</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-secondary text-white mb-4">
                    <div class="card-body">
                        <h5>Tokens</h5>
                        <p class="fs-3 fw-bold">{{ $tokenCount }}</p>
                    </div>

                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <h5>Stock</h5>
                        <p class="fs-3 fw-bold">{{ $outlet->stock ?? 0 }}</p>
                    </div>

                </div>
            </div>

        @endif
    </div>



@endsection
@section('scripts')

@endsection
