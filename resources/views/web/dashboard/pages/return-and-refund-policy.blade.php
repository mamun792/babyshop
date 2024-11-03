@extends('web.dashboard.app', ['page' => 'Refund-Policy'])


@section('content')
    <style>
        .bg-whi {
            background-color: white;
        }
    </style>
    {{-- @include('web.dashboard.components.cards') --}}
    <div class="container mt-5 bg-whi">

        <div class="card-header text-center mt-3">
            <h6 class="card-title">Return & Refund Policy</h6>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display error message -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="container">
            <x-policy-form :route="route('dashboard.pages.refund.policy.update')" type="return-refund-policy" :policies="$refund" />
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
