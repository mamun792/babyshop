@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/fontend/css/category.css') }}">
@endpush
@section('content')



    <section class="product-sorting-section">
        <div class="container">
            <div class="sorting-top">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h5>Products Found <span>({{ $products->total() }})</span></h5>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="sort-selection">
                            <label for="sort-select">Sort</label>
                            <select id="sort-select" name="sort" onchange="updateURL()">
                                <option selected disabled>Choose One</option>
                                <option value="Most Relevant" {{ request('sort') == 'Most Relevant' ? 'selected' : '' }}>
                                    Most Relevant</option>
                                <option value="Most Popular" {{ request('sort') == 'Most Popular' ? 'selected' : '' }}>Most
                                    Popular</option>
                                <option value="Alphabetical" {{ request('sort') == 'Alphabetical' ? 'selected' : '' }}>
                                    Alphabetical</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sorting-down mt-5">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 sorting-column">
                        <div class="filter-category">
                            <button class="dropbtn">
                                <input type="checkbox" id="new-in" name="new-product" onchange="updateURL()"
                                    {{ request('new-product') ? 'checked' : '' }}>
                                <label style="width:100%; cursor: pointer; padding: 8px 16px;" for="new-in">New In
                                    (492)</label>
                            </button>
                        </div>
                    </div>

                    @foreach ($attributes as $attribute)
                        @if (in_array($attribute->name, ['color', 'size']))
                            <div class="col-lg-3 col-md-6 col-sm-6 sorting-column">
                                <div class="dropdown">
                                    <button class="dropbtn" onclick="toggleDropdown(this)">
                                        {{ ucfirst($attribute->name) }} <span class="down-angle"><i
                                                class="fa-solid fa-angle-down"></i></span>
                                    </button>
                                    <div class="dropdown-content">
                                        <div class="dropdown-header">
                                            <span class="selected-count">{{ count(request()->input($attribute->name, [])) }}
                                                Selected</span>
                                            <span class="clear-all" onclick="clearAllSelections(this)">Clear All</span>
                                        </div>
                                        @foreach ($attribute->options as $option)
                                            <label>
                                                <input type="checkbox" name="{{ $attribute->name }}[]"
                                                    value="{{ $option->id }}"
                                                    {{ request()->input($attribute->name, []) && in_array($option->id, request($attribute->name, [])) ? 'checked' : '' }}
                                                    onchange="updateSelection(this, '{{ $attribute->name }}')">
                                                <!-- Call updateSelection on change -->
                                                {{ $option->name }} ({{ $option->id }})
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach



                    {{-- // step 2. --}}
                    {{-- @foreach ($attributes as $attribute)
                                @if ($attribute->name === 'color') <!-- Filter for the color attribute -->
                                    <div class="col-lg-3 col-md-6 col-sm-6 sorting-column">
                                        <div class="dropdown">
                                            <button class="dropbtn" onclick="toggleDropdown(this)">
                                                Colour <span class="down-angle"><i class="fa-solid fa-angle-down"></i></span>
                                            </button>
                                            <div class="dropdown-content">
                                                <div class="dropdown-header">
                                                    <span class="selected-count">0 Selected</span>
                                                    <span class="clear-all" onclick="clearAllSelections(this)">Clear All</span>
                                                </div>
                                                @foreach ($attribute->options as $option)
                                                    <label>
                                                        <input type="checkbox" value="{{ $option->name }}" onclick="updateSelection(this)"> 
                                                        {{ $option->name }} ({{ $option->id }}) <!-- You can replace this with a count if applicable -->
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($attribute->name === 'size') 
                                    <div class="col-lg-3 col-md-6 col-sm-6 sorting-column">
                                        <div class="dropdown">
                                            <button class="dropbtn" onclick="toggleDropdown(this)">
                                                Size <span class="down-angle"><i class="fa-solid fa-angle-down"></i></span>
                                            </button>
                                            <div class="dropdown-content">
                                                <div class="dropdown-header">
                                                    <span class="selected-count">0 Selected</span>
                                                    <span class="clear-all" onclick="clearAllSelections(this)">Clear All</span>
                                                </div>
                                                @foreach ($attribute->options as $option)
                                                    <label>
                                                        <input type="checkbox" value="{{ $option->name }}" onclick="updateSelection(this)"> 
                                                        {{ $option->name }} ({{ $option->id }}) <!-- You can replace this with a count if applicable -->
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                 @endif
                            @endforeach             --}}

                    {{-- @foreach ($attributes as $attribute)
                            @if (in_array($attribute->name, ['color', 'size']))
                                <div class="col-lg-3 col-md-6 col-sm-6 sorting-column">
                                    <div class="filter-category">
                                        <label for="{{ $attribute->name }}">{{ ucfirst($attribute->name) }}</label>
                                        <select id="{{ $attribute->name }}" name="{{ $attribute->name }}[]"
                                            class="form-select" multiple
                                            onchange="document.getElementById('filter-form').submit()">
                                            @foreach ($attribute->options as $option)
                                                <option value="{{ $option->id }}"
                                                    {{ request()->input($attribute->name, []) && in_array($option->id, request($attribute->name, [])) ? 'selected' : '' }}>
                                                    {{ $option->name }} ({{ $option->id }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                        @endforeach --}}


                    <div class="col-lg-3 col-md-6 col-sm-6 sorting-column">
                        <div class="dropdown">
                            <button class="dropbtn">
                                More <span class="down-angle"><i class="fa-solid fa-plus"></i></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product-view-section">
        <div class="container">
            <div class="row">
                @if ($products->isEmpty())
                    <div class="col-12 mt-20">
                        <p class="text-center">No products available.</p>
                    </div>
                @else
                    @foreach ($products as $product)
                        <div class="col-lg-3 col-md-4 col-sm-12">
                            <div class="product-view-wrapper">
                                <a href="{{ route('product-details', ['slug' => $product->slug]) }}">
                                    <div class="product-image">
                                        <img class="img-responsive" src="{{ asset($product->featured_image) }}"
                                            alt="{{ $product->name }}">
                                    </div>
                                    <div class="product-view-title">
                                        <span>{{ $product->name }}</span>
                                    </div>
                                    <div class="product-view-price">
                                        @if ($product->discount_price)
                                            <span
                                                class="price-discounted">£{{ number_format($product->discount_price, 2) }}-</span>
                                            <span class="price-original">£{{ number_format($product->price, 2) }}</span>
                                        @else
                                            <span>£{{ number_format($product->price, 2) }}</span>
                                        @endif
                                    </div>
                                </a>
                                <div class="rating-container">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="rating-star" data-value="{{ $i }}">&#9733;</span>
                                    @endfor
                                </div>
                                <div class="heart-svg">
                                  

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
                @endif
            </div>
        </div>
    </section>

@endsection



@push('scripts')
    <script>
        function toggleDropdown(element) {
            element.nextElementSibling.classList.toggle('show');
        }

        // Clear all selections in the dropdown
        function clearAllSelections(element) {
            const checkboxes = element.closest('.dropdown-content').querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            updateURL();
        }

        // Update the URL with selected filters
        function updateURL() {
            const url = new URL(window.location.href);
            const params = new URLSearchParams();


            const sortSelect = document.getElementById('sort-select');
            if (sortSelect.value && sortSelect.value !== "Choose One") {
                params.set('sort', sortSelect.value);
            }

            // Handle the new product checkbox

            const newProductCheckbox = document.getElementById('new-in');
            if (newProductCheckbox.checked) {
                params.set('new-product', 'on');
            } else {
                params.delete('new-product');
            }

            console.log('Current query parameters:', params.toString());
            console.log('new product checkbox:', newProductCheckbox.checked);




            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                if (checkbox.checked) {
                    const name = checkbox.name;
                    const value = checkbox.value;
                    if (name) {
                        params.append(name, value);
                    }
                }
            });



            // Update the URL with the new query parameters
            url.search = params.toString();
            window.history.pushState({}, '', url);

            // Fetch and display the filtered products using AJAX
            fetchFilteredProducts(params.toString());
        }

        // Function to handle checkbox selection changes
        function updateSelection(checkbox) {

            updateURL();
        }

        // Function to fetch and display filtered products
        function fetchFilteredProducts(query) {
            console.log('Fetching products with query:', query);
            fetch(`/all-products?${query}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(data => {
                    location.reload();
                })
                .catch(error => console.error('Error fetching products:', error));
        }
    </script>
@endpush
