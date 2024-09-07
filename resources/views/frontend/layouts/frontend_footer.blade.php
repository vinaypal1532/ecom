<style>

.swal2-popup {
    width: 300px !important; /* Adjust width as needed */
    height: auto !important; /* Adjust height as needed, or use a fixed height */
}

.swal2-title {
    font-size: 16px; 
}

.swal2-content {
    font-size: 14px;
}
</style>
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
            <div class="container py-5">
                <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <a href="#">
                                <h1 class="text-primary mb-0">Fruitables</h1>
                                <p class="text-secondary mb-0">Fresh products</p>
                            </a>
                        </div>
                        <div class="col-lg-6">
                        <div class="position-relative mx-auto">
                            <form id="subscription-form" method="POST" action="{{ route('subscribe') }}">
                                @csrf
                                <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="email" name="email" placeholder="Your Email" required>
                                <button type="submit" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;">Subscribe Now</button>
                            </form>
                            <div id="response-message" class="mt-3">                            
                            </div>
                        </div>

                        </div>
                        <div class="col-lg-3">
                            <div class="d-flex justify-content-end pt-3">
                                <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                                <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="text-light mb-3">Why People Like us!</h4>
                            <p class="mb-4">Fruitables is an online platform offering fresh fruits and vegetables delivered to your doorstep.Browse our wide selection, add items to your cart, and proceed to checkout. </p>
                          
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="d-flex flex-column text-start footer-item">
                            <h4 class="text-light mb-3">Shop Info</h4>
                            <a class="btn-link" href="{{ route('about') }}">About Us</a>
                            <a class="btn-link" href="{{ route('contact') }}">Contact Us</a>
                            <a class="btn-link" href="{{ route('privacy-policy') }}">Privacy Policy</a>
                            <a class="btn-link" href="{{ route('term-condition') }}">Terms & Condition</a>
                            <a class="btn-link" href="{{ route('return-policy') }}">Return Policy</a>
                            <a class="btn-link" href="{{ route('faq') }}">FAQs & Help</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="d-flex flex-column text-start footer-item">
                            <h4 class="text-light mb-3">Account</h4>
                            <a class="btn-link" href="{{ route('login') }}">My Account</a>
                            <a class="btn-link" href="">Shop details</a>
                            <a class="btn-link" href="">Shopping Cart</a>
                            <a class="btn-link" href="">Wishlist</a>
                            <a class="btn-link" href="">Order History</a>
                            <a class="btn-link" href="">International Orders</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="text-light mb-3">Contact</h4>
                            <p>Address: {{ $setting->address }}</p>
                            <p>Email: {{ $setting->email }}</p>
                            <p>Phone: {{ $setting->mobile_no }}</p>
                            <p>Payment Accepted</p>
                            <img src="{{ asset('asset/frontend/img/payment.png')}}" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Copyright Start -->
        <div class="container-fluid copyright bg-dark py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Fruitables
                        </a>, All right reserved.</span>
                    </div>
                    <div class="col-md-6 my-auto text-center text-md-end text-white">
                    
                        Designed By <a class="border-bottom" href="#">ABCD Codex</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->



        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('asset/frontend/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('asset/frontend/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('asset/frontend/lib/lightbox/js/lightbox.min.js')}}"></script>
    <script src="{{asset('asset/frontend/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('asset/frontend/js/main.js')}}"></script>
    </body>
   <!-- Include SweetAlert CSS and JS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.add-to-cart-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const productId = this.getAttribute('data-product-id');
                    const form = document.getElementById('add-to-cart-form-' + productId);
                    const formData = new FormData(form);

                    fetch(form.action, {
                        method: form.method,
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Ensure this element exists or is updated correctly
                            const cartCountElement = document.getElementById('cart-count-value');
                            if (cartCountElement) {
                                cartCountElement.innerText = data.cartCount;
                            }
                            Swal.fire({
                            position: "top-end",
                            icon: "success",
                            text: 'Product Added Successfully!',
                            showConfirmButton: false,
                            timer: 1500
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Failed to add product to cart.',
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
                });
            });
        });
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#subscription-form').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting the traditional way

        // Get the form data
        var formData = $(this).serialize();

        // Make the AJAX request
        $.ajax({
            url: $(this).attr('action'), 
            type: 'POST',
            data: formData,
            success: function(response) {
                // Handle success response
                $('#response-message').html('<div class="alert alert-success">Thank you for subscribing!</div>');
                $('#subscription-form')[0].reset(); 
                setTimeout(function() {
                    $('#response-message').fadeOut('slow');
                }, 5000);
            },
            error: function(xhr) {
                // Handle error response
                var errors = xhr.responseJSON.errors;
                var errorHtml = '<div class="alert alert-danger">';
                $.each(errors, function(key, value) {
                    errorHtml += '<p>' + value + '</p>';
                });
                errorHtml += '</div>';
                $('#response-message').html(errorHtml);

                setTimeout(function() {
                    $('#response-message').fadeOut('slow');
                }, 5000);
            }
        });
    });
});
</script>
</html>