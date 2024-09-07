@include('layouts.app')
@include('layouts.sidebar')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Invoice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Note:</h5>
                        This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                    </div>

                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> Your Company Name
                                    <small class="float-right">Date: {{ $order->created_at->format('d/m/Y') }}</small>
                                </h4>
                            </div>
                        </div>

                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                From
                                <address>
                                    <strong>Your Company Name</strong><br>
                                    Your Address<br>
                                    City, State, ZIP<br>
                                    Phone: Your Phone Number<br>
                                    Email: Your Email Address
                                </address>
                            </div>

                            <div class="col-sm-4 invoice-col">
                                To
                                <address>
                                    <strong>{{ $order->user->name }}</strong><br>
                                    {{ $order->user->address }}<br>
                                    {{ $order->user->city }}, {{ $order->user->state }} {{ $order->user->zip }}<br>
                                    Phone: {{ $order->user->mobile_no }}<br>
                                    Email: {{ $order->user->email }}
                                </address>
                            </div>

                            <div class="col-sm-4 invoice-col">
                                <b>Invoice #{{ $order->order_id }}</b><br>
                                <b>Order ID:</b> {{ $order->order_id }}<br>
                                <b>Payment Due:</b> {{ $order->created_at->addDays(14)->format('d/m/Y') }}<br>
                                <b>Account:</b> {{ $order->account_number }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Qty</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->OrderItems as $item)
                                        <tr>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->product->name }}</td>
                                            <td>₹ {{ $item->price }}</td>
                                            <td>₹ {{ $item->quantity * $item->price }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <p class="lead">Payment Methods:</p>
                                <img src="../../dist/img/credit/visa.png" alt="Visa">
                                <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                                <img src="../../dist/img/credit/american-express.png" alt="American Express">
                                <img src="../../dist/img/credit/paypal2.png" alt="Paypal">
                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                    Include payment methods and other relevant information here.
                                </p>
                            </div>

                            <div class="col-6">
                                <p class="lead">Amount Due {{ $order->created_at->addDays(14)->format('d/m/Y') }}</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td>₹ {{ $order->total }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tax (9.3%)</th>
                                            <td>₹ {{ $order->total * 0.093 }}</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping:</th>
                                            <td>₹ 50.00</td> <!-- Adjust shipping cost as needed -->
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td>₹ {{ $order->total * 1.093 + 50 }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row no-print">
                            <div class="col-12">
                                <a href="#" onclick="window.print();" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('layouts.footer')
