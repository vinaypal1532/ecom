@extends('frontend.layouts.app')
    
@section('title', 'Frequently Asked Questions - Fruitables: Your Queries Answered')

@section('description', 'Find answers to frequently asked questions about Fruitables. Learn more about our products, delivery options, payment methods, and more.')

@section('content')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Frequently Asked Questions</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Frequently Asked Questions</li>
    </ol>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">FAQs</h6>
            <h1 class="mb-5">Your Questions Answered</h1>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                <div class="faq-content">
                    <h3>What is Fruitables?</h3>
                    <p>Fruitables is an online platform offering a wide variety of fresh fruits and vegetables delivered directly to your doorstep. We are committed to providing quality products sourced from trusted farmers and suppliers.</p>

                    <h3>How can I place an order on Fruitables?</h3>
                    <p>To place an order, simply browse our selection of fruits and vegetables, add the desired items to your cart, and proceed to checkout. You can complete your purchase by providing your delivery details and payment information.</p>

                    <h3>What are the delivery options?</h3>
                    <p>We offer standard and express delivery options to meet your needs. Delivery times and availability may vary based on your location and order size. You can find specific delivery details during the checkout process.</p>

                    <h3>What payment methods do you accept?</h3>
                    <p>We accept a variety of payment methods, including credit/debit cards, net banking, and popular digital wallets. You can choose your preferred payment option during checkout.</p>

                    <h3>Do you have a return and refund policy?</h3>
                    <p>Yes, we have a customer-friendly return and refund policy. If you receive damaged or poor-quality products, please contact our customer service within 24 hours of delivery. We will arrange for a return or refund as per our policy.</p>

                    <h3>How do I contact Fruitables customer service?</h3>
                    <p>You can reach our customer service team via email at support@fruitables.com or by phone at (123) 456-7890. Our team is available to assist you with any questions or concerns.</p>

                    <h3>Can I schedule deliveries in advance?</h3>
                    <p>Yes, you can schedule deliveries in advance by selecting your preferred delivery date during checkout. We will do our best to deliver your order on the chosen date.</p>

                    <h3>Do you offer discounts or promotions?</h3>
                    <p>We frequently offer discounts and promotions to our customers. You can stay updated on our latest offers by subscribing to our newsletter or following us on social media.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
