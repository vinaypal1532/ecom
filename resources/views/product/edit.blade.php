@include('layouts.app')
@include('layouts.sidebar')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Product</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="card card-primary">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="name">Product Name</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ old('name', $product->name) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="subcategory_id">Sub Category</label>
                                            <select class="form-control" name="subcategory_id" id="subcategory_id">
                                                @foreach ($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}" {{ $product->subcategory_id == $subcategory->id ? 'selected' : '' }}>
                                                        {{ $subcategory->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="price">Price</label>
                                            <input type="number" class="form-control" name="price" id="price" placeholder="Price" value="{{ old('price', $product->price) }}" step="0.01">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="stock">Discount Price</label>
                                            <input type="number" class="form-control" name="discount_price" id="discount_price" placeholder="Stock" value="{{ old('discount_price', $product->discount_price) }}" min="0">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="stock">Stock</label>
                                            <input type="number" class="form-control" name="stock" id="stock" placeholder="Stock" value="{{ old('stock', $product->stock) }}" min="0">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Description">{{ old('description', $product->description) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control" name="image" id="image"><br/>
                                            @if($product->image)
                                                <img src="{{ asset('images/product/' . $product->image) }}" alt="{{ $product->name }}" width="100" height="100">
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label for="type">Type</label>
                                            <input type="text" class="form-control" name="type" id="type" placeholder="Type" value="{{ old('type', $product->type) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="status">Status</label>
                                            <select id="status" name="status" class="form-control">
                                                <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                <option value="2" {{ $product->status == 2 ? 'selected' : '' }}>Blocked</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('layouts.footer')
