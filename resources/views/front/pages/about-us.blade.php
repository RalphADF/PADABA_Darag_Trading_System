{{-- This page is rendered by contact() method inside Front/CmsController.php --}}
@extends('front.layout.layout')


@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>About Us</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="contact.html">About Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Contact-Page -->
    <div class="page-contact u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="touch-wrapper">
                        <h1 class="contact-h1">Darag Chicken</h1>


                        {{-- Displaying Laravel Validation Errors: https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors --}}    
                        {{-- Determining If An Item Exists In The Session (using has() method): https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session --}}
                        @if (Session::has('error_message')) <!-- Check AdminController.php, updateAdminPassword() method -->
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error:</strong> {{ Session::get('error_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif



                        {{-- Displaying Laravel Validation Errors: https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors --}}    
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">

                                @php
                                    echo implode('', $errors->all('<div>:message</div>'))
                                @endphp

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif


                        {{-- Displaying The Validation Errors: https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors AND https://laravel.com/docs/9.x/blade#validation-errors --}} 
                        {{-- Determining If An Item Exists In The Session (using has() method): https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session --}}
                        {{-- Our Bootstrap success message in case of updating admin password is successful: --}}
                        {{-- Displaying Success Message --}}
                        @if (Session::has('success_message')) <!-- Check vendorRegister() method in Front/VendorController.php -->
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success:</strong> {{ Session::get('success_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif


                       

                            <div class="group-inline u-s-m-b-30">
                                <div class="group-1 u-s-p-r-16" style="color: black;">
                                    <label for="contact-name" style="font-family: 'Poppins', sans-serif; font-weight: bold; font-size: 20px;"> DARAG CHICKEN
                                    </label>
                                    <h6 style="font-family: 'Poppins', sans-serif; font-size: 18px; ">
                                    The Darag chicken, native to the Philippines, is facing extinction due to hybridization and mass production, being replaced by fast-food chains. Known for its unique flavor and leaner texture, it is suitable for lactating mothers and cooking.
                                    </h6>
                                </div>

                                <div class="group-2">
                                </div>

                            </div>

                            <div class="u-s-m-b-30">
                            </div>

                            <div class="u-s-m-b-30">
                            </div>

                            <div class="u-s-m-b-30">
                            </div>
                        
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="information-about-wrapper">
                        <h1 class="contact-h1">Information About Us</h1>
                        <p style="font-family: 'Poppins', sans-serif; font-size: 15px">
                        Panay Darag Chicken Breeders Association Inc. (PADABA) was founded last March 2017 with the Help of the West Visayas State University - Research and Development. Duly registered to Security and Exchange Commission last April 27, 2017 with Registration Number CN 201713972 and also registered to Bureau of Internal Revenue.</p>
                        <p style="font-family: 'Poppins', sans-serif; font-size: 15px">
                        PADABA Focuses solely in the propagation and preservation of the Darag Native Chicken.
                        </p>
                    </div>
                    <div class="contact-us-wrapper">
                        <h1 class="contact-h1">Contact Us</h1>
                        <div class="contact-material u-s-m-b-16">
                            <h6>Location</h6>
                            <span>Iloilo City</span>
                            <span>La Paz, Iloilo</span>
                        </div>
                        <div class="contact-material u-s-m-b-16">
                            <h6>Email</h6>
                            <span>padaba@gmail.com</span>
                        </div>
                        <div class="contact-material u-s-m-b-16">
                            <h6>Contact Numbers</h6>
                            <span>Smart: 09617880022</span>
                            <span>Globe: 09164632232</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="u-s-p-t-80">
            <div id="map"></div>
        </div>
    </div>
    <!-- Contact-Page /- -->
@endsection