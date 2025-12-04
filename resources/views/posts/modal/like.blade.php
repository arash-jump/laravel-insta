<div class="modal fade" id="like-post-{{$post->id}}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">
                    <i class="fa-solid  heart fa-heart "></i> Like
                </h3>
            </div>
            <div class="modal-body scroll-area d-flex flex-column gap-2">
                @forelse($all_likes as $like)
                @if($like->user->avatar)
                    <a href="{{route('account.show', $like->user_id)}}" class="text-dark text-decoration-none fw-bold d-flex align-items-center gap-2"><img src="{{asset('/storage/images/' . $like->user->avatar)}}" alt="{{$like->user->name}}" class="rounded-circle avatar-sm"> {{$like->user->name}}</a>
                @else
                    <a href="{{route('account.show', $like->user_id)}}" class="text-dark text-decoration-none fw-bold d-flex align-items-center gap-2"><i class="fa-solid fa-circle-user text-secondary icon-sm"></i> {{$like->user->name}}</a>
                @endif
                @empty
                <p class="mt-3">No like</p>
                @endforelse
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Back</button>
            </div>
        </div>
    </div>
</div>