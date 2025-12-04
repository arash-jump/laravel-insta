<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class AdminController extends Controller
{
    public function users(){
        $all_users = User::where('role_id', 2)->withTrashed()->latest()->get();

        return view('admin.user', compact('all_users'));
    }

    public function inactive($id){
        User::where('id', $id)->delete();

        return redirect()->back();
    }

    public function active($id){
        User::where('id', $id)->restore();

        return redirect()->back();
    }

    public function posts(){
        $all_posts = Post::whereHas('user', fn($q)=>$q->whereNull('deleted_at'))->withTrashed()->get();

        return view('admin.post', compact('all_posts'));
    }

    public function hidden($id){
        Post::where('id', $id)->delete();

        return redirect()->back();
    }

    public function republic($id){
        Post::where('id', $id)->restore();

        return redirect()->back();
    }

    public function categories(){
        $all_categories = Category::get();
        $no_categories = Post::whereDoesntHave('category')->count();

        return view('admin.category', compact('all_categories' ,'no_categories'));
    }

    public function add(Request $request){
        $request->validate([
            'category_name' => 'required|min:1|max:30'
        ]);
        
        $category =new Category();
        $category->category_name = $request->category_name;

        $category->save();

        return redirect()->back();
    }

    public function edit(Request $request, $id){
        $request->validate([
            'category_name' => 'required|min:1|max:30'
        ]);

        $category = new Category();

        $category = $category->findOrFail($id);

        $category->category_name = $request->category_name;

        $category->save();

        return redirect()->back();
    }

    public function delete($id){
        $category = new Category();

        $category->destroy($id);

        return redirect()->back();
    }
}
