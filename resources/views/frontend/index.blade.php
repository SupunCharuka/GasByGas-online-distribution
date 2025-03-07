@extends('frontend.layouts.master')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

        <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

            <div class="carousel-item active">
                <img src="{{ asset('assets/frontend/img/hero-carousel/hero-carousel-1.jpg') }}" alt="">
                <div class="carousel-container">
                    <h2>Welcome to GasByGas<br></h2>
                    <p class="text-center">Reliable LP gas solutions at your doorstep! Whether for home, business, or
                        industrial use, we ensure
                        safe and efficient gas delivery tailored to your needs.</p>
                    <a href="#featured-services" class="btn-get-started">Get Started</a>
                </div>
            </div><!-- End Carousel Item -->

            <div class="carousel-item">
                <img src="{{ asset('assets/frontend/img/hero-carousel/hero-carousel-2.jpg') }}" alt="">
                <div class="carousel-container">
                    <h2>Fast & Secure Gas Delivery</h2>
                    <p class="text-center">Order gas cylinders online with ease and get them delivered on time! Track your
                        order, manage
                        refills, and enjoy a seamless experience with GasByGas.</p>
                    <a href="#featured-services" class="btn-get-started">Get Started</a>
                </div>
            </div><!-- End Carousel Item -->

            <div class="carousel-item">
                <img src="{{ asset('assets/frontend/img/hero-carousel/hero-carousel-3.jpg') }}" alt="">
                <div class="carousel-container">
                    <h2>Trusted by Homes & Businesses</h2>
                    <p class="text-center">We serve households, restaurants, and industries with high-quality LP gas,
                        ensuring safety, efficiency, and uninterrupted supply across Sri Lanka.</p>
                    <a href="#featured-services" class="btn-get-started">Get Started</a>
                </div>
            </div><!-- End Carousel Item -->

            <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

            <ol class="carousel-indicators"></ol>

        </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>About GasByGas</h2>
            <p>Your Trusted LP Gas Partner<br></p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                    <p>
                        GasByGas is a leading LP gas distributor, ensuring a safe, reliable, and efficient supply of gas to
                        homes and businesses across Sri Lanka. Our goal is to make gas refilling and delivery seamless for
                        our customers.
                    </p>
                    <ul>
                        <li><i class="bi bi-check2-circle"></i> <span>Fast and secure online gas ordering and doorstep
                                delivery.</span></li>
                        <li><i class="bi bi-check2-circle"></i> <span>Trusted by households, restaurants, and
                                industries.</span></li>
                        <li><i class="bi bi-check2-circle"></i> <span>Committed to safety and quality in every cylinder we
                                deliver.</span></li>
                    </ul>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <p>At GasByGas, we simplify gas distribution by offering an easy-to-use online ordering system,
                        real-time tracking, and customer support. Whether you need a refill for home cooking or bulk gas for
                        business operations, we’ve got you covered.</p>
                    <a href="{{ route('aboutUs') }}" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

        </div>

    </section><!-- /About Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

        <div class="container section-title" data-aos="fade-up">
            <h2>Our Services</h2>
            <p>Reliable & Convenient LP Gas Solutions</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item d-flex position-relative h-100">
                        <i class="bi bi-truck icon flex-shrink-0"></i>
                        <div>
                            <h4 class="title"><a href="#" class="stretched-link">Home Gas Delivery</a></h4>
                            <p class="description">Order your LP gas online and get it delivered to your doorstep quickly
                                and safely.</p>
                        </div>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item d-flex position-relative h-100">
                        <i class="bi bi-shop icon flex-shrink-0"></i>
                        <div>
                            <h4 class="title"><a href="#" class="stretched-link">Industrial & Commercial
                                    Supply</a></h4>
                            <p class="description">Bulk gas supply for restaurants, factories, and other business needs.
                            </p>
                        </div>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item d-flex position-relative h-100">
                        <i class="bi bi-credit-card icon flex-shrink-0"></i>
                        <div>
                            <h4 class="title"><a href="#" class="stretched-link">Flexible Payment Options</a></h4>
                            <p class="description">Choose from various payment methods, including cash on delivery, online
                                payments, and installment plans.</p>
                        </div>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-item d-flex position-relative h-100">
                        <i class="bi bi-geo-alt icon flex-shrink-0"></i>
                        <div>
                            <h4 class="title"><a href="#" class="stretched-link">Real-time Tracking</a></h4>
                            <p class="description">Track your gas delivery status in real-time with our smart tracking
                                system.</p>
                        </div>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="service-item d-flex position-relative h-100">
                        <i class="bi bi-headset icon flex-shrink-0"></i>
                        <div>
                            <h4 class="title"><a href="#" class="stretched-link">24/7 Customer Support</a></h4>
                            <p class="description">Our support team is available round the clock to assist with orders and
                                inquiries.</p>
                        </div>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="service-item d-flex position-relative h-100">
                        <i class="bi bi-tools icon flex-shrink-0"></i>
                        <div>
                            <h4 class="title"><a href="#" class="stretched-link">Gas Safety & Maintenance</a></h4>
                            <p class="description">We provide professional gas safety inspections and maintenance services
                                to ensure secure usage.</p>
                        </div>
                    </div>
                </div><!-- End Service Item -->

            </div>

        </div>

    </section><!-- /Services Section -->

@endsection

@section('scripts')
@endsection
