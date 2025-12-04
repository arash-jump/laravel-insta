@extends('layouts.app_admin')

@section('title', 'Confirm Post')

@section('content')
    <div class="container">
        <div class="row mx-auto">
            <div class="col-3">
                <div class="row border rounded">
                    <div class="col-12  bg-white rounded">
                        <div class="row border-bottom">
                        <a href="{{route('admin.users')}}" class="text-decoration-none text-dark border-space">
                            <div class="col">
                                    <i class="fa-solid fa-users"></i> Users
                            </div>
                        </a>
                        </div>
                        <div class="row border-bottom">
                            <a href="" class="text-decoration-none text-dark border-space">
                                <div class="col">
                                        <i class="fa-solid fa-image-portrait"></i> Posts
                                </div>
                            </a>
                        </div>
                        <div class="row">
                            <a href="{{route('admin.categories')}}" class="text-decoration-none text-dark border-space">
                                <div class="col">
                                    <i class="fa-solid fa-tags"></i> Categories
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-9 ">
            <table class="table table-hover mx-auto border w-100" >
                <thead class="table-primary">
                    <tr>
                        <th class="tr-center text-secondary fw-bold"></th>
                        <th class="tr-center text-secondary fw-bold"></th>
                        <th class="tr-center text-secondary fw-bold">CATEGORY</th>
                        <th class="tr-center text-secondary fw-bold">OWNER</th>
                        <th class="tr-center text-secondary fw-bold">CREATED AT</th>
                        <th class="tr-center text-secondary fw-bold">STATUS</th>
                        <th class="tr-center text-secondary fw-bold"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($all_posts as $post)
                    <tr>
                        <td class="tr-center">{{$post->id}}</td>
                        <td class="tr-center  text-dark fw-bold"><a href="{{route('post.show', $post->id)}}" class="text-decoration-none text-dark"><img src="{{asset('/storage/images/' . $post->image)}}" alt="{{$post->image}}" class="square"></a></td>
                        <td class="tr-center">
                            <ul class="list-unstyled d-flex justify-content-center">
                                @forelse($post->category as $category)
                                    <li class="rounded ps-2 pe-2 me-1 text-white" style="background:#D3D3D3;">{{$category->category_name}}</li>
                                @empty
                                    <li class="rounded ps-2 pe-2 me-1 text-white" style="background:#000000;">No Category</li>
                                @endforelse
                            </ul>    
                        </td>
                        <td class="tr-center fw-bold">{{$post->user->name}}</td>
                        <td class="tr-center">{{$post->created_at}}</td>
                        <td class="tr-center">
                            @if($post->deleted_at)
                            <i class="fa-solid fa-circle-minus text-secondary"></i> Hidden
                            @else
                            <i class="fa-solid fa-circle visible"></i> Visible
                            @endif
                        </td>
                        <td class="tr-center">
                            <div class="dropdown">
                                    <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        @if($post->deleted_at)
                                            <a href="{{route('admin.republic', $post->id)}}" class="dropdown-item">
                                                <i class="fa-solid fa-eye"></i>  Unhide Post {{$post->id}}
                                            </a>
                                        @else
                                            <button type="button" class="heart-btn text-danger dropdown-item" data-bs-toggle="modal" data-bs-target="#hide-post-{{$post->id}}">
                                                <i class="fa-solid fa-eye-slash"></i>  Hide Post {{$post->id}}
                                            </button>
                                        @endif
                                    </div>
                            </div>
                        </td>
                        @include('admin.modal.hide')
                    </tr>
                    @empty
                    <tr><td><p>No Post</p></td></tr>
                    @endforelse
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection