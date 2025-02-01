@extends('admin.layout.layout')


@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Update Breeder Details</h3>

                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="justify-content-end d-flex">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            
            @if ($slug == 'personal') {{-- $slug was passed from AdminController to view (using compact() method) --}}
                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Update Personal Information</h4>


                                {{-- Our Bootstrap error code in case of wrong current password or the new password and confirm password are not matching: --}}
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

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif



                                {{-- Our Bootstrap success message in case of updating admin password is successful: --}}
                                {{-- Determining If An Item Exists In The Session (using has() method): https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session --}}
                                @if (Session::has('success_message')) <!-- Check AdminController.php, updateAdminPassword() method -->
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success:</strong> {{ Session::get('success_message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                    

                                
                                <form class="forms-sample" action="{{ url('admin/update-vendor-details/personal') }}" method="post" enctype="multipart/form-data"> @csrf <!-- Using the enctype="multipart/form-data" to allow uploading files (images) -->
                                    <div class="form-group">
                                        <label>Breeder Email</label>
                                        <input class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly> <!-- Check updateAdminPassword() method in AdminController.php --> {{-- Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_name">First Name</label>
                                        <input type="text" class="form-control" id="vendor_name" placeholder="Enter Name" name="vendor_name" value="{{ Auth::guard('admin')->user()->name }}"> {{-- $vendorDetails was passed from AdminController --}} {{-- Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_name">Middle Name</label>
                                        <input type="text" class="form-control" id="vendor_name" placeholder="Enter Name" name="vendor_name" value="{{ Auth::guard('admin')->user()->mname }}"> {{-- $vendorDetails was passed from AdminController --}} {{-- Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_name">Last Name</label>
                                        <input type="text" class="form-control" id="vendor_name" placeholder="Enter Name" name="vendor_name" value="{{ Auth::guard('admin')->user()->lname }}"> {{-- $vendorDetails was passed from AdminController --}} {{-- Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_address">Address</label>
                                        <input type="text" class="form-control" id="vendor_address" placeholder="Enter Address" name="vendor_address" value="{{ $vendorDetails['address'] }}"> {{-- $vendorDetails was passed from AdminController --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_city">Sex</label>
                                        <select class="form-control" id="vendor_city" name="vendor_city"> 
                                            <option value="" disabled selected>Select Sex</option>
                                            <option value="Male" {{ isset($vendorDetails['city']) && $vendorDetails['city'] === 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ isset($vendorDetails['city']) && $vendorDetails['city'] === 'Female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_state">Birth Date</label>
                                        <input 
                                            type="date" 
                                            class="form-control" 
                                            id="vendor_state" 
                                            name="vendor_state" 
                                            value="{{ isset($vendorDetails['state']) ? $vendorDetails['state'] : '' }}"> {{-- $vendorDetails was passed from AdminController --}}
                                    </div>

                                    <div class="form-group">
                                        {{-- Show all world countries from the database `countries` table --}}
                                        <label for="shop_country">Municipality/District</label>
                                    
                                        <select class="form-control" id="vendor_country" name="vendor_country"  style="color: #495057">
                                            <option value="">Select Municipality/District</option>

                                            @foreach ($countries as $country) {{-- $countries was passed from AdminController to view using compact() method --}}
                                                <option value="{{ $country['country_name'] }}" @if ($country['country_name'] == $vendorDetails['country']) selected @endif>{{ $country['country_name'] }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_pincode">Zip Code</label>
                                        <input type="text" class="form-control" id="vendor_pincode" placeholder="Enter Zip Code" name="vendor_pincode" value="{{ $vendorDetails['pincode'] }}"> {{-- $vendorDetails was passed from AdminController --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_mobile">Mobile</label>
                                        <input type="text" class="form-control" id="vendor_mobile" placeholder="Enter 10 Digit Mobile Number" name="vendor_mobile" value="{{ Auth::guard('admin')->user()->mobile }}" maxlength="10" minlength="10"> {{-- Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_image">Profile Photo</label>
                                        <input type="file" class="form-control" id="vendor_image" name="vendor_image">
                                        {{-- Show the admin image if exists --}}
                                        @if (!empty(Auth::guard('admin')->user()->image)) {{-- Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances --}}
                                            <a target="_blank" href="{{ url('admin/images/photos/' . Auth::guard('admin')->user()->image) }}">View Image</a> <!-- We used    target="_blank"    to open the image in another separate page --> {{-- Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances --}}
                                            <input type="hidden" name="current_vendor_image" value="{{ Auth::guard('admin')->user()->image }}"> <!-- to send the current admin image url all the time with all the requests --> {{-- Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances --}}
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button type="reset"  class="btn btn-light">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif ($slug == 'business') 
                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Update Breeder Business Information</h4>


                                {{-- Our Bootstrap error code in case of wrong current password or the new password and confirm password are not matching: --}}
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

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif



                                {{-- Our Bootstrap success message in case of updating admin password is successful: --}}
                                
                                {{-- Determining If An Item Exists In The Session (using has() method): https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session --}}
                                @if (Session::has('success_message')) <!-- Check AdminController.php, updateAdminPassword() method -->
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success:</strong> {{ Session::get('success_message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                    

                                
                                <form class="forms-sample" action="{{ url('admin/update-vendor-details/business') }}" method="post" enctype="multipart/form-data"> @csrf <!-- Using the enctype="multipart/form-data" to allow uploading files (images) -->
                                    <div class="form-group">
                                        <label>Vendor Username/Email</label>
                                        <input class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly> <!-- Check updateAdminPassword() method in AdminController.php --> {{-- Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_name">Shop Name</label>
                                        <input type="text" class="form-control" id="shop_name" placeholder="Enter Shop Name" name="shop_name"  @if (isset($vendorDetails['shop_name'])) value="{{ $vendorDetails['shop_name'] }}" @endif> {{-- $vendorDetails was passed from AdminController --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_address">Shop Address</label>
                                        <input type="text" class="form-control" id="shop_address" placeholder="Enter Shop Address" name="shop_address" 
                                            @if (isset($vendorDetails['shop_address'])) value="{{ $vendorDetails['shop_address'] }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_city">Shop City</label>
                                        <input type="text" class="form-control" id="shop_city" placeholder="Enter Shop City" name="shop_city"  @if (isset($vendorDetails['shop_city'])) value="{{ $vendorDetails['shop_city'] }}" @endif> {{-- $vendorDetails was passed from AdminController --}}
                                    </div>

                                    <div class="form-group">
                                        <!DOCTYPE html>
                                            <html lang="en">
                                            <head>
                                                <meta charset="UTF-8">
                                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                                <title>Pinpoint Location on Map</title>
                                                <style>
                                                    /* Set the map size */
                                                    #map {
                                                        height: 500px;
                                                        width: 100%;
                                                    }
                                                </style>
                                            </head>
                                            <body>

                                                <h2>Select Your Location</h2>

                                                <div id="map"></div>

                                                <!-- Display latitude and longitude -->
                                                <p style="display: none;"><span id="lat"></span></p>
                                            <p style="display: none;"><span id="lng"></span></p>


                                                

                                                <!-- JavaScript to define initMap before loading the Google Maps API -->
                                                <script>
                                                    let map;
                                                    let marker;

                                                    // Define initMap in the global scope
                                                    window.initMap = function () {
                                                        const initialPosition = { lat: 10.7201, lng: 122.5533 }; // Initial position (can be dynamic)

                                                        // Initialize the map
                                                        map = new google.maps.Map(document.getElementById("map"), {
                                                            center: initialPosition,
                                                            zoom: 15,
                                                        });

                                                        // Add a draggable marker at the center of the map
                                                        marker = new google.maps.Marker({
                                                            position: initialPosition,
                                                            map: map,
                                                            draggable: true,
                                                        });

                                                        // Update location fields on marker drag
                                                        google.maps.event.addListener(marker, "dragend", function () {
                                                            const position = marker.getPosition();
                                                            updateLocationFields(position.lat(), position.lng());
                                                        });

                                                        // Update location fields on map click
                                                        google.maps.event.addListener(map, "click", function (event) {
                                                            const clickedLocation = event.latLng;
                                                            marker.setPosition(clickedLocation);
                                                            updateLocationFields(clickedLocation.lat(), clickedLocation.lng());
                                                        });
                                                    };

                                                    // Update latitude, longitude, and address fields
                                                    function updateLocationFields(lat, lng) {
                                                        document.getElementById("shop_pincode").value = lat;
                                                        document.getElementById("shop_state").value = lng;

                                                        // Call the Google Geocoding API for reverse geocoding
                                                        const apiKey = "{{ config('services.google_maps.javascript_api_key') }}"; // Replace with your API key
                                                        const geocodeUrl = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=${apiKey}`;

                                                        // Fetch the address
                                                        fetch(geocodeUrl)
                                                            .then((response) => response.json())
                                                            .then((data) => {
                                                                if (data.status === "OK" && data.results.length > 0) {
                                                                    const address = data.results[0].formatted_address;
                                                                    document.getElementById("shop_address").value = address;
                                                                } else {
                                                                    console.error("Failed to fetch address");
                                                                }
                                                            })
                                                            .catch((error) => console.error("Error:", error));
                                                    }
                                                </script>


                                                <!-- Load Google Maps JavaScript API asynchronously with defer -->
                                                <script async defer 
                                                        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.javascript_api_key') }}&callback=initMap">
                                                </script>

                                            </body>
                                            </html>

                                    </div>

                                    <div class="form-group" style="display: none;">
    <input type="text" class="form-control" id="shop_pincode" name="shop_pincode" 
        @if (isset($vendorDetails['shop_pincode'])) value="{{ $vendorDetails['shop_pincode'] }}" @endif readonly>
</div>

<div class="form-group" style="display: none;">
    <input type="text" class="form-control" id="shop_state" name="shop_state" 
        @if (isset($vendorDetails['shop_state'])) value="{{ $vendorDetails['shop_state'] }}" @endif readonly>
</div>
                                    <div class="form-group">
                                        {{-- Show all world countries from the database `countries` table --}}
                                        <label for="shop_country">Municipality/District</label>
                                    
                                        <select class="form-control" id="shop_country" name="shop_country" style="color: #495057">
                                            <option value="">Select Municipality/District</option>

                                            @foreach ($countries as $country) {{-- $countries was passed from AdminController to view using compact() method --}}
                                                <option value="{{ $country['country_name'] }}"  @if (isset($vendorDetails['shop_country']) && $country['country_name'] == $vendorDetails['shop_country']) selected @endif>{{ $country['country_name'] }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_mobile">Shop Phone Number</label>
                                        <input type="text" class="form-control" id="shop_mobile" placeholder="Enter your Shop Phone Number" name="shop_mobile"  @if (isset($vendorDetails['shop_mobile'])) value="{{ $vendorDetails['shop_mobile'] }}" @endif >
                                    </div>
                                    <div class="form-group" style="display: none;">
                                        <label for="shop_mobile">Shop Website</label>
                                        <input type="text" class="form-control" id="shop_website" placeholder="Enter Shop Website" name="shop_website"  @if (isset($vendorDetails['shop_website'])) value="{{ $vendorDetails['shop_website'] }}" @endif>
                                    </div>
                                     <div class="form-group" style="display: none;">
                                        <label for="business_license_number">RSBSA Number</label>
                                        <input type="text" class="form-control" id="business_license_number" placeholder="Enter Business License Number" name="business_license_number"  @if (isset($vendorDetails['business_license_number'])) value="{{ $vendorDetails['business_license_number'] }}" @endif> {{-- $vendorDetails was passed from AdminController --}}
                                    </div>
                                    <!--<div class="form-group">
                                        <label for="gst_number">Other Permit Nos. </label>

                                         Dropdown for selecting the Permit Type 
                                        <select class="form-control" id="permit_type" name="permit_type">
                                            <option value="">Select Permit Type</option>
                                            <option value="Building Permit">Building Permit</option>
                                            <option value="Breeding License">Breeding License</option>
                                            <option value="Animal Welfare Permit">Animal Welfare Permit</option>
                                            <option value="Kennel License">Kennel License</option>
                                        </select>
                                        
                                        <input type="text" class="form-control mt-2" id="gst_number" name="gst_number" placeholder="Input your Permit ID" 
                                            @if (isset($vendorDetails['gst_number'])) value="{{ $vendorDetails['gst_number'] }}" @endif>
                                    </div
                                   
                                    <div class="form-group">
                                        <label for="address_proof">Breeder Address Proof</label>
                                        <select class="form-control" name="address_proof" id="address_proof">
                                            <option value="ID Card"        @if(isset($vendorDetails['address_proof']) && $vendorDetails['address_proof'] == 'Passport')        selected @endif>ID Card</option>
                                            <option value="TIN ID"     @if(isset($vendorDetails['address_proof']) && $vendorDetails['address_proof'] == 'Voting Card')     selected @endif>TIN ID</option>
                                            <option value="Philippine Identification (PhilID / ePhilID)"             @if(isset($vendorDetails['address_proof']) && $vendorDetails['address_proof'] == 'PAN')             selected @endif>Philippine Identification (PhilID / ePhilID)</option>
                                            <option value="Driving License" @if(isset($vendorDetails['address_proof']) && $vendorDetails['address_proof'] == 'Driving License') selected @endif>Driving License</option>
                                            <option value="Barangay ID"     @if(isset($vendorDetails['address_proof']) && $vendorDetails['address_proof'] == 'Aadhar card')     selected @endif>Barangay ID</option>
                                        </select>
                                    </div>>-->
                                    <div class="form-group">
                                        <label for="address_proof_image">Business Permit:</label>
                                        <input type="file" class="form-control" id="address_proof_image" name="address_proof_image">
                                        {{-- Show the admin image if exists --}}
                                        @if (!empty($vendorDetails['address_proof_image']))
                                            <a target="_blank" href="{{ url('admin/images/proofs/' . $vendorDetails['address_proof_image']) }}">View Image</a> <!-- We used    target="_blank"    to open the image in another separate page -->
                                            <input type="hidden" name="current_address_proof" value="{{ $vendorDetails['address_proof_image'] }}"> <!-- to send the current admin image url all the time with all the requests -->
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button type="reset"  class="btn btn-light">Cancel</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @elseif ($slug == 'bank')
                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Update Vendor Bank Information</h4>


                                {{-- Our Bootstrap error code in case of wrong current password or the new password and confirm password are not matching: --}}
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


                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif



                                {{-- Our Bootstrap success message in case of updating admin password is successful: --}}
                                {{-- Determining If An Item Exists In The Session (using has() method): https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session --}}
                                @if (Session::has('success_message')) <!-- Check AdminController.php, updateAdminPassword() method -->
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success:</strong> {{ Session::get('success_message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                    

                                
                                <form class="forms-sample" action="{{ url('admin/update-vendor-details/bank') }}" method="post" enctype="multipart/form-data"> @csrf <!-- Using the enctype="multipart/form-data" to allow uploading files (images) -->
                                    <div class="form-group">
                                        <label>Vendor Username/Email</label>
                                        <input class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly> <!-- Check updateAdminPassword() method in AdminController.php --> {{-- Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="account_holder_name">Account Holder Name</label>
                                        <input type="text" class="form-control" id="account_holder_name" placeholder="Enter Account Holder Name" name="account_holder_name"  @if (isset($vendorDetails['account_holder_name'])) value="{{ $vendorDetails['account_holder_name'] }}" @endif> {{-- $vendorDetails was passed from AdminController --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="bank_name">Bank Name</label>
                                        <select class="form-control" id="bank_name" name="bank_name">
                                            <option value="">Select Bank</option>
                                            <option value="BDO Unibank, Inc. (BDO)" @if (isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'BDO Unibank, Inc. (BDO)') selected @endif>BDO Unibank, Inc. (BDO)</option>
                                            <option value="Bank of the Philippine Islands (BPI)" @if (isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'Bank of the Philippine Islands (BPI)') selected @endif>Bank of the Philippine Islands (BPI)</option>
                                            <option value="Metrobank (Metropolitan Bank and Trust Company)" @if (isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'Metrobank (Metropolitan Bank and Trust Company)') selected @endif>Metrobank (Metropolitan Bank and Trust Company)</option>
                                            <option value="Philippine National Bank (PNB)" @if (isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'Philippine National Bank (PNB)') selected @endif>Philippine National Bank (PNB)</option>
                                            <option value="Land Bank of the Philippines (Landbank)" @if (isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'Land Bank of the Philippines (Landbank)') selected @endif>Land Bank of the Philippines (Landbank)</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="account_number">Account Number</label>
                                        <input type="text" class="form-control" id="account_number" placeholder="Enter Account Number" name="account_number"  @if (isset($vendorDetails['account_number'])) value="{{ $vendorDetails['account_number'] }}" @endif> {{-- $vendorDetails was passed from AdminController --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="bank_ifsc_code">Bank SWIFT/BIC Code</label>
                                        <input type="text" class="form-control" id="bank_ifsc_code" placeholder="Enter Bank SWIFT/BIC Code" name="bank_ifsc_code"  @if (isset($vendorDetails['bank_ifsc_code'])) value="{{ $vendorDetails['bank_ifsc_code'] }}" @endif> {{-- $vendorDetails was passed from AdminController --}}
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button type="reset"  class="btn btn-light">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif



        </div>
        <!-- content-wrapper ends -->
        @include('admin.layout.footer')
        <!-- partial -->
    </div>
@endsection