<div class="card card-header bg-white py-3">
        <div class="row align-items-center">
            <div class="col-auto" >
                <a href="{{route('account.show', $post->user_id)}}">
                    @if ($post->user->avatar)
                        <img src="{{asset('/storage/images/' . $post->user->avatar)}}" alt="{{$post->user->avatar}}" class="rounded-circle avatar-sm">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                    @endif
                </a>
            </div>
        <div class="col ps-0">
                <a href="{{route('account.show', $post->user_id)}}" class="text-decoration-none text-dark">{{$post->user->name}}</a>
        </div>
        <div class="col-auto">
            <div class="dropdown">
                <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>
                    @if(Auth::user()->id === $post->user->id)
                    <div class="dropdown-menu">
                    <a href="{{route('post.edit', $post->id)}}" class="dropdown-item">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </a>
                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-post-{{$post->id}}">
                        <i class="fa-regular fa-trash-can"> Delete</i>
                    </button>
                    </div>
                    <!--Include Modal here-->
                    @include('posts.modal.delete')
                    @else
                    <div class="dropdown-menu">
                        <form action="{{route('account.unfollow', $post->user->id)}}" method="post">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="dropdown-item text-danger">Unfollow</button>
                        </form>
                    </div>
                    @endif
            </div>
        </div>
    </div>
</div>