    @extends('frontend.layouts.app')
    
    @section('title', 'About Us - Crafting Unforgettable Travel Experiences for Your Perfect Getaway | HolidayThrill')
    
    @section('description', 'Learn more about HolidayThrill and our mission to craft unforgettable travel experiences for your perfect getaway.')
    
    @section('content')

  <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">About Us</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">About Us</li>
            </ol>
        </div>
        <!-- Single Page Header End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="{{ asset('images/about.jpg')}}" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.3s">                 
                    <h1 class="mb-4">Welcome to <span class="text-primary">Fruitables</span></h1>
                    <p class="mb-4">Welcome to Fruitables, your one-stop online destination for the freshest and highest quality vegetables and fruits. At Fruitables, we believe in providing our customers with the best of nature's bounty, delivered straight to their doorstep.</p>
                    <p>Our Mission
                    Our mission is to make healthy eating accessible and convenient for everyone. We are committed to offering a wide selection of fresh produce, carefully sourced from trusted farmers and suppliers. Whether you're looking for organic fruits, seasonal vegetables, or exotic varieties, we have something for every taste and preference.</p>
                    <p>At Fruitables, we are committed to sustainability and supporting local communities. We work closely with farmers and suppliers who share our values, ensuring that you receive fresh, ethically sourced produce.</p>
                    
                    <div class="row gy-2 gx-4 mb-4">
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Freshness Guaranteed</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Convenience at Your Fingertips</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Reliable Delivery</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Exceptional Customer Service</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>150 Premium City Tours</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>24/7 Service</p>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Team Start -->
  <!--  <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Travel Guide</h6>
                <h1 class="mb-5">Meet Our Guide</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{ asset('asset/frontend/img/team-1.jpg')}}" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -19px;">
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Full Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{ asset('asset/frontend/img/team-2.jpg')}}" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -19px;">
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Full Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{ asset('asset/frontend/img/team-3.jpg')}}" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -19px;">
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Full Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{ asset('asset/frontend/img/team-4.jpg')}}" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -19px;">
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Full Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
  
   <div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
          <h1 class="mb-5">Discover the World with Our Expert Guide</h1>
        </div>
      
        <div class="row g-4 mb-4">
            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
                 <div class="text-center p-4" style="background-color: #fff;">
                    <h2 class="mb-0">50+</h2>
                    <small>City</small>
                </div>
            </div>
            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.3s">
                 <div class="text-center p-4" style="background-color: #fff;">
                    <h2 class="mb-0">500+</h2>
                    <small>Happy Customers</small>
                </div>
            </div>
            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.5s">
                <div class="text-center p-4" style="background-color: #fff;">
                    <h2 class="mb-0">3+</h2>
                    <small>Years</small>
                </div>
            </div>
        </div>
    </div>
</div>

  
  @endsection
