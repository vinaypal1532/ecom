@include('layouts.app')
@include('layouts.sidebar')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Create Product</li>
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

                        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="name">Product Name</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ old('name') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="subcategory_id">Sub Category</label>
                                            <select class="form-control" name="subcategory_id" id="subcategory_id">
                                                @foreach ($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="price">Price</label>
                                            <input type="number" class="form-control" name="price" id="price" placeholder="Price" value="{{ old('price') }}" step="0.01">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="stock">Discount Price</label>
                                            <input type="number" class="form-control" name="discount_price" id="discount_price" placeholder="Discount Price" value="{{ old('discount_price') }}" min="0">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="stock">Stock</label>
                                            <input type="number" class="form-control" name="stock" id="stock" placeholder="Stock" value="{{ old('stock') }}" min="0">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Description">{{ old('description') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control" name="image" id="image">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="type">Type</label>
                                            <input type="text" class="form-control" name="type" id="type" placeholder="Type" value="{{ old('type') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="status">Status</label>
                                            <select id="status" name="status" class="form-control" required>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                                <option value="2">Block</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('layouts.footer')
