<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Job\JobController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Homepage\HomePageController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Checkout\CheckoutController;
use App\Http\Controllers\Address\AddressController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Category\ShowCategoryController;
use App\Http\Controllers\Product\ShowProductController;
use App\Http\Controllers\Search\SearchController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomePageController::class, 'index']);

//Auth Controllers
Route::get("/login", [AuthController::class, 'login'])->name("login");
Route::get("/register", [AuthController::class, 'register'])->name("register");
Route::post("/register", [AuthController::class, 'registerPost'])->name('register');
Route::post("/login", [AuthController::class, 'loginPost'])->name('login');
Route::post("/logout", [AuthController::class, 'logout'])->name("logout");

//Dashboard Controllers
Route::get("/dashboard", [DashboardController::class, 'index'])->name("dashboard");

// Roles Controller
Route::prefix("admin")->group(function () {
    Route::resource("roles", RoleController::class)->middleware('role:Admin');
    Route::resource("categories", CategoryController::class)->middleware('role:Admin');
    Route::resource("products", ProductController::class)->middleware('role:Admin');
});

//Profile Controller
Route::get("/profile/{id}", [ProfileController::class, 'index'])->name("profile");
Route::put("/profile/{id}", [ProfileController::class, 'store'])->name("profile");

//Cart Controller
Route::post("/cart", [CartController::class, 'store'])->name("cart");
Route::get("/cart", [CartController::class, 'count'])->name("cart");
Route::get("/cart/show", [CartController::class, 'index']);
Route::post("/cart/update", [CartController::class, 'changeQty']);
Route::delete("/cart/delete", [CartController::class, 'delete']);
Route::get("/cart/totals", [CartController::class, 'cartTotal']);

//Checkout Controller
Route::get("/checkout", [CheckoutController::class, 'index']);
Route::post("/checkout", [CheckoutController::class, 'checkout']);

//Address Controller
Route::resource("address", AddressController::class);
Route::post("/address/billing", [AddressController::class, 'setAsBilling']);

//Orders Controller
Route::get("/orders", [OrderController::class, 'index']);
Route::get("/orders/{id}", [OrderController::class, 'getOrderItems']);

//Show category
Route::get("/category/{id}", [ShowCategoryController::class, 'index']);
Route::get("/genres", [ShowCategoryController::class, 'all']);
//show product
Route::get("/product/{id}", [ShowProductController::class, 'index']);

//Search
Route::get("/search", [SearchController::class, 'index'])->name("search");

//Customers
Route::get("/customers", [DashboardController::class, 'getCustomers']);
