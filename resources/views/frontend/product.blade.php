@extends('frontend.layouts.app')

@section('title', 'Packages - HolidayThrill: Explore Exclusive Travel Packages for Your Dream Vacation')

@section('description', 'Discover curated travel packages by HolidayThrill. Choose from a variety of options tailored to provide you with unforgettable and personalized travel experiences.')

@section('content')

<style>
    .h5 {
        font-size: 16px;
        font-weight: bold;
        margin: 0px 0px 5px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        text-align: left;
        -webkit-line-clamp: 1;
        line-clamp: 1;
        -webkit-box-orient: vertical;
    }
    .fixed-height-img {
        width: 100%; 
        height: 220px; 
        object-fit: cover; 
    }
</style>
<style>
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    .pagination .page-link {
        font-size: 14px; /* Adjust font size */
        padding: 8px 12px; /* Adjust padding */
    }
    .pagination .page-item {
        margin: 0 2px; /* Adjust spacing between items */
    }
    .pagination .page-item.active .page-link {
        background-color: #007bff; /* Active page color */
        border-color: #007bff; /* Border color for active page */
    }
    .pagination .page-link:hover {
        background-color: #e9ecef; /* Hover color */
        border-color: #ddd; /* Border color on hover */
    }
    .pagination .page-link {
        border-radius: 0.25rem; /* Border radius for rounded corners */
    }
    .pagination .page-link svg {
        width: 16px; /* Adjust size of icons */
        height: 16px; /* Adjust size of icons */
    }
    

</style>

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid page-header py-5">  
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>   
        <li class="breadcrumb-item active text-white">Fresh fruits shop</li>
    </ol>
</div>

<div class="container-fluid fruite py-5">
    <div class="container py-5">    
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-xl-3">
                        <h2>Fresh fruits shop</h2>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-xl-3">
                        <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                            <form id="sorting-form" action="{{ route('product') }}" method="GET">
                                <label for="fruits">Sorting:</label>
                                <select id="fruits" name="sort" class="border-0 form-select-sm bg-light me-3" onchange="document.getElementById('sorting-form').submit();">
                                    <option value="relevance" {{ request('sort') == 'relevance' ? 'selected' : '' }}>Relevance</option>
                                    <option value="low_to_high" {{ request('sort') == 'low_to_high' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="high_to_low" {{ request('sort') == 'high_to_low' ? 'selected' : '' }}>Price: High to Low</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>Categories</h4>
                                    <ul class="list-unstyled fruite-categorie border-bottom-list">
                                        <li>
                                            <a href="{{ route('product') }}" class="d-flex justify-content-between fruite-name">
                                              All Categories
                                                <span>({{ $products->total() }})</span>
                                            </a>
                                        </li>
                                        @foreach($subcategoryCounts as $subcategory)
                                            <li>
                                                <a href="{{ route('product', ['subcategory' => $subcategory->id]) }}" class="d-flex justify-content-between fruite-name">
                                                 {{ $subcategory->name }}
                                                    <span>({{ $subcategory->products_count }})</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>                                              
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row g-4">
                            @foreach($products as $product)
                                <div class="col-lg-4 col-md-6">
                                    <div class="product-item position-relative bg-light overflow-hidden">
                                        <div class="row p-0 m-0">
                                            <div class="col-lg-12 col-md-6 col-12 p-0">
                                                <a href="{{ route('product-detail', ['id' => $product->id]) }}">
                                                    <div class="product-image w-100">
                                                        <img class="img-fluid fixed-height-img" src="{{ asset('images/product/' . $product->image) }}" alt="Fresh Apple">
                                                    </div>
                                                </a>
                                                <div class="p-2">
                                                    <a class="h5 d-block" href="{{ route('product-detail', ['id' => $product->id]) }}">{{ $product->name }}</a>
                                                    <div class="d-flex flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">₹ {{ $product->discount_price }}</p>
                                                        <p class="text-muted fs-5 mb-0" style="text-decoration: line-through;margin-left: 12px;">₹ {{ $product->price }}</p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form id="add-to-cart-form-{{ $product->id }}" class="p-3" method="POST" action="{{ route('cart.add') }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="product_name" value="{{ $product->name }}">
                                            <input type="hidden" name="product_price" value="{{ $product->discount_price }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="button" class="btn btn-outline-dark w-100 add-to-cart-btn" data-product-id="{{ $product->id }}">Add to Cart</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                   
                      

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
