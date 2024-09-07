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
                    <h1>User Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Details</li>
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
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $client->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $client->email }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Mobile No</th>
                                        <td>{{ $client->mobile_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td>{{ $client->city }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{{ $client->status }}</td>
                                    </tr>
                                    <tr>
                                        <th>Address </th>
                                        <td>  @foreach($addresses as $address)
        <li>{{ $address->name }}( {{ $address->mobile }} ), {{ $address->address }}, {{ $address->city }}, {{ $address->state }} - {{ $address->pincode }} - {{ $address->landmark }}</li>
    @endforeach</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="{{ route('user.index') }}" class="btn btn-secondary" style="margin:10px;">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('layouts.footer')
