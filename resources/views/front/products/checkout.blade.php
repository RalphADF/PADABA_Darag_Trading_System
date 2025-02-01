{{-- Note: This page (view) is rendered by the checkout() method in the Front/ProductsController.php --}}
@extends('front.layout.layout')


@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Checkout</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="checkout.html">Checkout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Checkout-Page -->
    <div class="page-checkout u-s-p-t-80">
        <div class="container">

            {{-- Showing the following HTML Form Validation Errors: (check checkout() method in Front/ProductsController.php) --}}
            {{-- Determining If An Item Exists In The Session (using has() method): https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session --}}
            @if (Session::has('error_message')) <!-- Check AdminController.php, updateAdminPassword() method -->
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong> {{ Session::get('error_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif



                <div class="row">
                    <div class="col-lg-12 col-md-12">

                        <!-- Second Accordion /- -->

                        <div class="row">
                            <!-- Billing-&-Shipping-Details -->
                            <div class="col-lg-6" id="deliveryAddresses"> {{-- We created this id="deliveryAddresses" to use it as a handle for jQuery AJAX to refresh this page, check front/js/custom.js --}}



                                
                                
                                @include('front.products.delivery_addresses')



                            </div>
                            <!-- Billing-&-Shipping-Details /- -->
                            <!-- Checkout -->
                            <div class="col-lg-6">



                                {{-- The complete HTML Form of the user submitting their Delivery Address and Payment Method --}}
                                <form name="checkoutForm" id="checkoutForm" action="{{ url('/checkout') }}" method="post">
                                    @csrf {{-- Preventing CSRF Requests: https://laravel.com/docs/9.x/csrf#preventing-csrf-requests --}}


                                    
                                    
                                    @if (count($deliveryAddresses) > 0) {{-- Checking if there are any $deliveryAddreses for the currently authenticated/logged-in user --}} {{-- $deliveryAddresses variable is passed in from checkout() method in Front/ProductsController.php --}}

                                        <h4 class="section-h4" style="color: black;">Delivery Addresses</h4>

                                        @foreach ($deliveryAddresses as $address)
                                            <div style="display: flex; align-items: center; margin-bottom: 10px;"> <!-- Flex container -->
                                                <!-- Radio button -->
                                                <div style="margin-right: 10px;">
                                                    <input type="radio" id="address{{ $address['id'] }}" name="address_id" 
                                                        value="{{ $address['id'] }}" 
                                                        shipping_charges="{{ $address['shipping_charges'] }}" 
                                                        total_price="{{ $total_price }}" 
                                                        coupon_amount="{{ \Illuminate\Support\Facades\Session::get('couponAmount') }}" 
                                                        codpincodeCount="{{ $address['codpincodeCount'] }}" 
                                                        prepaidpincodeCount="{{ $address['prepaidpincodeCount'] }}">
                                                </div>

                                                <!-- Address and Buttons -->
                                                <div style="flex: 1;">
                                                    <label class="control-label" for="address{{ $address['id'] }}" style="word-wrap: break-word;">
                                                        {{ $address['name'] }}, {{ $address['address'] }}, {{ $address['country'] }} ({{ $address['mobile'] }})
                                                    </label>
                                                </div>

                                                <!-- Buttons -->
                                                <div style="margin-left: 10px; display: flex; flex-direction: column; align-items: flex-end;">
                                                    <a href="javascript:;" data-addressid="{{ $address['id'] }}" class="editAddress" 
                                                        style="background-color: #007bff; color: white; padding: 5px 10px; border-radius: 20px; text-decoration: none; margin-bottom: 5px;">Edit</a>
                                                    <a href="javascript:;" data-addressid="{{ $address['id'] }}" class="removeAddress" 
                                                        style="background-color: #dc3545; color: white; padding: 5px 10px; border-radius: 20px; text-decoration: none;">Remove</a>
                                                </div>
                                            </div>

                                            <!-- Separator -->
                                            <hr style="border: 1px solid #ddd; margin: 10px 0;"> <!-- Horizontal line for separation -->
                                        @endforeach



                                        <br>
                                    @endif 


                                    <h4 class="section-h4" style="color: black;">Your Order</h4>
                                    <div class="order-table">
                                        <table class="u-s-m-b-13">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                                
                                                {{-- We'll place this $total_price inside the foreach loop to calculate the total price of all products in Cart. Check the end of the next foreach loop before @endforeach --}}
                                                @php $total_price = 0 @endphp

                                                @foreach ($getCartItems as $item) {{-- $getCartItems is passed in from cart() method in Front/ProductsController.php --}}
                                                    @php
                                                        $getDiscountAttributePrice = \App\Models\Product::getDiscountAttributePrice($item['product_id'], $item['size']); // from the `products_attributes` table, not the `products` table
                                                        // dd($getDiscountAttributePrice);
                                                    @endphp


                                                    <tr>
                                                        <td>
                                                            <a href="{{ url('product/' . $item['product_id']) }}">
                                                                <img width="50px" src="{{ asset('front/images/product_images/small/' . $item['product']['product_image']) }}" alt="Product">
                                                                <h6 class="order-h6" style="color: black">{{ $item['product']['product_name'] }}
                                                                <br>
                                                                {{ $item['size'] }}{{ $item['product']['product_color'] }}</h6>
                                                            </a>
                                                            <span class="order-span-quantity">x {{ $item['quantity'] }}</span>
                                                        </td>
                                                        <td>
                                                            <h6 class="order-h6"  style="color: black">₱{{ $getDiscountAttributePrice['final_price'] * $item['quantity'] }}</h6> {{-- price of all products (after discount (if any)) (= price (after discoutn) * no. of products) --}}
                                                        </td>
                                                    </tr>


                                                    
                                                    {{-- This is placed here INSIDE the foreach loop to calculate the total price of all products in Cart --}}
                                                    @php $total_price = $total_price + ($getDiscountAttributePrice['final_price'] * $item['quantity']) @endphp
                                                @endforeach


                                                <tr>
                                                    <td>
                                                        <h3 class="order-h3">Subtotal</h3>
                                                    </td>
                                                    <td>
                                                        <h3 class="order-h3">₱{{ $total_price }}</h3>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6 class="order-h6" style="color: black">Shipping Charges</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="order-h6">
                                                            <span class="shipping_charges"  style="color: black">₱0</span>
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6 class="order-h6" style="color: black">Coupon Discount</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="order-h6" style="color: black">
                                                            
                                                            @if (\Illuminate\Support\Facades\Session::has('couponAmount')) {{-- We stored the 'couponAmount' in a Session Variable inside the applyCoupon() method in Front/ProductsController.php --}}
                                                                <span class="couponAmount"  style="color: black">₱{{ \Illuminate\Support\Facades\Session::get('couponAmount') }}</span>
                                                            @else
                                                                ₱0
                                                            @endif
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h3 class="order-h3">Grand Total</h3>
                                                    </td>
                                                    <td>
                                                        <h3 class="order-h3">
                                                            <strong class="grand_total">₱{{ $total_price - \Illuminate\Support\Facades\Session::get('couponAmount') }}</strong> {{-- We create the 'grand_total' CSS class to use it as a handle for AJAX inside    $('#applyCoupon').submit();    function in front/js/custom.js --}} {{-- We stored the 'couponAmount' a Session Variable inside the applyCoupon() method in Front/ProductsController.php --}}
                                                        </h3>
                                                    </td>
                                                </tr>


                                            </tbody>
                                        </table>
                                        <div class="u-s-m-b-13 codMethod"> {{-- We added the codMethod CSS class to disable that payment method (check front/js/custom.js) if the PIN code of that user's Delivery Address doesn't exist in our `cod_pincodes` database table --}}
                                            <input type="radio" class="radio-box" name="payment_gateway" id="cash-on-delivery" value="COD">
                                            <label class="label-text" for="cash-on-delivery">Cash on Delivery</label>
                                        </div>
                                       
                                        <div class="u-s-m-b-13 codMethod">
                                            {{-- We added the codMethod CSS class to disable that payment method (check front/js/custom.js) if the PIN code of that user's Delivery Address doesn't exist in our `cod_pincodes` database table --}}
                                            <input type="radio" class="radio-box" name="payment_gateway" id="pick-up" value="Pick-Up">
                                            <label class="label-text" for="pick-up">Pick-Up</label>
                                        </div>

                                        <div class="u-s-m-b-13">
                                            <input type="checkbox" class="check-box" id="accept" name="accept" value="Yes" title="Please agree to T&C">
                                            <label class="label-text no-color" for="accept">Confirm Order
                                            </label>
                                        </div>
                                        <button type="submit" id="placeOrder" class="button button-outline-secondary">Place Order</button> {{-- Show our Preloader/Loader/Loading Page/Preloading Screen while the <form> is submitted using the    id="placeOrder"    HTML attribute. Check front/js/custom.js --}}
                                    </div>
                                </form>


                            </div>
                            <!-- Checkout /- -->
                        </div>

                    </div>
                </div>


        </div>
    </div>
    <!-- Checkout-Page /- -->
@endsection