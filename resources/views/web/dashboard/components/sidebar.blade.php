<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>

        <a href="index.html" class="sidebar-logo">
            <img src="{{ asset(logo()) }}" alt="{{ env('APP_NAME') }}" class="light-logo">
            <img src="{{ asset(logo()) }}" alt="{{ env('APP_NAME') }}" class="dark-logo">
            <img src="{{ asset(logo()) }}" alt="{{ env('APP_NAME') }}" class="logo-icon">
        </a>


    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            @role('administrator')
                <li>
                    <a href="{{ route('dashboard') }}">
                        <iconify-icon icon="solar:gallery-wide-linear" class="menu-icon"></iconify-icon>
                        <span>Dashboard</span>
                    </a>
                </li>
            
                <li>
                    <a href="{{ route('dashboard.orders.index') }}">
                        <iconify-icon icon="ic:outline-shopping-cart" class="menu-icon"></iconify-icon>
                        <span>Order Management</span>
                    </a>
                </li>
            @endrole
            {{-- multiple permission  --}}
            @role('administrator|manager')
                <li>
                    <a href="{{ route('dashboard.pos.index') }}">
                        <iconify-icon icon="ic:round-point-of-sale" class="menu-icon"></iconify-icon> <span>POS
                            Management</span>
                    </a>
                </li>
            @endrole

            @role('administrator')
                <li>
                    <a href="{{ route('dashboard.brand.index') }}">
                        <iconify-icon icon="mdi:tag-outline" class="menu-icon"></iconify-icon>
                        <span>Brand</span>
                    </a>
                </li>
            @endrole
            
            @role('customer')
                <li>
                    <a href="{{ route('dashboard.wishlist.index') }}">
                        <iconify-icon icon="mdi:heart-outline" class="menu-icon"></iconify-icon>
                        <span>My Wishlist</span>
                    </a>
                </li>
            @endrole
            @role('customer')
                <li>
                    <a href="{{ route('dashboard.review.index') }}">
                        <iconify-icon icon="ic:baseline-rate-review" class="menu-icon"></iconify-icon>
                        <span>My Reviews</span>
                    </a>
                </li>
            @endrole



            @role('customer')
                <!-- Dashboard Dropdown -->
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="ic:outline-receipt-long" class="menu-icon"></iconify-icon>
                        <span>Orders </span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('dashboard.orders.select') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                My Orders
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.orders.return') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                My Returns

                            </a>
                        </li>

                        <li>
                            <a href="{{ route('dashboard.orders.cancel') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                My Cancellations

                            </a>
                        </li>


                    </ul>
                </li>
            @endrole
            <!-- Dashboard Dropdown -->
            @role('administrator')
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="mdi:package-variant-closed" class="menu-icon"></iconify-icon>
                        <span>Product </span>
                    </a>
                    <ul class="sidebar-submenu">
                       
                        <li>
                            <a href="{{ route('dashboard.product.add') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                Add Product

                            </a>
                        </li>
                       

                        <li>
                            <a href="{{ route('dashboard.product.allProducts') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                All Product

                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.product.review') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                Reviews

                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('dashboard.product.commission') }}">
                        <iconify-icon icon="mdi:tag-outline" class="menu-icon"></iconify-icon>
                        <span>Product Commission</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard.affiliate.withdraw') }}">
                        <iconify-icon icon="mdi:tag-outline" class="menu-icon"></iconify-icon>
                        <span>Affiliate withdraw</span>
                    </a>
                </li>
            @endrole



            <!-- Dashboard Dropdown -->
            @role('administrator')
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="mdi:ticket-percent-outline" class="menu-icon"></iconify-icon>
                        <span>Coupon Management </span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('dashboard.product.coupon.create') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                Add Coupon
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.product.coupon.index') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                Coupon List

                            </a>
                        </li>



                    </ul>
                </li>
            @endrole




            @role('administrator')
                <!-- Dashboard Dropdown -->
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="mdi:view-grid-outline" class="menu-icon"></iconify-icon>
                        <span>Categories </span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('dashboard.categories.index') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                Categories
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.subcategories.index') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                Sub-Category


                            </a>
                        </li>



                    </ul>
                </li>
            @endrole








            @role('administrator')
                <!-- Dashboard Dropdown -->
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="mdi:view-carousel-outline" class="menu-icon"></iconify-icon>
                        <span> Sliders </span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('dashboard.hero.index') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                Hero Slider

                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.hero.show') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                Banner Slider

                            </a>
                        </li>




                    </ul>
                </li>
            @endrole




            @role('administrator')
                <!-- Dashboard Dropdown -->
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="mdi:bullhorn-outline" class="menu-icon"></iconify-icon>
                        <span> Promotion </span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('dashboard.campaign.all') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>

                                Campaigns
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.campaign.addCampaigns') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                Add To Campaign

                            </a>
                        </li>


                    </ul>
                </li>
            @endrole



            @role('administrator')
                <!-- Dashboard Dropdown -->
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="mdi:chart-box-outline" class="menu-icon"></iconify-icon>
                        <span> Inventory </span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('dashboard.stock.index') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                Stock

                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.stock.out') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                Stock Out Products

                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.stock.upcoming') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                Upcoming Stock Out Products

                            </a>
                        </li>




                    </ul>
                </li>
            @endrole




            @role('administrator')
                <!-- Dashboard Dropdown -->
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="mdi:filter-outline" class="menu-icon"></iconify-icon>
                        <span> Attributes </span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('dashboard.attribute.index') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                List of Attribute


                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.attribute.create') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                                Add Attribute

                            </a>
                        </li>




                    </ul>
                </li>
            @endrole

            @role('administrator')
            <!-- Dashboard Dropdown -->
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:file-chart-outline" class="menu-icon"></iconify-icon>
                    <span> Reports</span>
                </a>
                <ul class="sidebar-submenu">
                    
                    <li>
                        <a href="{{ route('dashboard.reports.order') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Order Report



                        </a>
                    </li>
                   
                   
                  
            </li>
            
           





        </ul>
        </li>
    @endrole

        @role('administrator')

        <li class="dropdown">
            <a href="javascript:void(0)">
                <iconify-icon icon="mdi:cog-outline" class="menu-icon"></iconify-icon>
                <span> API Settings</span>
            </a>
            
            <ul class="sidebar-submenu">
                <li>
                    <a href="{{route('dashboard.steadfast.courier')}}">
                        <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                         Courier Api
                    </a>
                </li>

                <li>
                    <a href="{{route('dashboard.baksh')}}">
                        <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                        Baksh
                    </a>
                </li>
                <li>
                    <a href="{{route('dashboard.sscommerce')}}">
                        <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                        Sslcommerz
                    </a>
                </li>
                <li>
                    <a href="{{route('dashboard.amerpay')}}">
                        <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                        Amer Pay
                    </a>
                </li>
            </ul>
        </li>

@endrole

       

        <!-- Accound Section end  -->


        @role('administrator')
            <!-- Dashboard Dropdown -->
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:account-key-outline" class="menu-icon"></iconify-icon>
                    <span> User Role & Permission


                    </span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('dashboard.roles.all') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Users



                        </a>
                    </li>

                    {{-- <li>
                        <a href="{{ route('dashboard.roles.index') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Roles & Permissions



                        </a>
                    </li> --}}

                    <li>
                        <a href="{{ route('dashboard.roles.profileView') }}"><i
                                class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> View Profile</a>
                    </li>


                </ul>
            </li>
        @endrole


      


        @role('administrator')
            <!-- Dashboard Dropdown -->
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:cog-outline" class="menu-icon"></iconify-icon>
                    <span> Settings


                    </span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('dashboard.general-settings.create') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            General Settings
                        </a>
                    </li>

                    <li>
                    <a href="{{ route('dashboard.comments.index') }}">
                        <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                        Comments
                    </a>
                </li>

                    <li>
                        <a href="{{ route('dashboard.media.index') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Media
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('about') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            About Us
                        </a>
                    </li>



                </ul>



            </li>

            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:file-document-outline" class="menu-icon"></iconify-icon>
                    <span> Pages


                    </span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('dashboard.pages.policies') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Polices
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('dashboard.pages.condition') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            terms-conditions
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.pages.refund.policy') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            refund-policy
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.pages.sale.support') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            sale-support
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.pages.shipping.delivery') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            shipping-delivery
                        </a>
                    </li>
                </ul>
            </li>
        @endrole





        {{-- public --}}
        @role('customer')
            <!-- Dashboard Dropdown -->
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:account-outline" class="menu-icon"></iconify-icon>
                    <span> User Account Info




                    </span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('dashboard.address-book.manage-address') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Manage My Account

                        </a>
                    </li>

                    <li>
                        <a href="{{ route('dashboard.address-book.address-book') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Address Book

                        </a>
                    </li>


                </ul>
            </li>
        @endrole
        

        @role('affiliate')
        <ul>
            <li>
                <a href="{{ route('dashboard.affiliate.dashboard') }}" aria-label="Order Management">
                    <iconify-icon icon="ic:outline-shopping-cart" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>
        
            <li>
                <a href="{{route('dashboard.affiliate.products')}}" aria-label="Product Management">
                    <iconify-icon icon="ic:outline-category" class="menu-icon"></iconify-icon> 
                    <span>Product Management</span>
                </a>
            </li>

            <li>
                <a href="{{ route('dashboard.affiliate.earning') }}" aria-label="Payment">
                    <iconify-icon icon="ic:outline-payment" class="menu-icon"></iconify-icon>
                    <span>Earnings</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('dashboard.affiliate.payment') }}" aria-label="Payment">
                    <iconify-icon icon="ic:outline-payment" class="menu-icon"></iconify-icon>
                    <span>Payment</span>
                </a>
            </li>
           
            <li>
                <a href="{{ route('dashboard.affiliate.reports') }}" aria-label="Reports">
                    <iconify-icon icon="ic:outline-insights" class="menu-icon"></iconify-icon>
                    <span>Reports</span>
                </a>
            </li>

           
            <li>
                <a href="{{ route('dashboard.affiliate.settings') }}" aria-label="Settings">
                    <iconify-icon icon="ic:outline-settings" class="menu-icon"></iconify-icon>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
    
        </ul>
        @endrole
    </div>




</aside>
