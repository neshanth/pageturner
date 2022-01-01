<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   public function login()
   {
       return view("auth.login");
   }
   public function register()
   {
       return view("auth.register");
   }
   public function registerPost(Request $request)
   {
       $roles = $this->getUserRole();
       $userRole = $roles[0];
       $request->validate([
          'name' => "required",
          'email' => "required|email|unique:users",
          'password' => "required|min:5"
      ]);
       User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => Hash::make($request->password),
          'role_id' => $userRole->id
      ]);
      return redirect()->back()->with('success','Registration Successful');
   }
   public function loginPost(Request $request)
   {
        $request->validate([
           'email' => 'required',
           'password' => 'required'
       ]);
        $credentials = $request->only('email','password');
       if(Auth::attempt($credentials))
       {
           $request->session()->regenerate();
           return redirect("/");
       }
       return redirect()->back()->with("error", "Login Failed");
   }
   public function logout(Request $request)
   {
       Auth::logout();
       $request->session()->invalidate();
       $request->session()->regenerate();
       return redirect("/");
   }
   private  function getUserRole()
   {
       return DB::table('roles')->where('role','User')->get();
   }
}
