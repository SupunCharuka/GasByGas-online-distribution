@extends('frontend.layouts.master')

@section('title', 'About-Us')

@section('content')

    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">About-Us</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('/') }}">Home</a></li>
                    <li class="current">About-Us</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- About Us Section -->
    <section id="about-2" class="about-2 section">
        <div class="container" data-aos="fade-up">

            <div class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="200">

                <!-- Image Section -->
                <div class="col-lg-5">
                    <div class="about-img">
                        <img src="{{ asset('assets/frontend/img/about-us.jpg') }}" class="img-fluid rounded" alt="About Us">
                    </div>
                </div>

                <!-- Content Section -->
                <div class="col-lg-7">
                    <h3 class="pt-0 pt-lg-5">About GasByGas</h3>

                    <p class="fst-italic">
                        GasByGas is a trusted LP gas cylinder distributor providing seamless gas delivery services
                        islandwide. Our mission is to ensure every customer receives a hassle-free experience.
                    </p>

                    <!-- Tabs -->
                    <ul class="nav nav-pills mb-3">
                        <li>
                            <a class="nav-link active" data-bs-toggle="pill" href="#about-2-tab1">Our Mission</a>
                        </li>
                        <li>
                            <a class="nav-link" data-bs-toggle="pill" href="#about-2-tab2">Our Vision</a>
                        </li>
                        <li>
                            <a class="nav-link" data-bs-toggle="pill" href="#about-2-tab3">Our Services</a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content">

                        <!-- Mission Tab -->
                        <div class="tab-pane fade show active" id="about-2-tab1">
                            <p>We are committed to providing reliable, efficient, and affordable LP gas delivery services
                                across Sri Lanka, ensuring customer satisfaction at every step.</p>
                            <div class="d-flex align-items-center mt-4">
                                <i class="bi bi-check2 text-success"></i>
                                <h4>Customer Satisfaction</h4>
                            </div>
                            <p>We prioritize customer satisfaction through prompt service and transparent operations.</p>
                        </div>

                        <!-- Vision Tab -->
                        <div class="tab-pane fade" id="about-2-tab2">
                            <p>To become the most trusted gas distributor, delivering quality and safety to every home and
                                business.</p>
                            <div class="d-flex align-items-center mt-4">
                                <i class="bi bi-check2 text-success"></i>
                                <h4>Islandwide Delivery</h4>
                            </div>
                            <p>Expanding our services to reach every district in Sri Lanka.</p>
                        </div>

                        <!-- Services Tab -->
                        <div class="tab-pane fade" id="about-2-tab3">
                            <p>We offer gas delivery services to homes, businesses, and industries with scheduled pickups
                                and convenient payment options.</p>
                            <div class="d-flex align-items-center mt-4">
                                <i class="bi bi-check2 text-success"></i>
                                <h4>Home Delivery</h4>
                            </div>
                            <p>Doorstep gas delivery within your requested time.</p>
                            <div class="d-flex align-items-center mt-4">
                                <i class="bi bi-check2 text-success"></i>
                                <h4>Business Supplies</h4>
                            </div>
                            <p>Reliable gas supplies for small businesses and industries.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
@endsection
