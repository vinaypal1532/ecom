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
                    <h1>Product Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product Details</li>
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
                                    <th>Name</th>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>{{ $product->price }}</td>
                                </tr>
                                <tr>
                                    <th>Discount Price</th>
                                    <td>{{ $product->discount_price }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $product->description }}</td>
                                </tr>
                                <tr>
                                    <th>Stock</th>
                                    <td>{{ $product->stock }}</td>
                                </tr>
                                <tr>
        <th>Status</th>
        <td>
            @if($product->status == 1)
                Active
            @elseif($product->status == 0)
                Pending
            @elseif($product->status == 2)
                Blocked
            @else
                Unknown Status
            @endif
        </td>
    </tr>

                                <tr>
                                    <th>Image</th>
                                    <td>
                                        @if($product->image)
                                            <img src="{{ asset('images/product/' . $product->image) }}" alt="{{ $product->name }}" width="64" height="64">
                                        @else
                                            No image available
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Type</th>
                                    <td>{{ $product->type }}</td>
                                </tr>
                                <tr>
                                    <th>SubCategory</th>
                                    <td>{{ $product->subCategory->name ?? 'N/A' }}</td>
                                </tr>
                            </table>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products List</a>
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
