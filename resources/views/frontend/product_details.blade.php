 @extends('frontend.layouts.app')
    
 @section('title', 'Cart Page')
    
 @section('description', 'Learn more about HolidayThrill and our mission to craft unforgettable travel experiences for your perfect getaway.')
    
 @section('content')
    

<style> .single-product-features {
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
}

 .single-product-features ul {
    margin: 0px;
    padding: 0px;
}
 .single-product-features ul li {
    list-style: none;
    padding: 20px 20px;
    border-bottom: 1px solid #ddd;
    transition: all 0.3s 0s linear;
    display: flex;
    align-items: center;
}
 .single-product-features ul li p {
    margin: 0px;
    font-size: 14px;
    line-height: 20px;
    margin-left: 15px;
}
.p_price{
    font-size: 30px;
}
#reviewtForm{
    background-color: #d3cccc4f;
    padding: 10px;
}
</style>
        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">          
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Product</a></li>
                <li class="breadcrumb-item active text-white">{{ $product->name }}</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Single Product Start -->
        <div class="container-fluid mt-5">
            <div class="container">
                <div class="row g-4 mb-5">
                    <div class="col-lg-8 col-xl-9">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="border rounded">
                                    <a href="#">
                                        <img src="{{ asset('images/product/' . $product->image) }}" class="img-fluid rounded" alt="Image">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h4 class="fw-bold mb-3">{{ $product->name }}</h4>
                                <p class="mb-3"><b>Category: </b> {{ $product->subcategory->name }}</p>
                                <h5 class="fw-bold mb-3 p_price"><div class="d-flex flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">₹ {{ $product->discount_price }}</p>
                                                        <p class="text-muted fs-5 mb-0" style="text-decoration: line-through;margin-left: 12px;">₹ {{ $product->price }}</p>

                                                    </div></h5>

                                            <div class="d-flex mb-4">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fa fa-star {{ $i <= $averageRating ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                            </div>

                             
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-minus rounded-circle bg-light border" type="button" onclick="updateQuantity({{ $product->id }}, -1)">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" id="quantity-input-{{ $product->id }}" class="form-control form-control-sm text-center border-0" value="1">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-plus rounded-circle bg-light border" type="button" onclick="updateQuantity({{ $product->id }}, 1)">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                                <form id="add-to-cart-form-{{ $product->id }}" class="p-3" method="POST" action="{{ route('cart.add') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="product_name" value="{{ $product->name }}">
                                    <input type="hidden" name="product_price" value="{{ $product->discount_price }}">
                                    <input type="hidden" id="quantity-{{ $product->id }}" name="quantity" value="1">
                                    <button type="button" class="btn btn-outline-dark w-100 add-to-cart-btn" data-product-id="{{ $product->id }}">Add to Cart</button>
                                </form>

                            </div>
                            <div class="col-lg-12">
                                <nav>
                                    <div class="nav nav-tabs mb-3">
                                        <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                            id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                            aria-controls="nav-about" aria-selected="true">Description</button>
                                        <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                            id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                            aria-controls="nav-mission" aria-selected="false">Reviews</button>
                                    </div>
                                </nav>
                                <div class="tab-content mb-5">
                                    <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                  <p>  {{ $product->description }} </p>
                                    </div>
                                    <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                       @foreach($product->reviews as $review)
                                            <div class="d-flex">
                                                <img src="{{ asset('asset/frontend/img/avatar.jpg')}}" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                                <div class="">
                                                    <p class="mb-2" style="font-size: 14px;">{{ $review->created_at->format('d M Y') }}</p>
                                                    <div class="d-flex justify-content-between">
                                                        <h5>{{ $review->name }}</h5>
                                                        <div class="d-flex mb-3">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <i class="fa fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <p>{{ $review->comment }} </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="nav-vision" role="tabpanel">
                                        <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam
                                            amet diam et eos labore. 3</p>
                                        <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore.
                                            Clita erat ipsum et lorem et sit</p>
                                    </div>
                                </div>
                            </div>
                            <form id="reviewtForm">
                            @csrf
                                <h4 class="mb-5 fw-bold">Leave a Reply</h4>
                                <div class="row g-4">
                                    <div class="col-md-9">
                                        <div class="border-bottom rounded">
                                            <input type="text" name="name" class="form-control border-0 me-4" placeholder="Yur Name *" required/>
                                        </div>
                                    
                                        <div class="border-bottom rounded my-4">
                                            <textarea name="comment" id="comment" class="form-control border-0" cols="10" rows="4" placeholder="Your Review *" spellcheck="false"></textarea>
                                        </div>
                                
                                        <div class="d-flex justify-content-between py-3 mb-5">
                                            <div class="d-flex align-items-center">
                                                <p class="mb-0 me-3">Please rate:</p>
                                                <div class="d-flex align-items-center" style="font-size: 12px;">
                                                    <input type="hidden" name="rating" id="rating" value="">
                                                    <i class="fa fa-star text-muted star-rating" data-rating="1"></i>
                                                    <i class="fa fa-star text-muted star-rating" data-rating="2"></i>
                                                    <i class="fa fa-star text-muted star-rating" data-rating="3"></i>
                                                    <i class="fa fa-star text-muted star-rating" data-rating="4"></i>
                                                    <i class="fa fa-star text-muted star-rating" data-rating="5"></i>
                                                </div>
                                            </div>  
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                           
                                        </div>
                                        <button type="submit" class="btn border border-secondary text-primary rounded-pill px-4 py-3">Post Comment</button>
                                    </div>
                                </div>
                              
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-3">
                        <div class="row g-4 fruite">
                           
                            <div class="col-lg-12">
                              
                                <div class="single-product-right">
                                <div class="single-product-features">
                                <ul>
                                <li>
                                <i class="far fa-question-circle" aria-hidden="true"></i>
                                <p>Support 24/7 <br>Call us anytime</p>
                                </li>
                                <li>
                                <i class="fas fa-hands" aria-hidden="true"></i>
                                <p>100% Safety <br>Only secure payments</p>
                                </li>
                                <li>
                                <i class="fas fa-tag" aria-hidden="true"></i>
                                <p>Hot Offers <br>Discounts up to 80%</p>
                                </li>
                                </ul>
                                </div>
                                </div>
                            </div>
                         
                        </div>
                    </div>
                </div>
                <h1 class="fw-bold mb-0">Related products</h1>
                <div class="vesitable">
                    <div class="owl-carousel vegetable-carousel justify-content-center">
                    @foreach($relatedProducts as $related)
                        <div class="border border-primary rounded position-relative vesitable-item">
                            <a href="{{ route('product-detail', ['id' => $related->id]) }}">
                                <div class="vesitable-img" style="height: 210px;">
                                    <img src="{{ asset('images/product/' . $related->image) }}" class="img-fluid w-100 rounded-top" style="height: 210px;" alt="">
                                </div>
                            </a>
                            <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Vegetable</div>
                            <div class="p-4 pb-0 rounded-bottom">
                            <a href="{{ route('product-detail', ['id' => $related->id]) }}"><h4>{{ $related->name }}</h4> </a>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold">₹ {{ $related->price }}</p>
                                    <a href="{{ route('product-detail', ['id' => $related->id]) }}" class="p-3 btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                       
                    </div>
                </div>
            </div>
        </div>
  
    <script>
        function updateQuantity(productId, delta) {
    var quantityInput = document.getElementById('quantity-input-' + productId);
    var hiddenQuantityInput = document.getElementById('quantity-' + productId);
    var currentQuantity = parseInt(quantityInput.value);
    var newQuantity = currentQuantity + delta;

    if (newQuantity < 1) {
        newQuantity = 1; 
    }

    quantityInput.value = newQuantity;
    hiddenQuantityInput.value = newQuantity;
}

    </script>
    


  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).ready(function(){
        // Handle star rating click
        $('.star-rating').click(function() {
            var rating = $(this).data('rating');
            $('#rating').val(rating);

            // Update star styles
            $('.star-rating').removeClass('text-warning').addClass('text-muted');
            $(this).prevAll().addBack().removeClass('text-muted').addClass('text-warning');
        });

        // Handle form submission
        $('#reviewtForm').on('submit', function(e){
            e.preventDefault();
            
            $.ajax({
                type: 'POST',
                url: "{{ route('reviews.store') }}",
                data: $('#reviewtForm').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    Swal.fire({
                        title: 'Success!',
                        text: response.success,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    $('#reviewtForm')[0].reset();
                    $('.star-rating').removeClass('text-warning').addClass('text-muted'); 
                },
                error: function(error){
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while submitting the review.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>

@endsection

 