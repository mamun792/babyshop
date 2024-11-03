<div>
    @extends('web.dashboard.app')
    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}


        <div class="col-md-9 mx-auto grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Product</h4>
                    <p class="card-description"> Add class <code>.table-striped</code>
                    </p>

                    <form class="w-50 mx-auto" action="#" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="text" class="form-control mb-4" name="name" value="p_nmae">
                        <input type="text" class="form-control mb-4" name="product_code" value="p_code">
                        <textarea class="form-control mb-4" name="description" required>descprition</textarea>
                        <input type="number" step="0.01" class="form-control mb-4" name="price" value="200">
                        <input type="number" class="form-control mb-4" name="quantity" value="10">
                        <select name="category_id" class="form-select mb-4">

                            <option value="">p-1</option>
                        </select>
                        <select name="sub_category_id" class="form-select mb-4">
                            <option value="">c-1</option>
                        </select>
                        <select name="brand_id" class="form-select mb-4">
                            <option value="1">Brand 1</option>
                            <option value="2">Brand 2</option>
                            <option value="3">Brand 3</option>
                        </select>
                        <select name="coupon_id" class="form-select mb-4">
                            <option value="1">Coupon 1</option>
                            <option value="2">Coupon 2</option>
                        </select>
                        <input type="number" step="0.01" class="form-control mb-4" name="discount" value="10">
                        <input type="file" class="form-control mb-4" name="image" value="img">
                        <input type="submit" class="btn btn-sm btn-primary" value="Update">
                    </form>

                </div>
            </div>
        </div>
    @endsection

</div>
