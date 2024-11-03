<section class="home-slider position-relative pt-25 pb-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="position-relative">
                    <div class="hero-slider-1 style-3 dot-style-1 dot-style-1-position-1">
                        @foreach ( $sliders as  $slider)
                            
                       
                        <div class="single-hero-slider single-animation-wrap">
                            <div class="container">
                                <div class="slider-1-height-3 slider-animated-1">
                                    
                                    <div class="slider-img">
                                        <img src="{{ asset($slider->image_path) }}" alt="Image not found">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="slider-arrow hero-slider-1-arrow style-3"></div>
                </div>
            </div>
            <div class="col-lg-3 d-md-none d-lg-block">
                @foreach ($banners as  $banner)
                    
               
                <div class="banner-img banner-1 wow fadeIn animated home-3">
                    <img class="border-radius-10" src="{{ asset($banner->image_path) }}" alt="Image not found">
                   
                </div>
                @endforeach
                {{-- <div class="banner-img banner-2 wow fadeIn animated mb-0">
                    <img class="border-radius-10" src="{{ asset('ecommerce/assets/imgs/banner/banner-7.jpg') }}" alt="">
                    <div class="banner-text">
                        <span>Smart Offer</span>
                        <h4>Save 20% on <br>Eardrop</h4>
                        <a href="shop-grid-right.html">Shop Now <i class="fi-rs-arrow-right"></i></a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</section>
