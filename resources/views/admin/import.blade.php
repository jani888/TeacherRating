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
                <div>
                    @if(session()->has('status') && session('status') == 'success')
                        <div class="m-3">
                            <div class="alert alert-success text-center" role="alert">
                                <p class="mb-0">Sikeres feltöltés!</p>
                            </div>
                        </div>
                    @endif
                    @if(session()->has('errors'))
                        <div class="m-3">
                            <div class="alert alert-danger text-center" role="alert">
                                <p class="mb-0">Sikertelen feltöltés!</p>
                            </div>
                        </div>
                    @endif
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
                                    <label class="custom-file-label" for="validatedCustomFile">Válasszon egy fájlt...</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-12">
                                <p>Tanárok</p>
                                <!-- Divider -->
                                <hr class="my-3">
                                <div class="custom-file mb-3">
                                    <input type="file" name="teachers" class="custom-file-input" id="validatedCustomFile" required>
                                    <label class="custom-file-label" for="validatedCustomFile">Válasszon egy fájlt...</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-12">
                                <p>Csoportok</p>
                                <!-- Divider -->
                                <hr class="my-3">
                                <div class="custom-file mb-3">
                                    <input type="file" name="groups" class="custom-file-input" id="validatedCustomFile" required>
                                    <label class="custom-file-label" for="validatedCustomFile">Válasszon egy fájlt...</label>
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


@section('scripts')
    <script>
        $("input[type=file]").change(function () {
            var fieldVal = $(this).val();

            // Change the node's value by removing the fake path (Chrome)
            fieldVal = fieldVal.replace("C:\\fakepath\\", "");

            if (fieldVal != undefined || fieldVal != "") {
                $(this).next(".custom-file-label").attr('data-content', fieldVal);
                $(this).next(".custom-file-label").text(fieldVal);
            } else {
                $(this).next(".custom-file-label").text("Válasszon egy filet...");
            }
        });
    </script>
@endsection
