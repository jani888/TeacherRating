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
                            <th></th>
                        </thead>
                        @foreach($rating_types as $rating_type)
                            <tr>
                                <td>{{$rating_type->name}}</td>
                                <td>{{$rating_type->description}}</td>
                                <td><a class="text-primary" style="cursor:pointer" data-toggle="modal" data-target="#editModal{{$rating_type->id}}">Szerkesztés</a></td>
                                <td><a class="text-danger" style="cursor:pointer" data-toggle="modal" data-target="#deleteModal{{$rating_type->id}}">Törlés</a></td>
                            </tr>
                            @include('admin.editRatingModal', ['rating_type'=>$rating_type])
                            @include('admin.deleteRatingModal', ['rating_type'=>$rating_type])
                        @endforeach
                    </table>
                    <hr class="m-0">
                    <a class="btn btn-primary text-white float-right m-3" data-toggle="modal" data-target="#addModal">Új hozzáadása</a>
                </div>
            </div>
        </div>
    </div>

    @include('admin.addRatingModal')

@endsection
