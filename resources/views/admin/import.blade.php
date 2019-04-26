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
                  <div class="m-3" style="display: none" id="success">
                      <div class="alert alert-success text-center" role="alert">
                          <p class="mb-0">Sikeres feltöltés!</p>
                      </div>
                  </div>
                  <div class="m-3" style="display: none" id="error">
                      <div class="alert alert-danger text-center" role="alert">
                          <p class="mb-0">Sikertelen feltöltés!</p>
                      </div>
                  </div>
                </div>
                <div class="p-3">
                    <p>Az adatokat a program excell táblázat formájában kéri. A szükséges táblák a tanulók tábla a tantárgyfelosztás tábla és a tanulók csoportbeosztása tábla, melyek kiexportálhatók a Neptun-KRÉTA enaplóból. A három adatállományt egyszer kell feltölteni. A feltöltés ideje alatt ne végezzen más műveletet a weboldalon. A feltöltés végén a weboldal kiírja a sikeres feltöltés tényét. A feltöltés törli az előző adatállományt!</p>
                </div>
                <div class="p-4">
                    <form id="uploadForm" action="{{ route('admin.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-4 col-md-12">
                                <p>Diákok (tanulok.xlsx)</p>
                                <!-- Divider -->
                                <hr class="my-3">
                                <div class="custom-file mb-3">
                                    <input type="file" name="students" class="custom-file-input" id="validatedCustomFile">
                                    <label class="custom-file-label" for="validatedCustomFile">Válasszon egy fájlt...</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-12">
                                <p>Tanárok (tantargyfelosztas.xlsx)</p>
                                <!-- Divider -->
                                <hr class="my-3">
                                <div class="custom-file mb-3">
                                    <input type="file" name="teachers" class="custom-file-input" id="validatedCustomFile">
                                    <label class="custom-file-label" for="validatedCustomFile">Válasszon egy fájlt...</label>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-12">
                                <p>Csoportok (tanulo_besorolas_adatok.xlsx)</p>
                                <!-- Divider -->
                                <hr class="my-3">
                                <div class="custom-file mb-3">
                                    <input type="file" name="groups" class="custom-file-input" id="validatedCustomFile">
                                    <label class="custom-file-label" for="validatedCustomFile">Válasszon egy fájlt...</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center justify-content-md-end">
                            <button type="button" class="btn btn-success" style="cursor: pointer" data-toggle="modal" data-target="#alertModal">
                                Feltöltés
                                <i class="text-big ni ni-cloud-upload-96"></i>
                            </button>
                        </div>
                        @include('admin.importAlertModal')
                    </form>
                </div>
            </div>
        </div>
    </div>

      <!-- Modal -->
      <div class="modal fade" id="waitModal" tabindex="-1">
        <div class="modal-dialog modal-success modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Feltöltés folyamatban</h5>
            </div>
            <div class="modal-body text-center m-3">
              <p>Az adatok feltöltése folyamatban van, kérjük ne zárja be az oldalt, amíg a folyamat be nem fejeződött!</p>
              <div class="m-3">
                <i class="fas fa-circle-notch fa-4x fa-spin"></i>
              </div>
              <p class="text-small">Ez akár 5-10 percet is eltarthat</p>
            </div>
          </div>
        </div>
      </div>


@endsection


@push('custom-scripts')
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

        $(document).ready(function (e) {
           $("#uploadForm").on('submit',(function(e) {
              e.preventDefault();
              console.log(e);
              $.ajax({
                url: "{{ route('admin.import') }}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend : function(){
                  $("#alertModal").fadeOut();
                  $("#waitModal").modal({backdrop: 'static', keyboard: false});
                },
                success: function(data){
                  $("#success").fadeIn();
                  setTimeout(() => {
                    $("#waitModal").modal("hide");
                  }, 500);
                  $("#uploadForm")[0].reset();
                },
                error: function(e){
                  $("#error").fadeIn();
                  setTimeout(() => {
                    $("#waitModal").modal("hide");
                  }, 500);
                }
              });
           }));
        });
    </script>
@endpush
