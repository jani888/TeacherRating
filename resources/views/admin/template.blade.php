<!--  Admin template  -->

@extends('layouts.app')


@section('container')

    <!-- Side navbar -->
    @include('admin.sidenav')

    <div class="main-content">

        <!-- Header -->
        <div class="header bg-gradient-warning pb-8 pt-5 pt-md-8">

            <div class="container-fluid">
                <div class="header-body">
                    @yield('header')
                </div>
            </div>
        </div>

        <!-- Main content -->
    @yield('content')

    <!-- Footer -->
    @include('layouts.footer')
    </div>

@endsection

@push('custom-scripts')

@stack('scripts')

@endpush
