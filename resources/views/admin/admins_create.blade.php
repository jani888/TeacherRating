@extends('admin.template')


@section('header')
    <div class="mb-0 mb-lg-3"></div>
@endsection


@section('content')
    <div class="contaner-fluid mt--7">
        <div class="container">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="mb-0">Admin hozzáadása</h3>
                </div>
                <div class="mb-8 p-3 card-content">
                    <form role="form" action="{{route('admin.admins.store')}}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                </div>
                                <input class="form-control" placeholder="Név" type="text" name="name" required autofocus>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                </div>
                                <input class="form-control" placeholder="Felhasználónév" type="text" name="username" required autofocus>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                </div>
                                <input class="form-control" placeholder="Jelszó" type="password" name="password" required autofocus>
                            </div>
                        </div>

                        <button class="btn btn-primary float-right" type="submit">Mentés</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
