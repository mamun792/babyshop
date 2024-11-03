<div>
    @extends('web.dashboard.app', ['page' => 'General Settings'])
    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}

        <div class="container mt-5">
            <form action="{{ route('dashboard.update') }}" method="POST">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-12">
                        {{-- <h2 class="text-center mb-4" 
                            style="font-weight: 700; font-size: 2.5rem; color: #333; letter-spacing: 1px;">
                            General Settings
                        </h2> --}}
                        <div class="card-header text-center mb-4"  style="font-weight: 700; font-size: 2.5rem;  letter-spacing: 1px;">
                            General Settings
                        </div>
                        <hr class="mx-auto" style="width: 60px; border-top: 3px solid #007bff;">
                    </div>

                    <!-- Basic Information -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Basic Information</h5>
                                <div class="form-group mb-3">
                                    <label for="siteTitle">Site Title</label>
                                    <input type="text" class="form-control" id="siteTitle" name="site_title"
                                        value="{{ $settings->site_title ?? '' }}" placeholder="Enter site title">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="homePageTitle">Home Page Title</label>
                                    <input type="text" class="form-control" id="homePageTitle" name="home_page_title"
                                        value="{{ $settings->xxxxxxxxxx ?? '' }}" placeholder="Enter home page title">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Contact Information -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Contact Information</h5>
                                <div class="form-group mb-3">
                                    <label for="whatsappNumber">WhatsApp Number</label>
                                    <input type="text" class="form-control" id="whatsappNumber" name="whatsapp_number"
                                        value="{{ $settings->whatsapp_number ?? '' }}" placeholder="Enter WhatsApp number">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="storeEmail">Store Email</label>
                                    <input type="email" class="form-control" id="storeEmail" name="store_email"
                                        value="{{ $settings->store_email ?? '' }}" placeholder="Enter store email">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Store Details -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Store Details</h5>
                                <div class="form-group mb-3">
                                    <label for="facebookIframe">Facebook Iframe</label>
                                    <input type="text" class="form-control" id="facebookIframe" name="facebook_iframe"
                                        {{ $settings->facebook_iframe ?? '' }} placeholder="Enter Facebook iframe">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="shopAddress">Shop Address</label>
                                    <input type="text" class="form-control" id="shopAddress" name="shop_address"
                                        {{ $settings->shop_address ?? '' }} placeholder="Enter shop address">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- SEO Settings -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-3">SEO Settings</h5>
                                <div class="form-group mb-3">
                                    <label for="siteMetaKeywords">Site Meta Keywords</label>
                                    <input type="text" class="form-control" id="siteMetaKeywords"
                                        name="site_meta_keywords" value="{{ $settings->site_meta_keywords ?? '' }}"
                                        placeholder="Enter site meta keywords">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="siteMetaDescription">Site Meta Description</label>
                                    <input type="text" class="form-control" id="siteMetaDescription"
                                        name="site_meta_description" value="{{ $settings->site_meta_description  ?? ''}}"
                                        placeholder="Enter site meta description">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Marketing Settings -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Marketing</h5>
                                <div class="form-group mb-3">
                                    <label for="facebookPixel">Facebook Pixel</label>
                                    <input type="text" class="form-control" id="facebookPixel" name="facebook_pixel"
                                        value="{{ $settings->facebook_pixel ?? '' }}" placeholder="Enter Facebook Pixel ID">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tagManager">Tag Manager</label>
                                    <input type="text" class="form-control" id="tagManager" name="tag_manager"
                                        value="{{ $settings->tag_manager  ?? ''}}" placeholder="Enter Tag Manager ID">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="googleAnalytics">Google Analytics</label>
                                    <input type="text" class="form-control" id="googleAnalytics"
                                        name="google_analytics" value="{{ $settings->google_analytics ?? '' }}"
                                        placeholder="Enter Google Analytics ID">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="domainVerification">Domain Verification</label>
                                    <input type="text" class="form-control" id="domainVerification"
                                        name="domain_verification" value="{{ $settings->domain_verification ?? '' }}"
                                        placeholder="Enter Domain Verification Code">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Social Links -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Social Links</h5>
                                <div class="form-group mb-3">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" class="form-control" id="facebook" name="facebook_url"
                                        value="{{ $settings->facebook_url ?? '' }}" placeholder="Facebook URL">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="instagram">Instagram</label>
                                    <input type="text" class="form-control" id="instagram" name="instagram_url"
                                        value="{{ $settings->instagram_url ?? ''}}" placeholder="Instagram URL">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="youtube">YouTube</label>
                                    <input type="text" class="form-control" id="youtube" name="youtube_url"
                                        value="{{ $settings->youtube_url ?? ''}}" placeholder="YouTube URL">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tiktok">TikTok</label>
                                    <input type="text" class="form-control" id="tiktok" name="tiktok_url"
                                        value="{{ $settings->tiktok_url ?? ''}}" placeholder="TikTok URL">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="Twitter">Twitter</label>
                                    <input type="text" class="form-control" id="Twitter" name="twitter_url"
                                        value="{{ $settings->twitter_url ?? '' }}" placeholder="Twitter URL">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Appearance & Stock Settings -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Appearance & Stock Settings</h5>
                                <div class="form-group mb-3">
                                    <label for="primaryColor">Primary Color</label>
                                    <input type="color" class="form-control" id="primaryColor" name="primary_color"
                                        value="{{ $settings->primary_color ?? '' }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="stockAlertQuantity">Stock Alert Quantity</label>
                                    <input type="number" class="form-control" id="stockAlertQuantity"
                                        name="stock_alert_quantity" value="{{ $settings->stock_alert_quantity ?? ''}}"
                                        placeholder="Enter stock alert quantity">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="insideDeliveryCharge">Delivery Charge (Inside Dhaka)</label>
                                    <input type="number" name="delivery_charge_inside_dhaka" class="form-control"
                                        id="insideDeliveryCharge" value="{{ $settings->delivery_charge_inside_dhaka ?? '' }}"
                                        placeholder="Enter delivery charge inside Dhaka">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="outsideDeliveryCharge">Delivery Charge (Outside Dhaka)</label>
                                    <input type="number" name="delivery_charge_outside_dhaka" class="form-control"
                                        id="outsideDeliveryCharge" value="{{ $settings->delivery_charge_outside_dhaka ?? '' }}"
                                        placeholder="Enter delivery charge outside Dhaka">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Chat Bot Option -->
                    <div class="col-md-6 my-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Chat Bot Option</h5>
                                <div class="form-group mb-3">
                                    <label for="messengerBot">Messenger Bot</label>
                                    <input type="text" class="form-control" id="messengerBot" name="messenger_bot"
                                        value="{{ $settings->messenger_bot ?? '' }}"
                                        placeholder="Messenger Bot Integration Code">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="whatsAppBot">WhatsApp Bot</label>
                                    <input type="text" class="form-control" id="whatsAppBot" name="whatsapp_bot"
                                        value="{{ $settings->whatsapp_bot ?? '' }}"
                                        placeholder="WhatsApp Bot Integration Code">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Save Button -->
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg px-5">Save Settings</button>
                    </div>
                </div>
            </form>
        </div>
    @endsection
</div>
