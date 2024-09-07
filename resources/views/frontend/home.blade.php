 @extends('frontend.layouts.app')
    
 @section('title', 'Organic Veggies & Fruits Foods')
    
 @section('description', 'Organic Veggies & Fruits Foods')
    
 @section('content')

<style>
.p-4{
    padding: 1rem !important;
}
a h4{
    font-size: 16px;
    font-weight: bold;
    margin: 0px 0px 5px;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    text-align: left;
    -webkit-line-clamp: 1;
    line-clamp: 1;
    -webkit-box-orient: vertical;
}
.fixed-height-img {
        width: 100%; 
        height: 220px; 
        object-fit: cover; 
    }
    .img_pro{
        width: 100%; 
        height: 220px; 
        object-fit: cover; 
    }

</style>
  <div class="container-fluid py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-md-12 col-lg-7">
                        <h4 class="mb-3 text-secondary">{{ $setting->pan_card }}</h4>
                        <h1 class="mb-5 display-3 text-primary">{{ $setting->title }}</h1>
                        <!-- <div class="position-relative mx-auto">
                            <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="number" placeholder="Search">
                            <button type="submit" class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100" style="top: 0; right: 25%;">Submit Now</button>
                        </div> -->
                    </div>
                    <div class="col-md-12 col-lg-5">
                    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @foreach($banners as $index => $banner)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }} rounded">
                                <img src="{{ asset('images/' . $banner->image_path) }}" class="img-fluid w-100 h-100 bg-secondary rounded" alt="Slide {{ $index + 1 }}">
                                <a href="#" class="btn px-4 py-2 text-white rounded">Fruits</a>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->


        <!-- Featurs Section Start -->
        <div class="container-fluid featurs">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-car-side fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Free Shipping</h5>
                                <p class="mb-0">Free on order over ₹ 500</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-user-shield fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Security Payment</h5>
                                <p class="mb-0">100% security payment</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-exchange-alt fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>15 Days Return</h5>
                                <p class="mb-0">15 days money guarantee</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fa fa-phone-alt fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>24/7 Support</h5>
                                <p class="mb-0">Support every time fast</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Featurs Section End -->


        <!-- Fruits Shop Start-->
        <div class="container-fluid fruite py-5">
            <div class="container py-5">
              
                <h1 class="mb-0" style="padding-bottom: 20px;">Our Organic Products</h1>
                    <div class="tab-content">
                   
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                    @foreach($products as $product)
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <a href="{{ route('product-detail', ['id' => $product->id]) }}">
                                                    <div class="fruite-img"  style="height: 210px;">
                                                        @if($product->image && file_exists(public_path('images/product/' . $product->image)))
                                                            <img src="{{ asset('images/product/' . $product->image) }}" class="img-fluid w-100 fixed-height-img rounded-top" alt="{{ $product->name }}">
                                                        @else
                                                            <img src="{{ asset('images/no-image.png') }}" class="img-fluid w-100 rounded-top fixed-height-img" alt="No image available">
                                                        @endif
                                                    </div>
                                                </a>

                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{ $product->subcategory->name }}</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                   <a href="{{ route('product-detail', ['id' => $product->id]) }}"> <h4>{{ $product->name }}</h4>
                                                   </a>                                               
                                                    <div class="d-flex flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">₹ {{ $product->discount_price }}</p>
                                                        <p class="text-muted fs-5 mb-0" style="text-decoration: line-through;margin-left: 12px;">₹ {{ $product->price }}</p>

                                                    </div>
                                                    <form id="add-to-cart-form-{{ $product->id }}" class="p-3" method="POST" action="{{ route('cart.add') }}">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                            <input type="hidden" name="product_name" value="{{ $product->name }}">
                                                            <input type="hidden" name="product_price" value="{{ $product->discount_price }}">
                                                            <input type="hidden" name="quantity" value="1">
                                                            <button type="button" class="btn btn-outline-dark w-100 add-to-cart-btn" data-product-id="{{ $product->id }}">Add to Cart</button>
                                                        </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>                  
                        </div>                  
            </div>
        </div>
      
        <div class="container-fluid service">
            <div class="container py-5">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-secondary rounded border border-secondary">
                                <img src="{{ asset('asset/frontend/img/featur-1.jpg')}} " class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-primary text-center p-4 rounded">
                                        <h5 class="text-white">Fresh Apples</h5>
                                        <h3 class="mb-0">20% OFF</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-dark rounded border border-dark">
                                <img src="{{ asset('asset/frontend/img/featur-2.jpg')}}" class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-light text-center p-4 rounded">
                                        <h5 class="text-primary">Tasty Fruits</h5>
                                        <h3 class="mb-0">Free delivery</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-primary rounded border border-primary">
                                <img src="{{ asset('asset/frontend/img/featur-3.jpg')}}" class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-secondary text-center p-4 rounded">
                                        <h5 class="text-white">Exotic Vegitable</h5>
                                        <h3 class="mb-0">Discount ₹ 30</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="container-fluid vesitable">
            <div class="container">
                <h1 class="mb-0">Fresh Organic Vegetables</h1>
                <div class="owl-carousel vegetable-carousel justify-content-center">
                @foreach($products as $product)
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img"  style="height: 220px;">
                        <a href="{{ route('product-detail', ['id' => $product->id]) }}">  

                            <img src="{{ asset('images/product/' . $product->image) }}" class="img-fluid w-100 rounded-top img_pro" alt=""></a>
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Vegetable</div>
                        <div class="p-4 rounded-bottom">
                        <a href="{{ route('product-detail', ['id' => $product->id]) }}"><h4>{{ $product->name }}</h4> </a>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">₹ {{ $product->price }}</p>
                            
                            </div>
                            <form id="add-to-cart-form-{{ $product->id }}" class="p-3" method="POST" action="{{ route('cart.add') }}">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                            <input type="hidden" name="product_name" value="{{ $product->name }}">
                                                            <input type="hidden" name="product_price" value="{{ $product->price }}">
                                                            <input type="hidden" name="image" value="{{ $product->image }}">
                                                            <input type="hidden" name="quantity" value="1">
                                                            <button type="button" class="btn btn-outline-dark w-100 add-to-cart-btn" data-product-id="{{ $product->id }}">Add to Cart</button>
                                                        </form>
                        </div>
                    </div>
                  @endforeach
                </div>
            </div>
        </div>
        <!-- Vesitable Shop End -->


        <!-- Banner Section Start-->
        <div class="container-fluid banner bg-secondary my-5">
            <div class="container py-5">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <div class="py-4">
                            <h1 class="display-3 text-white">Fresh Exotic Fruits</h1>
                            <p class="fw-normal display-3 text-dark mb-4">in Our Store</p>
                            <p class="mb-4 text-dark">Browse our wide selection, add items to your cart, and proceed to checkout.</p>
                            <a href="{{ route('product') }}" class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5">BUY</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative">
                            <img src="{{ asset('asset/frontend/img/baner-1.png')}}" class="img-fluid w-100 rounded" alt="">
                            <div class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute" style="width: 140px; height: 140px; top: 0; left: 0;">
                                <h1 style="font-size: 100px;">1</h1>
                                <div class="d-flex flex-column">
                                    <span class="h2 mb-0">₹ 50</span>
                                    <span class="h4 text-muted mb-0">kg</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner Section End -->


        <!-- Bestsaler Product Start -->
        <div class="container-fluid">
    <div class="container">
        <div class="text-center mx-auto mb-5" style="max-width: 700px;">
            <h1 class="display-4">Bestseller Products</h1>
            <p>Discover our best-selling products loved by customers.</p>
        </div>
        <div class="row g-4">
            @foreach($bestsellingProducts as $product)
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-light">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="{{ asset('images/product/' . $product->image) }}" class="img-fluid rounded-circle w-100" alt="{{ $product->name }}">
                            </div>
                            <div class="col-6">
                                <a href="{{ route('product-detail', ['id' => $product->id]) }}" class="h5">{{ $product->name }}</a>
                                <div class="d-flex my-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $product->rating ? 'text-primary' : '' }}"></i>
                                    @endfor
                                </div>
                                <h4 class="mb-3">₹ {{ number_format($product->price, 2) }} </h4>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> View Detail</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
      
    </div>
</div>

        <!-- Bestsaler Product End -->


        <!-- Fact Start -->
        <div class="container-fluid py-5">
            <div class="container">
                <div class="bg-light p-5 rounded">
                    <div class="row g-4 justify-content-center">
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>satisfied customers</h4>
                                <h1>1963</h1>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>quality of service</h4>
                                <h1>99%</h1>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>quality certificates</h4>
                                <h1>33</h1>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>Available Products</h4>
                                <h1>789</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fact Start -->


        <!-- Tastimonial Start -->
        <div class="container-fluid testimonial">
            <div class="container">
                <div class="testimonial-header text-center">
                    <h4 class="text-primary">Our Testimonial</h4>
                    <h1 class="display-5 mb-5 text-dark">Our Client Saying!</h1>
                </div>
                <div class="owl-carousel testimonial-carousel">
                @foreach($testimonials as $testimonial)
                    <div class="testimonial-item img-border-radius bg-light rounded p-4">
                        <div class="position-relative">
                            <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                            <div class="mb-4 pb-4 border-bottom border-secondary">
                                <p class="mb-0">{{ $testimonial->message }}
                                </p>
                            </div>
                            <div class="d-flex align-items-center flex-nowrap">
                                <div class="bg-secondary rounded">
                                    <img src="{{ asset('asset/frontend/img/testimonial-1.jpg')}} " class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                                </div>
                                <div class="ms-4 d-block">
                                    <h4 class="text-dark">{{ $testimonial->name }}</h4>
                                    <p class="m-0 pb-3">{{ $testimonial->city }}</p>
                                    <div class="d-flex pe-5">
                                    @for($i = 0; $i < 5; $i++)
                                        <i class="fas fa-star {{ $i < $testimonial->rating ? 'text-primary' : '' }}"></i>
                                    @endfor
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
        <!-- Tastimonial End -->

  @endsection