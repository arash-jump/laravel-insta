@extends('layouts.app')

@section('title', 'Post Detail')

@section('content')
        <div class="row mx-auto shadow">
            <!--Post Picture-->
            <div class="col-8 p-0">
                <img src="{{asset('/storage/images/' . $post->image)}}" alt="$post->image" class="image-lg w-100">
            </div>
            <!--Post Info-->
            <div class="col-4 bg-white">
            <!--Header-->
            <div class="row align-items-center border-bottom" style="height:20%;">
                    <div class="col-auto">
                            <a href="{{route('account.show', $post->user->id)}}">
                                @if($post->user->avatar)
                                    <img src="{{asset('/storage/images/' . $post->user->avatar)}}" alt="{{$post->user->name}}" class="rounded-circle avatar-sm">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                @endif
                            </a>
                        </div>
                    <div class="col ps-0">
                            <a href="#" class="text-decoration-none text-dark">{{$post->user->name}}</a>
                    </div>
                    <div class="col-auto ">
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
                                    <form action="" method="post">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">Unfollow</button>
                                    </form>
                                </div>
                                @endif
                        </div>
                    </div>
                </div>
                <!--Body Up-->
                <div class="row mt-3 mb-0 w-100 mx-auto">
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
                            <li class="ms-1"><button type="button" class="heart-btn" data-bs-toggle="modal" data-bs-target="#like-post-{{$post->id}}">{{\App\Models\Like::where('post_id', $post->id)->count()}}</button></li>
                            @include('posts.modal.like')
                            </ul>
                        </li>
                        <li>
                            <ul class="list-unstyled d-flex">
                            @forelse($post->category as $category)
                                <li class="rounded ps-2 pe-2 me-1 text-white" style="background:#D3D3D3;">{{$category->category_name}}</li>
                            @empty
                                <li class="rounded ps-2 pe-2 me-1 text-white" style="background:#000000;">No Category</li>
                            @endforelse
                            </ul>
                        </li>
                    </ul>
                    <ul class="list-unstyled d-flex text-start mb-0">
                        <li>
                            <p class="fw-bold">{{$post->user->name}} <span class="fw-light">{{$post->body}}</span><br>
                            <span class="text-secondarr" style="font-size:0.5rem;">{{$post->created_at->format('M d, Y')}}</span></p>
                        </li>
                    </ul>
                </div>
                <!--Body Middle-->
                <div class="row w-100 mx-auto" >
                    <form action="{{route('comment.save', $post->id)}}" method="post" class="mb-3">
                        @csrf 
                        <div class="input-group mt-1">
                            <textarea name="body" id="body" rows="1" class="form-control" placeholder="Add a comment..."></textarea>
                            <button class="group-item btn btn-outline-primary" type="submit"><i class="fa-solid fa-paper-plane"></i></button>
                        </div>
                    </form>
                    <div class="container overflow-auto hy-auto" style="height:160px;">
                    
                    @forelse($all_comments as $comment)
                    <div class="row mt-1">
                        <div class="col-auto">
                            <p>{{$comment->user->name}}<br>
                            <span class="text-secondary" style="font-size:0.5rem;">{{$comment->created_at->format('M d, Y')}}
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
                    </div>
                   
                </div>
            </div>
        </div>
@endsection