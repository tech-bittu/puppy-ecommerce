<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('page-title','Admin') - PuppyUniverse</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset( 'admin-theme/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset( 'admin-theme/assets/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="{{ asset( 'admin-theme/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset( 'admin-theme/assets/css/custom.style.css') }}">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{ asset( 'admin-theme/assets/images/favicon.ico') }}" />

  @yield('style')
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    @include('admin.layouts.header')

    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        @yield('content-wrapper')
      </div>
      <!-- content-wrapper ends -->
      <!-- partial:../../partials/_footer.html -->
      @include('admin.layouts.footer')
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <!-- plugins:js -->
   <!-- Custom js for this page -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" defer async></script>
  <script src="{{asset('admin-theme/assets/js/jquery.cookie.js') }}" defer async></script>
  <script src="{{ asset( 'admin-theme/assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset( 'admin-theme/assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset( 'admin-theme/assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset( 'admin-theme/assets/js/misc.js') }}"></script>
  <!-- endinject -->
 <script>
  $.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  })
 </script>
  @yield('scripts')
  <!-- End custom js for this page -->
</body>

</html>