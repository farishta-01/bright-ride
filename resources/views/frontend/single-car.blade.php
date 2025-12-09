@extends('frontend.layout.app')
@section('title', $car_data['title'])
@section('css')
<style>
    .single-car-page {
        padding: 140px 0 80px;
        background: var(--gray-50);
        min-height: 100vh;
    }

    .car-gallery {
        position: relative;
    }

    .main-car-image {
        width: 100%;
        height: 450px;
        background: var(--white);
        border-radius: var(--radius-xl);
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
    }

    .main-car-image img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        display: none;
    }

    .main-car-image img.active {
        display: block;
    }

    .car-thumbnails {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        justify-content: center;
    }

    .car-thumbnails .thumb {
        width: 80px;
        height: 80px;
        background: var(--white);
        border-radius: var(--radius-md);
        overflow: hidden;
        cursor: pointer;
        border: 3px solid transparent;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px;
    }

    .car-thumbnails .thumb:hover,
    .car-thumbnails .thumb.active {
        border-color: var(--primary);
        box-shadow: var(--shadow-md);
    }

    .car-thumbnails .thumb img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .car-details {
        background: var(--white);
        border-radius: var(--radius-xl);
        padding: 2.5rem;
        box-shadow: var(--shadow-lg);
        height: 100%;
    }

    .car-brand-badge {
        display: inline-block;
        padding: 0.375rem 1rem;
        background: rgba(99, 102, 241, 0.1);
        color: var(--primary);
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-radius: var(--radius-full);
        margin-bottom: 1rem;
    }

    .car-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 1.5rem;
        font-family: 'Playfair Display', serif;
    }

    .car-price {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 0.5rem;
        font-family: 'Inter', sans-serif;
    }

    .price-note {
        font-size: 0.875rem;
        color: var(--gray-500);
        margin-bottom: 2rem;
    }

    .car-specs-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: var(--gray-50);
        border-radius: var(--radius-lg);
    }

    .spec-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .spec-item .spec-icon {
        width: 44px;
        height: 44px;
        background: var(--white);
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1.1rem;
        box-shadow: var(--shadow-sm);
    }

    .spec-item .spec-info {
        flex: 1;
    }

    .spec-item .spec-info span {
        display: block;
        font-size: 0.7rem;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }

    .spec-item .spec-info strong {
        font-size: 0.95rem;
        color: var(--gray-900);
        font-weight: 600;
    }

    .car-rating {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .car-rating .stars {
        display: flex;
        gap: 0.25rem;
    }

    .car-rating .stars i {
        color: #f59e0b;
        font-size: 1rem;
    }

    .car-rating .stars i.empty {
        color: var(--gray-300);
    }

    .car-rating .rating-text {
        color: var(--gray-600);
        font-size: 0.875rem;
    }

    .availability-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: var(--radius-full);
        margin-bottom: 1rem;
    }

    .availability-badge::before {
        content: '';
        width: 8px;
        height: 8px;
        background: #10b981;
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .car-description {
        color: var(--gray-600);
        line-height: 1.8;
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid var(--gray-200);
    }

    .btn-book {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        width: 100%;
        padding: 1rem 2rem;
        background: var(--primary);
        color: var(--white);
        font-size: 1rem;
        font-weight: 600;
        border-radius: var(--radius-lg);
        border: none;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
    }

    .btn-book:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 0 40px rgba(99, 102, 241, 0.3);
        color: var(--white);
    }

    @media (max-width: 991px) {
        .car-details {
            margin-top: 2rem;
        }

        .car-specs-grid {
            grid-template-columns: 1fr;
        }

        .main-car-image {
            height: 300px;
        }

        .car-title {
            font-size: 1.5rem;
        }

        .car-price {
            font-size: 2rem;
        }
    }
</style>
@endsection

@section('content')
    <section class="single-car-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="car-gallery">
                        <div class="main-car-image">
                            @foreach ($car_data['images'] as $index => $image)
                                <img src="{{ asset('storage/' . $image) }}"
                                     class="{{ $index === 0 ? 'active' : '' }}"
                                     alt="{{ $car_data['title'] }}"
                                     id="main-img-{{ $index }}">
                            @endforeach
                        </div>

                        <div class="car-thumbnails">
                            @foreach ($car_data['images'] as $index => $image)
                                <div class="thumb {{ $index === 0 ? 'active' : '' }}"
                                     onclick="changeImage({{ $index }})">
                                    <img src="{{ asset('storage/' . $image) }}" alt="Thumbnail {{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="car-details">
                        <span class="car-brand-badge">{{ $car_data['brand_name'] }}</span>
                        <h1 class="car-title">{{ $car_data['title'] }}</h1>

                        <div class="availability-badge">Available Now</div>

                        <div class="car-price">£{{ number_format($car_data['price'], 2) }}</div>
                        <p class="price-note">*Price is negotiable</p>

                        <div class="car-specs-grid">
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fa fa-cog"></i>
                                </div>
                                <div class="spec-info">
                                    <span>Transmission</span>
                                    <strong>{{ ucfirst($car_data['transmission']) }}</strong>
                                </div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="spec-info">
                                    <span>Model</span>
                                    <strong>{{ $car_data['model'] }}</strong>
                                </div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fa fa-tachometer"></i>
                                </div>
                                <div class="spec-info">
                                    <span>Mileage</span>
                                    <strong>{{ number_format($car_data['mileage']) }} miles</strong>
                                </div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fa fa-check-circle"></i>
                                </div>
                                <div class="spec-info">
                                    <span>Condition</span>
                                    <strong>Excellent</strong>
                                </div>
                            </div>
                        </div>

                        <div class="car-rating">
                            <div class="stars">
                                @php
                                    $rating = 7;
                                    $fullStars = floor($rating / 2);
                                    $halfStar = $rating % 2;
                                @endphp
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $fullStars)
                                        <i class="fa fa-star"></i>
                                    @elseif ($i == $fullStars && $halfStar)
                                        <i class="fa fa-star-half-o"></i>
                                    @else
                                        <i class="fa fa-star-o empty"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="rating-text">Condition Rating: {{ $rating }}/10</span>
                        </div>

                        <p class="car-description">{{ $car_data['description'] }}</p>

                        <a href="{{ route('appointment.create', ['id' => $car_data['id']]) }}" class="btn-book">
                            <i class="fa fa-calendar-check-o"></i>
                            Book Appointment
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
<script>
    function changeImage(index) {
        // Remove active from all images and thumbnails
        document.querySelectorAll('.main-car-image img').forEach(img => {
            img.classList.remove('active');
        });
        document.querySelectorAll('.car-thumbnails .thumb').forEach(thumb => {
            thumb.classList.remove('active');
        });

        // Add active to selected
        document.getElementById('main-img-' + index).classList.add('active');
        document.querySelectorAll('.car-thumbnails .thumb')[index].classList.add('active');
    }
</script>
@endsection
