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
                    <h1>SubCategory Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">SubCategory Details</li>
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
                                    <td>{{ $subCategory->name }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $subCategory->description }}</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td>{{ $subCategory->category->name }}</td>
                                </tr>
                                <tr>
                                    <th>Category Description</th>
                                    <td>{{ $subCategory->category->description }}</td>
                                </tr>
                            </table>
                            <a href="{{ route('subcategories.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('layouts.footer')
