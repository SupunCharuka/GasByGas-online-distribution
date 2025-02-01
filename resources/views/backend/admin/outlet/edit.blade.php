@extends('backend.layouts.master')
@section('title', 'Outlet Edit')
@section('styles')

@endsection
@section('breadcrumb-title', 'Outlet Edit')

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.outlet') }}">Manage Outlet</a></li>
    <li class="breadcrumb-item active">Edit Outlet</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div>
            <div class="row">
                <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
                    <livewire:admin.outlet.edit :outlet="$outlet" />
                </div>
               
            </div>
        </div>
    </div>

@endsection
@section('scripts')
@endsection
