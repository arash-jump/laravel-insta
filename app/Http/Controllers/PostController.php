<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use App\Models\Category;
use App\Models\Comment;


class PostController extends Controller
{
    private $post;
    const LOCAL_STORAGE_FOLDER = 'images/';

    public function __construct(Post $post, Category $category){

        $this->post = $post;
        $this->category = $category;
    }

    public function create(){
        $all_categories = Category::get();

        return view('posts.create')->with('all_categories', $all_categories);
    }

    public function save(Request $request){
        $request->validate([
            'categories' => 'required|array|between:1,3',
            'categories.*' => 'integer',
            'body' => 'required|min:1|max:1000',
            'image' => 'mimes:jpeg,png,jpg,gif|max:1048|required'
        ]);

        $this->post->body = $request->body;
        $this->post->user_id = Auth::user()->id;
        $this->post->image = $this->saveImage($request->image);
        $this->post->save();
        $this->post->category()->sync($request->categories);

        return redirect()->route('index');
    }

    public function saveImage($image){
        $image_name = time() . "." . $image->extension();

        $image->storeAs(self::LOCAL_STORAGE_FOLDER, $image_name);

        return $image_name;
    }

    public function show($id){
        $post = $this->post->findOrFail($id);
        $all_likes = \App\Models\Like::where('post_id' , $id)->whereHas('user', fn($q)=>$q->whereNull('deleted_at'))->get();
        $all_comments = \App\Models\Comment::where('post_id' , $id)->whereHas('user', fn($q)=>$q->whereNull('deleted_at'))->get();

        return view('posts.detail', compact('post','all_likes', 'all_comments'));
    }

    public function edit($id){
        $post = $this->post->findOrFail($id);
        $all_categories = Category::get();
        $post_category = [];

        foreach($post->category as $category){
            $post_category[] = $category->id;
        }

        return view('posts.edit')->with('post', $post)
                                 ->with('all_categories', $all_categories)
                                 ->with('post_category', $post_category);
    }

    public function update(Request $request, $id){
        $request->validate([
            'categories' => 'array|between:1,3',
            'categories.*' => 'integer',
            'body' => 'required|min:1|max:1000',
            'image' => 'mimes:jpeg,png,jpg,gif|max:1048'
        ]);
        $post = $this->post->findOrFail($id);

        $post->body = $request->body;
        $post->user_id = Auth::user()->id;

        if($request->image){
            $this->deleteImage($post->image);
            $post->image = $this->saveImage($request->image);
        }
        
        $post->save();
        $post->category()->sync($request->categories);

        return redirect()->route('index');
    }

    public function deleteImage($image_name){
        $image_path = self::LOCAL_STORAGE_FOLDER . $image_name;

        if(Storage::disk('public')->exists($image_path)){
            Storage::disk('public')->delete($image_path);
        }
    }

    public function destroy($id){

        if(Like::where('post_id', $id)->exists()){
            Like::where('post_id', $id)->delete();
        }
        if(Comment::where('post_id', $id)->exists()){
            Comment::where('post_id', $id)->delete();
        }

        $this->post->destroy($id);

        return redirect()->back();
    }

}
