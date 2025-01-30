@extends('backend.layouts.master')
@section('title', 'Reset Password')
@section('styles')

@endsection
@section('breadcrumb-title', 'Reset Password')

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.manage-user') }}">Manage User</a></li>
    <li class="breadcrumb-item active">Reset Password</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div>
            <div class="row">
                <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
                    <livewire:admin.user.reset-password :user="$user" />
                </div>


            </div>
        </div>
    </div>

@endsection
@section('scripts')
@endsection
