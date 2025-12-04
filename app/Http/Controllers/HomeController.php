<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use App\Models\Follow;
use App\Models\User;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        //pluck is to get user_id in where('follower_id', Auth::id())
        $followedId = Follow::where('follower_id', Auth::user()->id)->pluck('user_id');

        //whereIn is to get some datas in user_id * where is to get only one data in user_id
        //push is to add data into where or whereIn
        $all_posts = Post::with(['user'])->whereIn('user_id', $followedId->push(Auth::id()))->whereHas('user', fn($q)=>$q->whereNull('deleted_at'))->with('user')->latest()->get();

        $already_followed = Follow::where('follower_id', Auth::user()->id)->pluck('user_id');

        //!= is to get incollect datas in definitons
        $suggetions = User::where('id' ,'!=' , Auth::id())
                          ->whereNotIn('id', $already_followed)
                          ->get();

        

        return view('users.home')->with('all_posts', $all_posts)
                                 ->with('suggetions', $suggetions);
        //views/user/home.blade.php
    }
}
