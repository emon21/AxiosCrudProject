<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Page Title' }}</title>
    <!-- Bootstrap CSS Link -->
    <link href="{{ asset('admin/assets/bootstrap') }}/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Css Link -->
    <link href="{{ asset('admin/assets/css') }}/custom.css" rel="stylesheet">

    <!-- Toastr CSS -->
    <link href="{{ asset('admin/assets/') }}/toastr/toastr.min.css" rel="stylesheet">

</head>

<body>

    <!-- Page Content -->
    <!-- Loader -->
    {{-- <div id="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div> --}}

    <div id="loader">
        {{-- <img src="https://media.tenor.com/t5DMW5PI8mgAAAAj/loading-green-loading.gif" alt="Loading..." width="100"> --}}
        <img src="https://preview.kamleshyadav.com/pixacms//public/storage/site_images/kAtbvnnvClejA07AlaOxee0lPS0ZYWkXPARxX6FE.gif"
            alt="loader" />
        {{-- <img src="https://cdn.dribbble.com/userupload/22380501/file/original-e5657c47ad45deb699631ed9d41240f4.gif"
            alt="Loading..." width="300"> --}}
    </div>

    <!-- Navbar Start -->
    @include('layouts.navbar')
    <!-- Navbar End -->

    <div class="d-flex justify-content-between align-items-start" id="content">

        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- Sidebar End -->
        @yield('content')
    </div>
    <!-- Page Content End -->

    <!-- Js link -->

    <script src="{{ asset('admin/assets/js') }}/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5.3 JS (Bundle) -->
    <script src="{{ asset('admin/assets/bootstrap') }}/bootstrap.bundle.min.js"></script>
    <!--  Axios  link -->
    <script src="{{ asset('admin/assets/js') }}/axios.min.js"></script>
    <!-- jQuery (toastr এর জন্য লাগবে) -->
    <!-- Toastr JS -->
    <script src="{{ asset('admin/assets') }}/toastr/toastr.min.js"></script>

    <script src="{{ asset('admin/assets/js') }}/sweetalert.min.js"></script>
    <!-- Custom JS Link -->
    <script src="{{ asset('admin/assets') }}/js/custom.js"></script>
    @stack('scripts')
    <script>
        addEventListener("DOMContentLoaded", function() {
            // এখানে JS code লিখবেন যা DOM ready হলে চালাবে

            //  Loader show হবে, তারপর 1 সেকেন্ড পর content দেখাবে
            showLoader();
            setTimeout(function() {
                hideLoader();
            }, 2000);
        });

        // toastr.success("Category added successfully!");
    </script>
</body>

</html>
