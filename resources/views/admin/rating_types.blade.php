@extends('admin.template')


@section('header')
    <div class="mb-0 mb-lg-3"></div>
@endsection


@section('content')
    <div class="contaner-fluid mt--7">
        <div class="container">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="mb-0">Értékelési típusok</h3>
                </div>
                <div class="mb-8">
                    <table class="table">
                        <thead>
                            <th>Név</th>
                            <th>Leírás</th>
                            <th></th>
                        </thead>
                        @foreach($rating_types as $rating_type)
                            <tr>
                                <td>{{$rating_type->name}}</td>
                                <td>{{$rating_type->description}}</td>
                                <td>
                                    <form action="{{$rating_type->deleteUrl}}" method="post"> @csrf @method('delete')
                                        <button class="btn btn-link btn-sm"><i class="fa fa-pencil"></i> Törlés</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <hr>
                    <h3 class="pl-3">Új létrehozása</h3>
                    <form role="form" action="{{ route('admin.rating_types') }}" class="p-3" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <input class="form-control" placeholder="Új szempont neve" type="text" name="name" required autofocus>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <textarea class="form-control" placeholder="Új szempont leírása" name="description" required autofocus></textarea>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Létrehozás</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
