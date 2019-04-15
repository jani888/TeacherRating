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
                                <td><a class="btn btn-sm text-primary" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i> Szerkesztés</a></td>
                                <td>
                                  <form action="{{$admin->deleteUrl}}" method="post">
                                    @csrf @method('delete')
                                    <a href='#' class="text-danger" onclick='this.parentNode.submit(); return false;'>Törlés</a>
                                  </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <button data-toggle="modal" data-target="#addModal" class="m-3 btn btn-primary float-right">Új hozzáadása</button>
                </div>
            </div>
        </div>
    </div>

<!-- Edit Admin Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Admin Felhasználó Szerkesztése</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form role="form" action="{{ $admin->updateUrl }}" method="post">
          @csrf
          @method('put')
          <div class="modal-body">
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
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
      </form>
    </div>
  </div>
</div>


<!-- Add New Admin Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Új Admin Hozzáadása</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="{{route('admin.admins.store')}}" method="post">
          @csrf
        <div class="modal-body">
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Mentés</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
