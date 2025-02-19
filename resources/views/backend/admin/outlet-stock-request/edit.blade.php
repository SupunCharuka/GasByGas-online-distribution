@extends('backend.layouts.master')
@section('title', 'Outlet Edit')
@section('styles')

@endsection
@section('breadcrumb-title', 'Outlet Edit')

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    @if (Auth::user()->getRoleNames()->first() == 'admin')
        
    <li class="breadcrumb-item"><a href="{{ route('admin.stock-request.adminIndex') }}">Manage Outlet Stock Requests</a></li>
    @else
    <li class="breadcrumb-item"><a href="{{ route('admin.outlet-stock-request') }}">Manage Outlet Request</a></li>
    @endif
   
    <li class="breadcrumb-item active">Update Outlet Request</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div>
            <div class="row">
                <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
                    <livewire:admin.outlet-stock-request.edit :stockRequest="$stockRequest" />
                </div>

            </div>
        </div>
    </div>

@endsection
@section('scripts')
@endsection
