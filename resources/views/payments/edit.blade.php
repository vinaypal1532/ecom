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
                <div class="col-md-6">
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

                        <form action="{{ route('products.update', $product->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $product->name) }}" placeholder="Name">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Description">{{ old('description', $product->description) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" step="0.01" class="form-control" name="price" id="price" value="{{ old('price', $product->price) }}" placeholder="Price">
                                </div>

                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="number" class="form-control" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" placeholder="Stock">
                                </div>

                                <div class="form-group">
                                    <label for="subcategory_id">SubCategory</label>
                                    <select class="form-control" name="subcategory_id" id="subcategory_id">
                                        @foreach ($subCategories as $subCategory)
                                            <option value="{{ $subCategory->id }}" {{ $product->subcategory_id == $subCategory->id ? 'selected' : '' }}>
                                                {{ $subCategory->name }} ({{ $subCategory->category->name }})
                                            </option>
                                        @endforeach
                                    </select>
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
