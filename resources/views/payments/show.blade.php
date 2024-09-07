@include('layouts.app')
@include('layouts.sidebar')

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
                    <h1>Payment Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Payment Details</li>
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
                            <table class="table table-bordered">
                                <tr>
                                    <th>Order ID</th>
                                    <td>{{ $payment->order_id }}</td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td>{{ $payment->amount }}</td>
                                </tr>
                                <tr>
                                    <th>Method</th>
                                    <td>{{ $payment->method }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $payment->status }}</td>
                                </tr>
                            </table>
                            <a href="{{ route('payments.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('layouts.footer')
