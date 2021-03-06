<!-- Sidenav -->
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="/admin/dashboard">
            <h2 class="mb-0">{{ config('app.name', 'Laravel') }}</h2>
        </a>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a class="navbar-brand pt-0" href="/admin/dashboard">
                            <h2 class="mb-0">{{ config('app.name', 'Laravel') }}</h2>
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.dashboard')}}">
                        <i class="ni ni-planet text-orange"></i> Főoldal
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.results') }}">
                        <i class="ni ni-chart-bar-32 text-info"></i> Értékelési eredmények
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.admins') }}">
                        <i class="ni ni-single-02 text-yellow"></i> Admin felhasználók
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.rating_types')}}">
                        <i class="ni ni-ui-04 text-red"></i> Értékelési szempontok
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.classes') }}">
                        <i class="ni ni-bullet-list-67 text-blue"></i> Osztályok
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.groups') }}">
                        <i class="ni ni-compass-04 text-yellow"></i> Csoportok
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.import') }}">
                        <i class="ni ni-cloud-upload-96 text-success"></i> Adatok importálása
                    </a>
                </li>
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">{{ Auth::user()->name }}</h6>
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="ni ni-user-run"></i>
                            {{ __('Kijelentkezés') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
