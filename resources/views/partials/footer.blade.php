<!-- resources/views/partials/footer.blade.php -->

<button id="scroll-top-btn"><i class="fa-solid fa-angle-up"></i></button>
  <footer class="footer-section">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3 column-border">
            <a href="#">
              <div class="footer-top-inner">
                <div class="footer-top-icon">
                  <img class="img-responsive" src="{{asset('assets/fontend/images/icons/myaccount.svg')}}" alt="">
                 
                </div>
                <div class="footer-top-text">
                  <h5>My Account</h5>
                  <p>Sign-in to your account</p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-6 col-lg-3 column-border">
            <a href="#">
              <div class="footer-top-inner">
                <div class="footer-top-icon">
                  <img class="img-responsive" src="{{asset('assets/fontend/images/icons/languageselector.svg')}}" alt="">
                </div>
                <div class="footer-top-text">
                  <h5>Change Country</h5>
                  <p>Choose your shopping location</p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-6 col-lg-3 column-border">
            <a href="#">
              <div class="footer-top-inner">
                <div class="footer-top-icon">
                  <img class="img-responsive"  src="{{asset('assets/fontend/images/icons/new-next-storelocator.svg')}}" alt="">
                </div>
                <div class="footer-top-text">
                  <h5>Store Locator</h5>
                  <p>Find your nearest store</p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-6 col-lg-3 column-border">
            <a href="#">
              <div class="footer-top-inner">
                <div class="footer-top-icon">
                  <img class="img-responsive"   src="{{asset('assets/fontend/images/icons/startachat.svg')}}" alt="">
                </div>
                <div class="footer-top-text">
                  <h5>Start a Chat</h5>
                  <p>For general enquiries</p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-main">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3">
            <div class="footer-menu-title mb-3"><b>Help</b></div>
            <div class="footer-menu-link">
              <ul>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Delivery Information</a></li>
                <li><a href="#">Arrange A Return</a></li>
                <li><a href="#">Product Recall</a></li>
                <li><a href="#">Customer Services</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Accessible Site</a></li>
                <li><a href="#">Site Map</a></li>
                <li><a href="#">Website Policy</a></li>
                <li><a href="#">Accessibility In Our Stores</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="footer-menu-title mb-3"><b>Shopping With Us</b></div>
            <div class="footer-menu-link">
              <ul>
                <li><a href="#">Next Unlimited</a></li>
                <li><a href="#">Next Credit Options</a></li>
                <li><a href="#">eGift Cards</a></li>
                <li><a href="#">Gift Cards</a></li>
                <li><a href="#">Gift Experiences</a></li>
                <li><a href="#">Flowers, Plants & Wine</a></li>
                <li><a href="#">Privacy & Policy</a></li>
                <li><a href="#">Terms & Conditions</a></li>
                <li><a href="#">Manage Cookies</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="footer-menu-title mb-3"><b>Departments</b></div>
            <div class="footer-menu-link">
              <ul>
                <li><a href="#">Womens</a></li>
                <li><a href="#">Mens</a></li>
                <li><a href="#">Boys</a></li>
                <li><a href="#">Girls</a></li>
                <li><a href="#">Home</a></li>
                <li><a href="#">Furniture</a></li>
                <li><a href="#">Beauty</a></li>
                <li><a href="#">Brands</a></li>
                <li><a href="#">Baby</a></li>
                <li><a href="#">Sports</a></li>
                <li><a href="#">Clearance</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="footer-menu-title mb-3"><b>More From Next</b></div>
            <div class="footer-menu-link">
              <ul>
                <li><a href="#">Next App</a></li>
                <li><a href="#">The Company</a></li>
                <li><a href="#">Media & Press</a></li>
                <li><a href="#">Business 2 Business</a></li>
                <li><a href="#">Careers @ Next</a></li>
                <li><a href="#">Slavery Statement</a></li>
                <li><a href="#">Gender Pay Report</a></li>
                <li><a href="#">Responsibility Report</a></li>
                <li><a href="#">Website Policy</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr>
    <div class="copyright-section text-center mt-4 pb-2">
      <p>© 2024 Next Retail Ltd. All rights reserved.</p>
    </div>
  </footer>

  
 

 <!-- resources/views/components/cart-modal.blade.php -->

@include('components.cart-modal')


<!-- Footer section end -->