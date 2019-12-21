<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
   Kasir
  </title>
  <!-- Favicon -->
  <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
 @include('dashboard.include.css')
</head>

<body class="">
@include('dashboard.include.sidebar')
  <div class="main-content">
    <!-- Navbar -->
 @include('dashboard.include.navbar')
    <!-- End Navbar -->
    <!-- Header -->
@include('dashboard.include.header')
    <div class="container-fluid mt--7">
    @yield('content')
      <!-- Footer -->
      @include('dashboard.include.footer')
    </div>
  </div>
 @include('dashboard.include.script')
 @yield('script')
</body>

</html>
