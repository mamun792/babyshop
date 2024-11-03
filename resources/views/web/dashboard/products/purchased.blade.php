<div>
    @extends('web.dashboard.app', ['page' => 'Product Purchased'])
    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}

        {{-- product pursed list --}}



        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Product Purchased List</h4>
                <p class="card-description"> Add class <code>.table-striped</code></p>

                <!-- Make the table responsive -->
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Brand</th>
                                <th>Coupon</th>
                                <th>Discount</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>name</td>
                                <td>111</td>
                                <td>200</td>
                                <td>11</td>
                                <td>{{ substr('Magna ipsum clita est at dolor clita gubergren ea gubergren. Vero nonumy lorem voluptua erat. At ipsum sanctus eirmod sanctus.', 0, 25) }}
                                </td>
                                <td>sub1</td>
                                <td>b1</td>
                                <td>c1</td>
                                <td>10</td>
                                <td>
                                    <img src="path/to/image.jpg" class="img-fluid" alt="Product Image">
                                </td>
                                {{-- <td>
                                        <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                    </td> --}}
                                <td>
                                    <!-- Dropdown Button -->
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                            <li><a class="dropdown-item text-danger" href="#">Delete</a></li>
                                        </ul>
                                    </div>
                                </td>

                            </tr>
                            <!-- Repeat <tr> for each product -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
    @section('js')
        <script>
            $(document).ready(function() {
                // Initialize DataTable
                $('#dataTable').DataTable();
            });
        </script>
    @endsection

</div>
