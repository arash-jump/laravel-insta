@extends('layouts.app')

@section('titel', 'Account')

@section('content')
    <div class="container">
        <div class="row mx-auto">
            <div class="col-4">
            <p>
                @if($user->avatar)
                    <img src="{{asset('/storage/images/' . $user->avatar)}}" alt="{{$user->avatar}}" class="rounded-circle img-thumbnail">
                @else
                    <i class="fa-solid fa-circle-user text-secondary fa-10x"></i>
                @endif
            </p>
            </div>
            <div class="col-8">
                <div class="row mb-3">
                    <div class="col-auto">
                        <h1 class="mb-0">{{$user->name}}</h1>
                    </div>
                    @if(Auth::user()->id === $user->id)
                    <div class="col d-flex align-items-center">
                        <a href="{{route('account.edit', $user->id)}}"class="btn btn-outline-secondary btn-sm">Edit Profile</a>
                    </div>
                    @else
                    @if(\App\Models\Follow::where('user_id', $user->id)->where('follower_id', Auth::user()->id)->exists())
                    <div class="col d-flex align-items-center">
                        <form action="{{route('account.unfollow', $user->id)}}" method="post">
                        @csrf 
                        @method('DELETE')
                            <button type="submit" class="btn btn-primary btn-sm">Following</button>
                        </form>
                    </div>
                    @else
                    <div class="col d-flex align-items-center">
                        <a href="{{route('account.follow', $user->id)}}" class="btn btn-outline-primary btn-sm">Follow</a>
                    </div>
                    @endif
                    @endif
                </div>
                <div class="row">
                    <div class="col-auto">
                        <p class="fw-bold">{{$user->post->count()}}<span> posts</span></p>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="heart-btn text-decoration-none text-dark fw-bold" data-bs-toggle="modal" data-bs-target="#show-follower">{{$all_followers->count()}}<span> follower</span></button>
                        @include('users.accounts.modal.follower')
                    </div>
                    <div class="col">
                    <button type="button" class="heart-btn text-decoration-none text-dark fw-bold" data-bs-toggle="modal" data-bs-target="#show-following">{{$all_followings->count()}}<span> following</span></button>
                        @include('users.accounts.modal.following')
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto">
                        <h3 class="h6 fw-bold" style="line-height:1.8;">{!! nl2br(e($user->introduction))!!}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
                @forelse($user->post as $post)
                <div class="col-4">
                <a href="{{route('post.show', $post->id)}}">
                    <img src="{{asset('/storage/images/' . $post->image)}}" alt="$post->image" class="w-100 h-100">
                </a>
                </div>
                @empty
                <div class="w-100 text-center mx-auto">
                    @if(Auth::user()->id === $user->id)
                    <a href="{{route('post.create')}}" class="h3 text-decoration-none text-secondary">No Posts Yet</a>
                    @else
                    <h1 class="h3 text-decoration-none text-secondary">No Posts Yet</h1>
                    @endif
                </div>
                @endforelse
        </div>
    </div>
@endsection