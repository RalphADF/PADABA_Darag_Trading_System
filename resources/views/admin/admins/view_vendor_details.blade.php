@extends('admin.layout.layout')


@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Breeder Details</h3>
                            <h6 class="font-weight-normal mb-0"><a href="{{ url('admin/admins/vendor') }}">Back to Breeders</a></h6>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="justify-content-end d-flex">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Personal Information</h4>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" value="{{ $vendorDetails['vendor_personal']['email'] }}" readonly> <!-- Check updateAdminPassword() method in AdminController.php -->
                            </div>
                            <div class="form-group">
                                <label for="vendor_name">First Name</label>
                                <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['name'] }}" readonly> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="vendor_mname">Middle Name</label>
                                <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['mname'] }}" readonly> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="vendor_lname">Last Name</label>
                                <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['lname'] }}" readonly> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="vendor_address">Address</label>
                                <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['address'] }}" readonly> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="vendor_city">Sex</label>
                                <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['city'] }}" readonly> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="vendor_state">Birth Date</label>
                                <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['state'] }}" readonly> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="vendor_country">Municipality/District</label>
                                <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['country'] }}" readonly> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="vendor_pincode">Zip Code</label>
                                <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['pincode'] }}" readonly> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="vendor_mobile">Mobile No.</label>
                                <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['mobile'] }}" readonly>
                            </div>
                            @if (!empty($vendorDetails['image']))
                                <div class="form-group">
                                    <label for="vendor_image">Breeder Photo</label>
                                    <br>
                                    <img style="width: 200px" src="{{ url('admin/images/photos/' . $vendorDetails['image']) }}">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Business Information</h4>
                            <div class="form-group">
                                <label for="vendor_name">Shop Name</label>
                                <input type="text" class="form-control"  @if (isset($vendorDetails['vendor_business']['shop_name'])) value="{{ $vendorDetails['vendor_business']['shop_name'] }}" @endif  readonly> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="vendor_address">Shop Address</label>
                                <input type="text" class="form-control"  @if (isset($vendorDetails['vendor_business']['shop_address'])) value="{{ $vendorDetails['vendor_business']['shop_address'] }}" @endif  readonly> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="vendor_city">Shop City</label>
                                <input type="text" class="form-control"  @if (isset($vendorDetails['vendor_business']['shop_city'])) value="{{ $vendorDetails['vendor_business']['shop_city'] }}" @endif  readonly> {{-- $vendorDetails was passed from AdminController --}}
                            </div>

                            <div class="form-group">
                                <label for="vendor_state">Shop Map Location</label>
                            </div>

                            <!-- Add a div to display the map -->
                            <div id="map" style="height: 400px; width: 100%;"></div>

                            <!-- Google Maps JavaScript API -->
                            <script async defer
                                src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.javascript_api_key') }}&callback=initMap">
                            </script>

                            <script>
                                function initMap() {
                                    // Check if the latitude and longitude are available
                                    const latitude = parseFloat("{{ isset($vendorDetails['vendor_business']['shop_pincode']) ? $vendorDetails['vendor_business']['shop_pincode'] : '0' }}");
                                    const longitude = parseFloat("{{ isset($vendorDetails['vendor_business']['shop_state']) ? $vendorDetails['vendor_business']['shop_state'] : '0' }}");


                                    if (!isNaN(latitude) && !isNaN(longitude)) {
                                        // Create a new map centered at the given coordinates
                                        const map = new google.maps.Map(document.getElementById("map"), {
                                            center: { lat: latitude, lng: longitude },
                                            zoom: 17,
                                        });

                                        // Place a marker at the location
                                        const marker = new google.maps.Marker({
                                            position: { lat: latitude, lng: longitude },
                                            map: map,
                                            title: "Shop Location", // Title of the marker
                                        });
                                    } else {
                                        alert("Invalid coordinates for the shop location.");
                                    }
                                }
                            </script>

                            <div class="form-group">
                                <label for="vendor_country">Shop Municipality/District</label>
                                <input type="text" class="form-control"  @if (isset($vendorDetails['vendor_business']['shop_country'])) value="{{ $vendorDetails['vendor_business']['shop_country'] }}" @endif readonly> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="vendor_mobile">Shop Mobile</label>
                                <input type="text" class="form-control"  @if (isset($vendorDetails['vendor_business']['shop_mobile'])) value="{{ $vendorDetails['vendor_business']['shop_mobile'] }}" @endif  readonly>
                            </div>
                           <!-- <div class="form-group">
                                <label for="vendor_mobile">Shop Website</label>
                                <input type="text" class="form-control"  @if (isset($vendorDetails['vendor_business']['shop_website'])) value="{{ $vendorDetails['vendor_business']['shop_website'] }}" @endif  readonly>
                            </div> 
                            <div class="form-group">
                                <label>Shop Email</label>
                                <input class="form-control"  @if (isset($vendorDetails['vendor_business']['shop_email'])) value="{{ $vendorDetails['vendor_business']['shop_email'] }}" @endif  readonly>
                            </div>-->
                            <!--<div class="form-group">
                                <label>RSBSA Number</label>
                                <input class="form-control"  @if (isset($vendorDetails['vendor_business']['business_license_number'])) value="{{ $vendorDetails['vendor_business']['business_license_number'] }}" @endif  readonly> 
                            </div>-->
                            <!--<div class="form-group">
                                <label>Other Permit Nos.</label>
                                <input class="form-control"  @if (isset($vendorDetails['vendor_business']['gst_number'])) value="{{ $vendorDetails['vendor_business']['gst_number'] }}" @endif  readonly> 
                            </div> 
                            <div class="form-group">
                                <label>Other Permits (Optional)</label>
                                <input class="form-control"  @if (isset($vendorDetails['vendor_business']['address_proof'])) value="{{ $vendorDetails['vendor_business']['address_proof'] }}" @endif  readonly>  Check updateAdminPassword() method in AdminController.php 
                            </div>-->
                            @if (!empty($vendorDetails['vendor_business']['address_proof_image']))
                                <div class="form-group">
                                    <label for="vendor_image">Business Permit Image</label>
                                    <br>
                                    <img style="width: 200px" src="{{ url('admin/images/proofs/' . $vendorDetails['vendor_business']['address_proof_image']) }}">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Bank Information</h4>
                            <div class="form-group">
                                <label for="vendor_name">Account Holder Name</label>
                                <input type="text" class="form-control"  @if (isset($vendorDetails['vendor_bank']['account_holder_name'])) value="{{ $vendorDetails['vendor_bank']['account_holder_name'] }}" @endif  readonly> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="vendor_name">Bank Name</label>
                                <input type="text" class="form-control"  @if (isset($vendorDetails['vendor_bank']['bank_name'])) value="{{ $vendorDetails['vendor_bank']['bank_name'] }}" @endif  readonly> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="vendor_address">Account Number</label>
                                <input type="text" class="form-control"  @if (isset($vendorDetails['vendor_bank']['account_number'])) value="{{ $vendorDetails['vendor_bank']['account_number'] }}" @endif  readonly> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="vendor_city">Bank SWIFT/BIC Code</label>
                                <input type="text" class="form-control"  @if (isset($vendorDetails['vendor_bank']['bank_ifsc_code'])) value="{{ $vendorDetails['vendor_bank']['bank_ifsc_code'] }}" @endif  readonly> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Commissions module: Every vendor must pay a certain commission (that may vary from a vendor to another) for the website owner (admin) on every item sold, and it's defined by the website owner (admin) --}}
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Commission Information</h4>


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


                            {{-- Displaying The Validation Errors: https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors AND https://laravel.com/docs/9.x/blade#validation-errors --}}
                            {{-- Determining If An Item Exists In The Session (using has() method): https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session --}}
                            {{-- Our Bootstrap success message in case of updating admin password is successful: --}}
                            @if (Session::has('success_message')) <!-- Check AdminController.php, updateAdminPassword() method -->
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="form-group">
                                    <label for="vendor_name">Commission per order item (%)</label>
                                    <form method="post" action="{{ url('admin/update-vendor-commission') }}">
                                        @csrf {{-- Preventing CSRF Requests: https://laravel.com/docs/9.x/csrf#preventing-csrf-requests --}}

                                        <input                      type="hidden" name="vendor_id"   value="{{ $vendorDetails['vendor_personal']['id'] }}">
                                        <input class="form-control" type="text"   name="commission"  @if (isset($vendorDetails['vendor_personal']['commission'])) value="{{ $vendorDetails['vendor_personal']['commission'] }}" @endif required> {{-- $vendorDetails was passed from AdminController --}}
                                        <br>
                                        <button type="submit">Update</button>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- content-wrapper ends -->
        @include('admin.layout.footer')
        <!-- partial -->
    </div>
@endsection