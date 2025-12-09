@extends('frontend.layout.app')
@section('title', 'Brands')
@section('css')
<style>
    .brands-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        padding: 180px 0 100px;
        position: relative;
        overflow: hidden;
    }

    .brands-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .brands-hero .section-header {
        position: relative;
        z-index: 1;
    }

    .brands-hero .section-header p {
        color: #818cf8;
    }

    .brands-hero .section-header h2 {
        color: #fff;
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .brands-hero .section-header h2::after {
        display: none;
    }

    .hero-description {
        color: #94a3b8;
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.8;
    }

    .brands-section {
        background: linear-gradient(180deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
        padding: 80px 0 100px;
        position: relative;
    }

    .brands-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        margin-top: -40px;
        position: relative;
        z-index: 10;
    }

    .brand-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 3rem 2rem;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .brand-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(139, 92, 246, 0.05) 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .brand-card:hover {
        transform: translateY(-10px);
        border-color: rgba(99, 102, 241, 0.4);
        box-shadow: 0 25px 50px -12px rgba(99, 102, 241, 0.3);
    }

    .brand-card:hover::before {
        opacity: 1;
    }

    .brand-logo {
        width: 120px;
        height: 80px;
        margin: 0 auto 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 1;
    }

    .brand-logo img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        filter: grayscale(100%) brightness(0.8);
        opacity: 0.7;
        transition: all 0.4s ease;
    }

    .brand-card:hover .brand-logo img {
        filter: grayscale(0%) brightness(1);
        opacity: 1;
        transform: scale(1.1);
    }

    .brand-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        font-weight: 600;
        color: #fff;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
    }

    .brand-card p {
        font-size: 0.875rem;
        color: #64748b;
        position: relative;
        z-index: 1;
    }

    .brand-card:hover p {
        color: #94a3b8;
    }

    /* Featured Brands Carousel */
    .featured-brands {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        padding: 60px 0;
        position: relative;
        overflow: hidden;
    }

    .featured-brands::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .featured-brands .section-title {
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
        z-index: 1;
    }

    .featured-brands .section-title h3 {
        font-size: 1.5rem;
        color: #fff;
        font-weight: 600;
    }

    .featured-brands .brand-area {
        position: relative;
        z-index: 1;
    }

    .featured-brands .brand-area .item {
        padding: 1rem;
    }

    .featured-brands .brand-area .item a {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
        height: 100px;
    }

    .featured-brands .brand-area .item a:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-5px);
    }

    .featured-brands .brand-area .owl-carousel .owl-item img {
        height: 50px;
        width: auto;
        max-width: 100px;
        object-fit: contain;
        filter: brightness(0) invert(1);
        opacity: 0.9;
        transition: all 0.3s ease;
    }

    .featured-brands .brand-area .item a:hover img {
        opacity: 1;
        transform: scale(1.1);
    }

    /* Why Choose Section */
    .why-choose {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        padding: 80px 0;
    }

    .why-choose .section-header {
        margin-bottom: 3rem;
    }

    .why-choose .section-header p {
        color: #818cf8;
    }

    .why-choose .section-header h2 {
        color: #fff;
    }

    .why-choose .section-header h2::after {
        display: none;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
    }

    .feature-item {
        text-align: center;
        padding: 2rem 1.5rem;
        background: rgba(255, 255, 255, 0.02);
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.3s ease;
    }

    .feature-item:hover {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(99, 102, 241, 0.3);
        transform: translateY(-5px);
    }

    .feature-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.2) 0%, rgba(139, 92, 246, 0.1) 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .feature-item:hover .feature-icon {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    }

    .feature-icon i {
        font-size: 1.75rem;
        color: #818cf8;
        transition: color 0.3s ease;
    }

    .feature-item:hover .feature-icon i {
        color: #fff;
    }

    .feature-item h4 {
        font-size: 1.1rem;
        color: #fff;
        margin-bottom: 0.75rem;
        font-family: 'Inter', sans-serif;
        font-weight: 600;
    }

    .feature-item p {
        font-size: 0.875rem;
        color: #64748b;
        line-height: 1.6;
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
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
        .brands-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .features-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .brands-hero .section-header h2 {
            font-size: 2.25rem;
        }
    }

    @media (max-width: 767px) {
        .brands-grid {
            grid-template-columns: 1fr;
        }

        .features-grid {
            grid-template-columns: 1fr;
        }

        .cta-content h2 {
            font-size: 1.75rem;
        }
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="brands-hero">
        <div class="container">
            <div class="section-header">
                <p>Our Partners</p>
                <h2>Premium Brands We Deal With</h2>
                <p class="hero-description">
                    We partner with the world's most prestigious automotive brands to bring you
                    the finest selection of vehicles with guaranteed authenticity and quality.
                </p>
            </div>
        </div>
    </section>

    <!-- Brands Grid -->
    <section class="brands-section">
        <div class="container">
            <div class="brands-grid">
                <div class="brand-card">
                    <div class="brand-logo">
                        <img src="{{ asset('assets/images/brand/br1.png') }}" alt="BMW">
                    </div>
                    <h3>BMW</h3>
                    <p>German Excellence</p>
                </div>

                <div class="brand-card">
                    <div class="brand-logo">
                        <img src="{{ asset('assets/images/brand/br2.png') }}" alt="Mercedes-Benz">
                    </div>
                    <h3>Mercedes-Benz</h3>
                    <p>The Best or Nothing</p>
                </div>

                <div class="brand-card">
                    <div class="brand-logo">
                        <img src="{{ asset('assets/images/brand/br3.png') }}" alt="Audi">
                    </div>
                    <h3>Audi</h3>
                    <p>Vorsprung durch Technik</p>
                </div>

                <div class="brand-card">
                    <div class="brand-logo">
                        <img src="{{ asset('assets/images/brand/br4.png') }}" alt="Toyota">
                    </div>
                    <h3>Toyota</h3>
                    <p>Let's Go Places</p>
                </div>

                <div class="brand-card">
                    <div class="brand-logo">
                        <img src="{{ asset('assets/images/brand/br5.png') }}" alt="Honda">
                    </div>
                    <h3>Honda</h3>
                    <p>The Power of Dreams</p>
                </div>

                <div class="brand-card">
                    <div class="brand-logo">
                        <img src="{{ asset('assets/images/brand/br6.png') }}" alt="Ford">
                    </div>
                    <h3>Ford</h3>
                    <p>Built Ford Tough</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Brands Carousel -->
    <section class="featured-brands">
        <div class="container">
            <div class="section-title">
                <h3>Trusted by Leading Automotive Brands Worldwide</h3>
            </div>
            <div class="brand-area">
                <div class="owl-carousel owl-theme brand-item">
                    <div class="item">
                        <a href="#">
                            <img src="{{ asset('assets/images/brand/br1.png') }}" alt="BMW" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="#">
                            <img src="{{ asset('assets/images/brand/br2.png') }}" alt="Mercedes" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="#">
                            <img src="{{ asset('assets/images/brand/br3.png') }}" alt="Audi" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="#">
                            <img src="{{ asset('assets/images/brand/br4.png') }}" alt="Toyota" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="#">
                            <img src="{{ asset('assets/images/brand/br5.png') }}" alt="Honda" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="#">
                            <img src="{{ asset('assets/images/brand/br6.png') }}" alt="Ford" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Section -->
    <section class="why-choose">
        <div class="container">
            <div class="section-header text-center">
                <p>Why Choose Us</p>
                <h2>Benefits of Buying From Us</h2>
            </div>
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fa fa-certificate"></i>
                    </div>
                    <h4>Certified Vehicles</h4>
                    <p>All our vehicles undergo rigorous quality checks</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fa fa-shield"></i>
                    </div>
                    <h4>Warranty Included</h4>
                    <p>Comprehensive warranty on every purchase</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fa fa-handshake-o"></i>
                    </div>
                    <h4>Best Price Guarantee</h4>
                    <p>Competitive pricing with price match promise</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fa fa-headphones"></i>
                    </div>
                    <h4>24/7 Support</h4>
                    <p>Round the clock customer assistance</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Find Your Perfect Brand</h2>
                <p>Explore our collection of premium vehicles from world-renowned manufacturers.</p>
                <a href="{{ route('frontend.featured_cars') }}" class="cta-btn">
                    <i class="fa fa-car"></i>
                    View All Cars
                </a>
            </div>
        </div>
    </section>
@endsection
