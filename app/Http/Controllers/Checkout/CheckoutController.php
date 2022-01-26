<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       $customerId = $this->getCustomerId();
       //check if cart has products
       $cartCount = $this->checkIfCartHasProduct($customerId);
       if($cartCount <= 0){
         return redirect("/");
       }

       $cartItems = $this->getCartItemsByCustomerId($customerId);
       $addressCount = Address::where("user_id","=",$customerId)->count();
       $address = $this->getCustomerAddress($customerId);
       $total = $this->getCartTotal($customerId);
       
       return view("checkout.index",
       [
       'cartItems' => $cartItems, 
       'total' => $total,
       'count' => $addressCount,
       'address' => $address
       ]
      );
    }
    public function checkout(Request $request)
    {
       $customerId = $this->getCustomerId();
       //check if cart has products
       $cartCount = $this->checkIfCartHasProduct($customerId);
       if($cartCount <= 0){
         return redirect("/");
       }
       $cartItems = $this->getCartItemsByCustomerId($customerId);
       $total = $this->getCartTotal($customerId);
       $shippingAddress = $this->getCustomerShippingAddress($customerId);
       //check if billing address is set
       if($this->checkIfShippingAddressIsSet($customerId) > 0){
          $shippingAddressId = $shippingAddress[0]['id'];
          $deliveryMethod = $request->delivery_cost;
          $finalTotal = $this->getDeliveryCost($customerId,$deliveryMethod);
          //create order
          $orderData = ['customer_id' => $customerId,'total' => $finalTotal,'address_id' => $shippingAddressId ];
          $orderId = $this->createOrderAndReturnOrderId($orderData);
          //create order items
          $this->createOrderItems($customerId,$orderId);
          //Delete Cart Items
          $this->clearCart($customerId);
          //redirect to success page
          return view("checkout.success");
       }else{
         return redirect()->back()->with("error","Please choose a Shipping Address");
       }
    }
    private function getCustomerId()
    {
      return Auth::user()->id;
    }
    private function getCartItemsByCustomerId($customerId)
    {
      return Cart::where("customer_id","=",$customerId)->get();
    }
    private function getCartTotal($customerId)
    {
        $cartItems = $this->getCartItemsByCustomerId($customerId);
        $total = 0;
        foreach($cartItems as $cartItem){
            $total += $cartItem->price * $cartItem->quantity;
        }
        return $total;
    }
    private function getCustomerAddress($customerId)
    {
       return Address::where("user_id","=", $customerId)->get();
    }
    private function getCustomerShippingAddress($customerId)
    {
       $allAddress =  $this->getCustomerAddress($customerId);
       $shippingAddress = Address::where("is_billing",'=',true)->get(['id'])->toArray();
       return $shippingAddress;
    }
    private function getDeliveryCost($customerId,$method)
    {
      $cartTotal = $this->getCartTotal($customerId);
      if($method == "express"){
         $cartTotal += 10.00;
      }
      return $cartTotal;
    }
    private function createOrderAndReturnOrderId($data)
    {
      $order = Order::create($data);
      return $order->id;
    }
    private function createOrderItems($customerId,$orderId)
    {
      $cartItems = $this->getCartItemsByCustomerId($customerId);

      foreach($cartItems as $cartItem){
         OrderItem::create(['order_id' => $orderId,
         'product_id' => $cartItem->product_id,
         'price' => $cartItem->product->price,
         'quantity' => $cartItem->quantity
        ]);
       }
    }
    private function checkIfShippingAddressIsSet($customerId)
    {
         $shippingAddress = $this->getCustomerShippingAddress($customerId);
         return count($shippingAddress);
    }
    private function clearCart($customerId)
    {
      Cart::where("customer_id",'=',$customerId)->delete();
    }
    private function checkIfCartHasProduct($customerId)
    {
      $cart = Cart::where("customer_id","=",$customerId)->get();
      return $cart->count();
    }
}
