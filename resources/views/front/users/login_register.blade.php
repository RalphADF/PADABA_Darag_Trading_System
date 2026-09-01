{{-- This page is accessed from Customer Login tab in the dropdown menu in the header (in front/layout/header.blade.php) --}} 
@extends('front.layout.layout')


@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Account</h2>
                <ul class="bread-crumb">
                    <li style="color: black;" class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="index.html">Home</a>
                    </li>
                    <li style="color: black;" class="is-marked">
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
            @if (Session::has('success_message')) <!-- Check userRegister() method in Front/UserController.php -->
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success:</strong> {{ Session::get('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            {{-- Displaying Error Messages --}}
            @if (Session::has('error_message')) <!-- Check userRegister() method in Front/UserController.php -->
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong> {{ Session::get('error_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            {{-- Displaying Error Messages --}}
            @if ($errors->any()) <!-- Check userRegister() method in Front/UserController.php -->
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
                        <h2 class="account-h2 u-s-m-b-20"style="color:black;">Customer Login</h2>
                        <h6 style="font-weight: bold; color: black;" class="account-h6 u-s-m-b-30">Welcome back! Sign in to your account.</h6>


                        

                        {{-- Note: To show the form's Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend), we create a <p> tag after every <input> field --}} {{-- We structure and use a certain pattern so that the <p> id pattern must be like: delivery-x (e.g. delivery-mobile, delivery-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="delivery-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                        <p id="login-error"></p> {{-- if the Validation passes / is okay but the login credentials provided by the user are incorrect, this'll be used by jQuery to show a generic 'Wrong Credentials!' message. Or to show a message when the user's account is inactive/disabled/deactivated --}}
                        <form id="loginForm" action="javascript:;" method="post"> {{-- We need to deactivate the 'action' HTML attribute (using    'javascript:;'    ) as we'r going to submit using an AJAX call. Check front/js/custom.js --}}
                            @csrf {{-- Preventing CSRF Requests: https://laravel.com/docs/9.x/csrf#preventing-csrf-requests --}}


                            <div class="u-s-m-b-30">
                                <label for="user-email">Email
                                    <span class="astk">*</span>
                                </label>
                                <input type="email" name="email" id="users-email" class="text-field" placeholder="Email" name="email">
                                <p id="login-email"></p> {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="user-password">Password
                                    <span class="astk">*</span>
                                </label>
                                <input type="password" name="password" id="users-password" class="text-field" placeholder="Password" name="password">
                                <p id="login-password"></p> {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                            </div>



                            <div class="group-inline u-s-m-b-30">

                                {{-- Remember Me Functionality --}}
                                {{-- <div class="group-1">
                                    <input type="checkbox" class="check-box" id="remember-me-token">
                                    <label class="label-text" for="remember-me-token">Remember me</label>
                                </div> --}}


                                {{-- Forgot Password Functionality --}} 
                                <div class="group-2 text-right">
                                    <div class="page-anchor">
                                        <a href="{{ url('user/forgot-password') }}">
                                            <i class="fas fa-circle-o-notch u-s-m-r-9"></i>Lost your password?
                                        </a>
                                    </div>
                                </div>
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
                        <h2 class="account-h2 u-s-m-b-20" style="color:black;">Customer Register</h2>
                        <h6 style="font-weight: bold; color: black;" class="account-h6 u-s-m-b-30">Registering for this site allows you to access your order status and history.</h6>



                        {{-- Registration Success Message using jQuery. Check front/js/custom.js --}} 
                        {{-- <p id="register-success" style="color: green"></p> --}}
                        <p id="register-success"></p>



                        
                        <form id="registerForm" action="javascript:;" method="post"> {{-- We need to deactivate the 'action' HTML attribute (using    'javascript:;'    ) as we'r going to submit using an AJAX call. Check front/js/custom.js --}}
                            @csrf {{-- Preventing CSRF Requests: https://laravel.com/docs/9.x/csrf#preventing-csrf-requests --}}


                            <div class="u-s-m-b-30">
                                <label for="username">First Name
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="user-name" class="text-field" placeholder="First Name" name="name">
                                {{-- <p id="register-name" style="color: red"></p> --}} {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                <p id="register-name"></p> {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="username">Middle Name
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="user-name" class="text-field" placeholder="First Name" name="mname">
                                {{-- <p id="register-name" style="color: red"></p> --}} {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                <p id="register-name"></p> {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="username">Last Name
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="user-name" class="text-field" placeholder="First Name" name="lname">
                                {{-- <p id="register-name" style="color: red"></p> --}} {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                <p id="register-name"></p> {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="usermobile">Mobile
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="user-mobile" class="text-field" placeholder="User Mobile" name="mobile">
                                {{-- <p id="register-mobile" style="color: red"></p> --}} {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                <p id="register-mobile"></p> {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="useremail">Email
                                    <span class="astk">*</span>
                                </label>
                                <input type="email" id="user-email" class="text-field" placeholder="User Email" name="email">
                                {{-- <p id="register-email" style="color: red"></p> --}} {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                <p id="register-email"></p> {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="userpassword">Password
                                    <span class="astk">*</span>
                                </label>
                                <input type="password" id="user-password" class="text-field" placeholder="User Password" name="password">
                                {{-- <p id="register-password" style="color: red"></p> --}} {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                <p id="register-password"></p> {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                            </div>
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
                                            <h5 class="modal-title" id="termsModalLabel" style="font-weight: bold; color: black;">Terms and Conditions for Customer Registration</h5>
                                        </div>
                                        <div class="modal-body" style="max-height: 400px; overflow-y: auto; color: black;">
                                            <p>Welcome to PADABA Trading System. By registering as a customer on our platform, you agree to abide by the following terms and conditions. Please read them carefully before completing your registration.</p>

                                            <hr>

                                            <h6 style="font-weight: bold; color: black;">1. Eligibility</h6>
                                            <ul>
                                                <li style="color: black;">You must be at least 18 years old to register as a customer.</li>
                                                <li style="color: black;">You agree to provide accurate, complete, and up-to-date information during registration.</li>
                                            </ul>

                                            <h6 style="font-weight: bold; color: black;">2. Account Responsibilities</h6>
                                            <ul>
                                                <li style="color: black;">You are responsible for maintaining the confidentiality of your account credentials.</li>
                                                <li style="color: black;">Any activity conducted through your account will be considered your responsibility. Notify us immediately of any unauthorized access.</li>
                                            </ul>

                                            <h6 style="font-weight: bold; color: black;">3. Product Purchases</h6>
                                            <ul>
                                                <li style="color: black;">You agree to review product descriptions carefully before making any purchase.</li>
                                                <li style="color: black;">You are responsible for providing accurate delivery information for the successful fulfillment of your order.</li>
                                                <li style="color: black;">All purchases must comply with applicable laws and regulations.</li>
                                            </ul>

                                            <h6 style="font-weight: bold; color: black;">4. Payments and Fees</h6>
                                            <ul>
                                                <li style="color: black;">You agree to pay for all items purchased in accordance with the pricing outlined on the platform.</li>
                                                <li style="color: black;">Payments will be processed according to the payment method selected during checkout.</li>
                                                <li style="color: black;">Any applicable taxes, fees, or additional charges will be added to the total purchase price.</li>
                                            </ul>

                                            <h6 style="font-weight: bold; color: black;">5. Order Fulfillment and Returns</h6>
                                            <ul>
                                                <li style="color: black;">PADABA Trading System strives to ensure timely order fulfillment, but we are not responsible for delays caused by third parties or circumstances beyond our control.</li>
                                                <li style="color: black;">Our return and refund policies must be followed for any order returns or disputes.</li>
                                            </ul>

                                            <h6 style="font-weight: bold; color: black;">6. Prohibited Activities</h6>
                                            <ul>
                                                <li style="color: black;">Customers must not engage in fraudulent activities, including the use of false information or unauthorized payment methods.</li>
                                                <li style="color: black;">Any violation of these terms may result in account suspension or termination.</li>
                                            </ul>

                                            <h6 style="font-weight: bold; color: black;">7. Intellectual Property</h6>
                                            <ul>
                                                <li style="color: black;">You acknowledge that all trademarks, logos, and other intellectual property associated with the products listed on the platform are owned by their respective entities.</li>
                                                <li style="color: black;">You agree not to infringe on the intellectual property rights of PADABA Trading System or third-party entities.</li>
                                            </ul>

                                            <h6 style="font-weight: bold; color: black;">8. Termination</h6>
                                            <ul>
                                                <li style="color: black;">We reserve the right to terminate your customer account at any time for breaches of these terms or other violations of our policies.</li>
                                            </ul>

                                            <h6 style="font-weight: bold; color: black;">9. Liability and Indemnification</h6>
                                            <ul>
                                                <li style="color: black;">PADABA Trading System is not liable for any disputes arising between customers and breeders or third parties.</li>
                                                <li style="color: black;">You agree to indemnify and hold harmless PADABA Trading System from any claims or damages arising from your use of the platform.</li>
                                            </ul>

                                            <h6 style="font-weight: bold; color: black;">10. Amendments</h6>
                                            <ul>
                                                <li style="color: black;">We reserve the right to amend these terms and conditions at any time. Continued use of the platform constitutes your acceptance of any changes.</li>
                                            </ul>

                                            <h6 style="font-weight: bold; color: black;">11. Governing Law</h6>
                                            <ul>
                                                <li style="color: black;">These terms and conditions are governed by the laws of the Philippines.</li>
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