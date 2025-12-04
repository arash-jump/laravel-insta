<div class="card card-footer bg-white">
        <div class="row mt-1 mb-0">
            <ul class="list-unstyled d-flex justify-content-between align-items-center mb-3">
                <li>
                    <ul class="list-unstyled d-flex">
                        @if(\App\Models\Like::where('post_id', $post->id)->where('user_id', Auth::user()->id)->exists())
                        <form action="{{route('like.delete', $post->id)}}" method="post">
                            @csrf 
                            @method('DELETE')
                            <li><button class="heart-btn" type="submit"><i class="fa-solid  delete-icon fa-heart "></i></button></li>
                        </form>
                            @else
                            <li><a href="{{route('like.save', $post->id)}}" class="heart-btn"><i class="fa-solid  heart-icon fa-heart "></i></a></li>

                            @endif
                            @php
                            $all_likes = \App\Models\Like::where('post_id', $post->id)->whereHas('user', fn($q)=>$q->whereNull('deleted_at'))->with('user')->get();
                            @endphp
                            <li class="ms-1"><button type="button" class="heart-btn" data-bs-toggle="modal" data-bs-target="#like-post-{{$post->id}}">{{\App\Models\Like::where('post_id', $post->id)->whereHas('user', fn($q)=>$q->whereNull('deleted_at'))->with('user')->count()}}</button></li>
                            @include('posts.modal.like')
                            @php
                            $all_comments = \App\Models\Comment::where('post_id', $post->id)->whereHas('user', fn($q)=>$q->whereNull('deleted_at'))->with('user')->get();
                            @endphp
                            <li class="ms-1"><button class="heart-btn" data-bs-toggle="modal" data-bs-target="#show-comment-{{$post->id}}"><i class="fa-solid fa-message comment-icon"></i></a></button>
                            @include('posts.comments.modal.show')
                            <li class="ms-1">{{\App\Models\Comment::where('post_id', $post->id)->whereHas('user', fn($q)=>$q->whereNull('deleted_at'))->with('user')->count()}}</li>
                    </ul>
                </li>
                <li>
                    <ul class="list-unstyled d-flex">
                        @forelse($post->category as $category)
                            <li class="rounded ps-2 pe-2 me-1 text-white" style="background:#D3D3D3;">{{$category->category_name}}</li>
                        @empty
                            <li class="rounded ps-2 pe-2 me-1 text-white" style="background:#000000">No Category</li>
                        @endforelse
                    </ul>
                </li>
            </ul>
            <ul class="list-unstyled d-flex text-start mb-0">
                <li>
                    <p>{{$post->user->name}}<br>
                    <span class="text-secondarr" style="font-size:0.5rem;">{{$post->created_at->format('M d, Y')}}</span></p>
                </li>
                <li>
                    <p class="">{{$post->body}}</p>
                </li>
            </ul>
        </div>
</div>