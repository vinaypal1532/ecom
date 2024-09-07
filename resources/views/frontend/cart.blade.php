@extends('frontend.layouts.app')

@section('title', 'Cart')

@section('content')
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">Cart</li>
    </ol>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row">
            <!-- Cart Items Table -->
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Products</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody id="cart-items">
                        @forelse ($cart as $id => $item)
                        <tr data-id="{{ $id }}">
                            <th scope="row">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('images/product/' . $item['image']) }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="{{ $item['name'] }}">
                                </div>
                            </th>
                            <td>
                                <p class="mb-0 mt-4">{{ $item['name'] }}</p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4">₹ {{ number_format($item['price'], 2) }} </p>
                            </td>
                            <td>
                                <div class="input-group quantity mt-4" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border update-quantity" data-action="decrease">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0" value="{{ $item['quantity'] }}" data-id="{{ $id }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border update-quantity" data-action="increase">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 mt-4">₹ {{ number_format($item['price'] * $item['quantity'], 2) }} </p>
                            </td>
                            <td>
                                <button class="btn btn-md rounded-circle bg-light border mt-4 remove-item" data-id="{{ $id }}">
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Your cart is empty</td>
                        </tr>
                        @endforelse
                    </tbody>

                    </table>
                </div>
                <div class="mt-5">
                    <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
                    <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply Coupon</button>
                </div>
            </div>
            <!-- Cart Summary -->
            <div class="col-md-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4 cart-heading">Cart Totals</h1>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Subtotal:</h5>
                            <p class="mb-0" id="cart-subtotal">₹ 0</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Shipping</h5>
                            <div class="">
                                <p class="mb-0" id="cart-shipping">₹ </p>
                            </div>
                        </div>
                       
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Total</h5>
                        <p class="mb-0 pe-4" id="cart-total">₹ </p>
                    </div>
                    <a href="{{ route('checkout')}}" class="btn border-secondary px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Attach event listeners to quantity buttons
        document.querySelectorAll('.update-quantity').forEach(button => {
            button.addEventListener('click', function() {
                const action = this.getAttribute('data-action');
                const id = this.closest('tr').getAttribute('data-id');
                updateCartQuantity(id, action);
            });
        });

        // Attach event listeners to remove buttons
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                removeCartItem(id);
            });
        });

        // Initial calculation of cart totals
        updateCartTotals(@json($cart));
    });

    function updateCartQuantity(id, action) {
        const quantityInput = document.querySelector(`input[data-id="${id}"]`);
        let quantity = parseInt(quantityInput.value);

        if (isNaN(quantity)) {
            console.error(`Invalid quantity for item ${id}: ${quantityInput.value}`);
            return;
        }

        if (action === 'increase') {
            quantity++;
        } else if (action === 'decrease' && quantity > 1) {
            quantity--;
        }

        fetch('{{ route('cart.update') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id, quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                quantityInput.value = quantity;
                updateCartTotals(data.cart);

                // Update the individual item total price in the DOM
                const itemTotalPriceElement = document.querySelector(`tr[data-id="${id}"] td:nth-child(5) p`);
                const itemTotalPrice = data.cart[id].price * data.cart[id].quantity;
                itemTotalPriceElement.innerText = `₹ ${itemTotalPrice.toFixed(2)}`;
                Swal.fire({
                
                html: "Cart is Updating <b></b> .",
                timer: 400,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                    timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
                })
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to update cart quantity.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error!',
                text: 'An unexpected error occurred.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    }

    function removeCartItem(id) {
        fetch('{{ route('cart.remove') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector(`tr[data-id="${id}"]`).remove();
                updateCartTotals(data.cart);
                let timerInterval;
Swal.fire({
  title: "Cart is Updating",
  html: "I will close in <b></b> milliseconds.",
  timer: 500,
  timerProgressBar: true,
  didOpen: () => {
    Swal.showLoading();
    const timer = Swal.getPopup().querySelector("b");
    timerInterval = setInterval(() => {
      timer.textContent = `${Swal.getTimerLeft()}`;
    }, 100);
  },
  willClose: () => {
    clearInterval(timerInterval);
  }
}).then((result) => {
  /* Read more about handling dismissals below */
  if (result.dismiss === Swal.DismissReason.timer) {
    console.log("I was closed by the timer");
  }
});
            } else {
                let timerInterval;
Swal.fire({
    title: "Cart is Updating",
  html: "I will close in <b></b> milliseconds.",
  timer: 500,
  timerProgressBar: true,
  didOpen: () => {
    Swal.showLoading();
    const timer = Swal.getPopup().querySelector("b");
    timerInterval = setInterval(() => {
      timer.textContent = `${Swal.getTimerLeft()}`;
    }, 100);
  },
  willClose: () => {
    clearInterval(timerInterval);
  }
}).then((result) => {
  /* Read more about handling dismissals below */
  if (result.dismiss === Swal.DismissReason.timer) {
    console.log("I was closed by the timer");
  }
});
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error!',
                text: 'An unexpected error occurred.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    }

    function updateCartTotals(cart) {
        
        const subtotal = Object.values(cart).reduce((total, item) => total + (item.price * item.quantity), 0);
        const shipping = subtotal > 500 ? 0 : 49;
        const total = subtotal + shipping;

        document.getElementById('cart-subtotal').innerText = `₹ ${subtotal.toFixed(2)}`;
        document.getElementById('cart-shipping').innerText = `₹ ${shipping.toFixed(2)}`;
        document.getElementById('cart-total').innerText = `₹ ${total.toFixed(2)}`;
    }
</script>



@endsection
