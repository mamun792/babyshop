<div>
    @extends('web.dashboard.app', ['page' => 'All Users Reviews'])

    @section('content')
        {{-- {{-- @include('web.dashboard.components.cards') --}}

        <div class="col-xxl-12 col-sm-6">
            <h4 class="mb-4 mt-3">All Users Reviews</h4>
        
            <div class="d-flex justify-content-between align-items-center mb-4">
                <select class="form-select w-auto" id="sortSelect">
                    <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest</option>
                    <option value="highest" {{ request('sort') === 'highest' ? 'selected' : '' }}>Highest Rating</option>
                    <option value="lowest" {{ request('sort') === 'lowest' ? 'selected' : '' }}>Lowest Rating</option>
                </select>
                <input type="search" class="form-control w-50" id="searchInput" placeholder="Search Reviews..." value="{{ request('search') }}">
            </div>
        
            @if ($reviews->isEmpty())
                <div class="alert alert-info mt-3">You have not written any reviews yet.</div>
            @endif
        
            <div class="row g-3 mt-3">
                @foreach ($reviews as $review)
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="row g-0">
                            <div class="col-md-2 p-3 d-flex align-items-center justify-content-center">
                                <img src="{{ asset($review->product_image) }}" alt="{{ $review->product_name }}" class="img-fluid rounded">
                            </div>
                            <div class="col-md-10">
                                <div class="card-body">
                                    <h5 class="card-title mb-1">{{ $review->product_name }}</h5>
                                    <p class="card-text text-muted mb-1">{{ $review->brand_name }}</p>
                                    <p class="card-text text-muted mb-3">Purchased on: {{ \Carbon\Carbon::parse($review->review_date)->format('M d, Y') }}</p>
                                    <div class="mb-3">
                                        <span class="badge bg-warning text-dark">
                                            {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                                        </span>
                                    </div>
                                    <p class="card-text">{{ $review->review_text }}</p>
                                    <div class="d-flex gap-2">
                                        <form action="#" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete Review</button>
                                        </form>
                                        <a href="{{ route('product-details', $review->product_slug) }}" class="btn btn-outline-success btn-sm">View Product</a>
                                       
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        
            <div class="d-flex justify-content-center mt-5">
                {{ $reviews->links('vendor.pagination.bootstrap-5') }}

            </div>
          
        </div>
        



        
    @endsection
</div>

@section('js')
    <script>
        document.getElementById('sortSelect').addEventListener('change', function() {
            const sortValue = this.value;
            const searchValue = document.getElementById('searchInput').value;
            window.location.href = `?sort=${sortValue}&search=${searchValue}`;
        });

        document.getElementById('searchInput').addEventListener('input', function() {
            const searchValue = this.value;
            const sortValue = document.getElementById('sortSelect').value;
            window.location.href = `?sort=${sortValue}&search=${searchValue}`;
        });
    </script>
@endsection


