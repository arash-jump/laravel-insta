<div class="modal fade" id="show-follower">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">
                <i class="fa-solid fa-users"></i> Follower
                </h3>
            </div>
            <div class="modal-body d-flex flex-column gap-2 border-0">
                @forelse($all_followers as $follower)
                @if($follower->follower->avatar)
                <div class="row">
                    <div class="col-9">
                        <a href="{{route('account.show', $follower->follower_id)}}" class="text-dark text-decoration-none fw-bold d-flex align-items-center gap-2 mb-0"><img src="{{asset('/storage/images/' . $follower->follower->avatar)}}" alt="{{$follower->follower->name}}" class="rounded-circle avatar-sm"> {{$follower->follower->name}}</a>
                    </div>
                    <div class="col-3">
                    @if($follower->follower_id === Auth::user()->id)
                    @else
                    @if(\App\Models\Follow::where('user_id', $follower->follower->id)->where('follower_id', Auth::user()->id)->exists())
                    <div class="col d-flex align-items-center">
                        <form action="{{route('account.unfollow', $follower->follower_id)}}" method="post">
                        @csrf 
                        @method('DELETE')
                            <button type="submit" class="btn btn-primary btn-sm">Following</button>
                        </form>
                    </div>
                    @else
                    <div class="col d-flex align-items-center">
                        <a href="{{route('account.follow', $follower->follower_id)}}" class="btn btn-outline-primary btn-sm">Follow</a>
                    </div>
                    @endif
                    @endif
                    </div>
                </div>
                @else
                <div class="row">
                    <div class="col-9">
                        <a href="{{route('account.show', $follower->follower_id)}}" class="text-dark text-decoration-none fw-bold d-flex align-items-center gap-2 mb-0"><i class="fa-solid fa-circle-user text-secondary icon-sm"></i> {{$follower->follower->name}}</a>
                    </div>
                    <div class="col-3">
                    @if($follower->follower_id === Auth::user()->id)
                    @else
                    @if(\App\Models\Follow::where('user_id', $follower->follower->id)->exists() && \App\Models\Follow::where('follower_id', Auth::user()->id)->exists())
                        <div class="col d-flex align-items-center">
                            <form action="{{route('account.unfollow', $follower->follower_id)}}" method="post">
                            @csrf 
                            @method('DELETE')
                                <button type="submit" class="btn btn-primary btn-sm">Following</button>
                            </form>
                        </div>
                    @else
                        <div class="col d-flex align-items-center">
                            <a href="{{route('account.follow', $follower->follower_id)}}" class="btn btn-outline-primary btn-sm">Follow</a>
                        </div>
                    @endif
                    @endif
                        </div>
                    </div>
                @endif
                @empty
                <p class="mt-3">No Follower</p>
                @endforelse
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Back</button>
            </div>
        </div>
    </div>
</div>