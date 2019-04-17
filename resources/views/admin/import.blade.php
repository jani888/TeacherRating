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
                    <p>Az adatokat a program excell táblázat formájában kéri. A szükséges táblák a tanulók tábla a tantárgyfelosztás tábla és a tanulók csoportbeosztása tábla, melyek kiexportálhatók a Neptun-KRÉTA enaplóból. A három adatállományt egyszer kell feltölteni. A feltöltés ideje alatt ne végezzen más műveletet a weboldalon. A feltöltés végén a weboldal kiírja a sikeres feltöltés tényét. A feltöltés törli az előző adatállományt!</p>
                </div>
                <div class="p-4">
                    <form id="uploadForm" action="{{ route('admin.import') }}" method="POST" enctype="multipart/form-data">
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
                            <button class="btn btn-success" style="cursor: pointer" data-toggle="modal" data-target="#alertModal">
                                Feltöltés
                                <i class="text-big ni ni-cloud-upload-96"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('admin.importAlertModal')

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
          }else{
              $(this).next(".custom-file-label").text("Válasszon egy filet...");
          }
      });
  </script>
@endsection
