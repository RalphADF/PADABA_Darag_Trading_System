@extends('admin.layout.layout')

@section('content')
<!-- FullCalendar CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.css" rel="stylesheet">

<!-- FullCalendar JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.js"></script>

@if (Auth::guard('admin')->user()->type == 'superadmin')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Welcome {{ Auth::guard('admin')->user()->name }}</h3>
                            @if (Auth::guard('admin')->user()->type == 'admin' || Auth::guard('admin')->user()->type == 'superadmin')
                                <a href="{{ route('admin.dashboard.pdf') }}" class="mdi mdi-file-pdf">Generate Report as PDF</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-6 grid-margin transparent">
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                            <div class="card card-light-blue">
                                <div class="card-body">
                                    <p class="mb-4">Total Orders</p>
                                    <p class="fs-30 mb-2">{{ $ordersCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 stretch-card transparent">
                            <div class="card card-light-blue">
                                <div class="card-body">
                                    <p class="mb-4">New Orders</p>
                                    <p class="fs-30 mb-2">{{ $brandsCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 grid-margin transparent">
                    <div class="row">
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <p class="mb-4">Total Products</p>
                                    <p class="fs-30 mb-2">{{ $productsCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <p class="mb-4">Total Sales Made</p>
                                    <p class="fs-30 mb-2">₱{{ $totalPaidOrders }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 grid-margin transparent">
                    <div class="row">
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <p class="mb-4">Unapproved Breeder Accounts</p>
                                    <p class="fs-30 mb-2">{{ $vendorCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <p class="mb-4">Certified PADABA Member Breeders</p>
                                    <p class="fs-30 mb-2">{{ $vendorWithRsbsaCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 grid-margin transparent">
                    <div class="row">
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <p class="mb-4">Non-Member Breeders</p>
                                    <p class="fs-30 mb-2">{{ $vendorWithoutRsbsaCount }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-6 grid-margin transparent">
                    <div class="row">
                        <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.css"
                            rel="stylesheet">
                        <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.css"
                            rel="stylesheet">
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.js"></script>
                        <script
                            src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.js"></script>

                        <div id="calendar"></div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                var calendarEl = document.getElementById('calendar');

                                var calendar = new FullCalendar.Calendar(calendarEl, {
                                    plugins: ['dayGrid'],
                                    initialView: 'dayGridMonth',
                                    events: [
                                        @foreach ($calendarOrders as $order)
                                            {
                                                        title: '{{ $order->name }} - {{ $order->order_status }}',
                                                        start: '{{ $order->delivery_schedule }}',
                                                        url: '{{ url("admin/orders/" . $order->id) }}',
                                                        extendedProps: {
                                                            status: '{{ $order->order_status }}' // Pass order status for styling
                                                        }
                                                    },
                                        @endforeach
                                    ],
                                    eventRender: function (info) {
                                        // Apply color based on the order status
                                        var status = info.event.extendedProps.status;
                                        if (status === 'New') {
                                            info.el.style.backgroundColor = 'gray';
                                            info.el.style.color = 'white';
                                        } else if (status === 'In Progress' || status === 'In-Transit') {
                                            info.el.style.backgroundColor = '#8B8000';
                                            info.el.style.color = 'black';
                                        } else if (status === "Delivered & Paid") {
                                            info.el.style.backgroundColor = 'green';
                                            info.el.style.color = 'white';
                                        }
                                    }
                                });

                                calendar.render();
                            });
                        </script>
                    </div>
                </div>




            </div>

            <!-- Line Chart Section -->

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Sales Overview</h4>
                            <form method="GET" action="{{ route('admin.dashboard') }}">
                                <div class="form-group">
                                    <label for="year">Year:</label>
                                    <select name="year" id="year" class="form-control">
                                        <option value="">All Years</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                                {{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="month">Month:</label>
                                    <select name="month" id="month" class="form-control">
                                        <option value="">All Months</option>
                                        @foreach ($months as $month)
                                            <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                                                {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Filter</button>
                            </form>
                            <br>
                            <div class="row">
                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title"></h4>
                                            <canvas id="lineChart" style="height: 300px; width: 100%;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endif

        @if (Auth::guard('admin')->user()->type == 'subadmin')
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold">Welcome {{ Auth::guard('admin')->user()->name }}</h3>
                                    @if (Auth::guard('admin')->user()->type == 'admin' || Auth::guard('admin')->user()->type == 'superadmin')
                                        <a href="{{ route('admin.dashboard.pdf') }}" class="mdi mdi-file-pdf">Generate Report as
                                            PDF</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 grid-margin transparent">
                            <div class="row">
                                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                                    <div class="card card-light-blue">
                                        <div class="card-body">
                                            <p class="mb-4">Total Orders</p>
                                            <p class="fs-30 mb-2">{{ $ordersCount }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 stretch-card transparent">
                                    <div class="card card-light-blue">
                                        <div class="card-body">
                                            <p class="mb-4">New Orders</p>
                                            <p class="fs-30 mb-2">{{ $brandsCount }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>






                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Scheduled Deliveries</h4>
                                <div class="col-md-6 grid-margin transparent">
                                    <div class="row">
                                        <link
                                            href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.css"
                                            rel="stylesheet">
                                        <link
                                            href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.css"
                                            rel="stylesheet">
                                        <script
                                            src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.js"></script>
                                        <script
                                            src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.js"></script>

                                        <div id="calendar"></div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                var calendarEl = document.getElementById('calendar');
                                                var calendar = new FullCalendar.Calendar(calendarEl, {
                                                    plugins: ['dayGrid'],
                                                    initialView: 'dayGridMonth',
                                                    events: [
                                                        @foreach ($calendarOrders as $order)
                                                            {
                                                                    title: '{{ $order->name }} - {{ $order->order_status }}',
                                                                    start: '{{ $order->delivery_schedule }}',
                                                                    url: '{{ url("admin/orders/" . $order->id) }}'
                                                                },
                                                        @endforeach
                                                    ]
                                                });
                                                calendar.render();
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>

                            <!-- Line Chart Section -->

                            <div class="row">

                                <div class="col-md-12 grid-margin stretch-card">
                                    <!-- Include FullCalendar CSS and JS -->

                                </div>
                            </div>
                        </div>
                    </div>
        @endif

                @if (Auth::guard('admin')->user()->type == 'vendor')


                @endif



                <!-- Bar Chart Section -->

            </div>
        </div>

        {{-- WMA --}}
        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1"></script>
        
        <script>
            $(function () {
                var ordersByTime = @json($ordersByTime); // Pass grouped data from the backend
                var labels = []; // To store 'Month Year' formatted labels
                var totals = []; // To store the totals for each month-year group
        
                // Generate labels and totals
                ordersByTime.forEach(function (entry) {
                    var monthNames = [
                        "January", "February", "March", "April", "May", "June",
                        "July", "August", "September", "October", "November", "December"
                    ];
                    var month = monthNames[entry.month - 1]; // Convert month number to name
                    labels.push(`${month} ${entry.year}`); // Combine month and year for the label
                    totals.push(entry.total); // Push the total for this month-year
                });
        
                console.log('Labels:', labels);
                console.log('Totals:', totals);
        
                // Function to calculate Weighted Moving Average (WMA)
                function calculateWMA(data, windowSize) {
                    var weights = Array.from({ length: windowSize }, (_, i) => i + 1); // Weights (1, 2, 3, ...)
                    var wma = [];
        
                    for (var i = windowSize - 1; i < data.length; i++) {
                        var sum = 0;
                        var weightSum = 0;
                        for (var j = 0; j < windowSize; j++) {
                            sum += data[i - j] * weights[j];
                            weightSum += weights[j];
                        }
                        wma.push(sum / weightSum);
                    }
        
                    // Pad the beginning with null values (since WMA requires a window of data)
                    for (var i = 0; i < windowSize - 1; i++) {
                        wma.unshift(null);
                    }
        
                    return wma;
                }
        
                // Calculate WMA for the forecasted sales
                var windowSize = 3; // Adjust the window size as needed (e.g., 3-month WMA)
                var forecast = calculateWMA(totals, windowSize);
        
                // Extend the forecast into the future (optional)
                var futureMonths = 3; // Number of months to forecast into the future
                for (var i = 0; i < futureMonths; i++) {
                    var lastWMA = forecast[forecast.length - 1]; // Use the last WMA value for future predictions
                    forecast.push(lastWMA);
                    labels.push(`Future Month ${i + 1}`); // Add placeholder labels for future months
                }
        
                var data = {
                    labels: labels, // Use 'Month Year' as x-axis labels
                    datasets: [
                        {
                            label: 'Total Sales',
                            data: totals, // Data corresponding to the month-year groups
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1,
                            fill: true, // Create the shaded area under the line
                        },
                        {
                            label: 'Forecasted Sale (WMA)',
                            data: forecast, // Forecast data using WMA
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2,
                            fill: false,
                            borderDash: [5, 5], // Dash pattern for the forecast line
                            pointRadius: 0
                        }
                    ]
                };
        
                var options = {
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Months and Years'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Total Paid Orders'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true
                        }
                    },
                    elements: {
                        point: {
                            radius: 0
                        }
                    }
                };
        
                // Render the chart
                if ($("#lineChart").length) {
                    var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
                    var lineChart = new Chart(lineChartCanvas, {
                        type: 'line',
                        data: data,
                        options: options
                    });
                }
            });
        </script> --}}

        {{-- Econometric Forecasting --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/10.6.4/math.js"></script>
        
        <script>
            $(function () {
                var ordersByTime = @json($ordersByTime); // Pass grouped data from the backend
                var labels = []; // To store 'Month Year' formatted labels
                var totals = []; // To store the totals for each month-year group
        
                // Generate labels and totals
                ordersByTime.forEach(function (entry, index) {
                    var monthNames = [
                        "January", "February", "March", "April", "May", "June",
                        "July", "August", "September", "October", "November", "December"
                    ];
                    var month = monthNames[entry.month - 1]; // Convert month number to name
                    labels.push(`${month} ${entry.year}`); // Combine month and year for the label
                    totals.push(entry.total); // Push the total for this month-year
                });
        
                console.log('Labels:', labels);
                console.log('Totals:', totals);
        
                // Function to apply Exponential Smoothing for forecasting
                function exponentialSmoothing(data, alpha, futureMonths) {
                    let smoothed = [data[0]]; // Initialize with first data point
                    
                    for (let i = 1; i < data.length; i++) {
                        smoothed.push(alpha * data[i] + (1 - alpha) * smoothed[i - 1]);
                    }
        
                    // Forecast future values
                    let lastSmoothed = smoothed[smoothed.length - 1];
                    for (let i = 0; i < futureMonths; i++) {
                        smoothed.push(lastSmoothed);
                        labels.push(`Future Month ${i + 1}`);
                    }
        
                    return smoothed;
                }
        
                // Forecast the next 3 months using Exponential Smoothing
                var futureMonths = 3;
                var alpha = 0.5; // Smoothing factor (adjust as needed)
                var forecast = exponentialSmoothing(totals, alpha, futureMonths);
        
                var data = {
                    labels: labels, // Use 'Month Year' as x-axis labels
                    datasets: [
                        {
                            label: 'Total Sales',
                            data: totals, // Data corresponding to the month-year groups
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1,
                            fill: true, // Create the shaded area under the line
                        },
                        {
                            label: 'Forecasted Sales (Exponential Smoothing)',
                            data: forecast, // Forecast data using Exponential Smoothing
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2,
                            fill: false,
                            borderDash: [5, 5], // Dash pattern for the forecast line
                            pointRadius: 0
                        }
                    ]
                };
        
                var options = {
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Months and Years'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Total Paid Orders'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true
                        }
                    },
                    elements: {
                        point: {
                            radius: 0
                        }
                    }
                };
        
                // Render the chart
                if ($("#lineChart").length) {
                    var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
                    var lineChart = new Chart(lineChartCanvas, {
                        type: 'line',
                        data: data,
                        options: options
                    });
                }
            });
        </script>
        

        @endsection