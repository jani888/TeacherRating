

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
              <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->name }} ({{Auth::user()->schoolClass()->first()->name}})</span>
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
