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
                                <td><a class="btn btn-sm btn-link" href="{{$admin->editUrl}}"><i class="fa fa-pencil"></i> Szerkesztés</a></td>
                                <td><form action="{{$admin->deleteUrl}}" method="post"> @csrf @method('delete') <button class="btn btn-link btn-sm"><i class="fa fa-pencil"></i> Törlés</button></form></td>
                            </tr>
                        @endforeach
                    </table>
                    <a href="{{route('admin.admins.create')}}" class="m-3 btn btn-primary float-right">Új hozzáadása</a>
                </div>
            </div>
        </div>
    </div>
@endsection
