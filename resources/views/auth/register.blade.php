@extends('frontend.layouts.master')

@section('title', 'Register')

@section('content')

    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Register</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('/') }}">Home</a></li>
                    <li class="current">Register</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <livewire:auth.register />
@endsection

