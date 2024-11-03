@extends('web.dashboard.app', ['page' => 'campaigns'])


@section('content')
    {{-- @include('web.dashboard.components.cards') --}}
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header ">
                        Edit Campaign Product
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('dashboard.campaign.product.code.update', $productCampaign->id) }}">
                            
                                @csrf
                                @method('PATCH')
                                <div class="row mb-3">
                                    <!-- Product Selection -->
                                    <div class="col-md-6">
                                        <label for="product" class="form-label">Select Product</label>
                                        <select class="form-control" id="product" name="product_id">
                                           
                                            @foreach ($availableProducts as $product)
                                                <option value="{{ $product->id }}"
                                                    {{ optional($productCampaign)->product_id == $product->id ? 'selected' : '' }}>
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('product_id'))
                                            <div class="text-danger">{{ $errors->first('product_id') }}</div>
                                        @endif
                                    </div>
                            
                                    <!-- Campaign Selection -->
                                    <div class="col-md-6">
                                       <label for="campaign" class="form-label ">Select Campaign</label>
                                        <select class="form-control" id="campaign" name="campaign_id">
                                            <option value="">Select a campaign</option>
                                            @foreach ($allCampaigns as $campaignOption)
                                                <option value="{{ $campaignOption->id }}"
                                                    {{ optional($productCampaign)->campaign_id == $campaignOption->id ? 'selected' : '' }}>
                                                    {{ $campaignOption->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('campaign_id'))
                                            <div class="text-danger">{{ $errors->first('campaign_id') }}</div>
                                        @endif
                                    </div>
                                </div>

                            {{-- submit button --}}
                            <div class="row mb-3">
                                <div class="col-md-12 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">Update</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script></script>
@endsection
</div>
