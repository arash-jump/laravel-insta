<div class="modal fade" id="show-comment-{{$post->id}}">
    <div class="modal-dialog">
        <div class="modal-content border-primary">
            <div class="modal-header border-primary">
                <ul class="list-unstyled d-flex justify-content-between align-items-center w-100">
                    <li>
                        <h3 class="h5 modal-title text-primary">
                            <i class="fa-solid fa-message"></i> Comment
                        </h3>
                    </li>
                    <li>
                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
            @php
            $all_comments = \App\Models\Comment::where('post_id', $post->id)->whereHas('user', fn($q)=>$q->whereNull('deleted_at'))->with('user')->get();
            @endphp
            @forelse($all_comments as $comment)
            <div class="row">
                <div class="col-auto">
                    <p>{{$comment->user->name}}<br>
                    <span class="text-secondarr" style="font-size:0.5rem;">{{$comment->created_at->format('M d, Y')}}
                    </span></p>
                </div>
                <div class="col ps-0">
                       {{$comment->body}} <br>
                       @if($post->user_id === Auth::user()->id || $comment->user_id === Auth::user()->id)
                        <a href="{{route('comment.destroy', $comment->id)}}" class="text-danger text-decoration-none" style="font-size:0.5rem;"> Delete</a>
                       @endif
                </div>
            </div>
            @empty
            <p>No Comments</p>
            @endforelse
            <form action="{{route('comment.save', $post->id)}}" method="post">
                    @csrf 
                    <div class="input-group mt-1">
                        <textarea name="body" id="body" rows="1" class="form-control"></textarea>
                    <button class="group-item btn btn-primary" type="submit"><i class="fa-solid fa-paper-plane"></i></button>
                    </div>
            </form>
            </div>
        </div>
    </div>
</div>