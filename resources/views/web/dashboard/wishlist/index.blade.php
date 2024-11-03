<div>
    @extends('web.dashboard.app', ['page' => 'Wishlist'])

    @section('content')
        <div class="card h-100 p-0 radius-12 overflow-hidden">
            <div class="card-header border-bottom-0 pb-0 pt-0 px-0">
                <ul class="nav border-gradient-tab nav-pills mb-0 border-top-0" id="pills-tab" role="tablist">

                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-ui-design-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-ui-design" type="button" role="tab" aria-controls="pills-ui-design"
                            aria-selected="true">
                            Wishlist
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-web-design-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-web-design" type="button" role="tab"
                            aria-controls="pills-web-design" aria-selected="false" tabindex="-1">
                            Current Cart
                        </button>
                    </li>

                </ul>
            </div>
            <div class="card-body p-24">
                <div class="tab-content" id="pills-tabContent">


                    <div class="tab-pane fade active show" id="pills-ui-design" role="tabpanel"
                    aria-labelledby="pills-ui-design-tab" tabindex="0">
                   <div class="row gy-4">
                       @if ($wishlistsProducts->isEmpty())
                           <div class="col-12">
                               <div class="alert text-center" role="alert">
                                   Your wishlist is currently empty.
                               </div>
                           </div>
                       @else
                           @foreach ($wishlistsProducts as $product)
                               <div class="col-xl-6">
                                   <div class="card radius-12 overflow-hidden h-100 d-flex align-items-center flex-nowrap flex-row">
                                       <div class="d-flex flex-shrink-0 w-170-px h-100">
                                           <img src="{{ asset($product->featured_image) }}"
                                                class="h-100 w-100 object-fit-cover" alt="{{ $product->name }}">
                                       </div>
                                       <div class="card-body p-16 flex-grow-1">
                                           <h5 class="card-title text-lg text-primary-light mb-6">{{ $product->name }}</h5>
                                           <p class="card-text text-neutral-600 mb-16">
                                               {{ $product->short_description }}</p>
                                           <a href="{{ route('product-details', ['slug' => $product->slug]) }}"
                                              class="btn text-primary-600 hover-text-primary p-0 d-inline-flex align-items-center gap-2">
                                               Read More <iconify-icon icon="iconamoon:arrow-right-2"
                                                                      class="text-xl"></iconify-icon>
                                           </a>
                                           {{-- <button class="btn btn-danger btn-sm mt-2" onclick="deleteFromWishlist({{ $product->id }}, this)">Delete</button> --}}
                                           <button class="btn btn-danger btn-sm mt-2" onclick="deleteFromWishlist({{ $product->id }}, this)">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                        
                                       </div>
                                   </div>
                               </div>
                           @endforeach
                       @endif
                   </div>
               </div>
               

               <div class="tab-pane fade" id="pills-web-design" role="tabpanel" aria-labelledby="pills-web-design-tab" tabindex="0">
                <div class="card">
                    <div class="card-body w-50 mx-auto">
                        <div class="table-responsive">
                            <table class="table bordered-table mb-0 dataTable" id="dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Items</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Available Qty.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($composerCartList['items'] as $item)
                                    @if (is_array($item))
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset($item['featured_image'] ?? '') }}" alt=""
                                                         class="img-thumbnail" style="max-width: 60px; height: auto;">
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="text-md mb-0 fw-normal">{{ $item['name'] ?? 'N/A' }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>${{ number_format($item['price'] ?? 0, 2) }}</td>
                                            <td>
                                                <span class="bg-success-focus text-success-main px-3 py-1 rounded-pill fw-medium text-sm">
                                                    {{ $item['quantity'] ?? 0 }}
                                                </span>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="3" class="text-center">Invalid item format in cart.</td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No items found in the cart.</td>
                                    </tr>
                                @endforelse
                                
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            






                </div>
            </div>
        </div>


    @endsection
</div>

@section('js')
    <script>
      async function deleteFromWishlist(productId, buttonElement) {
    try {
        const response = await $.ajax({
            url: `/wishlist/remove/${productId}`, 
            method: 'DELETE', 
            data: {
                _token: '{{ csrf_token() }}' 
            },
        });

        // Handle the response
        if (response.success) {
           
            await Swal.fire({
                title: 'Removed!',
                text: response.message,
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            });
           
            $(buttonElement).closest('.col-xl-6').remove(); 
        } else {
           
            await Swal.fire({
                title: 'Oops!',
                text: response.message,
                icon: 'info',
                timer: 1500,
                showConfirmButton: false
            });
        }
    } catch (error) {
        console.error('Error removing from wishlist:', error);
        const errorMessage = error.responseJSON?.message || 'Something went wrong! Please try again later.';
        await Swal.fire({
            title: 'Error!',
            text: errorMessage,
            icon: 'error',
            timer: 1500,
            showConfirmButton: false
        });
    }
}

    </script>
@endsection
