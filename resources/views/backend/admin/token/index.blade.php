@extends('backend.layouts.master')
@section('title', 'Tokens')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
@endsection


@section('breadcrumb-title', 'Tokens')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Tokens</li>
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
                            <h5>Tokens</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dt-responsive nowrap" id="tokens"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Token Number</th>
                                            <th>User Name</th>
                                            <th>Outlet</th>
                                            <th>Issued At</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tokens as $token)
                                            <tr>
                                                <td>{{ $token->id }}</td>
                                                <td>{{ $token->token_number }}</td>
                                                <td>{{ $token->user->name }}</td>
                                                <td>{{ $token->gasRequest->outlet->name ?? 'N/A' }}</td>
                                                <td>{{ $token->token_issued_at->format('Y-m-d H:i') }}</td>
                                                <td>
                                                    <span
                                                        class="badge 
                                                    @if ($token->status == 'active') bg-success 
                                                    @elseif($token->status == 'used') bg-primary 
                                                    @elseif($token->status == 'expired') bg-danger 
                                                    @else bg-secondary @endif">
                                                        {{ ucfirst($token->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Token Number</th>
                                            <th>User Name</th>
                                            <th>Outlet</th>
                                            <th>Issued At</th>
                                            <th>Status</th>
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
    <script src="{{ asset('js/admin/token.js') }}"></script>
@endsection
