<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = Auth::user();
        $dashBoardInfo = null;
        if ($user->hasRole(['Admin'])) {
            $products = Product::all()->count();
            $customers = User::all()->count();
            $orders = Order::all()->count();
            $sales = Order::all()->sum("total");
            $dashBoardInfo['products'] = $products;
            $dashBoardInfo['customers'] = $customers;
            $dashBoardInfo['orders'] = $orders;
            $dashBoardInfo['sales'] = $sales;
        }
        return view("dashboard.index", ['customer' => $dashBoardInfo]);
    }
}
