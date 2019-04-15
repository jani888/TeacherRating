@extends('admin.template')

@section('header')
    <div class="mb-0 mb-lg-3"></div>
@endsection

@section('content')
    <div class="contaner-fluid mt--7">
        <div class="container">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="mb-0">Adatok feltöltése</h3>
                </div>
                <div class="p-3">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
                <div class="p-4">
                    <form class="" action="{{ route('admin.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-4 col-md-12">
                                <p>Diákok</p>
                                <!-- Divider -->
                                <hr class="my-3">
                                <div class="custom-file mb-3">
                                    <input type="file" name="students" class="custom-file-input" id="validatedCustomFile" required>
                                    <label class="custom-file-label" for="validatedCustomFile">Válasszon egy filet...</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-12">
                                <p>Tanárok</p>
                                <!-- Divider -->
                                <hr class="my-3">
                                <div class="custom-file mb-3">
                                    <input type="file" name="teachers" class="custom-file-input" id="validatedCustomFile" required>
                                    <label class="custom-file-label" for="validatedCustomFile">Válasszon egy filet...</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-12">
                                <p>Csoportok</p>
                                <!-- Divider -->
                                <hr class="my-3">
                                <div class="custom-file mb-3">
                                    <input type="file" name="groups" class="custom-file-input" id="validatedCustomFile" required>
                                    <label class="custom-file-label" for="validatedCustomFile">Válasszon egy filet...</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center justify-content-md-end">
                            <button class="btn btn-success" type="submit" name="button">
                                Feltöltés
                                <i class="text-big ni ni-cloud-upload-96"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
