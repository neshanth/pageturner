<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index($id)
    {
       $user = User::where("id",$id)->get();
       return view("profile.index",['details' => $user]);

    }
    public function store(Request $request,$id)
    {
       $request->validate([
           'name' => 'required',
           'email'=> "required|email|unique:users,email,$id",
           'avatar' => 'max:1000|mimes:png,jpeg,jpg'
       ]);
       $fileName = null;
       if($request->hasFile('avatar') && !$this->checkIfAvatarExists($id,$request)){
            $fileName = $request->file('avatar')->getClientOriginalName();
            $existingAvatar = $this->getUserAvatar($id);
            $this->deleteAvatar($existingAvatar);
            $request->file("avatar")->storeAs('public/avatar',$fileName);

       }
       $data = [
           'name' => $request->name,
           'email' => $request->email,
           'avatar' => $fileName
       ];
       User::find($request->user_id)->update($data);
       return redirect()->back()->with("success","Profile Updated Successfully");

    }
    private function checkIfAvatarExists($id,Request $request): bool
    {
        $user = User::find($id);
        return $user->avatar == $request->file('avatar')->getClientOriginalName();
    }
    private function getUserAvatar($id)
    {
        $user = User::find($id);
        return $user->avatar;
    }
    private function deleteAvatar($imageName)
    {
       Storage::delete("/public/avatar/".$imageName);
    }
}
