@extends('backend.layouts.master')
@section('title', 'permissions')
@section('styles')

@endsection
@section('breadcrumb-title', 'Category')

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.permission') }}">Manage Permissions</a></li>
    <li class="breadcrumb-item active">Edit permissions</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div>
            <div class="row">
                <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
                    <livewire:admin.permission.edit :permission="$permission" />
                </div>
               
            </div>
        </div>
    </div>

@endsection
@section('scripts')
@endsection
