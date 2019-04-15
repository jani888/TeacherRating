
<!-- Add Rating Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Értékelési szempont hozzáadása</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form role="form" action="{{ route('admin.rating_types') }}" class="p-3" method="post">
      @csrf
      <div class="modal-body">

            <div class="form-group mb-3">
                <div class="input-group input-group-alternative">
                    <input class="form-control" placeholder="Új szempont neve" type="text" name="name" required autofocus>
                </div>
            </div>
            <div class="form-group mb-3">
                <div class="input-group input-group-alternative">
                    <textarea class="form-control" placeholder="Új szempont leírása" name="description" required autofocus></textarea>
                </div>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Bezárás</button>
        <button type="submit" class="btn btn-primary">Létrehozás</button>
      </div>
    </form>
  </div>
</div>
</div>
