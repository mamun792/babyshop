@extends('web.dashboard.app', ['page' => 'Shipping-Delivery'])


@section('content')
    <style>
        .bg-whi {
            background-color: white;
        }
    </style>
    {{-- @include('web.dashboard.components.cards') --}}
    <div class="container mt-5 bg-whi">
     
        <div class="card-header text-center mt-3">
            <h6 class="card-title">Shipping & Delivery</h6>
        </div>

        <!-- Display error message -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        



        <div class="container">
            <x-policy-form :route="route('dashboard.pages.shipping.delivery.update')" type="shipping-delivery" :policies="$shipping" />
        </div>

    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#summernoteMetaDescription').summernote({
                height: 300, // Set editor height
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endsection


@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/summernote/summernote.min.css') }}">
@endsection
