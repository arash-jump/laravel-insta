<div class="modal fade" id="deactive-{{$user->id}}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title border-danger text-danger">
                <i class="fa-solid fa-user-slash"></i> Deactivate User
                </h3>
            </div>
            <div class="modal-body d-flex align-items-center border-0">
                <p>Are you sure you want to deactivate <stress class="extra-bold h5">{{$user->name}}</stress>?</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                <form action="{{route('admin.inactive', $user->id)}}" method="post">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Deactivate</button>
                </form>
            </div>
        </div>
    </div>
</div>