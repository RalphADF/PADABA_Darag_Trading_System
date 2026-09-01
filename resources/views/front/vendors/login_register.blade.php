{{-- This page is accessed from Vendor Login tab in the drop-down menu in the header (in front/layout/header.blade.php) --}} 
@extends('front.layout.layout')


@section('content')

    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Account</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="account.html">Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Account-Page -->
    <div class="page-account u-s-p-t-80">
        <div class="container">



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
            {{-- Displaying Error Messages --}}
            @if (Session::has('error_message')) <!-- Check vendorRegister() method in Front/VendorController.php -->
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong> {{ Session::get('error_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            {{-- Displaying Error Messages --}}
            @if ($errors->any()) <!-- Check vendorRegister() method in Front/VendorController.php -->
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong> @php echo implode('', $errors->all('<div>:message</div>')); @endphp
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif



            <div class="row">
                <!-- Login -->
                <div class="col-lg-6">
                    <div class="login-wrapper">
                        <h2 class="account-h2 u-s-m-b-20" style="color: black">Darag Breeder Login</h2>
                        <h6 class="account-h6 u-s-m-b-30">Welcome back! Sign in to your account.</h6>


                        
                        <form action="{{ url('admin/login') }}" method="post"> {{-- the same HTML Form as the one in the Admin Panel in admin/login.blade.php --}}
                            @csrf {{-- https://laravel.com/docs/9.x/csrf#preventing-csrf-requests --}}


                            <div class="u-s-m-b-30">
                                <label for="vendor-email">Email
                                    <span class="astk" style="color:red;">*</span>
                                </label>
                                <input type="email" name="email" id="vendor-email" class="text-field" placeholder="Email">
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="vendor-password">Password
                                    <span class="astk" style="color:red;">*</span>
                                </label>
                                <input type="password" name="password" id="vendor-password" class="text-field" placeholder="Password">
                            </div>
                            <div class="m-b-45">
                                <button class="button button-outline-secondary w-100">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Login /- -->
                <!-- Register -->
                <div class="col-lg-6">
                    <div class="reg-wrapper">
                        <h2 class="account-h2 u-s-m-b-20" style="color: black">Darag Breeder Registration</h2>
                        <h6 class="account-h6 u-s-m-b-30">Registering for this site allows you to access your order status and history.</h6>



                        
                        <form id="vendorForm" action="{{ url('/vendor/register') }}" method="post">
                            @csrf


                            <div class="u-s-m-b-30">
                                <label for="vendorname">First Name
                                    <span class="astk" style="color:red;">*</span>
                                </label>
                                <input type="text" id="vendorname" class="text-field" placeholder="First Name" name="name">
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="vendorname">Middle Name
                                    <span class="astk" style="color:gray;">(Leave blank if none)</span>
                                </label>
                                <input type="text" id="vendorname" class="text-field" placeholder="Middle Name" name="mname">
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="vendorname">Last Name
                                    <span class="astk" style="color:red;">*</span>
                                </label>
                                <input type="text" id="vendorname" class="text-field" placeholder="Last Name" name="lname">
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="vendormobile">Mobile
                                    <span class="astk" style="color:red;">*</span>
                                </label>
                                <input type="text" id="vendormobile" class="text-field" placeholder="Breeder Mobile" name="mobile">
                            </div>

                            <div class="u-s-m-b-30">
                                <label for="vendoremail">Email
                                    <span class="astk" style="color:red;">*</span>
                                </label>
                                <input type="email" id="vendoremail" class="text-field" placeholder="Breeder Email" name="email">
                            </div>

                            <div class="u-s-m-b-30">
                                <label for="vendorpassword">Password
                                    <span class="astk" style="color:red;">*</span>
                                </label>
                                <input type="password" id="vendorpassword" class="text-field" placeholder="Password" name="password">
                            </div>

                            <!-- Membership Status Checkbox -->
                            <div class="u-s-m-b-30">
                                <label for="membershipStatus">Check the box if you are a Certified PADABA Member</label>
                                <input type="checkbox" id="membershipStatus" name="membershipStatus" onclick="toggleRSBSAField()">
                            </div>

                            <!-- RSBSA Number Text Field -->
                            <div class="u-s-m-b-30" id="rsbsaField" style="display: none;">
                                <label for="rsbsaNumber">RSBSA Number</label>
                                <input type="text" id="rsbsaNumber" class="text-field" placeholder="Enter RSBSA Number" name="rsbsaNumber">
                            </div>

                            <script>
                                function toggleRSBSAField() {
                                    var checkbox = document.getElementById("membershipStatus");
                                    var rsbsaField = document.getElementById("rsbsaField");
                                    
                                    if (checkbox.checked) {
                                        rsbsaField.style.display = "block"; // Show RSBSA number field
                                    } else {
                                        rsbsaField.style.display = "none"; // Hide RSBSA number field
                                    }
                                }
                            </script>


                            <!-- Terms & Conditions Checkbox -->
                            <div class="u-s-m-b-30">
                                <input type="checkbox" class="check-box" id="accept" name="accept">
                                <label class="label-text no-color" for="accept">
                                    I’ve read and accept the
                                    <a href="#" class="u-c-brand" data-bs-toggle="modal" data-bs-target="#termsModal">terms & conditions</a>
                                </label>
                            </div>

                            <!-- Terms & Conditions Modal -->
                            <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="termsModalLabel" >Terms and Conditions for Breeder Registration</h5>                                          
                                        </div>
                                        <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                            <style>
                                                h6, h5, p, a {
                                                    color: black !important;
                                                    font-weight: bold;
                                                }

                                                li {
                                                    color: black;
                                                }
                                            </style>

                                            <p>Welcome to PADABA Trading System. By registering as a breeder on our platform, you agree to abide by the following terms and conditions. Please read them carefully before completing your registration.</p>

                                            <hr>

                                            <h6>1. Eligibility</h6>
                                            <ul>
                                                <li>You must be at least 18 years old to register as a breeder.</li>
                                                <li>You agree to provide accurate, complete, and up-to-date information during registration.</li>
                                            </ul>

                                            <h6>2. Account Responsibilities</h6>
                                            <ul>
                                                <li>You are responsible for maintaining the confidentiality of your account credentials.</li>
                                                <li>Any activity conducted through your account will be considered your responsibility. Notify us immediately of unauthorized access.</li>
                                            </ul>

                                            <h6>3. Product Listings</h6>
                                            <ul>
                                                <li>All products listed must comply with local laws and regulations. Prohibited or illegal items are strictly forbidden.</li>
                                                <li>Product descriptions must be accurate and not misleading.</li>
                                            </ul>

                                            <h6>4. Payments and Fees</h6>
                                            <ul>
                                                <li>You agree to pay any applicable fees for listing or transactions as per our fee structure.</li>
                                                <li>Payments for orders will be disbursed after successful order fulfillment, subject to our payment schedule.</li>
                                            </ul>

                                            <h6>5. Order Fulfillment and Returns</h6>
                                            <ul>
                                                <li>Breeders are responsible for timely order processing and shipping.</li>
                                                <li>Breeders must comply with our return and refund policies to ensure customer satisfaction.</li>
                                            </ul>

                                            <h6>6. Prohibited Activities</h6>
                                            <ul>
                                                <li>Breeders must not engage in fraudulent activities, including false advertising, counterfeit products, or manipulation of reviews.</li>
                                                <li>Any violation of these terms may result in account suspension or termination.</li>
                                            </ul>

                                            <h6>7. Intellectual Property</h6>
                                            <ul>
                                                <li>Breeders warrant that they own or have the right to use any trademarks, logos, or copyrighted material associated with their products.</li>
                                            </ul>

                                            <h6>8. Termination</h6>
                                            <ul>
                                                <li>We reserve the right to terminate your breeder account at any time for breaches of these terms or other violations of our policies.</li>
                                            </ul>

                                            <h6>9. Liability and Indemnification</h6>
                                            <ul>
                                                <li>PADABA Trading System is not liable for any disputes arising between breeders and customers.</li>
                                                <li>You agree to indemnify and hold harmless PADABA Trading System from any claims or damages arising from your use of the platform.</li>
                                            </ul>

                                            <h6>10. Amendments</h6>
                                            <ul>
                                                <li>We reserve the right to amend these terms and conditions at any time. Continued use of the platform constitutes your acceptance of any changes.</li>
                                            </ul>

                                            <h6>11. Governing Law</h6>
                                            <ul>
                                                <li>These terms and conditions are governed by the laws of the Philippines.</li>
                                            </ul>

                                            <p>By clicking "Register," you confirm that you have read, understood, and agree to these terms and conditions.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="color: white;"><i class="bi bi-x-square-fill"></i> Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bootstrap JS (Required for Modal) -->
                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


                            <div class="u-s-m-b-45">
                                <button class="button button-primary w-100">Register</button>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- Register /- -->
            </div>
        </div>
    </div>
    <!-- Account-Page /- -->
@endsection