<div class="modal fade" id="hide-post-{{$post->id}}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title border-danger text-danger">
                    <i class="fa-solid fa-eye-slash"></i> Hide Post
                </h3>
            </div>
            <div class="modal-body border-0">
                <p>Are you sure you want to hide this post?</p>
                <img src="{{asset('/storage/images/' . $post->image)}}" alt="{{$post->image}}" class="square">
                <p class="text-secondary">{{$post->body}}</p>
            </div>
             <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                <form action="{{route('admin.hidden', $post->id)}}" method="post">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hide</button>
                </form>
            </div>
        </div>
    </div>
</div>