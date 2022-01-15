<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       $customerId = Auth::user()->id;
       $cartItems = Cart::where("customer_id","=",$customerId)->get();
       $total = 0;
       foreach($cartItems as $cartItem){
            $total += $cartItem->price * $cartItem->quantity;
        }
       return view("checkout.index",['cartItems' => $cartItems, 'total' => $total]);
    }
}
