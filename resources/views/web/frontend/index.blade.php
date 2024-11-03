<!-- resources/views/index.blade.php -->
@extends('layouts.app')

@section('title', 'Next Ecommerce')

@section('content')

<!-- sub nav news section start -->
<section class="sub-nav-news-section">
  <div class="container">
    <div class="sub-nav-news">
      <p class="animate-text">
        <a href="#">Be in the know - Opt into Emails.</a>
        <a href="#"> <strong>Next day delivery </strong> available to home or <strong> free to store.*</strong></a>
        <a href="#">Enjoy <strong>free delivery </strong> across fashion & furniture with
          <strong>nextunlimited</strong> </a>
      </p>
    </div>
  </div>
</section>
<!-- sub nav news section end -->

<!-- Banner slider start -->



<section class="home-banner-section">
  <div class="container">
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        @foreach ($sliders as $slider)
       
        <div class="swiper-slide">
          <div class="banner-slide-image">
            {{-- <img src="{{ asset('assets/fontend/images/home-banner/banner-1.jpg') }}" alt=""> --}}
            <img src="{{ asset($slider->image_path) }}" alt="{{ $banner->alt_text ?? 'Banner Image' }}">
          </div>
        </div>
        @endforeach
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
  </div>
</section>



<!-- Banner slider end -->


<section class="category-slider-section">
  <div class="container">
    <div class="swiper categorySwiper">
      <div class="swiper-wrapper">
        @foreach ($categories as $categorie)

        <div class="swiper-slide">
          <div class="category-slide">
            <div class="category-slide-image">
              <img src="{{ asset($categorie->image_path) }}" alt="{{$categorie->name}}" loading="lazy">
            </div>
            <div class="category-slide-title">
              <span>
                {{$categorie->name}}
              </span>
            </div>
          </div>
        </div>
        @endforeach

      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
  </div>
</section>



<!-- Banner slider start -->
<section class="category-thumb-section bg-light">
  <div class="container">
    <div class="tranding-title">
      <h4>TRENDING NOW</h4>
    </div>
    <div class="swiper thumbSwiper">
      <div class="swiper-wrapper">
        @foreach ($sub_categories as $sub_categorie )
          
        

        <div class="swiper-slide">
          <a href="#">
            <div class="category-thumb">
              <div class="category-thumb-image">
                <img src="{{ asset($sub_categorie->image) }}" alt="New In">
              </div>
              <div class="category-thumb-title">
                <h4>
                  {{$sub_categorie->name}}
                </h4>
                <span>
                 
                  Shop Now
                </span>
              </div>
            </div>
          </a>
        </div>
        @endforeach
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
  </div>
</section>

<!-- Banner slider end -->



<section class="product-view-section">
  <div class="container">
      <div class="row">
          @foreach ($categoriesWithProducts as $category)
              <h3>{{ $category->name }}</h3> 
              <div class="row">
                  @foreach ($category->products as $product)
                      <div class="col-lg-3 col-md-4 col-sm-12">
                          <div class="product-view-wrapper">
                              <a href="{{ route('product-details', ['slug' => $product->slug]) }}">
                                  <div class="product-image">
                                      <img class="img-responsive" src="{{ asset($product->featured_image) }}" alt="{{ $product->name }}">
                                  </div>
                                  <div class="product-view-title">
                                      <span>{{ $product->name }}</span>
                                  </div>
                                  <div class="product-view-price">
                                      <span>
                                          {{ $product->campaign_price}} - {{ $product->discount_price }}
                                      </span>
                                  </div>
                              </a>
                              <div class="rating-container">
                                  @for ($i = 1; $i <= 5; $i++)
                                  <span class="rating-star" data-value="{{ $i }}">&#9733;</span>
                                     
                                  @endfor
                              </div>
                            
                             
                              <div class="heart-svg" data-product-id="{{ $product->id }}">
                                <svg aria-label="Toggle favorite" role="img" 
                                     class="favorite heart {{ $product->wishlist_id ? 'favorited' : '' }}" 
                                     onclick="toggleFavorite(this, {{ $product->id }})" 
                                     xmlns="http://www.w3.org/2000/svg" 
                                     viewBox="0 0 24 24" 
                                     fill="{{ $product->wishlist_id ? '#FF0000' : 'black' }}">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 1 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                            </div>
                            
                       
                            
                            
                             

                          </div>
                      </div>
                  @endforeach
              </div>
          @endforeach
      </div>
  </div>
</section>


@endsection



