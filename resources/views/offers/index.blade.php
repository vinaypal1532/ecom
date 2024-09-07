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
                    <h1>Offers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Offers</li>
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
                            <a href="{{ route('offers.create') }}" class="btn btn-primary mb-3">Create New Offer</a>
                            <table id="offersTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Discount (%)</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($offers as $offer)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $offer->title }}</td>
                                        <td>{{ $offer->type }}</td>
                                        <td>{{ $offer->discount_percentage }}</td>
                                        <td>{{ $offer->start_date }}</td>
                                        <td>{{ $offer->end_date }}</td>
                                        <td>{{ $offer->status }}</td>
                                        <td>
                                            <a href="{{ route('offers.edit', $offer->id) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('offers.destroy', $offer->id) }}" method="POST" style="display:inline;">
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
        $('#offersTable').DataTable();
    });
</script>

@include('layouts.footer')
