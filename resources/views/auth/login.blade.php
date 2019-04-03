@extends('layouts.app')


@section('content')
  <!-- Header -->
  <div class="header bg-gradient-primary py-7 py-lg-8">
    <div class="mb-7"></div>
    <!--div class="container">
      <div class="header-body text-center mb-7">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-6">
            <h1 class="text-white">Welcome!</h1>
            <p class="text-lead text-light">Use these awesome forms to login or create new account in your project for free.</p>
          </div>
        </div>
      </div>
    </div-->
    <div class="separator separator-bottom separator-skew zindex-100">
      <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
        <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
      </svg>
    </div>
  </div>

  <div class="container mt--8 pb-5">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary shadow border-0">
          <div class="card-body px-lg-5 py-lg-5">
            <div class="text-center text-muted mb-4">
              <small>Jelentkezzen be a nevével, és az oktatási azonosítójával</small>
            </div>
            <form role="form" action="{{ route('login') }}" method="post">
              @csrf
              <div class="form-group mb-3">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                  </div>
                  <input class="form-control" placeholder="Név" type="text" name="name" value="{{ old('name') }}" required autofocus>

                  @if ($errors->has('name'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif

                </div>
              </div>
              <div class="form-group">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                  </div>
                  <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Oktatási azonosító" type="password">

                  @if ($errors->has('password'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif

                </div>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary my-4">Bejelentkezés</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
    <!--div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bejelentkezés') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="born_at" class="col-md-4 col-form-label text-md-right">{{ __('Születési dátum') }}</label>

                            <div class="col-md-6">
                                <input id="born_at" type="text" class="p-2 form-control" name="born_at" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('born_at'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('born_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('OM azonosító') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div-->
</div>

@endsection
