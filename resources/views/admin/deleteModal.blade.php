<!-- Delete Admin User Modal -->

  <div class="modal fade" id="deleteModal{{$admin->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-danger">

                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Felhasználó törlése!</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="py-3 text-center">
                        <i class="ni ni-bell-55 ni-3x"></i>
                        <h4 class="heading mt-4">Admin felhasználó törlése!</h4>
                        <p>Biztosan törölni kívánja a(z): <strong class="text-underline">{{$admin->name}}</strong> nevű felhasználót, ez a módosítás nem vonható vissza.</p>
                    </div>

                </div>

                <div class="modal-footer">
                    <form action="{{$admin->deleteUrl}}" method="post">
                      @csrf @method('delete')
                      <button type="submit" class="btn btn-white">Törlés Mindenképpen</button>
                    </form>
                    <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Bezárás</button>
                </div>

            </div>
        </div>
    </div>
</div>
