<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    private $like;

    public function __construct(Like $like){
        $this->like = $like;
    }

    public function save($id){
        $this->like->post_id = $id;
        $this->like->user_id = Auth::user()->id;

        $this->like->save();

        return redirect()->back();
    }

    public function delete($id){
        $user_id = Auth::user()->id;
        $this->like->where('post_id' , $id)->where('user_id', $user_id)->delete();

        return redirect()->back();
    }
}
