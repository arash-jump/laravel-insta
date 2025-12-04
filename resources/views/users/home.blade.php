@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row gx-5">
        <div class="col-8">
                @forelse($all_posts as $post)
                 <div class="card my-3">
                    @include('users.contents.title')
                    <a href="{{route('post.show', $post->id)}}">
                        <img src="{{asset('/storage/images/' . $post->image)}}" alt="{{$post->image}}" class="w-100 rounded-0">
                    </a>
                    @include('users.contents.footer')
                    
                 </div>
                @empty
                <h2>Share Photos</h2>
                <p class="text-secondary">When you share photos, they'll appear on your profile.</p>
                <a href="#" class="text-decoration-none">Share your first photo</a>
                @endforelse
        </div>
        <div class="col-4">
            <div class="my-3 border rounded bg-white box-shadow d-flex align-items-center" style="height:100px;">
                <div class="row g-0">
                <div class="col-auto">
                    <a href="{{route('account.show', Auth::user()->id)}}" class="ms-3">
                        @if (Auth::user()->avatar)
                            <img src="{{asset('/storage/images/' . Auth::user()->avatar)}}" alt="{{Auth::user()->name}}" class="rounded-circle avatar-md">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary icon-m"></i>
                        @endif
                    </a>
                </div>
                    <div class="col ps-0">
                            <p class="ms-2 mb-0 fw-bold">
                            {{Auth::user()->name}}<br>
                            <span class="text-secondary">{{Auth::user()->email}}</span>
                            </p>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-9">
                        <p class="text-secondary">Suggestions For You</p>
                    </div>
                    <div class="col-3">
                        <p class="fw-bold">See all</p>
                    </div>
                </div>
                @forelse($suggetions as $suggetion)
                <div class="row mb-3">
                    <div class="col-9 d-flex align-items-center">
                    @if ($suggetion->avatar)
                    <a href="{{route('account.show', $suggetion->id)}}" class="text-decoration-none text-dark fw-bold d-flex align-items-center gap-2 mb-0"><img src="{{asset('/storage/images/' . $suggetion->avatar)}}" alt="{{$suggetion->name}}" class="rounded-circle avatar-sm"> {{$suggetion->name}}</a>
                    @else
                    <a href="{{route('account.show', $suggetion->id)}}" class="text-decoration-none text-dark fw-bold d-flex align-items-center gap-2 mb-0"><i class="fa-solid fa-circle-user text-secondary icon-sm"></i> {{$suggetion->name}}</a>
                    @endif
                    </div>
                    <div class="col-3 d-flex align-items-center">
                        <a href="{{route('account.follow', $suggetion->id)}}" class="text-primary text-decoration-none">Follow</a>
                    </div>
                </div>
                @empty
                <p>No suggetions</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
