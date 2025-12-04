@extends('layouts.app_admin')

@section('title', 'Confirm User')

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
            <table class="table table-hover mx-auto border w-100" >
                <thead class="table-success">
                    <tr>
                        <th class="tr-center text-secondary fw-bold"></th>
                        <th class="tr-center text-secondary fw-bold">NAME</th>
                        <th class="tr-center text-secondary fw-bold">EMAIL</th>
                        <th class="tr-center text-secondary fw-bold">CREATED AT</th>
                        <th class="tr-center text-secondary fw-bold">STATUS</th>
                        <th class="tr-center text-secondary fw-bold"></th>
                    </tr>
                </thead>
                <tbody class="table-default">
                    @forelse($all_users as $user)
                    <tr>
                        <td class="tr-center"><a href="{{route('account.show', $user->id)}}" class="text-decoration-none text-dark"><img src="{{asset('/storage/images/' . $user->avatar)}}" alt="{{$user->name}}" class="rounded-circle img-thumbnail avatar-md"></a></td>
                        <td class="tr-center  text-dark fw-bold"><a href="{{route('account.show', $user->id)}}" class="text-decoration-none text-dark">{{$user->name}}</a></td>
                        <td class="tr-center  text-secondary">{{$user->email}}</td>
                        <td class="tr-center  text-secondary">{{$user->created_at}}</td>
                        <td class="tr-center">
                            @if($user->deleted_at)
                            <i class="fa fa-circle inactive"></i> Inactive
                            @else
                            <i class="fa-solid fa-circle active"></i> Active
                            @endif
                        </td>
                        <td class="tr-center">
                            <div class="dropdown">
                                    <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        @if($user->deleted_at)
                                            <a href="{{route('admin.active', $user->id)}}" class="dropdown-item">
                                                <i class="fa-solid fa-user-check"></i> Active {{$user->name}}
                                            </a>
                                        @else
                                            <button type="button" class="heart-btn text-danger dropdown-item" data-bs-toggle="modal" data-bs-target="#deactive-{{$user->id}}">
                                                <i class="fa-solid fa-user-slash"></i>  Deactive {{$user->name}}
                                            </button>
                                        @endif
                                    </div>
                            </div>
                            @include('admin.modal.inactive')
                        </td>
                    </tr>
                    @empty
                    <tr><td><p>No User</p></td></tr>
                    @endforelse
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection