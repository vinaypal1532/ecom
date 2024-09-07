@include('layouts.app')
@include('layouts.sidebar')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Summary Boxes -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <a href="{{ route('client.index') }}">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $user }}</h3>
                                <p>User</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-6">
                    <a href="{{ route('products.index') }}">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $product }}</h3>
                                <p>Product</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-6">
                    <a href="{{ route('categories.index') }}">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $category }}</h3>
                                <p>Category</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-6">
                    <a href="{{ route('orders.index') }}">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $order }}</h3>
                                <p>Order</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Latest Orders -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Today's Orders</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>User</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Order Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($todayOrders as $order)
                                            <tr>
                                                <td><a href="{{ route('orders.show', $order->id) }}">{{ $order->id }}</a></td>
                                                <td>{{ $order->user->name }}</td>
                                                <td>₹ {{ $order->total }}</td>
                                                <td><span class="badge badge-{{ $order->status_class }}">{{ $order->status }}</span></td>
                                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer clearfix">
                            <a href="{{ route('orders.index') }}" class="btn btn-sm btn-secondary float-right">View All Orders</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Latest Orders</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>User</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Order Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($latestOrders as $order)
                                            <tr>
                                                <td><a href="{{ route('orders.show', $order->id) }}">{{ $order->id }}</a></td>
                                                <td>{{ $order->user->name }}</td>
                                                <td>₹ {{ $order->total }}</td>
                                                <td><span class="badge badge-{{ $order->status_class }}">{{ $order->status }}</span></td>
                                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer clearfix">
                            <a href="{{ route('orders.index') }}" class="btn btn-sm btn-secondary float-right">View All Orders</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sales Charts -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Sales Overview</h3>
                                <a href="javascript:void(0);">View Report</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">₹ {{ $salesTotal }}</span>
                                    <span>Sales Over Time</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right">
                                    <span class="text-success">
                                        <i class="fas fa-arrow-up"></i> {{ $salesIncrease }}%
                                    </span>
                                    <span class="text-muted">Since last month</span>
                                </p>
                            </div>

                            <div class="position-relative mb-4">
                                <canvas id="sales-chart" height="200"></canvas>
                            </div>
                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square text-primary"></i> This year
                                </span>
                                <span>
                                    <i class="fas fa-square text-gray"></i> Last year
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <!-- Another Card or Content -->
                </div>
            </div>
        </div>
    </section>
</div>

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var months = @json($months);
    var thisYearSales = @json($thisYearSales);
    var lastYearSales = @json($lastYearSales);

    var ctx = document.getElementById('sales-chart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'This Year',
                data: thisYearSales,
                borderColor: 'rgba(0, 123, 255, 0.7)',
                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                fill: true,
            }, {
                label: 'Last Year',
                data: lastYearSales,
                borderColor: 'rgba(108, 117, 125, 0.7)',
                backgroundColor: 'rgba(108, 117, 125, 0.2)',
                fill: true,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ₹' + tooltipItem.raw.toFixed(2);
                        }
                    }
                }
            }
        }
    });
</script>
