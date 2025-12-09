@extends('frontend.layout.app')
@section('title', 'Featured Cars')
@section('css')
@endsection
@section('content')
    <section id="featured-cars" class="featured-cars">
        <div class="container">
            <div class="section-header light">
                <p>Explore Our Collection</p>
                <h2>Featured Cars</h2>
            </div>
            <div class="featured-cars-content">
                <div class="row">
                    @forelse ($cars_data as $car)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="single-featured-cars">
                                <div class="featured-img-box">
                                    <div class="featured-cars-img">
                                        <img src="{{ asset('storage/' . $car['first_image']) }}" alt="{{ $car['title'] }}">
                                    </div>
                                    <a href="{{ route('frontend.featured_cars.show', ['id' => $car['id']]) }}">
                                        <div class="featured-model-info">
                                            <p>
                                                <span><i class="fa fa-calendar"></i> {{ $car['model'] }}</span>
                                                <span><i class="fa fa-tachometer"></i> {{ number_format($car['mileage']) }} mi</span>
                                                <span><i class="fa fa-cog"></i> {{ ucfirst($car['transmission']) }}</span>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="featured-cars-txt">
                                    <h2>
                                        <a href="{{ route('frontend.featured_cars.show', ['id' => $car['id']]) }}">
                                            {{ $car['brand_name'] }} {{ $car['title'] }}
                                        </a>
                                    </h2>
                                    <h3>£{{ number_format($car['price'], 2) }}</h3>
                                    <p>{{ Str::limit($car['description'], 80) }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <div style="padding: 60px 20px; background: rgba(255,255,255,0.05); border-radius: 16px;">
                                <i class="fa fa-car" style="font-size: 48px; color: #6366f1; margin-bottom: 20px;"></i>
                                <h3 style="color: #fff; margin-bottom: 10px;">No Cars Available</h3>
                                <p style="color: #94a3b8;">Check back soon for our latest inventory.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
@section('javascript')
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif
    </script>
@endsection
