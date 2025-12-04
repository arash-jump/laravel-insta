<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{   
    private $user;
    const LOCAL_STORAGE_FOLDER = 'images/';

    public function __construct(User $user){
        $this->user = $user;
    }

    
    public function show_account($id){
        $user = $this->user->findOrFail($id);
        $all_followers = Follow::where('user_id', $id)->whereHas('follower', fn($q)=>$q->whereNull('deleted_at'))->get();
        $all_followings = Follow::where('follower_id', $id)->whereHas('user', fn($q)=>$q->whereNull('deleted_at'))->get();
 
        return view('users.accounts.show', compact('user', 'all_followers', 'all_followings'));
     }

     public function edit($id){
        $user = $this->user->findOrFail($id);

        return view('users.accounts.edit', compact('user'));
     }

     public function update(Request $request,$id){
        $request->validate([
            'name' => 'required|min:1|max:100',
            'email'=> 'required|min:1',
            'introduction' => '',
            'avatar' => 'mimes:jpeg,png,jpg,gif|max:1048'
        ]);

        $user = $this->user->findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->introduction){
            $user->introduction = $request->introduction;
        }

        if($user->avatar){
            $this->deleteImage($user->image);
            $user->avatar = $this->saveImage($request->avatar);
        }elseif(!$user->avatar){
            $user->avatar = $this->saveImage($request->avatar);
        }

        $user->save();
        return redirect()->route('account.show', $id);
     }

     public function deleteImage($image_name){
        $image_path = self::LOCAL_STORAGE_FOLDER . $image_name;

        if(Storage::disk('public')->exists($image_path)){
            Storage::disk('public')->delete($image_path);
        }
     }

     public function saveImage($image){
        $image_name = time() . "." . $image->extension();

        $image->storeAs(self::LOCAL_STORAGE_FOLDER, $image_name);

        return $image_name;
     }
}
