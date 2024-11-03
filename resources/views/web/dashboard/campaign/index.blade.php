@extends('web.dashboard.app')
@section('content')
    {{-- @include('web.dashboard.components.cards') --}}

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Create Product Code</h3>
                    </div>
                    <div class="card-body">
                        <form id="campaignForm">
                            <div class="form-group">
                                <label for="campaignName">Campaign Name</label>
                                <input type="text" class="form-control" id="campaignName" required>
                            </div>
                            <div class="form-group">
                                <label for="startDate">Start Date</label>
                                <input type="date" class="form-control" id="startDate" required>
                            </div>
                            <div class="form-group">
                                <label for="expiryDate">Expiry Date</label>
                                <input type="date" class="form-control" id="expiryDate" required>
                            </div>
                            <div class="form-group">
                                <label for="flatDiscount">Flat Discount</label>
                                <input type="number" class="form-control" id="flatDiscount"
                                    placeholder="Enter flat discount" required>
                            </div>
                            <div class="form-group">
                                <label for="percentageDiscount">Percentage Discount</label>
                                <input type="number" class="form-control" id="percentageDiscount"
                                    placeholder="Enter percentage discount" required>
                            </div>
                            <button type="button" class="btn btn-primary" id="generateCodeBtn">Generate Code</button>
                        </form>
                        <div class="mt-3">
                            <label for="generatedCode">Generated Code</label>
                            <input type="text" class="form-control" id="generatedCode" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        @if (session()->has('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session()->has('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>
@endsection
