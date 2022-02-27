<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
  public function __construct()
  {
    $this->middleware("auth");
  }
  public function index()
  {
    $user = $this->getUser();
    $orders = null;
    if ($user->hasRole(['Admin'])) {
      $orders = Order::all();
    } else {
      $customerId = $this->getCustomerId();
      $orders  = Order::where("customer_id", "=", $customerId)->get();
    }
    return view("order.index", ['orders' => $orders]);
  }
  public function getOrderItems(Request $request)
  {
    $orderId = $request->id;
    $orderItems = OrderItem::where("order_id", "=", $orderId)->get();
    return view("orderitems.index", ['orderItems' => $orderItems]);
  }
  private function getCustomerId()
  {
    return Auth::user()->id;
  }
  private function getUser()
  {
    return Auth::user();
  }
}
