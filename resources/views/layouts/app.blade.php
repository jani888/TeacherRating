<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Icons -->
    <link href="/assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Argon CSS -->
    <link type="text/css" href="/assets/css/argon.css?v=1.0.0" rel="stylesheet">

</head>
<body>
      <main class="bg-default main-content">

        <!-- Top navbar -->
        <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
          <div class="container px-4">
            <!-- Brand -->
            <a class="h4 mb-0 text-white text-uppercase d-lg-inline-block" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
            <!-- User -->
            <ul class="navbar-nav align-items-center d-lg-inline-block">
              @auth
              <li class="nav-item dropdown">
                <a class="text-white pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="media align-items-center">
                    <div class="media-body ml-2 ">
                      <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->name }}</span>
                    </div>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      <i class="ni ni-user-run"></i>
                      {{ __('Kijelentkezés') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </div>
              </li>
              @endauth
            </ul>
          </div>
        </nav>


        @yield('content')

        <!-- Footer -->
        <footer class="footer mt-4">
          <div class="container">
            <div class="row align-items-center justify-content-xl-center">
              <div class="col-xl-6">
                <div class="copyright text-center text-xl-left text-muted">
                  &copy; 2018 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
                </div>
              </div>
              <div class="col-xl-6">
                <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                  <li class="nav-item">
                    <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
                  </li>
                  <li class="nav-item">
                    <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
                  </li>
                  <li class="nav-item">
                    <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
                  </li>
                  <li class="nav-item">
                    <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
    </main>


    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Argon JS -->
    <script src="../assets/js/argon.js?v=1.0.0"></script>
</body>
</html>
