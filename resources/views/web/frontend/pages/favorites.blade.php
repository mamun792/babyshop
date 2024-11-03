@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/fontend/css/favourite.css') }}">
@endpush
@section('content')


    <div class="container">
        <div class="favourites-section">
            <h5 class="mt-3 mb-3">Favourites <span>You have {{ $favoritesCount }} / {{ $maxFavorites }} items saved</span>
            </h5>
            <hr>

            @if ($favoritesCount > 0)
               

                <div class="row">
                    @foreach ($favorites as $favorite)
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <div class="favourite-item">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="item-image">
                                            <img class="img-responsive" src="{{ asset($favorite->product->featured_image) }}"
                                                 alt="{{ $favorite->product->name }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="item-details">
                                            <h6>{{ $favorite->product->name }}</h6>
                                            <p>{{ $favorite->product->product_code }}</p>
                                            <p class="price"><b>£{{ number_format($favorite->product->price, 2) }}</b></p>
                                            <a href="#" class="remove-link" data-id="{{ $favorite->product->id }}"
                                                 onclick="removeFavorite(event, {{ $favorite->product->id }})"
                                                >Remove</a>
                
                                            {{-- Size Selection --}}
                                            <div class="size-selection mb-2 mt-2">
                                                <select name="size" class="size-select" data-product-id="{{ $favorite->product->id }}">
                                                   {{-- // <option selected disabled>Choose Size</option> --}}
                                                    @forelse ($favorite->product->productOptions as $option)
                                                        @if (in_array(strtolower(trim($option->option->attribute->name)), ['size', 'sizes', 'sizec', 'sze', 'sizee', 'sizeee', 'sizeeee']))
                                                            <option value="{{ $option->option->id }}">{{ $option->option->name }}</option>
                                                        @endif
                                                    @empty
                                                        <option value="0">Not Available</option>
                                                    @endforelse
                                                </select>
                                            </div>
                
                                            {{-- Color Selection --}}
                                            <div class="color-selection mb-2 mt-2">
                                                <select name="color" class="color-select" data-product-id="{{ $favorite->product->id }}">
                                                    {{-- <option selected disabled>Choose Color</option> --}}
                                                    @php $hasColorOptions = false; @endphp
                                                    @forelse ($favorite->product->productOptions as $option)
                                                        @if (in_array(strtolower(trim($option->option->attribute->name)), ['color', 'colors', 'colour', 'colours']))
                                                            <option value="{{ $option->option->id }}">{{ $option->option->name }}</option>
                                                            @php $hasColorOptions = true; @endphp
                                                        @endif
                                                    @empty
                                                        <option value="0">Not Available</option>
                                                    @endforelse
                
                                                    @if (!$hasColorOptions)
                                                        <option value="0">Not Available</option>
                                                    @endif
                                                </select>
                                            </div>
                
                                            <button class="add-to-bag-btn" data-product-id="{{ $favorite->product->id }}">ADD TO BAG</button>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>You have no favorite items saved.</p>
            @endif
        </div>
    </div>



@endsection

@push('scripts')
    <script src="{{ asset('assets/fontend/js/remove-favorit.js') }}"></script>

    <script>
        document.querySelectorAll('.add-to-bag-btn').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const sizeSelect = this.closest('.item-details').querySelector('.size-select');
                const colorSelect = this.closest('.item-details').querySelector('.color-select');
    
                const selectedSize = sizeSelect.value;
                const selectedColor = colorSelect.value;

                console.log(selectedSize.data);
                console.log(selectedColor);

                // validation at lest one size and color must be selected . if is not avavilable then direct add to cart

                // if (selectedSize == 0 || selectedColor == 0) {
                //     alert('Please select size and color');
                //     return;
                // }


    
               
                const quantity = 1;
    
                
                const data = {
                    product_id: productId,
                    quantity: quantity,
                    attributes: {
                        color: selectedColor,
                        size: selectedSize,
                    },
                };

                console.log(data);
    
                // Axios post request to add to cart
                axios.post('/cart/add', data)
                    .then(response => {
                       
                        console.log('Product added to cart:', response.data);
                        
                    })
                    .catch(error => {
                        
                        console.error('Error adding product to cart:', error);
                       
                    });
            });
        });

        //  onclick remove  favorite item
        
    </script>
@endpush
