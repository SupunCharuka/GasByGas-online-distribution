@extends('backend.layouts.master')
@section('title', 'User')
@section('styles')
@endsection

@section('breadcrumb-title', 'Dashboard')
@section('breadcrumb-items')
    <li class="breadcrumb-item active">Dashboard</li>

@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    <strong>Error:</strong> {{ session('error') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning">
                    <strong>Warning:</strong> {{ session('warning') }}
                </div>
            @endif
            @if (Auth::check())
                <h2 class="text-xl font-bold">Welcome, {{ Auth::user()->name }}!</h2>
            @endif

            @if (auth()->user()->hasRole('business'))


                <div class="card">
                    <div class="card-header">
                        <h5>Business Details</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Business Name:</strong> {{ auth()->user()->business->business_name }}</p>
                        <p><strong>Registration Number:</strong>
                            {{ auth()->user()->business->business_registration_number }}</p>
                        <p><strong>Status:</strong>
                            <span
                                class="badge 
                                    {{ auth()->user()->business->status == 'approved'
                                        ? 'bg-success'
                                        : (auth()->user()->business->status == 'pending'
                                            ? 'bg-warning'
                                            : 'bg-danger') }}">
                                {{ ucfirst(auth()->user()->business->status) }}
                            </span>
                        </p>

                        @if (auth()->user()->business->certificate_file)
                            <p><strong>Certificate File:</strong>
                                <a href="{{ asset('storage/' . auth()->user()->business->certificate_file) }}"
                                    target="_blank" class="btn btn-sm btn-primary">
                                    View Certificate
                                </a>
                            </p>
                        @else
                            <p class="text-danger">No certificate uploaded.</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>



@endsection
@section('scripts')

@endsection
