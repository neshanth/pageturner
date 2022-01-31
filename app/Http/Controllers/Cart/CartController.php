<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

   public function index()
   {
      if (!Auth::user()) {
         $cartItems = session()->get("cart");
         return view("cart.index", ['cartItems' => $cartItems]);
      }
      $customerId = Auth::user()->id;
      $cartItems = Cart::where("customer_id", "=", $customerId)->get();
      return view("cart.index", ['cart' => $cartItems]);
   }

   public function count()
   {
      $count = 0;
      if (!Auth::user()) {
         if (session('cart') !== null) {
            return response()->json(count(session('cart')));
         }
      } else {
         $customerId = Auth::user()->id;
         $count = Cart::where("customer_id", "=", $customerId)->count();
      }
      return response()->json($count);
   }
   public function store(Request $request)
   {
      $productId = $request->product_id;

      if (!Auth::user()) {

         $this->addToGuestCart($productId, $request->quantity, $request->price);
         return response()->json("Added To Cart");
      }

      $data = [
         'product_id' => $productId,
         'customer_id' => $request->customer_id,
         'quantity' => $request->quantity,
         'price' => $request->price
      ];

      //check if value already exists
      if ($this->checkProductCount($productId, $request->customer_id) > 0) {
         $cart = Cart::where("product_id", "=", $productId)
            ->where("customer_id", "=", $request->customer_id)
            ->get();

         $cart[0]->quantity += 1;
         $cart[0]->save();
         return response()->json("Updated Cart");
      } else {
         Cart::create($data);
         return response()->json("Added To Cart");
      }
   }
   public function changeQty(Request $request)
   {
      if (!Auth::user()) {
         $this->updateGuestCart($request->cartId, $request->qty);
         return response()->json("Cart Updated");
      }
      $cart =  Cart::find($request->cartId);
      $identifier =  $request->qty;
      if ($identifier == "inc") {
         $cart->quantity += 1;
      } else {
         if ($cart->quantity > 1) {
            $cart->quantity -= 1;
         }
      }
      $cart->save();
      return response()->json("Cart Updated");
   }
   public function delete(Request $request)
   {
      if (!Auth::user()) {
         $this->removeGuestCart($request->cartId);
         return response()->json("Deleted");
      }
      Cart::destroy($request->cartId);
      return response()->json("Deleted");
   }
   public function cartTotal()
   {
      if (!Auth::user()) {
         $total = $this->guestCartTotal();
         return response()->json(floatval($total));
      }

      $customerId = Auth::user()->id;
      $cartItems = Cart::where("customer_id", "=", $customerId)->get();
      $total = 0;
      foreach ($cartItems as $cartItem) {
         $total += $cartItem->price * $cartItem->quantity;
      }
      return response()->json(floatval($total));
   }

   private function checkProductCount($productId, $customerId)
   {
      return Cart::where("product_id", "=", $productId)
         ->where("customer_id", "=", $customerId)
         ->count();
   }

   private function addToGuestCart($productId, $quantity, $price)
   {
      $cart = session()->get('cart', []);
      $product = Product::find($productId);

      if (isset($cart[$productId])) {
         $cart[$productId]['quantity']++;
      } else {
         $cart[$productId] = [
            'product_id' => $productId,
            'quantity' => $quantity,
            'price' => $price,
            'image' => $product->image,
            'title' => $product->title
         ];
      }
      session()->put("cart", $cart);
   }
   private function guestCartTotal()
   {
      $total = 0;
      $cart = session()->get('cart');
      if ($cart != null) {
         foreach ($cart as $id => $items) {
            $total += $items['price'] * $items['quantity'];
         }
      }
      return $total;
   }
   private function updateGuestCart($productId, $identifier)
   {
      $cart = session()->get("cart");
      if ($identifier == "inc") {
         $cart[$productId]['quantity']++;
      } else {
         if ($cart[$productId]['quantity'] > 1) {
            $cart[$productId]['quantity']--;
         }
      }
      session()->put("cart", $cart);
   }
   private function removeGuestCart($productId)
   {
      $cart = session()->get('cart');
      unset($cart[$productId]);
      session()->put("cart", $cart);
   }
}
