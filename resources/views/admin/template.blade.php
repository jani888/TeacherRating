<!--  Admin template  -->

@extends('layouts.app')


@section('container')

  <!-- Side navbar -->
  @include('admin.sidenav')

  <div class="main-content">

    @yield('content')

    <!-- Footer -->
    @include('layouts.footer')
  </div>

@endsection
