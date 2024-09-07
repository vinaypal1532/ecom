@include('layouts.app')
@include('layouts.sidebar')
<!-- DataTables CSS -->
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
                    <h1>Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
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
                        <div class="card-body" style="overflow-x:auto;">
                            <table id="ordersTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>User</th>
                                        <th>Order Id</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->order_id }}</td>
                                        <td>₹ {{ number_format($order->total, 2) }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>
                                        <a href="{{ route('invoice.show', $order->order_id) }}" class="btn btn-secondary">View Invoice</a>
                                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info">View</a>
                                            <a href="#" class="btn btn-warning">Edit</a>
                                            <form action="#" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>    
                                    @endforeach                       
                                </tbody>
                                <tfoot>
                                    <!-- Optional footer content -->
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>      
        </div>      
    </section>
</div>

<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script>
    $.noConflict();
    jQuery(document).ready(function ($) {
        $('#ordersTable').DataTable();
    });
</script>

@include('layouts.footer')
