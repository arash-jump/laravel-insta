<div class="modal fade" id="delete-category-{{$category->id}}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title border-danger text-danger">
                    <i class="fa-solid fa-trash-can"></i> Delete Category
                </h3>
            </div>
            <div class="modal-body border-0">
               <p>Are you sure want to delete <span class="h4 fw-bold">{{$category->category_name}}</span> ?</p>
            </div>
            <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{route('admin.delete', $category->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </form>
            </div>
        </div>
    </div>
</div>