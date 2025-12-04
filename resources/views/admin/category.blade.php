@extends('layouts.app_admin')

@section('title', 'Confirm Post')

@section('content')
    <div class="container">
        <div class="row mx-auto">
            <div class="col-3">
                <div class="row border rounded">
                    <div class="col-12 bg-white rounded">
                        <div class="row border-bottom">
                        <a href="{{route('admin.users')}}" class="text-decoration-none text-dark border-space">
                            <div class="col">
                                    <i class="fa-solid fa-users"></i> Users
                            </div>
                        </a>
                        </div>
                        <div class="row border-bottom">
                            <a href="{{route('admin.posts')}}" class="text-decoration-none text-dark border-space">
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
            <form action="{{route('admin.add')}}" method="post" class="mb-3">
                @csrf 
                <input type="text" name="category_name" class="form-control w-50 d-inline" placeholder="Add a category...">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i>Add</button>
            </form>
            <table class="table table-hover border w-75 align-middle" >
                <thead class="table-warning">
                    <tr>
                        <th class="tr-center text-secondary fw-bold">#</th>
                        <th class="tr-center text-secondary fw-bold">NAME</th>
                        <th class="tr-center text-secondary fw-bold">COUNT</th>
                        <th class="tr-center text-secondary fw-bold">LAST UPDATED</th>
                        <th class="tr-center text-secondary fw-bold"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($all_categories as $category)
                    <tr>
                        <td class="tr-center">{{$category->id}}</td>
                        <td class="tr-center  text-dark fw-bold">{{$category->category_name}}</td>
                        <td class="tr-center">{{$category->post->count()}}</td>
                        <td class="tr-center">{{$category->updated_at}}</td>
                        <td class="tr-center text-nowrap">
                            <button type="button" class="btn btn-outline-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#edit-category-{{$category->id}}"><i class="fa-solid fa-pen"></i></a></li>
                            <button type="button" class="btn btn-outline-danger btn-sm d-inline" data-bs-toggle="modal" data-bs-target="#delete-category-{{$category->id}}"><i class="fa-solid fa-trash-can"></i></button>
                        </td>
                    </tr>
                    @include('admin.modal.edit_category')
                    @include('admin.modal.delete_category')
                    @empty
                    <tr><td><p>No Category</p></td></tr>
                    @endforelse
                    <tr>
                        <td class="tr-center d-xlex align-item-center" colspan="2"><p class="text-secondary mb-0">Uncategorized<br><span style="font-size:0.8rem;">Hidden posts are not included</span></td>
                        <td class="tr-center">{{$no_categories}}</td>
                        <td colspan="2"></td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection