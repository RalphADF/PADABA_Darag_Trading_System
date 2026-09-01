{{-- @extends('front.layout.layout')

@section('content')
    <!-- Main-Slider -->
    <div class="default-height ph-item position-relative">
        <div class="slider-main owl-carousel">
            @foreach ($sliderBanners as $banner)
                <div class="bg-image d-flex align-items-center justify-content-center" style="height: 400px; overflow: hidden;">
                    <div class="slide-content text-center">
                        <a href="{{ !empty($banner['link']) ? url($banner['link']) : 'javascript:;' }}">
                            <img src="{{ asset('front/images/banner_images/' . $banner['image']) }}" alt="{{ $banner['title'] }}" class="img-fluid" style="max-height: 100%; width: auto; object-fit: contain;">
                        </a>
                        <h2>{{ $banner['title'] }}</h2>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container mt-5 pt-5">
        @if (!empty($fixBanners[1]['image']))
            <div class="banner-layer text-center my-4">
                <a href="{{ url($fixBanners[1]['link']) }}" target="_blank" class="d-block">
                    <img class="img-fluid" src="{{ asset('front/images/banner_images/' . $fixBanners[1]['image']) }}" alt="{{ $fixBanners[1]['alt'] }}">
                </a>
            </div>
        @endif
    </div>

    <section class="section-maker mt-5">
        <div class="container">
            <div class="sec-maker-header text-center pt-5">
                <h3>Products</h3>
                <ul class="nav nav-tabs justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#new-arrivals">New Arrivals</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="new-arrivals">
                    <div class="row">
                        @foreach ($newProducts as $product)
                            <div class="col-md-6 col-lg-3 mb-4">
                                <div class="card product-card">
                                    <a href="{{ url('product/' . $product['id']) }}">
                                        <img class="card-img-top" src="{{ asset('front/images/product_images/small/' . ($product['product_image'] ?? 'no-image.png')) }}" alt="{{ $product['product_name'] }}">
                                    </a>
                                    <div class="card-body text-center">
                                        <h6><a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a></h6>
                                        <p class="text-muted">{{ $product['product_code'] }}</p>
                                        @php
                                            $discountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                        @endphp
                                        <p class="font-weight-bold text-danger">
                                            ₱ {{ $discountPrice > 0 ? number_format($discountPrice, 2) : number_format($product['product_price'], 2) }}
                                        </p>
                                        <a href="{{ url('product/' . $product['id']) }}" class="btn btn-primary btn-sm">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr>
    <section class="app-priority py-5 bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="priority-item">
                        <i class="ion ion-md-star display-4" style="color: rgb(111, 125, 95)"></i>
                        <h5>Exceptional Quality</h5>
                        <p>Enjoy rich flavor, adaptability, and sustainability with our premium, locally raised Panay Darag Native Chicken.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="priority-item">
                        <i class="ion ion-md-cash display-4" style="color: rgb(111, 125, 95)"></i>
                        <h5>Raise with Confidence</h5>
                        <p>We ensure healthy, sustainable farming from hatch to harvest.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="priority-item">
                        <i class="ion ion-ios-card display-4" style="color: rgb(111, 125, 95)"></i>
                        <h5>Secure Purchase</h5>
                        <p>Order your Panay Darag Native Chicken with peace of mind.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="priority-item">
                        <i class="ion ion-md-contacts display-4" style="color: rgb(111, 125, 95)"></i>
                        <h5>Reliable Support</h5>
                        <p>Get expert guidance and assistance anytime.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection --}}

@extends('front.layout.layout')

@section('content')
    <!-- Main-Slider -->
    <div class="container mt-4 p-3 border rounded">
        <div class="slider-main owl-carousel position-relative">
            @foreach ($sliderBanners as $banner)
                <div class="bg-image d-flex align-items-center justify-content-center" style="height: 400px; overflow: hidden;">
                    <div class="slide-content text-center w-100">
                        <a href="{{ !empty($banner['link']) ? url($banner['link']) : 'javascript:;' }}">
                            <img src="{{ asset('front/images/banner_images/' . $banner['image']) }}" 
                                alt="{{ $banner['title'] }}" 
                                class="img-fluid d-block mx-auto" 
                                style="max-height: 100%; width: auto; object-fit: contain;">
                        </a>
                        <h2 class="mt-3">{{ $banner['title'] }}</h2>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    

    <div class="container mt-5 pt-5">
        @if (!empty($fixBanners[1]['image']))
            <div class="banner-layer text-center my-4">
                <a href="{{ url($fixBanners[1]['link']) }}" target="_blank" class="d-block">
                    <img class="img-fluid" src="{{ asset('front/images/banner_images/' . $fixBanners[1]['image']) }}" alt="{{ $fixBanners[1]['alt'] }}">
                </a>
            </div>
        @endif
    </div>

    <section class="section-maker mt-5">
        <div class="container">
            <div class="sec-maker-header text-center pt-5">
                <h3>Products</h3>
                <ul class="nav nav-tabs justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#new-arrivals">New Arrivals</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="new-arrivals">
                    <div class="row">
                        @foreach ($newProducts as $product)
                            <div class="col-md-6 col-lg-3 mb-4">
                                <div class="card product-card">
                                    <a href="{{ url('product/' . $product['id']) }}">
                                        <img class="card-img-top" src="{{ asset('front/images/product_images/small/' . ($product['product_image'] ?? 'no-image.png')) }}" alt="{{ $product['product_name'] }}">
                                    </a>
                                    <div class="card-body text-center">
                                        <h6><a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a></h6>
                                        <p class="text-muted">{{ $product['product_code'] }}</p>
                                        @php
                                            $discountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                        @endphp
                                        <p class="font-weight-bold text-danger">
                                            ₱ {{ $discountPrice > 0 ? number_format($discountPrice, 2) : number_format($product['product_price'], 2) }}
                                        </p>
                                        <a href="{{ url('product/' . $product['id']) }}" class="btn btn-primary btn-sm">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="app-priority py-5 bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="priority-item">
                        <i class="ion ion-md-star display-4" style="color: #6f7d5f"></i>
                        <h5>Exceptional Quality</h5>
                        <p>Enjoy rich flavor, adaptability, and sustainability with our premium, locally raised Panay Darag Native Chicken.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="priority-item">
                        <i class="ion ion-md-cash display-4" style="color: #6f7d5f"></i>
                        <h5>Raise with Confidence</h5>
                        <p>We ensure healthy, sustainable farming from hatch to harvest.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="priority-item">
                        <i class="ion ion-ios-card display-4" style="color: #6f7d5f"></i>
                        <h5>Secure Purchase</h5>
                        <p>Order your Panay Darag Native Chicken with peace of mind.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="priority-item">
                        <i class="ion ion-md-contacts display-4" style="color: #6f7d5f"></i>
                        <h5>Reliable Support</h5>
                        <p>Get expert guidance and assistance anytime.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
