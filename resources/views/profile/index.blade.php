@extends('frontend.layouts.app')

@section('title', 'Profile Page ')

@section('content')

<div class="container-fluid page-header py-5">
        <div class="container">
            <div class="main-body">
                <div class="row">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

               @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQtbEsykx-0fhTred6UwHDYtMFd2UgTJCG4gaklT1dx4suRO4_n5LJr4Gg28kquSX5fpNo&usqp=CAU" alt="Admin"
                                        class="rounded-circle p-1 bg-warning" width="110">
                                    <div class="mt-3">
                                        <h4>{{ $user->name }}</h4>
                                        <p class="text-secondary mb-1">{{ $user->mobile_no }}</p>
                                        <p class="text-muted font-size-sm">{{ $user->city }}</p>
                                    </div>
                                </div>
                                <div class="list-group list-group-flush text-center mt-4">
                                    <a href="#" class="list-group-item list-group-item-action border-0 active" onclick="showProfileDetails()">
                                        Profile Information
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action border-0" onclick="showOrderDetails()">Orders</a>
                                    <a href="#" class="list-group-item list-group-item-action border-0"
                                        onclick="showAddressBook()">
                                        Address Book
                                    </a>
                                    <a href="{{ route('logout') }}" class="list-group-item list-group-item-action border-0">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                       <div class="col-lg-8">

                        <div id="orderDetails" class="order_card" style="display: none;">
                            <div class="card">
                                <div class="card-body">
                                    <div class="top-status">
                                        <h5>ORDER</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-4">
                                <div class="card-body p-0 table-responsive">
                                    <h4 class="p-3 mb-0">Order Details</h4>
                                    <table class="table mb-0 table-striped table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Description</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Amount/Quantity</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($orders as $order)
                                                @foreach($order->orderItems as $item)
                                                    <tr>
                                                        <td class="text-center">
                                                            <img src="{{ asset('images/product/' . $item->product->image) }}"
                                                                alt="product" class="img-fluid" width="80">
                                                        </td>
                                                        <td>{{ $item->product->name ?? 'Product Name' }}</td>
                                                        <td>₹{{ number_format($item->price, 2) }} X {{ $item->quantity }}</td>
                                                        <td><strong>₹{{ number_format($item->price * $item->quantity, 2) }}</strong></td>
                                                        <td>
                                                            @if($order->status === 'pending')
                                                                <span class="badge bg-warning text-dark">Pending</span>
                                                            @elseif($order->status === 'success')
                                                                <span class="badge bg-success">Success</span>
                                                            @else
                                                                <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <th colspan="3">
                                                        <span>Order Id:</span> {{ $order->order_id }}
                                                    </th>
                                                    <td>
                                                        <span class="text-muted">Grand Total</span>
                                                        <strong>₹{{ number_format($order->total, 2) }}</strong>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a href="{{ route('invoicess', $item->order_id) }}" class="me-3">
                                                                <i class="fa fa-download me-2"></i> 
                                                            </a>
                                                            <a href="{{ route('cancel', $item->id) }}">
                                                                <i class="fa fa-times"></i> 
                                                            
                                                            </a>
                                                        </div>
                                                    </td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">No orders found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div id="profileDetails" class="card" style="display: none;">
                        <div class="card-body">
                            <h5>Update Profile Information</h5>
                            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="name"><strong>Name:</strong></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="email"><strong>Email Address:</strong></label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="mobile_no"><strong>Mobile Number:</strong></label>
                                    <input type="tel" class="form-control" id="mobile_no" name="mobile_no" value="{{ old('mobile_no', $user->mobile_no) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="city"><strong>City:</strong></label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $user->city) }}" required>
                                </div>

                                <button type="submit" class="btn btn-custom">Update Profile</button>
                            </form>
                        </div>
                    </div>


                        <div id="addressBook" class="card" style="display: block;">
                            <div class="card-body">
                                <h5>Address Book</h5>
                                <button class="btn btn-primary mb-3" onclick="showAddAddressModal()">Add Address</button>
                                <div id="addressList">
                                    @foreach($addresses as $address)
                                        <div class="address-item mb-3">
                                            <strong>{{ $address->name }} {{ $address->mobile }}</strong>
                                            <p>
                                                {{ $address->address }}, {{ $address->locality }}, {{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}
                                                @if($address->landmark)
                                                    <br><b>Landmark: {{ $address->landmark }} </b>
                                                @endif
                                                @if($address->alternatePhone)
                                                    <br>Alternate Phone: {{ $address->alternatePhone }}
                                                @endif
                                            </p>
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editAddressModal" data-address-id="{{ $address->id }}" data-name="{{ $address->name }}" data-mobile="{{ $address->mobile }}" data-address="{{ $address->address }}" data-locality="{{ $address->locality }}" data-city="{{ $address->city }}" data-state="{{ $address->state }}" data-pincode="{{ $address->pincode }}" data-landmark="{{ $address->landmark }}" data-alternate-phone="{{ $address->alternatePhone }}">Edit</button>
                                            <button class="btn btn-danger btn-sm delete-address" data-address-id="{{ $address->id }}">Delete</button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div id="addAddressModal" class="modal" style="display: none;">
                            <div class="modal-content">
                                <span class="close" onclick="closeAddAddressModal()">&times;</span>
                                <h2>Add Address</h2>

                                <form id="addAddressForm" action="{{ route('address.store') }}" method="post">
                                @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="name">Name:</label>
                                            <input type="text" id="name" name="name" class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="mobile">Mobile No.:</label>
                                            <input type="tel" id="mobile" class="form-control" name="mobile" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="pincode">Pin code:</label>
                                            <input type="text" id="pincode" class="form-control" name="pincode" required>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <label for="locality">Locality:</label>
                                            <input type="text" id="locality" name="locality" class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="city">City/District/Town:</label>
                                            <input type="text" id="city" name="city" class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="state">State:</label>
                                            <select id="state" name="state" class="form-control" required>
                                                <option value="mp">Madhya Pradesh</option>
                                                <option value="delhi">Delhi</option>
                                                <option value="gj">Gujarat</option>
                                                <option value="punjab">Punjab</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <label for="address">Address:</label>
                                            <textarea id="address" name="address" class="form-control" rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <label for="landmark">Landmark (Optional):</label>
                                            <input type="text" id="landmark" name="landmark" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <label for="alternatePhone">Alternate Phone (Optional):</label>
                                            <input type="text" id="alternatePhone" name="alternatePhone" class="form-control">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Add Address</button>
                                </form>
                            </div>
                        </div>

                        
<!-- Edit Address Modal -->
<div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAddressModalLabel">Edit Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editAddressForm" action="{{ route('address.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="id" id="address-id">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="locality" class="form-label">Locality</label>
                        <input type="text" class="form-control" id="locality" name="locality" required>
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    <div class="mb-3">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" id="state" name="state" required>
                    </div>
                    <div class="mb-3">
                        <label for="pincode" class="form-label">Pincode</label>
                        <input type="text" class="form-control" id="pincode" name="pincode" required>
                    </div>
                    <div class="mb-3">
                        <label for="landmark" class="form-label">Landmark (Optional)</label>
                        <input type="text" class="form-control" id="landmark" name="landmark">
                    </div>
                    <div class="mb-3">
                        <label for="alternatePhone" class="form-label">Alternate Phone (Optional)</label>
                        <input type="text" class="form-control" id="alternatePhone" name="alternatePhone">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
        
          <script>
       function showProfileDetails() {
    document.getElementById('profileDetails').style.display = 'block';
    document.getElementById('orderDetails').style.display = 'none';
    document.getElementById('addressBook').style.display = 'none';
}

function showOrderDetails() {
    document.getElementById('profileDetails').style.display = 'none';
    document.getElementById('orderDetails').style.display = 'block';
    document.getElementById('addressBook').style.display = 'none';
}

function showAddressBook() {
    document.getElementById('profileDetails').style.display = 'none';
    document.getElementById('orderDetails').style.display = 'none';
    document.getElementById('addressBook').style.display = 'block';
}

function showAddAddressModal() {
    document.getElementById('addAddressModal').style.display = 'block';
}

function closeAddAddressModal() {
    document.getElementById('addAddressModal').style.display = 'none';
}

function showUpdateAddressModal() {
    document.getElementById('updateAddressModal').style.display = 'block';
}

function closeUpdateAddressModal() {
    document.getElementById('updateAddressModal').style.display = 'none';
}
document.addEventListener('DOMContentLoaded', function () {
        var addressModal = document.getElementById('editAddressModal');
        addressModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var addressId = button.getAttribute('data-address-id');
            var name = button.getAttribute('data-name');
            var mobile = button.getAttribute('data-mobile');
            var address = button.getAttribute('data-address');
            var locality = button.getAttribute('data-locality');
            var city = button.getAttribute('data-city');
            var state = button.getAttribute('data-state');
            var pincode = button.getAttribute('data-pincode');
            var landmark = button.getAttribute('data-landmark');
            var alternatePhone = button.getAttribute('data-alternate-phone');

            var modalBody = addressModal.querySelector('.modal-body');
            modalBody.querySelector('#address-id').value = addressId;
            modalBody.querySelector('#name').value = name;
            modalBody.querySelector('#mobile').value = mobile;
            modalBody.querySelector('#address').value = address;
            modalBody.querySelector('#locality').value = locality;
            modalBody.querySelector('#city').value = city;
            modalBody.querySelector('#state').value = state;
            modalBody.querySelector('#pincode').value = pincode;
            modalBody.querySelector('#landmark').value = landmark;
            modalBody.querySelector('#alternatePhone').value = alternatePhone;
        });
    });


</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-address').forEach(button => {
            button.addEventListener('click', function () {
                const addressId = this.getAttribute('data-address-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Perform the delete operation
                        fetch(`/addresses/${addressId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your address has been deleted.',
                                    'success'
                                ).then(() => {
                                    // Optionally, remove the address from the DOM
                                    button.closest('.address-item').remove();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'There was an error deleting the address.',
                                    'error'
                                );
                            }
                        })
                        .catch(error => {
                            Swal.fire(
                                'Error!',
                                'There was an error deleting the address.',
                                'error'
                            );
                        });
                    }
                });
            });
        });
    });
</script>

<style>
/* Container and Card Styling */
.card {
    border: 1px solid #ddd; /* Light border */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    padding: 20px; /* Padding around the card */
}

/* Form Group Styling */
.form-group {
    margin-bottom: 15px; /* Space between form groups */
}

/* Form Control Styling */
.form-control {
    border-radius: 5px; /* Rounded input corners */
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1); /* Inner shadow for inputs */
}

/* Button Styling */
.btn-custom {
    background-color: #007bff; /* Primary color */
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.3s;
}

.btn-custom:hover {
    background-color: #0056b3; /* Darker shade for hover */
    transform: scale(1.05); /* Slightly enlarge the button */
}

.btn-custom:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(38, 143, 255, 0.5); /* Custom focus ring */
}

.btn-custom:disabled {
    background-color: #b0b0b0;
    cursor: not-allowed;
}

.card {
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 20px;
}

.card-body {
    padding: 20px;
}

.card img {
    max-width: 100%;
    border-radius: 50%;
}

.card .top-status {
    background-color: #f8f9fa;
    padding: 10px;
    border-bottom: 1px solid #dee2e6;
}

/* Address Book */
.address-item {
    border: 1px solid #dee2e6;
    border-radius: 5px;
    padding: 15px;
}


    .address-item:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    background-color: #fff;
    margin: 10% auto;
    padding: 20px;
    border-radius: 5px;
    width: 80%;
    max-width: 500px;
}

.modal-content .close {
    color: #000;
    float: right;
    font-size: 30px;
    font-weight: bold;
}

.modal-content .close:hover,
.modal-content .close:focus {
    color: #f00;
    text-decoration: none;
    cursor: pointer;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .card {
        margin-bottom: 10px;
    }

    .modal-content {
        width: 90%;
    }

    .row {
        flex-direction: column;
    }

    .col-md-4 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}

@media (max-width: 576px) {
    .card img {
        width: 80px;
        height: 80px;
    }

    .modal-content {
        width: 95%;
    }
}
.table-bordered {
    border-collapse: separate;
    border-spacing: 0; /* Remove default spacing between rows */
}

.order-row, .order-summary {
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Adds shadow to rows */
    border-radius: 0.25rem; /* Rounds the corners of rows */
    margin-bottom: 1rem; /* Adds space between order rows */
}

.order-summary {
    margin-bottom: 2rem; /* Adds extra space below the summary row */
}

.order-row th, .order-row td, .order-summary td {
    vertical-align: middle;
    border: 1px solid #dee2e6; /* Borders for individual cells */
}

.table img {
    max-width: 100%;
    height: auto;
    border-radius: 0.25rem; /* Rounds the corners of images */
}

.table .badge {
    padding: 0.5em 0.75em;
    font-size: 0.9em;
}

.text-center {
    text-align: center;
}

.text-muted {
    color: #6c757d;
}

.d-flex {
    display: flex;
    align-items: center;
}

.justify-content-between {
    justify-content: space-between;
}

@media (max-width: 768px) {
    .order-row, .order-summary {
        display: block;
        margin-bottom: 1rem;
    }

    .order-row th, .order-row td, .order-summary td {
        display: block;
        text-align: left;
        padding: 0.5rem;
    }

    .order-row img {
        margin-bottom: 0.5rem;
    }
}
.thead-dark{
    background-color: #505050;
    color: #fff;
}
.modal-backdrop {
    z-index: 1040 !important;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal {
    z-index: 1050 !important;
}

    </style>
@endsection
