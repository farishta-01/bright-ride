@extends('frontend.layout.app')
@section('title', 'Services')
@section('css')
<style>
    .services-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        padding: 180px 0 100px;
        position: relative;
        overflow: hidden;
    }

    .services-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .services-hero .section-header {
        position: relative;
        z-index: 1;
    }

    .services-hero .section-header p {
        color: #818cf8;
    }

    .services-hero .section-header h2 {
        color: #fff;
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .services-hero .section-header h2::after {
        display: none;
    }

    .hero-description {
        color: #94a3b8;
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.8;
    }

    .services-section {
        background: linear-gradient(180deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
        padding: 80px 0 100px;
        position: relative;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        margin-top: -60px;
        position: relative;
        z-index: 10;
    }

    .service-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 2.5rem 2rem;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }

    .service-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.05) 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: -1;
    }

    .service-card:hover {
        transform: translateY(-10px);
        border-color: rgba(99, 102, 241, 0.3);
        box-shadow: 0 25px 50px -12px rgba(99, 102, 241, 0.25);
    }

    .service-card:hover::before {
        transform: scaleX(1);
    }

    .service-card:hover::after {
        opacity: 1;
    }

    .service-icon {
        width: 90px;
        height: 90px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.2) 0%, rgba(139, 92, 246, 0.1) 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s ease;
        position: relative;
    }

    .service-icon::before {
        content: '';
        position: absolute;
        inset: -2px;
        background: linear-gradient(135deg, #6366f1, #a855f7);
        border-radius: 22px;
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: -1;
    }

    .service-card:hover .service-icon {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        transform: scale(1.1) rotate(5deg);
    }

    .service-card:hover .service-icon::before {
        opacity: 1;
    }

    .service-icon i,
    .service-icon [class^="flaticon-"]::before,
    .service-icon [class*=" flaticon-"]::before {
        font-size: 2.5rem;
        color: #818cf8;
        transition: all 0.4s ease;
    }

    .service-card:hover .service-icon i,
    .service-card:hover .service-icon [class^="flaticon-"]::before,
    .service-card:hover .service-icon [class*=" flaticon-"]::before {
        color: #fff;
    }

    .service-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.375rem;
        font-weight: 600;
        color: #fff;
        margin-bottom: 1rem;
        transition: color 0.3s ease;
    }

    .service-card:hover h3 {
        color: #c7d2fe;
    }

    .service-card p {
        font-size: 0.95rem;
        color: #94a3b8;
        line-height: 1.8;
        margin-bottom: 1.5rem;
    }

    .service-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #818cf8;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .service-link i {
        transition: transform 0.3s ease;
    }

    .service-card:hover .service-link {
        color: #c7d2fe;
    }

    .service-card:hover .service-link i {
        transform: translateX(5px);
    }

    /* Stats Section */
    .stats-section {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        padding: 60px 0;
        position: relative;
        overflow: hidden;
    }

    .stats-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        position: relative;
        z-index: 1;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.8);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        padding: 80px 0;
        text-align: center;
    }

    .cta-content h2 {
        font-size: 2.5rem;
        color: #fff;
        margin-bottom: 1rem;
    }

    .cta-content p {
        color: #94a3b8;
        font-size: 1.1rem;
        max-width: 500px;
        margin: 0 auto 2rem;
    }

    .cta-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 2.5rem;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: #fff;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .cta-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 40px rgba(99, 102, 241, 0.4);
        color: #fff;
    }

    @media (max-width: 991px) {
        .services-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem 1rem;
        }

        .services-hero .section-header h2 {
            font-size: 2.25rem;
        }
    }

    @media (max-width: 767px) {
        .services-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .stat-number {
            font-size: 2.25rem;
        }

        .cta-content h2 {
            font-size: 1.75rem;
        }
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="services-hero">
        <div class="container">
            <div class="section-header">
                <p>What We Offer</p>
                <h2>Premium Services for Your Journey</h2>
                <p class="hero-description">
                    We're committed to providing exceptional automotive services that exceed your expectations.
                    From purchase to maintenance, we've got you covered.
                </p>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="services-section">
        <div class="container">
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="flaticon-car"></i>
                    </div>
                    <h3>Largest Dealership Network</h3>
                    <p>
                        Access our extensive network of dealerships across the country.
                        Find your perfect vehicle from thousands of certified options.
                    </p>
                    <a href="#" class="service-link">
                        Learn More <i class="fa fa-arrow-right"></i>
                    </a>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="flaticon-car-repair"></i>
                    </div>
                    <h3>Unlimited Repair Warranty</h3>
                    <p>
                        Drive with confidence with our comprehensive warranty coverage.
                        Enjoy unlimited repairs and maintenance support.
                    </p>
                    <a href="#" class="service-link">
                        Learn More <i class="fa fa-arrow-right"></i>
                    </a>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="flaticon-car-1"></i>
                    </div>
                    <h3>Complete Insurance Support</h3>
                    <p>
                        Get fully covered with our tailored insurance packages.
                        We partner with top insurers for the best protection.
                    </p>
                    <a href="#" class="service-link">
                        Learn More <i class="fa fa-arrow-right"></i>
                    </a>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fa fa-credit-card"></i>
                    </div>
                    <h3>Flexible Financing Options</h3>
                    <p>
                        Make your dream car affordable with easy financing solutions.
                        Low interest rates and flexible payment plans available.
                    </p>
                    <a href="#" class="service-link">
                        Learn More <i class="fa fa-arrow-right"></i>
                    </a>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fa fa-exchange"></i>
                    </div>
                    <h3>Easy Trade-In Process</h3>
                    <p>
                        Upgrade your vehicle hassle-free with our simple trade-in program.
                        Get the best value for your current car.
                    </p>
                    <a href="#" class="service-link">
                        Learn More <i class="fa fa-arrow-right"></i>
                    </a>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fa fa-truck"></i>
                    </div>
                    <h3>Home Delivery Service</h3>
                    <p>
                        Can't visit us? We deliver your purchased vehicle directly
                        to your doorstep with contactless delivery.
                    </p>
                    <a href="#" class="service-link">
                        Learn More <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Cars Available</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">10K+</div>
                    <div class="stat-label">Happy Customers</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Brand Partners</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Years Experience</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to Find Your Dream Car?</h2>
                <p>Browse our extensive collection of premium vehicles and find the perfect match for your lifestyle.</p>
                <a href="{{ route('frontend.featured_cars') }}" class="cta-btn">
                    <i class="fa fa-car"></i>
                    Browse Our Collection
                </a>
            </div>
        </div>
    </section>
@endsection
