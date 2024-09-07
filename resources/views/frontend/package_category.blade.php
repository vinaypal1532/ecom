@extends('frontend.layouts.app')
    
@section('title', 'Packages - HolidayThrill: Explore Exclusive Travel Packages for Your Dream Vacation')

@section('description', 'Discover curated travel packages by HolidayThrill. Choose from a variety of options tailored to provide you with unforgettable and personalized travel experiences.')
    
@section('content')

   

<div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white mb-3 animated slideInDown">Enjoy Your Holiday With Us</h1>
                    </div>
                </div>
            </div>
        </div>
        
    <div class="container-xxl">
        
        <div class="tour-enquiry-card">
            <div class="enquiry-image">
              <img src="https://holidaythrill.in/asset/frontend/img/package-2.jpg" alt="Image description" id="people-image" class="img-fluid">
            </div>
            <div class="tour-enquiry-content">
              <div class="enquiry-content">
                <div class="tour-expereince-question">
                  <span>Bigger Group? Get special offers upto 50% off!</span>
                </div>
                <div class="tour-expereince">
                  <span>We create unforgettable adventures, customised for your group.</span>
                </div>
              </div>
            </div>
            <div class="tour-enquiry-call">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                 Get a Callback
                 </button>
            </div>
   
        </div>
  
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Packages</h6>
                <h1 class="mb-5">Awesome Packages</h1>
            </div>
            <div class="row g-4">
                   @foreach($packages as $package)

                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="package-item">
                            
                            <a href="{{ route('package.details', ['id' => $package->id]) }}"> <div class="overflow-hidden">
                                <img class="img-fluid" style="height: 220px;width: 100%;" src="{{ asset('storage/app/public/' . $package->image) }}" alt="{{ $package->name }}">
                            </div> </a>
                            <div class="d-flex border-bottom">
                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $package->d_name }}</small>
                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-primary me-2"></i>{{ $package->category_name }}</small>
                                <small class="flex-fill text-center py-2">&#8377;&nbsp;{{ number_format($package->amount) }}</small>

                            </div>
                           <div class="p-40" style="height: 70px;padding:10px">
                                <a href="{{ route('package.details', ['id' => $package->id]) }}">
                                    <h3 class="mb-0 package-name">{{ $package->name }}</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


                            
   <div class="loader" style="display: none;"></div>
  
  
 

 <style>
 .tour-enquiry-card .enquiry-image {
    border-radius: 10px;
    width: 90px;
    height: 90px;
    margin: 10px;
}
.enquiry-image img{
    height: 83px;
}
.enquiry-content{
        text-align: center;
}
 .tour-enquiry-card {
    font-family: "Poppins";
    pointer-events: all;
    transition: 0.2s all;
    font-style: normal;
    align-items: center;
    background: #ffffff;
    border: 1px solid #86B817;
    box-shadow: 0px 0px 10px 2px rgba(243,112,34,0.3);
    border-radius: 10px;
    display: grid;
    max-width: 1080px;
    margin: 50px auto;
    grid-template-columns: 0.2fr 1.5fr 0.5fr;
}
 .loader {
    border: 4px solid rgba(0, 0, 0, 0.1);
    border-left: 4px solid #3498db;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-top: -20px;
    margin-left: -20px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>


  @endsection