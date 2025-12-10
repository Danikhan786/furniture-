@extends('layouts.frontend')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1>Terms and Conditions</h1>
                        <p class="mb-4">Please read these terms and conditions carefully before using our website.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Terms Section -->
    <div class="untree_co-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="content">
                        <p class="text-muted mb-4">Last updated: {{ date('F d, Y') }}</p>

                        <h2 class="mb-4">1. Introduction</h2>
                        <p class="mb-4">
                            Welcome to Oasis Mubales. These Terms and Conditions ("Terms") govern your use of our website and services. 
                            By accessing or using our website, you agree to be bound by these Terms. If you disagree with any part of these 
                            terms, you may not access the service.
                        </p>

                        <h2 class="mb-4">2. Use of Our Website</h2>
                        <p class="mb-4">
                            You may use our website for lawful purposes only. You agree not to use the website:
                        </p>
                        <ul class="mb-4">
                            <li>In any way that violates any applicable national or international law or regulation</li>
                            <li>To transmit, or procure the sending of, any advertising or promotional material without our prior written consent</li>
                            <li>To impersonate or attempt to impersonate the company, a company employee, another user, or any other person or entity</li>
                            <li>In any way that infringes upon the rights of others, or in any way is illegal, threatening, fraudulent, or harmful</li>
                        </ul>

                        <h2 class="mb-4">3. Products and Services</h2>
                        <p class="mb-4">
                            We strive to provide accurate descriptions and images of our products. However, we do not warrant that product 
                            descriptions or other content on this site is accurate, complete, reliable, current, or error-free. If a product 
                            offered by us is not as described, your sole remedy is to return it in unused condition.
                        </p>

                        <h2 class="mb-4">4. Pricing and Payment</h2>
                        <p class="mb-4">
                            All prices are displayed in the currency specified on the website. We reserve the right to change prices at any 
                            time without prior notice. Payment must be made in full at the time of purchase unless otherwise agreed. We accept 
                            cash on delivery and other payment methods as specified during checkout.
                        </p>

                        <h2 class="mb-4">5. Orders and Delivery</h2>
                        <p class="mb-4">
                            When you place an order, you are making an offer to purchase products subject to these Terms. We reserve the right 
                            to accept or reject your order for any reason. Delivery times are estimates only and are not guaranteed. We are not 
                            responsible for delays caused by circumstances beyond our control.
                        </p>

                        <h2 class="mb-4">6. Returns and Refunds</h2>
                        <p class="mb-4">
                            You may return products within 30 days of delivery, provided they are unused and in their original packaging. 
                            Custom or personalized items may not be returned unless defective. Refunds will be processed within 14 business days 
                            of receiving the returned items.
                        </p>

                        <h2 class="mb-4">7. Intellectual Property</h2>
                        <p class="mb-4">
                            All content on this website, including text, graphics, logos, images, and software, is the property of Oasis Mubales 
                            or its content suppliers and is protected by copyright and other intellectual property laws. You may not reproduce, 
                            distribute, modify, or create derivative works from any content without our prior written permission.
                        </p>

                        <h2 class="mb-4">8. Limitation of Liability</h2>
                        <p class="mb-4">
                            To the fullest extent permitted by law, Oasis Mubales shall not be liable for any indirect, incidental, special, 
                            consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or indirectly, 
                            or any loss of data, use, goodwill, or other intangible losses resulting from your use of our website or products.
                        </p>

                        <h2 class="mb-4">9. Indemnification</h2>
                        <p class="mb-4">
                            You agree to indemnify, defend, and hold harmless Oasis Mubales and its officers, directors, employees, and agents 
                            from any claims, damages, losses, liabilities, and expenses (including legal fees) arising out of your use of the 
                            website or violation of these Terms.
                        </p>

                        <h2 class="mb-4">10. Changes to Terms</h2>
                        <p class="mb-4">
                            We reserve the right to modify these Terms at any time. We will notify users of any material changes by posting 
                            the new Terms on this page and updating the "Last updated" date. Your continued use of the website after such 
                            modifications constitutes acceptance of the updated Terms.
                        </p>

                        <h2 class="mb-4">11. Governing Law</h2>
                        <p class="mb-4">
                            These Terms shall be governed by and construed in accordance with the laws of the jurisdiction in which Oasis Mubales 
                            operates, without regard to its conflict of law provisions.
                        </p>

                        <h2 class="mb-4">12. Contact Information</h2>
                        <p class="mb-4">
                            If you have any questions about these Terms and Conditions, please contact us through our 
                            <a href="{{ route('contact') }}">contact page</a>.
                        </p>

                        <div class="mt-5 pt-4 border-top">
                            <p class="text-muted">
                                By using our website, you acknowledge that you have read, understood, and agree to be bound by these Terms and Conditions.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Terms Section -->
@endsection

