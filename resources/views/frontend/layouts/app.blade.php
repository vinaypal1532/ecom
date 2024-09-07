<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Organic Veggies & Fruits Foods')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('asset/frontend/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('asset/frontend/lib/owlcarousel/assets/owl.carousel.min.css')}} " rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('asset/frontend/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('asset/frontend/css/style.css')}} " rel="stylesheet">
    
</head>

<body>
    @include('frontend.layouts.frontend_header')
    @yield('content')
    @include('frontend.layouts.frontend_footer')

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="{{ asset('asset/frontend/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Additional Libraries -->
    <script src="{{ asset('asset/frontend/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('asset/frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Custom Script -->
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
                            document.getElementById('cart-count-value').innerText = data.cartCount;
                           
                        } else {
                          
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
        });
        
    </script>
</body>

</html>
