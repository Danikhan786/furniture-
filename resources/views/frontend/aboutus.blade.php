@extends('layouts.frontend')

@section('content')
		<!-- Start Hero Section -->
        <div class="hero">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <h1>About Us</h1>
                            <p class="mb-4">Welcome to our furniture store, where quality craftsmanship meets modern design. We've been dedicated to helping you create beautiful, comfortable living spaces for over a decade.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Hero Section -->

    

    <!-- Start Why Choose Us Section -->
    <div class="why-choose-section">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6">
                    <h2 class="section-title">Why Choose Us</h2>
                    <p>With years of experience in the furniture industry, we pride ourselves on offering exceptional quality, outstanding customer service, and designs that stand the test of time. Your satisfaction is our top priority.</p>

                    <div class="row my-5">
                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="frontend/images/truck.svg" alt="Image" class="img-fluid">
                                </div>
                                <h3>Fast &amp; Free Shipping</h3>
                                <p>Enjoy free shipping on all orders over $500. We ensure safe and timely delivery to your doorstep.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="frontend/images/bag.svg" alt="Image" class="img-fluid">
                                </div>
                                <h3>Easy to Shop</h3>
                                <p>Browse our extensive catalog with ease. Our user-friendly website makes finding your perfect furniture simple and enjoyable.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="frontend/images/support.svg" alt="Image" class="img-fluid">
                                </div>
                                <h3>24/7 Support</h3>
                                <p>Our dedicated customer service team is available around the clock to assist you with any questions or concerns.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="frontend/images/return.svg" alt="Image" class="img-fluid">
                                </div>
                                <h3>Hassle Free Returns</h3>
                                <p>Not satisfied? Return any item within 30 days for a full refund. We make returns easy and stress-free.</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="img-wrap">
                        <img src="frontend/images/why-choose-us-img.jpg" alt="Image" class="img-fluid">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Why Choose Us Section -->

    

    <!-- Start Testimonial Slider -->
    <div class="testimonial-section before-footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto text-center">
                    <h2 class="section-title">Testimonials</h2>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="testimonial-slider-wrap text-center">

                        <div id="testimonial-nav">
                            <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
                            <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
                        </div>

                        <div class="testimonial-slider">
                            
                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">

                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>&ldquo;I absolutely love my new furniture! The quality is exceptional and the customer service was outstanding. The pieces arrived on time and look even better in person than online. Highly recommend!&rdquo;</p>
                                            </blockquote>

                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="frontend/images/person-1.png" alt="Maria Jones" class="img-fluid">
                                                </div>
                                                <h3 class="font-weight-bold">Sarah Johnson</h3>
                                                <span class="position d-block mb-3">Homeowner, New York</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> 
                            <!-- END item -->

                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">

                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>&ldquo;I absolutely love my new furniture! The quality is exceptional and the customer service was outstanding. The pieces arrived on time and look even better in person than online. Highly recommend!&rdquo;</p>
                                            </blockquote>

                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="frontend/images/person-1.png" alt="Maria Jones" class="img-fluid">
                                                </div>
                                                <h3 class="font-weight-bold">Sarah Johnson</h3>
                                                <span class="position d-block mb-3">Homeowner, New York</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> 
                            <!-- END item -->

                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">

                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>&ldquo;I absolutely love my new furniture! The quality is exceptional and the customer service was outstanding. The pieces arrived on time and look even better in person than online. Highly recommend!&rdquo;</p>
                                            </blockquote>

                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="frontend/images/person-1.png" alt="Maria Jones" class="img-fluid">
                                                </div>
                                                <h3 class="font-weight-bold">Sarah Johnson</h3>
                                                <span class="position d-block mb-3">Homeowner, New York</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> 
                            <!-- END item -->

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonial Slider -->

@endsection
