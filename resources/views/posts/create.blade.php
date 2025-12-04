@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <div class="container">
        <div class="row w-100 mx-auto">
            <form action="{{route('post.save')}}" method="post" enctype="multipart/form-data">
            @csrf 
            <div class="mb-3">
                    <label for="categories[]" class="form-label d-block fw-bold">Category<span class="text-muted"> (up to 3)</span></label>
                @forelse($all_categories as $category)
                    <label class="d-inline-flex justify-items-center me-2">
                    <input type="checkbox" name="categories[]" value="{{$category->id}}" class="me-1 "> {{$category->category_name}}
                    </label>
                @empty
                    <p>No categories</p>
                @endforelse
                @error('categories')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="body" class="form-label fw-bold">Description</label>
                <textarea type="text" name="body" id="body" rows="3" class="form-control" placeholder="What's on your mind">{{old('body')}}</textarea>
                @error('body')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="iamge" class="form-label fw-bold">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                <p class="text-secondary">Acceptable formats:jpeg, jpg, png, gif only <br> 
                <span>Max file size is 1048KB</span></p>
                @error('image')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="w-25">
                <button class="btn btn-primary w-75" type="submit">Post</button>
            </div>

            </form>
        </div>
    </div>
@endsection('content')