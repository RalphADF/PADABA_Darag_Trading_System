@extends('admin.layout.layout')


@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $title }}</h4>
                            @if ($title == 'Delivery Drivers')
                                <a href="{{ route('admin.add_delivery_driver_form') }}" 
                                style="max-width: 200px; float: right; display: inline-block" 
                                class="btn btn-block btn-primary">
                                    Add Delivery Driver
                                </a>
                            @endif

                            @if ($title == 'Breeders')
                            <button onclick="window.open('https://finder-rsbsa.da.gov.ph/', '_blank')" class="btn btn-primary">
                                Go to RSBSA Finder
                            </button>
                            @endif

                            <div class="table-responsive pt-3">
                            
                                <table id="orders" class="table table-bordered">
                                
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Admin ID</th>
                                            <th> Full Name</th>
                                           <!-- <th>Type</th> -->
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            @foreach ($admins as $admin)
                                                @if ($admin['type'] == 'vendor')
                                                    <th>RSBSA Number</th>
                                                    @break {{-- Stop after adding the column once --}}
                                                @endif
                                            @endforeach
                                           <!-- <th>Image</th>-->
                                            <th>Status</th>
                                            <th>Actions <br> (View Details)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($admins as $admin)
                                            <tr>
                                                <td>{{ $admin['id'] }}</td>
                                                <td>{{ $admin['name'] }} {{ $admin['mname'] ?? '' }} {{ $admin['lname'] ?? '' }}</td>
                                                <!-- <td>{{ $admin['type'] }}</td>-->
                                                <td>{{ $admin['mobile'] }}</td>
                                                <td>{{ $admin['email'] }}</td>
                                                @if ($admin['type'] == 'vendor') 
                                                <td>{{ $admin['rsbsaNumber'] }}</td>
                                                @endif
                                               <!-- <td>
                                                    @if ($admin['image'] != '')
                                                        <img src="{{ asset('admin/images/photos/' . $admin['image']) }}">
                                                    @else
                                                        <img src="{{ asset('admin/images/photos/no-image.gif') }}">
                                                    @endif
                                                </td>-->
                                                <td>
                                                    @if ($admin['status'] == 1)
                                                        <a class="updateAdminStatus" id="admin-{{ $admin['id'] }}" admin_id="{{ $admin['id'] }}" href="javascript:void(0)"> {{-- Using HTML Custom Attributes. Check admin/js/custom.js --}}
                                                            <i style="font-size: 25px" class="mdi mdi-account-check" status="Active"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                            <h7>Approved</h7>
                                                        </a>
                                                    @else {{-- if the admin status is inactive --}}
                                                        <a class="updateAdminStatus" id="admin-{{ $admin['id'] }}" admin_id="{{ $admin['id'] }}" href="javascript:void(0)"> {{-- Using HTML Custom Attributes. Check admin/js/custom.js --}}
                                                            <i style="font-size: 25px; color: red;" class="mdi mdi-account-remove" status="Inactive"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                            <h7>Unapproved</h7>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($admin['type'] == 'vendor')
                                                     {{-- if the admin `type` is vendor, show their further details --}}
                                                        <a href="{{ url('admin/view-vendor-details/' . $admin['id']) }}">
                                                            
                                                            <i style="font-size: 25px" class="mdi mdi-account-card-details"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                            
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"></span>
            </div>
        </footer>
        <!-- partial -->
    </div>
    
@endsection