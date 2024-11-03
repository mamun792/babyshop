<div>
    @extends('web.dashboard.app')

    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}

        <div class="container my-5">
            <h2>Edit Review</h2>
            <div class="card">
                <div class="card-body">

                    <div class="mt-4">
                        <div class="container my-5">
                            <div class="row justify-content-center">
                                <!-- Image Column -->
                                <div class="col-lg-6 mb-4">

                                    <img src="your-image-url.jpg" class="card-img-top" alt="Product Image">

                                </div>
                                <!-- Content Column -->
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Mukti Electric House</h5>
                                            <p class="card-subtitle mb-2 text-muted">Purchased on 12 Sep 2023</p>
                                            <p class="card-text">
                                                <strong>Product:</strong> At voluptua ut magna est dolor invidunt dolor
                                                ipsum. Amet vero sit sit eirmod stet invidunt, est sanctus dolor
                                                voluptua.<br>
                                                <strong>Color Family:</strong> White
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="#" method="post">
                        <h3 class="mt-4">Add Review</h3>
                        <div class="form-group">
                            {{-- add review  --}}
                            <label for="review">Add Review:</label>
                            <textarea class="form-control" id="review" rows="3"></textarea>
                        </div>
                        {{-- photo upload --}}
                        <div class="form-group">
                            <label for="photo">Upload Photo:</label>
                            <input type="file" class="form-control-file" id="photo">
                        </div>
                        <div class="form-group">
                            <label>Rate the Product:</label>
                            <div class="d-flex">
                                <input type="radio" id="rating5" name="rating" value="5"
                                    class="form-check-input d-none">
                                <label class="form-check-label" for="rating5">
                                    <span class="fa fa-star" style="color: orange;"></span>
                                </label>
                                <input type="radio" id="rating4" name="rating" value="4"
                                    class="form-check-input d-none">
                                <label class="form-check-label" for="rating4">
                                    <span class="fa fa-star" style="color: orange;"></span>
                                </label>
                                <input type="radio" id="rating3" name="rating" value="3"
                                    class="form-check-input d-none">
                                <label class="form-check-label" for="rating3">
                                    <span class="fa fa-star" style="color: orange;"></span>
                                </label>
                                <input type="radio" id="rating2" name="rating" value="2"
                                    class="form-check-input d-none">
                                <label class="form-check-label" for="rating2">
                                    <span class="fa fa-star" style="color: grey;"></span>
                                </label>
                                <input type="radio" id="rating1" name="rating" value="1"
                                    class="form-check-input d-none">
                                <label class="form-check-label" for="rating1">
                                    <span class="fa fa-star" style="color: grey;"></span>
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Review</button>
                    </form>
                    {{--  --}}
                </div>
            </div>
        </div>
    @endsection
</div>
