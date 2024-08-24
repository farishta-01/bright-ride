@extends('frontend.layout.app')
@section('title', 'Cars')
@section('css')

    <style>
        .main_section {
            margin: 20% auto;
            /* Default margin for smaller screens */

        }

        /* Adjust margin for screens larger than 993px */
        @media (min-width: 993px) {
            .main_section {
                margin: 10% auto;
                /* Margin for larger screens */
            }
        }

        .description {
            margin: 4% 0;

            color: white;
            /* background-color: #9f2626; */
        }

        /* General styles for the thumbnails container */
        .thumbnails-container {
            display: flex;
            flex-wrap: nowrap;
            /* Ensure thumbnails are in a row */
            overflow-x: auto;
            /* Allow horizontal scrolling if necessary */
            margin-top: 10px;
            justify-content: center;
            position: relative;
            /* Adjust positioning */
        }

        /* Style for thumbnails */
        .thumbnail {
            cursor: pointer;
            height: 70px;
            /* Size of the thumbnails */
            width: 70px;
            /* Size of the thumbnails */
            margin: 5px;
            /* Spacing between thumbnails */
            border: 2px solid #bbb;
            border-radius: 4px;
            transition: border-color 0.6s ease;
        }

        /* Active thumbnail border color */
        .thumbnail:hover,
        .thumbnail.active {
            border-color: #717171;
        }

        /* Adjust layout for larger screens */
        @media (min-width: 1200px) {
            .slideshow-container {
                display: flex;
                flex-direction: column;
                /* Ensure the slideshow and thumbnails stack vertically */
                align-items: center;
                /* Center the slideshow and thumbnails */
            }

            .thumbnails-container {
                position: static;
                /* Default position */
                margin-top: 10px;
            }
        }

        /* Adjust layout for medium screens (between 992px and 1199px) */
        @media (min-width: 992px) and (max-width: 1199px) {
            .slideshow-container {
                display: block;
            }

            .thumbnails-container {
                display: flex;
                flex-wrap: nowrap;
                /* Ensure thumbnails are in a row */
                overflow-x: auto;
                /* Allow horizontal scrolling */
                margin-top: 10px;
                justify-content: center;
            }
        }

        /* Adjust layout for smaller screens */
        @media (max-width: 991px) {
            .slideshow-container {
                display: block;
            }

            .thumbnails-container {
                display: flex;
                flex-wrap: wrap;
                /* Allow wrapping on smaller screens */
                justify-content: center;
                margin-top: 10px;
            }
        }

        /* Optional fading animation for slides */
        .mySlides {
            animation: fade 1.5s ease-in-out;
        }

        @keyframes fade {
            0% {
                opacity: 0;
            }

            20% {
                opacity: 1;
            }

            60% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }
    </style>
@endsection

@section('content')
    <div class="main_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Slideshow Container -->
                    <div class="slideshow-container">
                        @foreach ($car_data['images'] as $index => $image)
                            <div class="mySlides">
                                <img src="{{ asset('storage/' . $image) }}" style="width: 400px" class="d-block"
                                    alt="Car Image">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Thumbnails Container -->
                    <div class="thumbnails-container">
                        @foreach ($car_data['images'] as $index => $image)
                            <img src="{{ asset('storage/' . $image) }}" class="thumbnail"
                                onclick="currentSlide({{ $index + 1 }})" alt="Thumbnail">
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="description">
                <div class="col-lg-8">
                    <h4 class="title text-dark">
                        {{ $car_data['title'] }} <br />
                        {{ $car_data['brand_name'] }}
                    </h4>
                    <div class="d-flex flex-row my-3">
                        <strong>Condition: </strong>
                        <span class="text-warning mb-1 me-2">
                            @php
                                // Get the rating value from the database
                                $rating = 7; // Assuming this value is between 1 and 10

                                // Calculate the number of full and half stars
                                $fullStars = intdiv($rating, 1);
                                $halfStar = $rating % 2 !== 0;
                            @endphp

                            @for ($i = 0; $i < $fullStars; $i++)
                                <i class="fa fa-star"></i>
                            @endfor

                            @if ($halfStar)
                                <i class="fas fa-star-half-alt"></i>
                            @endif

                            @for ($i = $fullStars + (int) $halfStar; $i <= 10; $i++)
                                <i class="fa fa-star-o"></i>
                            @endfor

                            {{-- <strong class="ms-1">{{ $rating }}/10</strong> --}}
                        </span>
                        <br>



                        <strong>Transmission:</strong> {{ ucfirst($car_data['transmission']) }}<br>
                        <strong>Model:</strong> {{ $car_data['model'] }}<br>
                        <strong>Mileage:</strong> {{ $car_data['mileage'] }} miles<br>


                    </div>

                    <div class="mb-3">
                        <strong>Demand: </strong>
                        <span class="h3"> {{ $car_data['price'] }}£</span>
                        <small class="text-muted" style="color: red"> *negotiable price*</small>
                    </div>
                    <strong class="text-success ms-2">Available</strong>
                    <p>
                        {{ $car_data['description'] }}
                    </p>
                    <div class="row mb-4">
                        <a href="{{ route('appointment.create', ['id' => $car_data['id']]) }}" class="btn btn-warning">Book
                            Appointment</a>
                        {{-- <a href="#" class="btn btn-primary "> <i class="me-1 fa fa-shopping-basket"></i> Add to
                            cart </a> --}}
                    </div>
                    <hr />




                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')

    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }
    </script>
@endsection
