<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment){
            $this->comment = $comment;
    }

    public function save(Request $request, $id){

        $request->validate([
            'body' => 'required|min:1'
        ]);

        $this->comment->user_id = Auth::user()->id;
        $this->comment->post_id = $id;
        $this->comment->body    = $request->body;
        $this->comment->save();

        return redirect()->back();
    }

    public function destroy($id){
        $this->comment->destroy($id);

        return redirect()->back();
    }
}
