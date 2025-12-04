<div class="modal fade" id="edit-category-{{$category->id}}">
    <div class="modal-dialog">
        <div class="modal-content border-warning">
            <div class="modal-header border-warning">
                <h3 class="h5 modal-title border-warning text-warning">
                    <i class="fa-solid fa-pen"></i> Edti Category
                </h3>
            </div>
            <div class="modal-body border-0">
                <form action="{{route('admin.edit', $category->id)}}" method="post">
                    @csrf 
                    @method('PATCH')
                    <input type="text" value="{{old('category_name', $category->category_name)}}" name="category_name" class="form-control">
            </div>
            <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-warning btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning btn-sm">Change</button>
                </form>
            </div>
        </div>
    </div>
</div>