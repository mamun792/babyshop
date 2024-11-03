<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  {{-- <title>@yield('title')</title>  --}}
  <title>{{ env('APP_NAME') }}</title>

  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ asset('assets/fontend/css/all.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fontend/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fontend/css/swiper-bundle.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fontend/css/common-style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fontend/css/homepage.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 



  
  <!-- Additional styles pushed from specific views -->
  @stack('styles')
</head>

<body>
    <!-- Header Section -->
    @include('partials.header')

    <!-- Main Content Section -->
    <main>
        @yield('content')
    </main>

    <!-- Footer Section -->
    @include('partials.footer')

    <!-- JavaScript Files -->
    <script src="{{ asset('assets/fontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/fontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/fontend/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/fontend/js/script.js') }}"></script>
    <script src="{{ asset('assets/fontend/js/home-script.js') }}"></script>
    <script src="{{ asset('assets/fontend/js/product-details.js') }}"></script>
 
   
  
 
    
   

    <!-- Additional scripts pushed from specific views -->
    @stack('scripts')
    <!-- external js -->
    <script src="{{ asset('assets/fontend/js/cart.js') }}"></script>
    <script>
     const allProductsUrl = "{{ route('all.products') }}"; 
   </script>
   <script src="{{asset('assets/fontend/js/search.js')}}"></script>
</body>

</html>
