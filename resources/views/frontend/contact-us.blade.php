@extends('frontend.layouts.master')

@section('title', 'Contact US')

@section('content')

    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Contact US</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('/') }}">Home</a></li>
                    <li class="current">Contact US</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

   <!-- Contact Section -->
   <section id="contact" class="contact section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

   

      <div class="row gy-4">

        <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                    <h3>Address</h3>
                    <p>123 Galle Road, Colombo 03, Sri Lanka</p>
                </div>
            </div><!-- End Info Item -->
        
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-telephone flex-shrink-0"></i>
                <div>
                    <h3>Call Us</h3>
                    <p>+94 11 234 5678</p>
                </div>
            </div><!-- End Info Item -->
        
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                    <h3>Email Us</h3>
                    <p><a href="mailto:info@example.lk">info@example.lk</a></p>
                </div>
            </div><!-- End Info Item -->
        </div>
        
        <livewire:frontend.contact-us />
        

      </div>

    </div>

  </section><!-- /Contact Section -->

@endsection

@section('scripts')
@endsection
