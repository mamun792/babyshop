<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">



    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ env('APP_NAME') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
        <!-- remix icon font css  -->
        <link rel="stylesheet" href="{{ asset('css/remixicon.css') }}">
        <!-- BootStrap css -->
        <link rel="stylesheet" href="{{ asset('css/lib/bootstrap.min.css') }}">
        <!-- Apex Chart css -->
        <link rel="stylesheet" href="{{ asset('css/lib/apexcharts.css') }}">
        <!-- Data Table css -->
        <link rel="stylesheet" href="{{ asset('css/lib/dataTables.min.css') }}">
        <!-- Text Editor css -->
        <link rel="stylesheet" href="{{ asset('css/lib/editor-katex.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/lib/editor.atom-one-dark.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/lib/editor.quill.snow.css') }}">
        <!-- Date picker css -->
        <link rel="stylesheet" href="{{ asset('css/lib/flatpickr.min.css') }}">
        <!-- Calendar css -->
        <link rel="stylesheet" href="{{ asset('css/lib/full-calendar.css') }}">
        <!-- Vector Map css -->
        <link rel="stylesheet" href="{{ asset('css/lib/jquery-jvectormap-2.0.5.css') }}">
        <!-- Popup css -->
        <link rel="stylesheet" href="{{ asset('css/lib/magnific-popup.css') }}">
        <!-- Slick Slider css -->
        <link rel="stylesheet" href="{{ asset('css/lib/slick.css') }}">
        <!-- prism css -->
        <link rel="stylesheet" href="{{ asset('css/lib/prism.css') }}">
        <!-- file upload css -->
        <link rel="stylesheet" href="{{ asset('css/lib/file-upload.css') }}">

        <link rel="stylesheet" href="{{ asset('css/lib/audioplayer.css') }}">

        <!-- main css -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

        <!-- Select2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="{{ asset('assets/js/tagify/tagify.css') }}" rel="stylesheet">

        {{-- font awosome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <script src="{{ asset('assets/js/axios.js') }}"></script>
        {{-- sweet alert --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
        <style>
            .swal2-title{
                font-size: 10px important;
            }
        </style>
    </head>

    <body>

        @include('web.dashboard.components.sidebar')

        <main class="dashboard-main">
            @include('web.dashboard.components.header')

            <div class="dashboard-main-body">

                {{-- @include('web.dashboard.components.breadcrumb' , compact('page')) --}}



                <div class="row gy-4">

                    @yield('content')

                </div>

            </div>

            <footer class="d-footer">
                <div class="row align-items-center justify-content-between">
                    {{-- <div class="col-auto">
                        <p class="mb-0">© {{now()->format('Y')}} {{env('APP_NAME')}}. All Rights Reserved.</p>
                    </div> --}}
                    {{-- <div class="col-auto">
                        <p class="mb-0">Made by <span class="text-primary-600">wowtheme7</span></p>
                    </div> --}}
                </div>
            </footer>
        </main>

        <!-- jQuery library js -->
        <script src="{{ asset('js/lib/jquery-3.7.1.min.js') }}"></script>
        <!-- Bootstrap js -->
        <script src="{{ asset('js/lib/bootstrap.bundle.min.js') }}"></script>
        <!-- Apex Chart js -->
        <script src="{{ asset('js/lib/apexcharts.min.js') }}"></script>
        <!-- Data Table js -->
        <script src="{{ asset('js/lib/dataTables.min.js') }}"></script>
        <!-- Iconify Font js -->
        <script src="{{ asset('js/lib/iconify-icon.min.js') }}"></script>
        <!-- jQuery UI js -->
        <script src="{{ asset('js/lib/jquery-ui.min.js') }}"></script>
        <!-- Vector Map js -->
        <script src="{{ asset('js/lib/jquery-jvectormap-2.0.5.min.js') }}"></script>
        <script src="{{ asset('js/lib/jquery-jvectormap-world-mill-en.js') }}"></script>
        <!-- Popup js -->
        <script src="{{ asset('js/lib/magnifc-popup.min.js') }}"></script>
        <!-- Slick Slider js -->
        <script src="{{ asset('js/lib/slick.min.js') }}"></script>
        <!-- prism js -->
        <script src="{{ asset('js/lib/prism.js') }}"></script>
        <!-- file upload js -->
        <script src="{{ asset('js/lib/file-upload.js') }}"></script>
        <!-- audioplayer -->
        <script src="{{ asset('js/lib/audioplayer.js') }}"></script>

        <!-- Dashboard js -->
        <script src="{{ asset('js/homeTwoChart.js') }}"></script>
        



        {{-- <script src="{{ asset('js/homeThreeChart.js') }}"></script> --}}


        

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Tagify JS (if you plan to use it) -->
<script src="http://127.0.0.1:8000/assets/js/tagify/tagify.min.js"></script>
        <!-- Include Summernote JS -->
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>

        <script src="{{ asset('assets/js/tagify/tagify.js') }}"></script>
        <script src="{{ asset('assets/js/tagify/tagify.polyfills.min.js') }}"></script>
        <!-- SweetAlert2 CDN -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.14/jspdf.plugin.autotable.min.js"></script>

        @yield('js')
                <!-- main js -->
                <script src="{{ asset('js/app.js') }}"></script>
    </body>


</html>
