@extends('frontend.layouts.app')
    
@section('title', 'Our Services - HolidayThrill: Elevate Your Journey with Tailored Travel Experiences')

@section('description', 'Explore a range of services provided by HolidayThrill. Discover our commitment to crafting unique and unforgettable travel experiences for every type of adventurer.')
    
@section('content')


<style>
    .category-box {
        transition: box-shadow 0.3s, border 0.3s;
    }

    .category-box:hover {
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        border: 2px solid #3498db; 
    }
  
  .row.g-4 {
    display: flex;
    flex-wrap: wrap;
  }

  .row.g-4 > [class*='col-'] {
    display: flex;
    flex-direction: column;
  }

  .service-item {
    flex: 1;
  }

</style>
 <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white mb-3 animated slideInDown">Enjoy Your Holiday With Us</h1>
                    </div>
                </div>
            </div>
        </div>
        
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Services</h6>
                <h1 class="mb-5">Our Services</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                            <h5>Holiday Packages</h5>
                            <p>Embark on a journey tailored to your desires. Our expert team crafts bespoke holiday packages that cater to your preferences, ensuring a perfect blend of adventure, relaxation, and cultural immersion.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                              <i class="fas fa-3x fa-plane text-primary mb-4"></i>
                            <h5>Flight Tickets</h5>
                            <p>Unlock the skies with ease. Book your flight tickets hassle-free through our user-friendly platform, offering competitive prices and a range of options to suit your travel plans.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-user text-primary mb-4"></i>
                            <h5>Group Trip</h5>
                            <p>Enjoy special group rates and discounts, making your travel experience not only memorable but also budget-friendly. We negotiate with our partners to ensure you get the best value for your group.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                             <i class="fas fa-3x fa-passport text-primary mb-4"></i>
                            <h5>Visa Service</h5>
                            <p>Navigate the requirements for tourist visas with our assistance. Whether you're planning a short vacation or an extended exploration, we guide you through the necessary steps to secure your tourist visa.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fas fa-3x fa-globe text-primary mb-4"></i>
                            <h5>Honeymoon Packages</h5>
                            <p>Celebrate love with our enchanting honeymoon packages. From exotic beach getaways to romantic mountain retreats, we create the ideal setting for you to start your journey of marital bliss.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-hotel text-primary mb-4"></i>
                            <h5>Hotel Booking</h5>
                            <p>Find your home away from home with our extensive hotel booking services. We partner with top-rated accommodations worldwide to provide you with comfort and luxury at your fingertips.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-user text-primary mb-4"></i>
                            <h5>Travel Guides</h5>
                            <p>Our guides are crafted with a blend of local expertise and traveler insights. We provide you with the inside scoop on hidden gems, local hotspots, and cultural nuances that add depth to your travels.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-cog text-primary mb-4"></i>
                            <h5>Event Management</h5>
                            <p>Elevate your corporate gatherings with our professional event management services. From conferences and seminars to product launches and team-building events, we handle the logistics, so you can focus on achieving your business goals.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
 
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title bg-white text-center text-primary px-3">Testimonial</h6>
                <h1 class="mb-5">Our Clients Say!!!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">

            @foreach($testimonials as $testimonial)
                <div class="testimonial-item bg-white text-center border p-4">
                    <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="{{ asset('asset/frontend/img/testimonial-2.jpg')}}" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">{{ $testimonial->name }}</h5>
                    <p>{{ $testimonial->city }}</p>
                    <p class="mb-0">{{ $testimonial->message }}</p>
                </div>
            @endforeach
               
            </div>
        </div>
    </div>
   
   

  @endsection
