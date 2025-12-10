@extends('layouts.frontend')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1>Privacy Policy</h1>
                        <p class="mb-4">We are committed to protecting your privacy and personal information.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Privacy Section -->
    <div class="untree_co-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="content">
                        <p class="text-muted mb-4">Last updated: {{ date('F d, Y') }}</p>

                        <h2 class="mb-4">1. Introduction</h2>
                        <p class="mb-4">
                            Oasis Meubles ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how 
                            we collect, use, disclose, and safeguard your information when you visit our website and make purchases from us.
                        </p>

                        <h2 class="mb-4">2. Information We Collect</h2>
                        <h3 class="mb-3">2.1 Personal Information</h3>
                        <p class="mb-4">
                            We may collect personal information that you voluntarily provide to us when you:
                        </p>
                        <ul class="mb-4">
                            <li>Register for an account</li>
                            <li>Place an order</li>
                            <li>Subscribe to our newsletter</li>
                            <li>Contact us through our contact form</li>
                            <li>Leave a product review</li>
                        </ul>
                        <p class="mb-4">
                            This information may include your name, email address, phone number, shipping address, billing address, and payment information.
                        </p>

                        <h3 class="mb-3">2.2 Automatically Collected Information</h3>
                        <p class="mb-4">
                            When you visit our website, we automatically collect certain information about your device, including:
                        </p>
                        <ul class="mb-4">
                            <li>IP address</li>
                            <li>Browser type and version</li>
                            <li>Operating system</li>
                            <li>Pages you visit and time spent on pages</li>
                            <li>Referring website addresses</li>
                        </ul>

                        <h2 class="mb-4">3. How We Use Your Information</h2>
                        <p class="mb-4">We use the information we collect to:</p>
                        <ul class="mb-4">
                            <li>Process and fulfill your orders</li>
                            <li>Send you order confirmations and updates</li>
                            <li>Respond to your inquiries and provide customer support</li>
                            <li>Send you marketing communications (with your consent)</li>
                            <li>Improve our website and services</li>
                            <li>Detect and prevent fraud</li>
                            <li>Comply with legal obligations</li>
                        </ul>

                        <h2 class="mb-4">4. Information Sharing and Disclosure</h2>
                        <p class="mb-4">
                            We do not sell, trade, or rent your personal information to third parties. We may share your information only in 
                            the following circumstances:
                        </p>
                        <ul class="mb-4">
                            <li><strong>Service Providers:</strong> We may share information with third-party service providers who perform 
                                services on our behalf, such as payment processing, shipping, and email delivery.</li>
                            <li><strong>Legal Requirements:</strong> We may disclose your information if required by law or in response to 
                                valid requests by public authorities.</li>
                            <li><strong>Business Transfers:</strong> In the event of a merger, acquisition, or sale of assets, your information 
                                may be transferred as part of that transaction.</li>
                        </ul>

                        <h2 class="mb-4">5. Data Security</h2>
                        <p class="mb-4">
                            We implement appropriate technical and organizational security measures to protect your personal information against 
                            unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the Internet or 
                            electronic storage is 100% secure, and we cannot guarantee absolute security.
                        </p>

                        <h2 class="mb-4">6. Cookies and Tracking Technologies</h2>
                        <p class="mb-4">
                            We use cookies and similar tracking technologies to track activity on our website and store certain information. 
                            Cookies are files with a small amount of data that are sent to your browser from a website and stored on your device.
                        </p>
                        <p class="mb-4">
                            You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do 
                            not accept cookies, you may not be able to use some portions of our website.
                        </p>

                        <h2 class="mb-4">7. Your Rights</h2>
                        <p class="mb-4">Depending on your location, you may have the following rights regarding your personal information:</p>
                        <ul class="mb-4">
                            <li><strong>Access:</strong> Request access to your personal information</li>
                            <li><strong>Correction:</strong> Request correction of inaccurate or incomplete information</li>
                            <li><strong>Deletion:</strong> Request deletion of your personal information</li>
                            <li><strong>Objection:</strong> Object to processing of your personal information</li>
                            <li><strong>Data Portability:</strong> Request transfer of your personal information</li>
                            <li><strong>Withdraw Consent:</strong> Withdraw consent for processing where consent is the legal basis</li>
                        </ul>
                        <p class="mb-4">
                            To exercise these rights, please contact us through our <a href="{{ route('contact') }}">contact page</a>.
                        </p>

                        <h2 class="mb-4">8. Data Retention</h2>
                        <p class="mb-4">
                            We will retain your personal information only for as long as necessary to fulfill the purposes outlined in this 
                            Privacy Policy, unless a longer retention period is required or permitted by law.
                        </p>

                        <h2 class="mb-4">9. Children's Privacy</h2>
                        <p class="mb-4">
                            Our website is not intended for children under the age of 18. We do not knowingly collect personal information from 
                            children. If you are a parent or guardian and believe your child has provided us with personal information, please 
                            contact us immediately.
                        </p>

                        <h2 class="mb-4">10. Third-Party Links</h2>
                        <p class="mb-4">
                            Our website may contain links to third-party websites. We are not responsible for the privacy practices or content 
                            of these external sites. We encourage you to review the privacy policies of any third-party sites you visit.
                        </p>

                        <h2 class="mb-4">11. Changes to This Privacy Policy</h2>
                        <p class="mb-4">
                            We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy 
                            Policy on this page and updating the "Last updated" date. You are advised to review this Privacy Policy periodically 
                            for any changes.
                        </p>

                        <h2 class="mb-4">12. Contact Us</h2>
                        <p class="mb-4">
                            If you have any questions or concerns about this Privacy Policy or our data practices, please contact us through our 
                            <a href="{{ route('contact') }}">contact page</a>.
                        </p>

                        <div class="mt-5 pt-4 border-top">
                            <p class="text-muted">
                                By using our website, you consent to the collection and use of information in accordance with this Privacy Policy.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Privacy Section -->
@endsection

