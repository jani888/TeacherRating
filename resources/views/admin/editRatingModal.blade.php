
<!-- Edit Rating Modal -->
<div class="modal fade" id="editModal{{$rating_type->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Értékelési szempont módosítása</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form role="form" action="{{ $rating_type->updateUrl }}" method="post">
        @csrf
        @method('put')
        <div class="modal-body">
          <div class="form-group mb-3">
              <label>Rövid név:</label>
              <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                  </div>
                  <input class="form-control" placeholder="Rövid név" type="text" name="name" value="{{ $rating_type->name }}" required autofocus>
              </div>
          </div>
          <div class="form-group mb-3">
              <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                  </div>
                  <input class="form-control" placeholder="Felhasználónév" type="text" name="username" value="{{ $rating_type->description }}" required autofocus>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Bezárás</button>
          <button type="submit" class="btn btn-primary">Mentés</button>
        </div>
    </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Bezárás</button>
      <button type="button" class="btn btn-primary">Save changes</button>
    </div>
  </div>
</div>
</div>
