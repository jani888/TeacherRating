@extends('admin.template')


@section('header')
    <div class="mb-0 mb-lg-3"></div>
@endsection

@section('content')
    <div class="contaner-fluid mt--7">
        <div class="container">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="mb-0">Osztályok</h3>
                </div>
                <div class="mb-8">
                    @if (session()->has('status') && session('status') == "success")
                        <div class="col-xs-12 m-3">
                            <div class="alert alert-success" role="alert">
                                <strong>Elmentve!</strong> Az osztályok mentése megtörtént!
                            </div>
                        </div>
                    @endif

                    <div class="m-3">
                      <a href="rating_types/on" class="btn btn-success"> Összes bekapcsolása</a>
                      <a href="rating_types/off" class="btn btn-warning"> Összes kikapcsolása</a>
                    </div>
                    <form action="{{route('admin.classes')}}" method="post">
                        @csrf
                        @method('PUT')
                        <table class="table">
                            <thead>
                                <th>Osztály</th>
                                <th>Szavazhat</th>
                            </thead>
                            <tbody>
                                @foreach($classes as $school_class)
                                    <tr>
                                        <td>{{$school_class->name}}</td>
                                        <td>
                                            <label class="custom-toggle">
                                                <input class="custom-control-input" id="can_vote_{{$school_class->id}}" type="checkbox" name="can_vote[{{$school_class->id}}]" @if($school_class->can_vote) checked @endif>
                                                <span class="custom-toggle-slider rounded-circle"></span>
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="col-xs-12 pr-5 text-right">
                        <button class="btn btn-primary" type="submit">Mentés</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
