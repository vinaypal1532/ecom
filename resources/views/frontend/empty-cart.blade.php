@extends('frontend.layouts.app')

@section('title', 'Cart Empty')

@section('content')
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">Cart</li>
    </ol>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="{{ asset('images/empty-cart.jpg') }}" alt="Empty Cart" class="mb-4" style="width: 150px; height: auto;">
                <h2 class="mb-4">Your cart is empty</h2>
                <p class="mb-4">It looks like you haven't added any items to your cart yet.</p>
                <a href="{{ route('product') }}" class="btn btn-primary">Continue Shopping</a>
            </div>
        </div>
    </div>
</div>
@endsection
