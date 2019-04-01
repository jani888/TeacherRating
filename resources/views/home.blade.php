@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tanár értékelés</div>

                <div class="card-body">
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

                        <h4>{{$teacher->name}}</h4>

                        <table class="table table-hover mb-4">

                          <thead class="thead-light">
                            <th></th>
                            @for($i = 0; $i<10; $i++)
                              <th class="p-1 align-middle"><p class="m-0">{{$i}}</p></th>
                            @endfor
                          </thead>

                          @foreach($rating_types as $rating_type)
                            <tr>
                              <td>{{$rating_type->name}}</td>
                                @for($i = 0; $i<10; $i++)
                                <td class="p-1 align-middle"><input type="radio" name="ratings[{{$teacher->id}}][{{$rating_type->id}}]" value="{{$i}}"></td>
                                @endfor
                            </tr>
                          @endforeach
                        </table>

                      @endforeach
                      <input type="submit" name="" value="Küldés">
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
