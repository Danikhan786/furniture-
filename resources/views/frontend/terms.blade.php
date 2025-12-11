@extends('layouts.frontend')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1>{{ __('messages.terms.title') }}</h1>
                        <p class="mb-4">{{ __('messages.terms.description') }}</p>
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
                        <p class="text-muted mb-4">{{ __('messages.terms.lastUpdated') }} {{ date('F d, Y') }}</p>

                        <h2 class="mb-4">{{ __('messages.terms.introduction') }}</h2>
                        <p class="mb-4">
                            {{ __('messages.terms.introductionText') }}
                        </p>

                        <h2 class="mb-4">{{ __('messages.terms.useOfWebsite') }}</h2>
                        <p class="mb-4">
                            {{ __('messages.terms.useOfWebsiteText') }}
                        </p>
                        <ul class="mb-4">
                            <li>{{ __('messages.terms.useOfWebsiteItem1') }}</li>
                            <li>{{ __('messages.terms.useOfWebsiteItem2') }}</li>
                            <li>{{ __('messages.terms.useOfWebsiteItem3') }}</li>
                            <li>{{ __('messages.terms.useOfWebsiteItem4') }}</li>
                        </ul>

                        <h2 class="mb-4">{{ __('messages.terms.productsServices') }}</h2>
                        <p class="mb-4">
                            {{ __('messages.terms.productsServicesText') }}
                        </p>

                        <h2 class="mb-4">{{ __('messages.terms.pricingPayment') }}</h2>
                        <p class="mb-4">
                            {{ __('messages.terms.pricingPaymentText') }}
                        </p>

                        <h2 class="mb-4">{{ __('messages.terms.ordersDelivery') }}</h2>
                        <p class="mb-4">
                            {{ __('messages.terms.ordersDeliveryText') }}
                        </p>

                        <h2 class="mb-4">{{ __('messages.terms.returnsRefunds') }}</h2>
                        <p class="mb-4">
                            {{ __('messages.terms.returnsRefundsText') }}
                        </p>

                        <h2 class="mb-4">{{ __('messages.terms.intellectualProperty') }}</h2>
                        <p class="mb-4">
                            {{ __('messages.terms.intellectualPropertyText') }}
                        </p>

                        <h2 class="mb-4">{{ __('messages.terms.limitationLiability') }}</h2>
                        <p class="mb-4">
                            {{ __('messages.terms.limitationLiabilityText') }}
                        </p>

                        <h2 class="mb-4">{{ __('messages.terms.indemnification') }}</h2>
                        <p class="mb-4">
                            {{ __('messages.terms.indemnificationText') }}
                        </p>

                        <h2 class="mb-4">{{ __('messages.terms.changesToTerms') }}</h2>
                        <p class="mb-4">
                            {{ __('messages.terms.changesToTermsText') }}
                        </p>

                        <h2 class="mb-4">{{ __('messages.terms.governingLaw') }}</h2>
                        <p class="mb-4">
                            {{ __('messages.terms.governingLawText') }}
                        </p>

                        <h2 class="mb-4">{{ __('messages.terms.contactInformation') }}</h2>
                        <p class="mb-4">
                            {{ __('messages.terms.contactInformationText') }} 
                            <a href="{{ route('contact') }}">{{ __('messages.terms.contactPage') }}</a>.
                        </p>

                        <div class="mt-5 pt-4 border-top">
                            <p class="text-muted">
                                {{ __('messages.terms.acknowledge') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Terms Section -->
@endsection

