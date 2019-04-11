@extends('admin.template')


@section('header')
    <div class="mb-0 mb-lg-3"></div>
@endsection


@section('content')
    <div class="contaner-fluid mt--7">
        <div class="container">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="mb-0">Admin beállításai</h3>
                </div>
                <div class="mb-8 p-3 card-content">
                    <form role="form" action="{{ $admin->updateUrl }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                </div>
                                <input class="form-control" placeholder="Név" type="text" name="name" value="{{ $admin->name }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                </div>
                                <input class="form-control" placeholder="Felhasználónév" type="text" name="username" value="{{ $admin->username }}" required autofocus>
                            </div>
                        </div>

                        <button class="btn btn-primary float-right" type="submit">Mentés</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
