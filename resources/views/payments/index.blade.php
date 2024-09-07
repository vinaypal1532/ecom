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
                    <h1>Payments</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Payments</li>
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
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Order ID</th>
                                        <th>Amount</th>
                                        <th>Method</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $payment->order_id }}</td>
                                        <td>₹ {{ number_format($payment->amount, 2) }}</td>
                                        <td>{{ $payment->method }}</td>
                                        <td>{{ $payment->status }}</td>
                                        <td>{{ $payment->created_at }}</td>
                                        <td>
                                            <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-info">View</a>
                                            <a href="" class="btn btn-warning">Edit</a>
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
        $('#example1').DataTable();
    });
</script>

@include('layouts.footer')
