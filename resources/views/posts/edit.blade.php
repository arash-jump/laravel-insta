@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="container">
        <div class="row w-100 mx-auto">
            <form action="{{route('post.update', $post->id)}}" method="post" enctype="multipart/form-data">
            @csrf 
            <div class="mb-3">
                    <label for="categories[]" class="form-label d-block fw-bold">Category<span class="text-muted"> (up to 3)</span></label>
                @forelse($all_categories as $category)
                    @if(in_array($category->id, $post_category))
                    <label class="d-inline-flex align-items-center me-2">
                    <input type="checkbox" name="categories[]" value="{{$category->id}}" class="me-1" checked>
                    {{$category->category_name}}
                    </label>
                    @else
                    <label class="d-inline-flex align-items-center me-2">
                    <input type="checkbox" name="categories[]" value="{{$category->id}}" class="me-1">
                    {{$category->category_name}}
                    </label>
                    @endif
                @empty
                    <p>No categories</p>
                @endforelse
                @error('categories')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="body" class="form-label fw-bold">Description</label>
                <textarea type="text" name="body" id="body" rows="3" class="form-control" placeholder="What's on your mind">{{old('body', $post->body)}}</textarea>
                @error('body')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-4 w-50">
                <label for="iamge" class="form-label fw-bold">Image</label> <br>
                <img src="{{asset('/storage/images/' . $post->image)}}" alt="$post->image" class="mb-2 img-thumbnail">
                <input type="file" name="image" id="image" class="form-control">
                <p class="text-secondary">Acceptable formats:jpeg, jpg, png, gif only <br> 
                <span>Max file size is 1048KB</span></p>
                @error('image')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="w-25">
                <button class="btn btn-warning w-75" type="submit">Save</button>
            </div>

            </form>
        </div>
    </div>
@endsection