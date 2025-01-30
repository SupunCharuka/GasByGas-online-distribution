@extends('backend.layouts.master')
@section('title', 'Edit User')
@section('styles')

@endsection
@section('breadcrumb-title', 'Edit USer')

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.manage-user') }}">Manage User</a></li>
    <li class="breadcrumb-item active">Edit User</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div>
            <div class="row">
                <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
                    <livewire:admin.user.edit :user="$user" />
                </div>


            </div>
        </div>
    </div>

@endsection
@section('scripts')
@endsection
