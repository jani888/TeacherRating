@extends('admin.template')


@section('header')
    <div class="mb-0 mb-lg-3"></div>
@endsection


@section('content')
    <div class="contaner-fluid mt--7">
        <div class="container">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="mb-0">Admin felhasználók</h3>
                </div>
                <div class="mb-8">
                    <table class="table">
                        <thead>
                            <th>Név</th>
                            <th>Felhasználónév</th>
                            <th></th>
                        </thead>
                        @foreach($admins as $admin)
                            <tr>
                                <td>{{$admin->name}}</td>
                                <td>{{$admin->username}}</td>
                                <td>
                                  <a class="text-primary" style="cursor: pointer" data-toggle="modal" data-target="#editModal{{$admin->id}}">Szerkesztés</a>
                                </td>
                                <td>
                                  <a class="text-danger" style="cursor: pointer" data-toggle="modal" data-target="#deleteModal{{$admin->id}}">Törlés</a>
                                </td>
                            </tr>
                            @include('admin.editModal', ['admin'=>$admin])
                            @include('admin.deleteModal', ['admin'=>$admin])
                        @endforeach
                    </table>
                    <button data-toggle="modal" data-target="#addModal" class="m-3 btn btn-primary float-right">Új hozzáadása</button>
                </div>
            </div>
        </div>
    </div>

    @include('admin.addModal')

@endsection
