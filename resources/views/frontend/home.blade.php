@extends('frontend.layout.app')
@section('title', 'Home')
@section('css')
@endsection
@section('content')
    <section id="home" class="welcome-hero">
        <div class="container">
            <div class="welcome-hero-txt">
                <div class="hero-badge">
                    <i class="fa fa-star"></i>
                    <span>Premium Car Dealership</span>
                </div>
                <h2>Find Your <span>Dream Car</span> at the Best Price</h2>
                <p>
                    Discover an extensive collection of premium vehicles. From luxury sedans to powerful SUVs,
                    we offer the finest selection with unbeatable prices and exceptional service.
                </p>
                <div class="hero-buttons">
                    <a href="{{ route('frontend.featured_cars') }}" class="welcome-btn">
                        <i class="fa fa-car"></i>
                        Browse Cars
                    </a>
                    <a href="{{ route('frontend.contact') }}" class="welcome-btn btn-outline">
                        <i class="fa fa-phone"></i>
                        Contact Us
                    </a>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="model-search-content">
                        <div class="row">
                            <div class="single-model-search">
                                <h2>Select Year</h2>
                                <div class="model-select-icon">
                                    <select class="form-control">
                                        <option value="default">Choose Year</option>
                                        <option value="2024">2024</option>
                                        <option value="2023">2023</option>
                                        <option value="2022">2022</option>
                                        <option value="2021">2021</option>
                                        <option value="2020">2020</option>
                                    </select>
                                </div>
                            </div>
                            <div class="single-model-search">
                                <h2>Body Style</h2>
                                <div class="model-select-icon">
                                    <select class="form-control">
                                        <option value="default">Choose Style</option>
                                        <option value="sedan">Sedan</option>
                                        <option value="suv">SUV</option>
                                        <option value="coupe">Coupe</option>
                                        <option value="hatchback">Hatchback</option>
                                        <option value="convertible">Convertible</option>
                                    </select>
                                </div>
                            </div>
                            <div class="single-model-search">
                                <h2>Select Make</h2>
                                <div class="model-select-icon">
                                    <select class="form-control">
                                        <option value="default">Choose Make</option>
                                        <option value="bmw">BMW</option>
                                        <option value="mercedes">Mercedes-Benz</option>
                                        <option value="audi">Audi</option>
                                        <option value="toyota">Toyota</option>
                                        <option value="honda">Honda</option>
                                    </select>
                                </div>
                            </div>
                            <div class="single-model-search">
                                <h2>Price Range</h2>
                                <div class="model-select-icon">
                                    <select class="form-control">
                                        <option value="default">Choose Price</option>
                                        <option value="0-10000">Under £10,000</option>
                                        <option value="10000-25000">£10,000 - £25,000</option>
                                        <option value="25000-50000">£25,000 - £50,000</option>
                                        <option value="50000+">£50,000+</option>
                                    </select>
                                </div>
                            </div>
                            <div class="single-model-search">
                                <button class="welcome-btn model-search-btn" onclick="window.location.href='{{ route('frontend.featured_cars') }}'">
                                    <i class="fa fa-search"></i>
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('javascript')
@endsection
