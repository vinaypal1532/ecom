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
                    <h1>Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <a href="{{ route('categories.create') }}" class="btn btn-info">Add New Category</a>
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
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>
                                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info">View</a>
                                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
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
