<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
   public function __construct()
   {
     $this->middleware("auth");
   }

   public function index()
   {
      $customerId = Auth::user()->id;
      $cartItems = Cart::where("customer_id","=",$customerId)->get();
      return view("cart.index",['cart' => $cartItems]);
   }

   public function count()
   {
     $customerId = Auth::user()->id;
     $count = Cart::where("customer_id","=",$customerId)->count();
     return response()->json($count);
   }
    public function store(Request $request)
    {
      $productId = $request->product_id;

      $data = [
       'product_id' => $productId,
       'customer_id' => $request->customer_id,
       'quantity' => $request->quantity,
       'price' => $request->price
      ];

      //check if value already exists
      if($this->checkProductCount($productId,$request->customer_id) > 0){
         $cart = Cart::where("product_id","=",$productId)
         ->where("customer_id","=",$request->customer_id)
         ->get();
         
         $cart[0]->quantity += 1;
         $cart[0]->save();
            return response()->json("Updated Cart");

      }else{
         Cart::create($data);
         return response()->json("Added Cart");
         
      }
   }
   public function changeQty(Request $request)
   {
      $cart =  Cart::find($request->cartId);
      $identifier =  $request->qty;
      if($identifier == "inc"){
         $cart->quantity += 1;
      }else{
         if($cart->quantity > 1){
            $cart->quantity -= 1;
         }
      }
      $cart->save();
      return response()->json("Cart Updated");
   }
   public function delete(Request $request)
   {
      Cart::destroy($request->cartId);
      return response()->json("Deleted");
   }
   public function cartTotal()
   {
      $customerId = Auth::user()->id;
      $cartItems = Cart::where("customer_id","=",$customerId)->get();
      $total = 0;
      foreach($cartItems as $cartItem){
         $total += $cartItem->price * $cartItem->quantity;
      }
      return response()->json(floatval($total));
   }

   private function checkProductCount($productId,$customerId)
   {
       return Cart::where("product_id","=",$productId)
         ->where("customer_id","=",$customerId)
         ->count();
   }
   

}
