<div class="logo-search-section">
    <div class="container">
      <div class="logo-icon-section-main">
        <div class="logo-search">
          <div class="main-logo">
           
            <a class="navbar-brand" href="index.html">
              <img src="{{ asset('assets/fontend/images/logo.svg') }}" alt="">
            </a>
          </div>
          <div class="search-box">
            <button class="btn-search"><i class="fa-solid fa-magnifying-glass"></i></button>
            <input type="text" class="input-search" placeholder="search product or brand">
          </div>
        </div>
        <div class="nav-icons-section">
          <div class="user-icon">
            <a href="signin.html">
              <img class="img-responsive" src="{{ asset('assets/fontend/images/icons/next_my-account_desktop.svg') }}" alt="">
            </a>
          </div>
          <div class="fevorite-icon">
            <a href="favourite.html">
              <img class="img-responsive" src="{{ asset('assets/fontend/images/icons/favourites-inactive-large.svg') }}" alt="">
            </a>
          </div>
          <div data-bs-toggle="modal" data-bs-target="#exampleModal" class="shopingbag-icon position-relative">
            <span>3</span>
            <a href="#">
              <img class="img-responsive" src="{{ asset('assets/fontend/images/icons/shopping-bag-large.svg') }}" alt="">
            </a>
          </div>
          <div class="checkout-btn">
            <a href="#">Checkout</a>
          </div>
        </div>
      </div>
    </div>
  </div>