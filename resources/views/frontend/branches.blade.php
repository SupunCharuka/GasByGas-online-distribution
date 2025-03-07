@extends('frontend.layouts.master')

@section('title', 'Branches')

@section('content')

    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Branches</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('/') }}">Home</a></li>
                    <li class="current">Branches</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <section id="branches" class="section">
        <div class="container" data-aos="fade-up">
            <div class="row">
                @foreach ($outlets as $outlet)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm p-4">
                        <h4 class="text-primary">
                            <i class="bi bi-shop"></i> {{ $outlet->name }}
                        </h4>
                        <p><i class="bi bi-geo-alt"></i> <strong>District:</strong> {{ $outlet->district->name ?? 'N/A' }}</p>
                        <p><i class="bi bi-map"></i> <strong>Address:</strong> {{ $outlet->address }}</p>
                        <p><i class="bi bi-telephone"></i> <strong>Contact:</strong> {{ $outlet->contact_number }}</p>
                       
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
