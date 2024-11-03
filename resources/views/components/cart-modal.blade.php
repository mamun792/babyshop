<div class="modal" id="cartModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-size: 16px;" id="exampleModalLabel">{{ $cartCount ?? 0 }} Items in Bag</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach($cartItems ?? [] as $item)
                    <div class="modal-bag-items">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-5">
                                <div class="modal-bag-image text-center">
                                    <img class="img-responsive" src="{{ asset($item['featured_image']) }}" alt="{{ $item['name'] }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-3 col-sm-6">
                                <div class="modal-bag-items-details">
                                    <div class="item-title">
                                        <h6>{{ $item['name'] }}</h6>
                                    </div>
                                  
                                    <span>Quantity: {{ $item['quantity'] }}</span>
                                    <span style="color: green;">In Stock</span>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-6">
                                <div class="modal-price">
                                    {{-- <h6>£{{ number_format($item['price'] * $item['quantity'], 2) }}</h6> --}}
                                    <h6>£{{ number_format($item['price'] ) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer d-block">
                <div class="row">
                    <div class="col-md-6">Total</div>
                    <div class="col-md-6 text-end">
                        <div class="modal-price">
                            <span id="cart-total-show">£{{ number_format($cartTotal ?? 0, 2) }}</span>
                        </div>
                    </div>
                </div>
                <hr class="mt-2 mb-2">
                <div class="row">
                    <div class="col-md-6">
                        <a class="modal-bag-btn" href="{{ route('cart') }}">View Bag</a>
                    </div>
                    <div class="col-md-6">
                        <a class="modal-checkout-btn" href="{{ route('productCheckout') }}">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>