{{-- This page is rendered by orders() method inside Admin/OrderController.php --}}
@extends('admin.layout.layout')


@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Orders</h4>
                            
                            @if (Auth::guard('admin')->user()->type == 'vendor')
                            <div class="card-body">
                                    <h3>Total Orders: {{ $orderCount }}</h3>
                                    <h3>Total Sum of Sales: <strong>{{ number_format($totalDeliveredAndPaid, 2) }}</strong></h3>
                                    <!-- Add any other dashboard content here -->
                                </div>
                                 @endif

                            <div class="table-responsive pt-3"> {{-- Add responsive wrapper --}}
                                {{-- DataTable --}}
                               
                                <table id="orders" class="table table-bordered table-striped table-hover">
                                    <thead class="thead-dark"> <!-- Adds dark header styling -->
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Order Date</th>
                                            <th>Customer Name</th>
                                            <th>Ordered Products</th>
                                            <th>Order Amount</th>
                                            <th>Order Status</th>
                                            <th>Delivery Driver</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            @if ($order['orders_products'])
                                                <tr>
                                                    <td>{{ $order['id'] }}</td>
                                                    <td>{{ date('Y-m-d h:i:s', strtotime($order['created_at'])) }}</td>
                                                    <td>{{ $order['name'] }}</td>
                                                    <td>
                                                        @foreach ($order['orders_products'] as $product)
                                                            {{ $product['product_name'] }} ({{ $product['product_qty'] }})<br>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $order['grand_total'] }}</td>
                                                    <td>{{ $order['order_status'] }}</td>
                                                    <td>{{ $order['courier_name'] }}</td>
                                                    <td class="text-nowrap"> {{-- Prevents text wrapping in action buttons --}}
                                                        <a title="View Order Details" href="{{ url('admin/orders/' . $order['id']) }}">
                                                            <i class="mdi mdi-file-document" style="font-size: 20px;"></i>
                                                        </a>
                                                        <a title="View Order Invoice" href="{{ url('admin/orders/invoice/' . $order['id']) }}" target="_blank">
                                                            <i class="mdi mdi-printer" style="font-size: 20px;"></i>
                                                        </a>
                                                        <a title="Print PDF Invoice" href="{{ url('admin/orders/invoice/pdf/' . $order['id']) }}" target="_blank">
                                                            <i class="mdi mdi-file-pdf" style="font-size: 20px;"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
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
        
        <!-- partial -->
    </div>
    
@endsection

