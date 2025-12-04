<div class="modal fade" id="show-following">
    <div class="modal-dialog">
        <div class="modal-content border-primary">
            <div class="modal-header border-primary">
                <h3 class="h5 modal-title text-primary">
                <i class="fa-solid fa-users"></i> Following
                </h3>
            </div>
            <div class="modal-body d-flex flex-column gap-2 border-0">
                @forelse($all_followings as $following)
                @if($following->user->avatar)
                <div class="row">
                    <div class="col-9">
                        <a href="{{route('account.show', $following->user_id)}}" class="text-dark text-decoration-none fw-bold d-flex align-items-center gap-2 mb-0"><img src="{{asset('/storage/images/' . $following->user->avatar)}}" alt="{{$following->user->name}}" class="rounded-circle avatar-sm"> {{$following->user->name}}</a>
                    </div>
                    <div class="col-3">
                    @if($following->user_id === Auth::user()->id)
                    @else
                    @if(\App\Models\Follow::where('user_id', $following->user_id)->where('follower_id', Auth::user()->id)->exists())
                    <div class="col d-flex align-items-center">
                        <form action="{{route('account.unfollow', $following->user_id)}}" method="post">
                        @csrf 
                        @method('DELETE')
                            <button type="submit" class="btn btn-primary btn-sm">Following</button>
                        </form>
                    </div>
                    @else
                    <div class="col d-flex align-items-center">
                        <a href="{{route('account.follow', $following->user_id)}}" class="btn btn-outline-primary btn-sm">Follow</a>
                    </div>
                    @endif
                    @endif
                    </div>
                </div>
                @else
                <div class="row">
                    <div class="col-9">
                        <a href="{{route('account.show', $following->user_id)}}" class="text-dark text-decoration-none fw-bold d-flex align-items-center gap-2 mb-0"><i class="fa-solid fa-circle-user text-secondary icon-sm"></i> {{$following->user->name}}</a>
                    </div>
                    <div class="col-3">
                    @if($following->user_id === Auth::user()->id)
                    @else
                    @if(\App\Models\Follow::where('user_id', $following->user_id)->exists() && \App\Models\Follow::where('follower_id', Auth::user()->id)->exists())
                        <div class="col d-flex align-items-center">
                            <form action="{{route('account.unfollow', $following->user_id)}}" method="post">
                            @csrf 
                            @method('DELETE')
                                <button type="submit" class="btn btn-primary btn-sm">Following</button>
                            </form>
                        </div>
                    @else
                        <div class="col d-flex align-items-center">
                            <a href="{{route('account.follow', $following->user_id)}}" class="btn btn-outline-primary btn-sm">Follow</a>
                        </div>
                    @endif
                    @endif
                        </div>
                    </div>
                @endif
                @empty
                
                    <p class="mt-3">No Following</p>
               
                @endforelse
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Back</button>
            </div>
        </div>
    </div>
</div>