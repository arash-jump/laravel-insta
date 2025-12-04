@extends('layouts.app')

@section('title', 'Update Profile')

@section('content')
    <div class="container">
        <div class="row w-75 mx-auto shadow bg-white my-3">
            <form action="{{route('account.update', $user->id)}}" method="post" enctype="multipart/form-data">
                @csrf 
                @method('POST')
                <div class="row my-5 mx-auto">
                    <div class="col-4 text-center">
                        <h1 class="h3 text-secondary">Updata Profile</h1>
                    </div>
                    <div class="col-8">
                    </div>
                    <div class="row">
                        <div class="col-4 d-flex justify-content-center">
                        @if($user->avatar)
                            <p class="text-dark text-decoration-none fw-bold d-flex align-items-center gap-2 "><img src="{{asset('/storage/images/' . $user->avatar)}}" alt="$user->avatar" class="rounded-circle img-thumbnail"></p>
                        @else
                            <p class="text-dark text-decoration-none fw-bold d-flex align-items-center gap-2 "><i class="fa-solid fa-circle-user text-secondary fa-10x"></i> </p>
                        @endif   
                        </div>
                        <div class="col-8 d-flex flex-column justify-content-center">
                            <input type="file" name="avatar" class="form-control">
                            <label for="avatar" class="text-secondary">Acceptable formats:jpeg, jpg, png, gif only <br> 
                            <span>Max file size is 1048KB</span></label>
                        </div>
                    </div>
                    <div class="row mx-auto mb-3">
                        <div class="col">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{old('name', $user->name)}}">
                            @error('name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mx-auto mb-3">
                        <div class="col">
                            <label for="email">E-mail Address</label>
                            <input type="text" name="email" class="form-control" value="{{old('email', $user->email)}}">
                            @error('email')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mx-auto mb-3">
                        <div class="col">
                            <label for="introduction">Introduction</label>
                            <textarea name="introduction" id="introduction" rows="5" class="form-control" placeholder="Describe yourself">{{old('introduction', $user->introduction)}}</textarea>
                            @error('introduction')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mx-auto">
                        <div class="col">
                            <button type="submit" class="btn btn-warning ps-5 pe-5">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection