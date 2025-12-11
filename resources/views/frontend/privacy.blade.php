@extends('layouts.frontend')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1>{{ __('messages.privacy.title') }}</h1>
                        <p class="mb-4">{{ __('messages.privacy.description') }}</p>
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
                        <p class="text-muted mb-4">{{ __('messages.privacy.lastUpdated') }} {{ date('F d, Y') }}</p>

                        <h2 class="mb-4">{{ __('messages.privacy.introduction') }}</h2>
                        <p class="mb-4">
                            {{ __('messages.privacy.introductionText') }}
                        </p>

                        <h2 class="mb-4">{{ __('messages.privacy.informationWeCollect') }}</h2>
                        <h3 class="mb-3">{{ __('messages.privacy.personalInformation') }}</h3>
                        <p class="mb-4">
                            {{ __('messages.privacy.personalInformationText') }}
                        </p>
                        <ul class="mb-4">
                            <li>{{ __('messages.privacy.personalInformationItem1') }}</li>
                            <li>{{ __('messages.privacy.personalInformationItem2') }}</li>
                            <li>{{ __('messages.privacy.personalInformationItem3') }}</li>
                            <li>{{ __('messages.privacy.personalInformationItem4') }}</li>
                            <li>{{ __('messages.privacy.personalInformationItem5') }}</li>
                        </ul>
                        <p class="mb-4">
                            {{ __('messages.privacy.personalInformationDesc') }}
                        </p>

                        <h3 class="mb-3">{{ __('messages.privacy.automaticallyCollected') }}</h3>
                        <p class="mb-4">
                            {{ __('messages.privacy.automaticallyCollectedText') }}
                        </p>
                        <ul class="mb-4">
                            <li>{{ __('messages.privacy.automaticallyCollectedItem1') }}</li>
                            <li>{{ __('messages.privacy.automaticallyCollectedItem2') }}</li>
                            <li>{{ __('messages.privacy.automaticallyCollectedItem3') }}</li>
                            <li>{{ __('messages.privacy.automaticallyCollectedItem4') }}</li>
                            <li>{{ __('messages.privacy.automaticallyCollectedItem5') }}</li>
                        </ul>

                        <h2 class="mb-4">{{ __('messages.privacy.howWeUse') }}</h2>
                        <p class="mb-4">{{ __('messages.privacy.howWeUseText') }}</p>
                        <ul class="mb-4">
                            <li>{{ __('messages.privacy.howWeUseItem1') }}</li>
                            <li>{{ __('messages.privacy.howWeUseItem2') }}</li>
                            <li>{{ __('messages.privacy.howWeUseItem3') }}</li>
                            <li>{{ __('messages.privacy.howWeUseItem4') }}</li>
                            <li>{{ __('messages.privacy.howWeUseItem5') }}</li>
                            <li>{{ __('messages.privacy.howWeUseItem6') }}</li>
                            <li>{{ __('messages.privacy.howWeUseItem7') }}</li>
                        </ul>

                        <h2 class="mb-4">{{ __('messages.privacy.informationSharing') }}</h2>
                        <p class="mb-4">
                            {{ __('messages.privacy.informationSharingText') }}
                        </p>
                        <ul class="mb-4">
                            <li>{{ __('messages.privacy.informationSharingItem1') }}</li>
                            <li>{{ __('messages.privacy.informationSharingItem2') }}</li>
                            <li>{{ __('messages.privacy.informationSharingItem3') }}</li>
                        </ul>

                        <h2 class="mb-4">{{ __('messages.privacy.dataSecurity') }}</h2>
                        <p class="mb-4">
                            {{ __('messages.privacy.dataSecurityText') }}
                        </p>

                        <h2 class="mb-4">{{ __('messages.privacy.cookies') }}</h2>
                        <p class="mb-4">
                            {{ __('messages.privacy.cookiesText1') }}
                        </p>
                        <p class="mb-4">
                            {{ __('messages.privacy.cookiesText2') }}
                        </p>

                        <h2 class="mb-4">{{ __('messages.privacy.yourRights') }}</h2>
                        <p class="mb-4">{{ __('messages.privacy.yourRightsText') }}</p>
                        <ul class="mb-4">
                            <li>{{ __('messages.privacy.yourRightsItem1') }}</li>
                            <li>{{ __('messages.privacy.yourRightsItem2') }}</li>
                            <li>{{ __('messages.privacy.yourRightsItem3') }}</li>
                            <li>{{ __('messages.privacy.yourRightsItem4') }}</li>
                            <li>{{ __('messages.privacy.yourRightsItem5') }}</li>
                            <li>{{ __('messages.privacy.yourRightsItem6') }}</li>
                        </ul>
                        <p class="mb-4">
                            {{ __('messages.privacy.yourRightsContact') }} <a href="{{ route('contact') }}">{{ __('messages.terms.contactPage') }}</a>.
                        </p>

                        <h2 class="mb-4">{{ __('messages.privacy.dataRetention') }}</h2>
                        <p class="mb-4">
                            {{ __('messages.privacy.dataRetentionText') }}
                        </p>

                        <h2 class="mb-4">{{ __('messages.privacy.childrenPrivacy') }}</h2>
                        <p class="mb-4">
                            {{ __('messages.privacy.childrenPrivacyText') }}
                        </p>

                        <h2 class="mb-4">{{ __('messages.privacy.thirdPartyLinks') }}</h2>
                        <p class="mb-4">
                            {{ __('messages.privacy.thirdPartyLinksText') }}
                        </p>

                        <h2 class="mb-4">{{ __('messages.privacy.changesToPolicy') }}</h2>
                        <p class="mb-4">
                            {{ __('messages.privacy.changesToPolicyText') }}
                        </p>

                        <h2 class="mb-4">{{ __('messages.privacy.contactUs') }}</h2>
                        <p class="mb-4">
                            {{ __('messages.privacy.contactUsText') }} 
                            <a href="{{ route('contact') }}">{{ __('messages.terms.contactPage') }}</a>.
                        </p>

                        <div class="mt-5 pt-4 border-top">
                            <p class="text-muted">
                                {{ __('messages.privacy.consent') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Privacy Section -->
@endsection

