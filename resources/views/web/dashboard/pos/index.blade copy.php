@extends('web.dashboard.app')







@section('content')
{{-- @include('web.dashboard.components.cards') --}}


<div class="row">

    <div class="px-4 px-lg-0 col-6">



        <div class="container">

            <div class="row">



                <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                    <form action="" method="post" class="row">
                        <div class="dropdown col-2">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Category
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>

                        <input type="search" class="col-8 form-control w-50" name="" id="">
                        <input type="reset" class="col-1 btn btn-sm btn-danger" value="X">
                        <input type="submit" class="col-1 btn btn-sm btn-primary">

                    </form>

                    <!-- Shopping cart table -->
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="p-2 px-3 text-uppercase">Product</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Price</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Quantity</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Remove</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row" class="border-0">
                                    <div class="p-2">
                                        <img src="https://bootstrapious.com/i/snippets/sn-cart/product-1.jpg"
                                            alt="" width="100" class="img-fluid rounded shadow-sm">
                                        <div class="ml-3 d-inline-block align-middle">
                                            <h5 class="mb-0">
                                                Timex Unisex Originals
                                            </h5>

                                            <span class="text-muted font-weight-normal font-italic d-block">Category:
                                                Watches</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="border-0 align-middle"><strong>$79.00</strong></td>
                                <td class="border-0 align-middle"><input type="number" min="0"
                                        class="py-2 text-uppercase form-control w-50" /></td>
                                <td class="border-0 align-middle">
                                    <button class="btn btn-sm btn-warning">Add to cart</button>
                                </td>
                            </tr>

                            <tr>
                                <td scope="row" class="border-0">
                                    <div class="p-2">
                                        <img src="https://bootstrapious.com/i/snippets/sn-cart/product-1.jpg"
                                            alt="" width="100" class="img-fluid rounded shadow-sm">
                                        <div class="ml-3 d-inline-block align-middle">
                                            <h5 class="mb-0">
                                                Timex Unisex Originals
                                            </h5>

                                            <span class="text-muted font-weight-normal font-italic d-block">Category:
                                                Watches</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="border-0 align-middle"><strong>$79.00</strong></td>
                                <td class="border-0 align-middle"><input type="number" min="0"
                                        class="py-2 text-uppercase form-control w-50" /></td>
                                <td class="border-0 align-middle">
                                    <button class="btn btn-sm btn-warning">Add to cart</button>
                                </td>
                            </tr>
                            <tr>
                                <td scope="row" class="border-0">
                                    <div class="p-2">
                                        <img src="https://bootstrapious.com/i/snippets/sn-cart/product-1.jpg"
                                            alt="" width="100" class="img-fluid rounded shadow-sm">
                                        <div class="ml-3 d-inline-block align-middle">
                                            <h5 class="mb-0">
                                                Timex Unisex Originals
                                            </h5>

                                            <span class="text-muted font-weight-normal font-italic d-block">Category:
                                                Watches</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="border-0 align-middle"><strong>$79.00</strong></td>
                                <td class="border-0 align-middle"><input type="number" min="0"
                                        class="py-2 text-uppercase form-control w-50" /></td>
                                <td class="border-0 align-middle">
                                    <button class="btn btn-sm btn-warning">Add to cart</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- End -->
                </div>
            </div>



        </div>

    </div>
    <div class="px-4 px-lg-0 col-6">


        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create New User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="firstName" class="form-label">Full Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter Full Name" id="firstName">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="PhoneNumber" class="form-label">Phone Number</label>
                                        <input name="phone" type="tel" class="form-control" placeholder="Enter Phone Number" id="PhoneNumber">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="emailAddress" class="form-label">Email Address</label>
                                        <input name="email" type="email" class="form-control" placeholder="Enter Email Address" id="emailAddress">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input name="username" type="text" class="form-control" placeholder="Enter Username" id="username">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="country" class="form-label">Country</label>
                                        <select name="country" class="form-select">
                                            <option value="">Select a country</option>
                                            <option value="1">Bangladesh</option>
                                            <option value="5">China</option>
                                            <option value="6">England</option>
                                            <option value="4">Russia</option>
                                            <option value="7">Saudi Arabia</option>
                                            <option value="3">Turkey</option>
                                            <option value="2">USA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="state" class="form-label">State</label>
                                        <select name="state" class="form-select">
                                            <option value="">Select a state</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <select name="city" class="form-select">
                                            <option value="">Select a city</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="customerAddress" class="form-label">Customer Address</label>
                                        <input name="address" type="text" class="form-control" placeholder="Enter Customer Address" id="customerAddress">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send message</button>
                    </div>
                </div>
            </div>
        </div>



        <div class="container">


            <div class="row py-5 p-4 bg-white rounded shadow-sm">

                <div class="container mt-5">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="javascript:void(0)"
                                onclick="tab('customer_search')">Customer Search</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0)" onclick="tab('walkIn')">Walk In</a>
                        </li>
                    </ul>
                    <div id="customer_search" class="tab-content my-4">
                        <h4>Find by Phone/Email</h4>

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Recipient's username"
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">+</button>


                            </div>
                        </div>
                    </div>
                    <div id="walkIn" class="tab-content my-4 text-center" style="display: none">
                        <h4>Ordering for walk in customer
                        </h4>
                    </div>
                </div>
                <div class="col-12">
                    <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary
                    </div>
                    <div class="p-4">

                        <table class="table">

                            <thead>
                                <tr>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="p-2 px-3 text-uppercase">Product</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Price</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Quantity</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Remove</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            <img src="https://bootstrapious.com/i/snippets/sn-cart/product-1.jpg"
                                                alt="" width="100" class="img-fluid rounded shadow-sm">
                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0">
                                                    Timex Unisex Originals
                                                </h5>

                                                <span
                                                    class="text-muted font-weight-normal font-italic d-block">Category:
                                                    Watches</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle"><strong>$79.00</strong></td>
                                    <td class="border-0 align-middle"><strong>00</strong></td>

                                    <td class="border-0 align-middle">
                                        <a href="#" class="text-dark">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                    <div class="p-4">
                        <p class="font-italic mb-4">Shipping and additional costs are calculated based on values you
                            have entered.</p>
                        <ul class="list-unstyled mb-4">
                            <li class="d-flex justify-content-between py-3 border-bottom">
                                <strong class="text-muted">Order Subtotal </strong>
                                <strong>$390.00</strong>
                            </li>
                            <li class="d-flex justify-content-between py-3 border-bottom">
                                <strong class="text-muted">Shipping and handling</strong>
                                <strong>$10.00</strong>
                            </li>
                            <li class="d-flex py-3 border-bottom">

                                <div class="input-group">
                                    <strong class="text-muted"> Discount ( Optional )</strong>
                                    <select class="form-control ms-3">
                                        <option>Discount Type</option>
                                        <option value="">sfasd</option>
                                        <option value="">sfasd</option>

                                    </select>
                                    <input type="text" class="form-control" placeholder="Amount">
                                </div>
                            </li>



                            <li class="d-flex justify-content-between py-3 border-bottom">
                                <strong class="text-muted">Total</strong>
                                <h5 class="font-weight-bold">$400.00</h5>
                            </li>
                        </ul>
                    </div>


                </div>
                <div class="col-12">
                    <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Coupon code</div>
                    <div class="p-4">
                        <p class="font-italic mb-4">If you have a coupon code, please enter it in the box below</p>
                        <div class="input-group mb-4 border rounded-pill p-2">
                            <input type="text" placeholder="Apply coupon" aria-describedby="button-addon3"
                                class="form-control border-0">
                            <div class="input-group-append border-0">
                                <button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i
                                        class="fa fa-gift mr-2"></i> &nbsp; Apply coupon</button>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Instructions for
                            seller</div>
                        <div class="p-4">
                            <p class="font-italic mb-4">If you have some information for the seller you can leave them
                                in the box below</p>
                            <textarea name="" cols="30" rows="2" class="form-control"></textarea>
                        </div> --}}
                </div>

                <div class="row">
                    <div class="container">
                        <a href="#"
                            class="col-3 btn btn-danger rounded-pill py-2 btn-block float-end ms-4">Cancel</a>
                        <a href="#" class="col-3 btn btn-dark rounded-pill py-2 btn-block float-end">Procceed to
                            checkout</a>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
@endsection