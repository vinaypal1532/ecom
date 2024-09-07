@include('layouts.app')
@include('layouts.sidebar')

<!-- DataTables CSS -->
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
                    <h1>Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <a href="{{ route('products.create') }}" class="btn btn-info">Add New Product</a>
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
                        <div class="card-body" style="overflow-x:auto;">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Name</th>
                                        <th>Stock</th>
                                        <th>SubCategory</th>
                                        <th>Price</th>
                                        <th>Discount Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->subCategory->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->discount_price }}</td>
                                        <td class="project-state">
                                            @if ($product->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @elseif ($product->status == 0)
                                                <span class="badge badge-warning">Inactive</span>
                                            @else
                                                <span class="badge badge-danger">Blocked</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">View</a>
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>    
                                    @endforeach                       
                                </tbody>
                                <tfoot>
                                    <!-- Optional footer content -->
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>   
            </div>      
        </div>      
    </section>
</div>

<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script>
    $.noConflict();
    jQuery(document).ready(function ($) {
        $('#example1').DataTable();
    });
</script>

@include('layouts.footer')
