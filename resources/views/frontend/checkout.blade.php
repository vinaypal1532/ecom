@extends('frontend.layouts.app')

@section('title', 'Checkout')

@section('content')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Checkout</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">Checkout</li>
    </ol>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12 col-lg-8 col-xl-7">               
                    @if($addresses->isEmpty())
                        <div class="row">
                            <div class="col-md-12 col-lg-8 col-xl-7">
                                <div class="form-item">
                                    <label class="form-label my-3">Full Name<sup>*</sup></label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>                               
                             
                                <div class="form-item">
                                    <label class="form-label my-3">Address <sup>*</sup></label>
                                    <input type="text" name="address" class="form-control" placeholder="House Number Street Name" required>
                                </div>
                                <div class="form-item">
                                    <label class="form-label my-3">Town/City<sup>*</sup></label>
                                    <input type="text" name="city" class="form-control" required>
                                </div>
                                <div class="form-item">
                                    <label class="form-label my-3">State<sup>*</sup></label>
                                    <input type="text" name="state" class="form-control" required>
                                </div>
                                <div class="form-item">
                                    <label class="form-label my-3">Pincode/Zip<sup>*</sup></label>
                                    <input type="text" name="pincode" class="form-control" required>
                                </div>
                                <div class="form-item">
                                    <label class="form-label my-3">Mobile<sup>*</sup></label>
                                    <input type="tel" name="mobile" class="form-control" required>
                                </div>
                                <div class="form-item">
                                    <label class="form-label my-3">Email Address<sup>*</sup></label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="form-item">
                                    <label class="form-label my-3">Alternate Mobile<sup>*</sup></label>
                                    <input type="text" name="alternate_phone" class="form-control" required>
                                </div>
                                <div class="form-item">
                                    <label class="form-label my-3">locality<sup>*</sup></label>
                                    <input type="text" name="locality" class="form-control" required>
                                </div>                
                             
                                <div class="form-item">
                                <label class="form-label my-3">Landmark<sup>*</sup></label>
                                <input type="text" name="landmark" class="form-control" required>                                 
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-md-12 col-lg-12">
                       <ul class="list-group mb-4">
                            @foreach($addresses as $address)
                                <li class="list-group-item d-flex align-items-center">
                                    <input type="radio" id="address_{{ $address->id }}" name="selected_address" value="{{ $address->id }}" class="mr-3 form-check-input" checked>
                                    <div class="address-details flex-grow-1">
                                        <strong>{{ $address->name }} ({{ $address->mobile }})</strong>
                                        <p>
                                            {{ $address->address }}, {{ $address->locality }}, {{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}
                                        </p>
                                        @if($address->landmark)
                                            <p><b>Landmark: </b> {{ $address->landmark }}</p>
                                        @endif
                                        @if($address->alternatePhone)
                                            <p>Alternate Phone: {{ $address->alternatePhone }}</p>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                    </ul>


                        </div>
                    @endif
                    <!-- Address Form End -->
                </div>

                <div class="col-md-12 col-lg-4 col-xl-5">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-start">Price Details</th>
                                    <th scope="col" class="text-end">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                <tr>
                                    <td class="py-3 text-dark">Price ({{ count(Session::get('cart', [])) }} item{{ count(Session::get('cart', [])) > 1 ? 's' : '' }})</td>
                                    <td class="py-3 text-end text-dark">₹  {{ number_format($subtotal, 2) }}</td>
                                </tr>
                              
                                <tr>
                                    <td class="py-3 text-dark">Shipping</td>
                                    <td class="py-3 text-end text-dark">₹  {{ number_format($shipping, 2) }}</td>
                                </tr>
                             
                                <tr class="border-top border-dark">
                                    <td class="py-3 text-dark text-uppercase">Total Payable</td>
                                    <td class="py-3 text-end text-dark">₹  {{ number_format($total, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Payment Method -->
                    <div class="form-check my-3">
                        <input type="radio" class="form-check-input" id="payment-cod" name="payment_method" value="payment" checked>
                        <label class="form-check-label" for="payment-cod">Payment gateway</label>
                    </div>

                    <div class="form-check my-3">
                        <input type="radio" class="form-check-input" id="payment-cod" name="payment_method" value="cod" checked>
                        <label class="form-check-label" for="payment-cod">Cash on Delivery</label>
                    </div>

                    <!-- Place Order Button -->
                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <button type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<style>

   .flex-grow-1 {
    padding: 10px 0px 10px 20px;
    }
</style>

@endsection
