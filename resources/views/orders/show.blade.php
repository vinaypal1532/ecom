@include('layouts.app')
@include('layouts.sidebar')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Order Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="container" style="padding: 20px;">
                            <!-- Display Order Details -->
                            <table class="table table-bordered">
                                <tr>
                                    <th>Order ID</th>
                                    <td>{{ $order->order_id }}</td>
                                </tr>
                                <tr>
                                    <th>Customer Name</th>
                                    <td>{{ $order->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Total Amount</th>
                                    <td>₹ {{ $order->total }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $order->status }}</td>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <td>{{ $order->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile No</th>
                                    <td>{{ $order->user->mobile_no }}</td>
                                </tr>
                                <tr>
                                    <th>Email Id</th>
                                    <td>{{ $order->user->email }}</td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td>{{ $order->user->city }}</td>
                                </tr>
                            </table>

                            <!-- Display Order Items -->
                            <h3>Order Items</h3>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->OrderItems as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>₹ {{ $item->price }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <a href="{{ route('invoice.show', $order->order_id) }}" class="btn btn-secondary">View Invoice</a>
                            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script>
    $.noConflict();
    jQuery(document).ready(function ($) {
        $('#example1').DataTable();
    });
</script>
@include('layouts.footer')
