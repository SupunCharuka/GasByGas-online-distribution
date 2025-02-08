@extends('backend.layouts.master')
@section('title', 'Token Details')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
@endsection


@section('breadcrumb-title', 'Token Details')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.gas-requests') }}">My Gas Requests</a></li>
    <li class="breadcrumb-item active">Token Details</li>
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
                    @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Token Details</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Token Number:</strong> {{ $token->token_number }}</p>
                            <p><strong>Issued At:</strong> {{ $token->token_issued_at->format('Y-m-d') }}</p>
                            <p><strong>Request ID:</strong> {{ $gasRequest->id }}</p>
                            <p><strong>Customer Name:</strong> {{ $gasRequest->user->name }}</p>
                            <p><strong>Quantity:</strong> {{ $gasRequest->quantity }}</p>
                            <p><strong>Status:</strong>
                                <span
                                    class="badge 
                                    @if ($token->status == 'active') badge-success 
                                    @elseif ($token->status == 'used') badge-warning 
                                    @elseif ($token->status == 'expired') badge-danger 
                                    @else badge-warning @endif">
                                    {{ ucfirst($token->status) }}
                                </span>
                            </p>
                            <p><strong>Pickup Date:</strong> {{ $gasRequest->expected_pickup_date->format('Y-m-d') }}</p>
                            @if ($token->status != 'used' && $token->status != 'expired')
                                <form action="{{ route('admin.tokens.markUsed', $token->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">Mark as Used</button>
                                </form>
                                @if ($token->status != 'expired')
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#reallocateModal">
                                        Reallocate
                                    </button>
                                @endif
                            @endif
                            <a href="{{ route('admin.gas-requests') }}" class="btn btn-secondary">Back to
                                Requests</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Reallocating Token -->
    <div class="modal fade" id="reallocateModal" tabindex="-1" role="dialog" aria-labelledby="reallocateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reallocateModalLabel">Reallocate Token</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.tokens.reallocate', $token->id) }}" method="POST">
                        @csrf
                        <label for="new_gas_request_id">Select New User (Same Outlet):</label>
                        <select class="form-control" name="new_gas_request_id" required>
                            @foreach ($pendingGasRequests as $request)
                                <option value="{{ $request->id }}">
                                    {{ $request->user->name }} (Gas Request ID: {{ $request->id }}) - Qty:
                                    {{ $request->quantity }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-success mt-3">Confirm Reallocation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

@endsection
