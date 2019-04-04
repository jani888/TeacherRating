@extends('layouts.app')

@section('content')

  <div class="main-content">

    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body py-4">
        </div>
      </div>
    </div>
  </div>

<div class="container-fluid mt--8">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-0">Tanár értékelés</div>

                <div>
                  <form class="" action="/rate" method="post">
                    @csrf

                    <!--table>
                      @foreach($teachers as $teacher)
                        <tr>
                          <td><h4>{{$teacher->name}}</h4></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td></td>
                          @for($i = 0; $i<10; $i++)
                          <td class="p-1">{{$i}}</td>
                          @endfor
                        </tr>
                        @foreach($rating_types as $rating_type)
                          <tr style="border: 1px solid red">
                            <td></td>
                            <td>{{$rating_type->name}}</td>
                              @for($i = 0; $i<10; $i++)
                              <td class="p-1"><input type="radio" name="ratings[{{$teacher->id}}][{{$rating_type->id}}]" value="{{$i}}"></td>
                              @endfor
                          </tr>
                        @endforeach
                      @endforeach
                    </table-->

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
                                <td>{{$rating_type->name}}</td>
                                  @for($i = 0; $i<10; $i++)
                                  <td class="p-1 align-middle text-center">
                                    <div class="tab-pane tab-example-result fade show active" style="margin-left: 8px">
                                      <div class="custom-control custom-radio">
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
@endsection
