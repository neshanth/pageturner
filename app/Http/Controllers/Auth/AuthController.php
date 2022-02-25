<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Cart;

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
        $request->validate([
            'name' => "required",
            'email' => "required|email|unique:users",
            'password' => "required|min:5|confirmed"
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $user->assignRole("User");
        return redirect("/login");
    }
    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            if ($request->session()->get("cart") !== null) {
                $customerId = Auth::user()->id;
                $this->getGuestCart($request, $customerId);
                $request->session()->forget("cart");
                return redirect("/cart/show");
            }

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

    private function getGuestCart(Request $request, $customerId)
    {
        $cartItems =  $request->session()->get("cart");
        foreach ($cartItems as $cartItem) {
            $cart = new Cart;
            $cart->product_id  = $cartItem['product_id'];
            $cart->customer_id = $customerId;
            $cart->quantity = $cartItem['quantity'];
            $cart->price = $cartItem['price'];
            $cart->save();
        }
    }
}
