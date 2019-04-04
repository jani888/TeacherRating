@extends('layouts.app')

@section('content')

<div class="bg main-content">

  <!-- Header for the top background -->
  <div class="header bg-gradient-primary py-7 py-lg-8">
    <div class="mb-7"></div>
    <div class="separator separator-bottom separator-skew zindex-100">
      <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
        <polygon class="fill-secondary" points="2560 0 2560 100 0 100"></polygon>
      </svg>
    </div>
  </div>

  <div class="container-fluid mt--8">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="text-uppercase card-header border-0">Tanár értékelés</div>

                  <div>
                    <form class="" action="/rate" method="post">
                      @csrf

                        @foreach($teachers as $teacher)

                          <h3 class="p-2">{{$teacher->name}}</h3>
                          <div class="table-responsive">
                            <table class="table table-hover mb-4">

                              <thead class="thead-light">
                                <th></th>
                                @for($i = 0; $i<10; $i++)
                                  <th class="p-1 align-middle text-center"><p class="m-0">{{$i}}</p></th>
                                @endfor
                              </thead>

                              @foreach($rating_types as $rating_type)
                                <tr>
                                  <td class="text-wrap">
                                    <p class="mb-0">{{$rating_type->name}}</p>
                                  </td>

                                  @for($i = 0; $i<10; $i++)
                                    <td class="p-1 align-middle text-center">
                                      <div class="tab-pane tab-example-result fade show active">
                                        <div class="custom-control custom-radio m-0">
                                          <input type="radio" class="custom-control-input" id="input_{{$i . $teacher->id . $rating_type->id}}" name="ratings[{{$teacher->id}}][{{$rating_type->id}}]" value="{{$i}}">
                                          <label class="custom-control-label" for="input_{{$i . $teacher->id . $rating_type->id}}"></label>
                                        </div>
                                      </div>
                                    </td>
                                  @endfor

                                </tr>
                              @endforeach
                            </table>
                          </div>

                        @endforeach
                        <p class="text-center text-warning">Elküldés előtt győződjön meg róla, hogy mindent megfelelően töltött ki, ugyanis az utólagos módosításra nincsen lehetőség!</p>
                        <div class="d-flex justify-content-center justify-content-md-end">
                            <input type="submit" class="btn btn-success m-3" name="" value="Küldés">
                        </div>
                    </form>
                  </div>
              </div>
          </div>
      </div>
  </div>

</div>
@endsection
