@extends('frontend.layout.app')
@section('title', 'Cars')
@section('css')
@endsection
@section('content')

    <section id="featured-cars" class="featured-cars">
        <div class="container">
            <div class="section-header">
                <p style="color: rgb(0, 0, 0)">checkout <span>the</span> featured cars</p>
                <h2 style="color: aliceblue;">featured cars</h2>
            </div><!--/.section-header-->
            <div class="featured-cars-content">
                <div class="row">
                    @foreach ($cars_data as $car)
                        {{-- {{ dd($car['first_image']) }} --}}
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="single-featured-cars">
                                <div class="featured-img-box">
                                    <div class="featured-cars-img">
                                        <img src="{{ asset('storage/' . $car['first_image']) }}" alt="Car Image">
                                    </div>
                                    <a href="{{ route('frontend.featured_cars.show', ['id' => $car['id']]) }}">
                                        <div class="featured-model-info">
                                            <p>
                                                model: {{ $car['model'] }}
                                                <span class="featured-mi-span">Milage: {{ $car['mileage'] }}
                                                    <small>m/h</small>
                                                </span>

                                                {{ $car['transmission'] }}
                                            </p>
                                        </div>
                                </div>
                                <div class="featured-cars-txt">
                                    <h2><a href="#">{{ $car['brand_name'] }} {{ $car['title'] }}</a></h2>
                                    <h3>£ {{ number_format($car['price'], 2) }}</h3>
                                    </a>
                                    <h6 class="text-info">
                                        {{ $car['description'] }}
                                    </h6>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div><!--/.row-->
            </div><!--/.featured-cars-content-->

    </section><!--/.featured-cars-->
@endsection
@section('javascript')
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif
    </script>

@endsection
