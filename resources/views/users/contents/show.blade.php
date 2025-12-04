<div class="modal fade" id="show-comment-{{$post->id}}">
    <div class="modal-dialog">
        <div class="modal-content border-primary">
            <div class="modal-header border-primary">
                <h3 class="h5 modal-title text-primary">
                    <i class="fa-solid fa-message">Comment</i>
                </h3>
            </div>
            <div class="modal-body">
            @php
                $all_comments = \App\Models\Comment::where('post_id', $post->id)->get();
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
            @endforelse
            <form action="{{route('comment.save', $post->id)}}" method="post">
                    @csrf 
                    <div class="input-group mt-1">
                        <textarea name="body" id="body" rows="1" class="form-control"></textarea>
                    <button class="group-item btn btn-secondary" type="submit">Post</button>
                    </div>
            </form>
            </div>
        </div>
    </div>
</div>