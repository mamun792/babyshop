@extends('web.dashboard.app', ['page' => 'My Reviews'])

@section('content')
{{-- // return view('web.dashboard.reviews.index', compact('reviews')); --}}

<div class="container mt-4">
   
    <div class="d-flex align-items-center mb-4 p-3 border-bottom">
        <h4 class="mb-0 text-primary">My Reviews</h4>
    </div>


    <div class="card p-4">
      
        <div class="d-flex justify-content-between align-items-center mb-4">
            <select class="form-select w-auto" id="sortSelect">
                <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest</option>
                <option value="highest" {{ request('sort') === 'highest' ? 'selected' : '' }}>Highest Rating</option>
                <option value="lowest" {{ request('sort') === 'lowest' ? 'selected' : '' }}>Lowest Rating</option>
            </select>
            <input type="search" class="form-control w-50" id="searchInput" placeholder="Search Reviews..." value="{{ request('search') }}">
        </div>

      
        @if ($reviews->isEmpty())
            <div class="alert  mt-4 text-center">
                <div class="d-flex flex-column align-items-center">
                   
                    <h5 class="mb-2">No Reviews Yet!</h5>
                    <p class="mb-3">It looks like you haven’t written any reviews yet. Share your thoughts with others!</p>
                  
                </div>
            </div>
        @endif

        <!-- Reviews List -->
        <div class="row g-4 mt-3">
            @foreach ($reviews as $review)
                <div class="col-md-12">
                    <div class="card shadow-sm border-light rounded-3">
                        <div class="row g-0">
                            <div class="col-md-3 p-3 d-flex align-items-center justify-content-center">
                                <img src="{{ asset($review->product->featured_image) }}" alt="{{ $review->product->name }}" class="img-fluid " style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title mb-1">{{ $review->product->name }}</h5>
                                    <p class="card-text text-muted mb-1">{{ $review->product->brand->company }}</p>
                                    <p class="card-text text-muted mb-3">Purchased on: {{ \Carbon\Carbon::parse($review->review_date)->format('M d, Y') }}</p>
                                    <div class="mb-3">
                                        <span class="badge bg-warning text-dark">
                                            {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                                        </span>
                                    </div>
                                    <p class="card-text">{{ $review->review_text }}</p>
                                    <div class="d-flex gap-2">
                                        {{-- <form action="#" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete Review</button>
                                        </form> --}}
                                        <a href="{{ route('product-details', $review->product_id) }}" class="btn btn-outline-success btn-sm">View Product</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

      
        <div class="mt-4">
            {{ $reviews->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>



@endsection


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



