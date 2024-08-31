@extends('frontend.layout.app')
@section('title', 'Brand')
@section('css')
@endsection
@section('content')
    <section id="brand" class="brand">
        <div class="container">
            <div class="section-header">
                <p style="color: rgb(0, 0, 0)">Brands<span> of</span> your choice</p>
                <h2 style="color: aliceblue;">Brands WE deal</h2>
            </div><!--/.section-header-->
            <div class="brand-area" style="padding-top: 60px">
                <div class="owl-carousel owl-theme brand-item">
                    <div class="item">
                        <a href="#">
                            <img src="assets/images/brand/br1.png" alt="brand-image" />
                        </a>
                    </div><!--/.item-->
                    <div class="item">
                        <a href="#">
                            <img src="assets/images/brand/br2.png" alt="brand-image" />
                        </a>
                    </div><!--/.item-->
                    <div class="item">
                        <a href="#">
                            <img src="assets/images/brand/br3.png" alt="brand-image" />
                        </a>
                    </div><!--/.item-->
                    <div class="item">
                        <a href="#">
                            <img src="assets/images/brand/br4.png" alt="brand-image" />
                        </a>
                    </div><!--/.item-->

                    <div class="item">
                        <a href="#">
                            <img src="assets/images/brand/br5.png" alt="brand-image" />
                        </a>
                    </div><!--/.item-->

                    <div class="item">
                        <a href="#">
                            <img src="assets/images/brand/br6.png" alt="brand-image" />
                        </a>
                    </div><!--/.item-->
                </div><!--/.owl-carousel-->
            </div><!--/.clients-area-->

        </div><!--/.container-->

    </section><!--/brand-->
@endsection

