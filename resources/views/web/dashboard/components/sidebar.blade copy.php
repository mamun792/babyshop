<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- Profile Section -->
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="assets/images/faces/face1.jpg" alt="profile" />
                    <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{ auth()->user()->name }}</span>
                    <span class="text-secondary text-small">{{ authUserRoles() }}</span>

                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="index.html">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        <!-- Supplier Section -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#supplier" aria-expanded="false"
                aria-controls="supplier">
                <span class="menu-title">Order Management</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-truck-fast menu-icon"></i>
            </a>
            <div class="collapse" id="supplier">
                <ul class="nav flex-column sub-menu">
                    <!-- Add Supplier -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.orders.index') }}">Online Store</a>

                    </li>


                    <!-- Suppliers Table -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.orders.offline.index') }}">Ofline Store</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.pos.index') }}">
                <span class="menu-title">PoS</span>
                <i class="mdi mdi-file-export menu-icon"></i>
            </a>
        </li>
        <!-- Export -->
        <li class="nav-item">
            <a class="nav-link" href="pages/export.html">
                <span class="menu-title">Export</span>
                <i class="mdi mdi-file-export menu-icon"></i>
            </a>
        </li>
        <!-- Attribute Section -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#attributes" aria-expanded="false"
                aria-controls="attributes">
                <span class="menu-title">Attribute</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-tag menu-icon"></i>
            </a>
            <div class="collapse" id="attributes">
                <ul class="nav flex-column sub-menu">
                    <!-- Attribute Option -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.attribute.index') }}">List of Attribute</a>
                    </li>
                    <!-- Attribute Name -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.attribute.create') }}">Add</a>
                    </li>


                </ul>
            </div>
        </li>


        <!-- Product Management -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#product-management" aria-expanded="false"
                aria-controls="product-management">
                <span class="menu-title">Product Management</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-cube menu-icon"></i>
            </a>
            <div class="collapse" id="product-management">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.product.index') }}">Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.product.add') }}">Add Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.product.purchased') }}">Product Purchase</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/products/review.html">Product Reviews</a>
                    </li>
                    <!-- All Product  -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.product.allProducts') }}">All Product </a>
                    </li>
                    {{-- add cupone --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.product.coupon.index') }}">Coupon</a>
                    </li> --}}

                    {{-- add cupone --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.product.coupon.attach.index') }}">Coupon</a>
                    </li> --}}
                </ul>
            </div>
        </li>

        <li class="nav-item">

            <a class="nav-link" data-bs-toggle="collapse" href="#categories" aria-expanded="false"
                aria-controls="categories">
                <span class="menu-title">Coupon Management</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-tag-multiple menu-icon"></i>
            </a>
            <div class="collapse" id="categories">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.product.coupon.create') }}">Add Coupon</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.product.coupon.index') }}">Coupon List</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.product.coupon.index') }}">Coupon List</a>
                    </li> --}}
                </ul>
            </div>
        </li>


        <!-- Categories -->
        <li class="nav-item">

            <a class="nav-link" data-bs-toggle="collapse" href="#categories" aria-expanded="false"
                aria-controls="categories">
                <span class="menu-title">Categories</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-tag-multiple menu-icon"></i>
            </a>
            <div class="collapse" id="categories">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.categories.index') }}">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.subcategories.index') }}">Sub-Category</a>
                    </li>
                </ul>
            </div>
        </li>



        <!-- Supplier Section -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#supplier" aria-expanded="false"
                aria-controls="supplier">
                <span class="menu-title">Supplier</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-truck-fast menu-icon"></i>
            </a>
            <div class="collapse" id="supplier">
                <ul class="nav flex-column sub-menu">
                    <!-- Add Supplier -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.supplier.index') }}">Add Supplier</a>

                    </li>


                    <!-- Suppliers Table -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.supplier.list') }}">Suppliers </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Brand Section -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#brand" aria-expanded="false"
                aria-controls="brand">
                <span class="menu-title">Brand</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-truck-fast menu-icon"></i>
            </a>
            <div class="collapse" id="supplier">
                <ul class="nav flex-column sub-menu">
                    <!-- Add Supplier -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.supplier.index') }}">Add Supplier</a>

                    </li>


                    <!-- Suppliers Table -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.supplier.list') }}">Suppliers </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="">
                <span class="menu-title">Brand</span>
                <i class="mdi mdi-file-export menu-icon"></i>
            </a>
        </li>
        <!-- Accound Section -->
        {{-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#product-management" aria-expanded="false"
                aria-controls="product-management">
                <span class="menu-title">Accounts</span>
                <i class="menu-arrow"></i>
                <i class="fa fa-money"></i>

            </a>
            <div class="collapse" id="product-management">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.accounts.income') }}"><i
                                class="fa fa-arrow-circle-right"></i> Income
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.accounts.expense') }}"><i
                                class="fa fa-arrow-circle-right"></i>Expense
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.accounts.due') }}"><i
                                class="fa fa-arrow-circle-right"></i>Due
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.accounts.manageBalance') }}"><i
                                class="fa fa-arrow-circle-right"></i>Mange Balance
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.accounts.balance') }}"><i
                                class="fa fa-arrow-circle-right"></i>Balance
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.accounts.fundTransfer') }}">
                            <i class="fa fa-arrow-circle-right"></i>Fund Transfer
                        </a>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.accounts.accountPurpose') }}"> <i
                                class="fa fa-folder-open"></i> Account Purpose </a>
                    </li>
                </ul>
            </div>
        </li> --}}

        <!-- Accound Section end  -->

        <!-- Gallery Section -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.hero.index') }}">
                <span class="menu-title">Hero Slider</span>
                <i class="mdi mdi-account-multiple menu-icon"></i>
            </a>
        </li>


        <!-- Promotion Section -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#promotion" aria-expanded="false"
                aria-controls="promotion">
                <span class="menu-title">Promotion</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-campaign menu-icon"></i>
            </a>
            <div class="collapse" id="promotion">
                <ul class="nav flex-column sub-menu">
                    <!-- Add Campaign Product -->
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.campaign.index') }}">Add Campaign Product</a>
                    </li> --}}
                    {{-- code added --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.campaign.addCampaigns') }}">Add Campaign</a>
                    </li>
                    <!-- Generate Discount Code -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.campaign.all') }}">Generate Discount
                            Code</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Stock Out Product Section -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#stock-out" aria-expanded="false"
                aria-controls="stock-out">
                <span class="menu-title">Stock Out Product</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-alert-outline menu-icon"></i>
            </a>
            <div class="collapse" id="stock-out">
                <ul class="nav flex-column sub-menu">
                    <!-- Stock Out Product Table List -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.stock-out-product.index') }}">Stock Out Product
                            Table List</a>
                    </li>
                    <!-- Upcoming Stock Out Product List -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.stock-out-product.upcoming') }}">Upcoming Stock
                            Out Product
                            List</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Product Purchase Section -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#product-purchase" aria-expanded="false"
                aria-controls="product-purchase">
                <span class="menu-title">Product Purchase</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-cart menu-icon"></i>
            </a>
            <div class="collapse" id="product-purchase">
                <ul class="nav flex-column sub-menu">
                    <!-- Add Product Purchase -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.product-purchase.create') }}">Add Product
                            Purchase</a>
                    </li>
                    <!-- Product Purchase List -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.product-purchase.index') }}">Product Purchase
                            List</a>
                    </li>

                </ul>
            </div>
        </li>

        <!-- Review Section -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#review" aria-expanded="false"
                aria-controls="review">
                <span class="menu-title">Review</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-star menu-icon"></i>
            </a>
            <div class="collapse" id="review">
                <ul class="nav flex-column sub-menu">
                    <!-- Product Review Table -->
                    <li class="nav-item">
                        <a class="nav-link" href="pages/review/product-review.html">Product Review Table</a>
                    </li>
                </ul>
            </div>
        </li>


        <!-- User Role & Permission -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#user-role-permission" aria-expanded="false"
                aria-controls="user-role-permission">
                <span class="menu-title">User Role & Permission</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-key menu-icon"></i>
            </a>
            <div class="collapse" id="user-role-permission">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.roles.all') }}">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.roles.index') }}">Roles</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Reports -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#reports" aria-expanded="false"
                aria-controls="reports">
                <span class="menu-title">Reports</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-chart-areaspline menu-icon"></i>
            </a>
            <div class="collapse" id="reports">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.reports.profitLoss') }}">Profit/Loss Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.reports.stock') }}">Product Stock and
                            Profit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.reports.order') }}">Order Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.reports.office.sale') }}">Office Sale
                            Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.reports.order.profit') }}">Order Profit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.reports.sale.profit') }}">Sale Profit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.reports.purchase') }}">Purchase Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.reports.supplier') }}">Supplier Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.reports.account') }}">Account Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.reports.product.stock') }}">Stock Report</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Customers -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.customers.index') }}">
                <span class="menu-title">Customers</span>
                <i class="mdi mdi-account-multiple menu-icon"></i>
            </a>
        </li>

        <!-- Landing Page -->
        {{-- <li class="nav-item">
            <a class="nav-link" href="pages/landing-page.html">
                <span class="menu-title">Landing Page</span>
                <i class="mdi mdi-web menu-icon"></i>
            </a>
        </li> --}}

        <!-- General Settings -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.general-settings.create') }}">
                <span class="menu-title">General Settings</span>
                <i class="mdi mdi-settings menu-icon"></i>
            </a>
        </li>
        <!-- Testimonial  -->
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.testimonial.index') }}">
                <span class="menu-title ">Testimonial</span>
                <i class="mdi mdi-format-quote-close menu-icon"></i>
            </a>
        </li> --}}
        <!-- Media -->
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.media.index') }}">
                <span class="menu-title">Media</span>
                <i class="mdi mdi-folder-image menu-icon"></i>
            </a>
        </li> --}}

        <!-- Courier API Settings -->
        <li class="nav-item">
            <a class="nav-link" href="pages/settings/courier-api.html">
                <span class="menu-title">Courier API Settings</span>
                <i class="mdi mdi-truck-delivery menu-icon"></i>
            </a>
        </li>

        <!-- References -->
        {{-- <li class="nav-item">
            <a class="nav-link" href="pages/references.html">
                <span class="menu-title">References</span>
                <i class="mdi mdi-book-open-variant menu-icon"></i>
            </a>
        </li> --}}

        <!-- seprate -->
        <!---user registration  and login -->


        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#user-role-permission" aria-expanded="false"
                aria-controls="user-role-permission">
                <span class="menu-title">User Account info</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-key menu-icon"></i>
            </a>
            <div class="collapse" id="user-role-permission">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.address-book.manage-address') }}">
                            <span class="menu-title"> Manage My Account</span>
                            <i class="mdi mdi-account-details menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.address-book.address-book') }}">
                            <span class="menu-title ">Address Book</span>
                            <i class="mdi mdi-account-details menu-icon"></i>
                        </a>
                    </li>



                </ul>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#user-role-permission" aria-expanded="false"
                aria-controls="user-role-permission">
                <span class="menu-title">Oders</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-key menu-icon"></i>
            </a>
            <div class="collapse" id="user-role-permission">
                <ul class="nav flex-column sub-menu">




                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.orders.select') }}">
                            <span class="menu-title">My Orders</span>
                            <i class="mdi mdi-account-details menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.orders.return') }}">
                            <span class="menu-title"> My Returns </span>
                            <i class="mdi mdi-account-details menu-icon"></i>
                        </a>
                    </li>
                    {{-- cancel oder --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.orders.cancel') }}">
                            <span class="menu-title"> My Cancellations</span>
                            <i class="mdi mdi-account-details menu-icon"></i>
                        </a>
                    </li>


                </ul>
            </div>
        </li>
        </li>

        {{-- My reivew s --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.review.index') }}">
                <span class="menu-title">My Reviews</span>
                <i class="mdi mdi-account-multiple menu-icon"></i>
            </a>
        </li>

        {{-- My Wishlist --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.wishlist.index') }}">
                <span class="menu-title">My Wishlist</span>
                <i class="mdi mdi-heart menu-icon"></i>
            </a>
        </li>

        {{-- polices --}}

        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.pages.policies') }}">
                <span class="menu-title">Polices</span>

            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.pages.condition') }}">
                <span class="menu-title">terms-conditions</span>

            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.pages.refund.policy') }}">
                <span class="menu-title">refund-policy</span>

            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.pages.sale.support') }}">
                <span class="menu-title">sale-support</span>

            </a>
        </li>
        {{-- shipping-delivery --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.pages.shipping.delivery') }}">
                <span class="menu-title">shipping-delivery</span>
            </a>
        </li>


        <!---user registration  and login end -->
    </ul>
</nav>
