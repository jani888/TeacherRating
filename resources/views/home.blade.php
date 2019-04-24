@extends('layouts.app')


@section('container')

    <!-- Top navbar -->
    @include('layouts.navbar')


    <div class="bg main-content">

        <!-- Header for the top background -->
        <div class="bg-gradient-success py-7 py-lg-8 fixed-top" style="z-index: 0">
            <div class="mb-7"></div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-secondary" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>

        <div class="container-fluid mt-8">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        @if(auth()->user()->hasVoted())
                            <div class="m-3 m-md-8">
                                <div class="alert alert-success text-center" role="alert">
                                    <p class="mb-0">Köszönjük, hogy szavazott!</p>
                                </div>
                                <div class="text-center">
                                  <a class="btn btn-primary" href="{{ route('logout') }}"
                                     onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                      <i class="ni ni-user-run"></i>
                                      {{ __('Kijelentkezés') }}
                                  </a>
                                </div>
                            </div>
                        @elseif(!auth()->user()->canVote())
                            <div class="m-3 m-md-8">
                                <div class="alert alert-danger text-center" role="alert">
                                    <p class="mb-0">A szavazás számodra le van tiltva!</p>
                                </div>
                            </div>
                        @else
                            <div class="text-uppercase card-header border-0">Tanár értékelés</div>
                            <div class="m-3 ml-3 ml-sm-6 ml-xl-8">
                                <p class="text-primary">
                                    {{$rating_info}}
                                </p>
                                @foreach($rating_types as $rating_type)
                                    <p>
                                        <span class="font-weight-bold">{{$rating_type->name}}:</span> {{$rating_type->description}}
                                    </p>
                                @endforeach

                            </div>
                            <div>

                                <form class="" action="/rate" method="post">
                                    @csrf

                                    @foreach($teachers as $teacher)

                                        <h3 class="p-2">{{$teacher->name}}</h3>
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-4">

                                                <thead class="thead-light">
                                                    <th class="d-none d-md-table-cell"></th>
                                                    @for($i = 0; $i<10; $i++)
                                                        <th class="p-1 align-middle text-center d-none d-md-table-cell">
                                                            <p class="m-0">{{$i}}</p>
                                                        </th>
                                                    @endfor
                                                </thead>

                                                @foreach($rating_types as $rating_type)
                                                    <tr>
                                                        <td class="text-wrap">
                                                            <p class="mb-0">{{$rating_type->name}}</p>
                                                        </td>

                                                        @for($i = 0; $i<10; $i++)
                                                            <td class="p-1 align-middle text-center  d-none d-md-table-cell">
                                                                <div class="tab-pane tab-example-result fade show active">
                                                                    <div class="custom-control custom-radio m-0">
                                                                        <input type="radio" class="custom-control-input" id="input_{{$i . $teacher->id . $rating_type->id}}" name="ratings[{{$teacher->id}}][{{$rating_type->id}}]" value="{{$i}}">
                                                                        <label class="custom-control-label" for="input_{{$i . $teacher->id . $rating_type->id}}"></label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        @endfor

                                                        <td class="d-table-cell d-md-none">
                                                          <select name="ratings[{{$teacher->id}}][{{$rating_type->id}}]">
                                                            @for ($i=0; $i < 10; $i++)
                                                              <option value="{{$i}}">{{$i}}</option>
                                                            @endfor
                                                          </select>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>

                                    @endforeach
                                    <p class="text-center text-danger">Elküldés előtt győződjön meg róla, hogy mindent megfelelően töltött ki, ugyanis az utólagos módosításra nincsen lehetőség!</p>
                                    <div class="d-flex justify-content-center justify-content-md-end">
                                        <button type="submit" class="btn btn-success m-3" name="button">
                                            Küldés
                                            <i class="ni ni-send"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    @include('layouts.footer')

    <style>
      .custom-radio .custom-control-label::before{
        border: 1px solid #a0a0a0;
      }
    </style>

@endsection
