<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ env('APP_NAME') }}</title>
        <!-- Vendor css -->
        <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
        <!-- endinject -->

        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">

        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

        <link rel="shortcut icon" href="assets/images/favicon.png" />


        <link rel="stylesheet" href="{{ asset('assets/js/jquery.dataTables.min.css') }}">

        <link rel="stylesheet" href="{{ asset('assets/js/dataTables.responsive.min.js') }}">


        <link href="{{ asset('assets/css/bootstrap-icons.css') }}" rel="stylesheet">

        <link href="{{ asset('assets/css/select2.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/js/tagify/tagify.css') }}" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        @yield('css')

        <style>
            /* change border radius for the tab , apply corners on top*/

            #exTab3 .nav-pills>li>a {
                border-radius: 4px 4px 0 0;
            }

            #exTab3 .tab-content {
                color: white;
                background-color: #428bca;
                padding: 5px 15px;
            }
        </style>
    </head>

    <body>
        <div class="container-scroller">

            <!-- partial:partials/_navbar.html -->
            @include('web.dashboard.components.navbar')
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_sidebar.html -->

                @include('web.dashboard.components.sidebar')
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="page-header">
                            <h3 class="page-title">
                                <span class="page-title-icon bg-gradient-primary text-white me-2">
                                    <i class="mdi mdi-home"></i>
                                </span> Dashboard
                            </h3>
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <span></span>Overview <i
                                            class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        @yield('content')



                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->


                    @include('web.dashboard.components.footer')
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>



        {{-- Vendor JS --}}

        <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
        {{-- <script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script> --}}
        <script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
        {{-- Plugin JS --}}

        <script src="{{ asset('assets/js/dashboard.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/js/datatable.js') }}"></script>

        <script src="{{ asset('assets/js/axios.js') }}"></script>

        {{-- Core JS --}}
        {{-- <script src="{{ asset('assets/js/off-canvas.js') }}"></script> --}}
        <script src="{{ asset('assets/js/misc.js') }}"></script>
        {{-- <script src="{{ asset('assets/js/settings.js') }}"></script> --}}
        {{-- <script src="{{ asset('assets/js/todolist.js') }}"></script> --}}
        {{-- <script src="{{ asset('assets/js/jquery.cookie.js') }}"></script> --}}
        <script src="{{ asset('assets/js/jquery-3.7.1.js') }}"></script>
        <script src="{{ asset('assets/js/tagify/tagify.js') }}"></script>
        <script src="{{ asset('assets/js/tagify/tagify.polyfills.min.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        

        <script>
            new DataTable('#example');
        </script>


        @yield('script')
        <script src="{{ asset('assets/js/select2.js') }}"></script>
        <script>
            $('.selectTag').select2({
                placeholder: 'Select an option'
            });
        </script>




    </body>

</html>
