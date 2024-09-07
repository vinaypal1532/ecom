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
                    <h1>Testimonial</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <a href="{{ route('add_testi')}}" class="btn btn-info">Add Testimonial</a>
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
                                            <th>Email</th>             
                                            <th>City</th>
                                            <th>Mobile No</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>              
                                        @php $i = 1; @endphp
                                        @foreach ($testimonials as $client)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $client->name }}</td>    
                                                <td>{{ $client->message }}</td>
                                                <td>{{ $client->city }}</td>
                                                <td>{{ $client->rating }}</td>
                                                <td class="project-state">
                                                    @if ($client->status == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-warning">Inactive</span>                               
                                                    @endif
                                                </td>
                                                <td>
                                                    @can('admin-access')
                                                        <a href="#" class="btn btn-info">Show</a>
                                                        <form action="{{ route('testimonials.destroy', $client->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">
                                                                Delete
                                                            </button>
                                                        </form>

                                                    @endcan
                                                </td>
                                            </tr>    
                                        @endforeach                       
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
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