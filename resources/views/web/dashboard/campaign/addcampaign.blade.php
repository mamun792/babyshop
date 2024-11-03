<div>
    @extends('web.dashboard.app', ['page' => 'campaigns'])
    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}

        <div class="row gy-4">

            <div class="col-xxl-6 mx-auto">
                <div class="card mb-24">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Add Product to This Campaign</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gy-3">
                            <form method="POST" action="{{ route('dashboard.campaign.product.store') }}">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="product" class="form-label">Select Product</label>
                                        <select class="form-control" id="product" name="product_id">
                                            <option value="">Select a product</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('product_id'))
                                            <div class="text-danger">{{ $errors->first('product_id') }}</div>
                                        @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="campaign" class="form-label">Select Campaign</label>
                                    <select class="form-control" id="campaign" name="campaign_id">
                                        <option value="">Select a campaign</option>
                                        @foreach ($campaigns as $campaign)
                                            <option value="{{ $campaign->id }}">{{ $campaign->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('campaign_id'))
                                        <div class="text-danger">{{ $errors->first('campaign_id') }}</div>
                                    @enderror
                            </div>
                        </div>

                        <div class="row mb-3">

                            @if ($errors->has('end_date'))
                                <div class="text-danger">{{ $errors->first('end_date') }}</div>
                            @enderror
                    </div>
                    <div class="col-md-12 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Attach</button>
                    </div>
            </div>
            </form>

        </div>
    </div>
</div>

<div class="card basic-data-table">
    <div class="card-header">
        <h5 class="card-title mb-0">Current Campaigns</h5>
    </div>
    <div class="card-body">
        <table id="campaign-products-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Campaign Name</th>

                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example static row -->

                @foreach ($productCampaigns as $pc)
                    <tr>
                        <td>{{ $pc->id }}</td>
                        <td>{{ $pc->product_name }}</td>
                        <td>{{ $pc->campaign_name }}</td>




                        <td>
                            <div class="btn-group" role="group" aria-label="Actions">
                                <a href="{{ route('dashboard.campaign.edit.product.campaign', $pc->id) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                
                                <button class="btn btn-danger btn-sm"
                                    onclick="confirmDelete({{ $pc->id }})">
                                    <i class="fas fa-trash"></i> Delete
                                </button>

                                <form id="delete-form-{{ $pc->id }}" action="{{ route('dashboard.campaign.product.code.delete', $pc->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                   
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
</div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#campaign-products-table').DataTable();
    });

    function confirmDelete(id) {
        console.log(id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to undo this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
@endsection
