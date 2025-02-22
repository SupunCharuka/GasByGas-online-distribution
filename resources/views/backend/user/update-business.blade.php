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

            <h2>Update Business Details</h2>

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('user.update-business.save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="business_name" class="form-label">Business Name</label>
                    <input type="text" class="form-control" id="business_name" name="business_name"
                        value="{{ old('business_name', $business->business_name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="business_registration_number" class="form-label">Registration Number</label>
                    <input type="text" class="form-control" id="business_registration_number"
                        name="business_registration_number"
                        value="{{ old('business_registration_number', $business->business_registration_number) }}" required>
                </div>

                <div class="mb-3">
                    <label for="certificate_file" class="form-label">Certificate File</label>
                    <input type="file" class="form-control" id="certificate_file" name="certificate_file">
                    @if ($business->certificate_file)
                        <p>Current File: <a href="{{ asset('storage/' . $business->certificate_file) }}"
                                target="_blank">View Certificate</a></p>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Update Details</button>
            </form>

        </div>
    </div>



@endsection
@section('scripts')

@endsection
