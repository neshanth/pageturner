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
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomePageController::class,'index']);

//Auth Controllers
Route::get("/login",[AuthController::class,'login'])->name("login");
Route::get("/register",[AuthController::class,'register'])->name("register");
Route::post("/register",[AuthController::class,'registerPost'])->name('register');
Route::post("/login",[AuthController::class,'loginPost'])->name('login');
Route::post("/logout",[AuthController::class,'logout'])->name("logout");

//Dashboard Controllers
Route::get("/dashboard",[DashboardController::class,'index'])->name("dashboard");
// Roles Controller
Route::prefix("admin")->group(function(){
    Route::resource("roles", RoleController::class)->middleware('role:Admin');
    Route::resource("categories",CategoryController::class)->middleware('role:Admin');
    Route::resource("products",ProductController::class)->middleware('role:Admin');
});

//Profile Controller
Route::get("/profile/{id}", [ProfileController::class,'index'])->name("profile");
Route::put("/profile/{id}",[ProfileController::class,'store'])->name("profile");

//Cart Controller
Route::post("/cart",[CartController::class,'store'])->name("cart");
Route::get("/cart",[CartController::class,'count'])->name("cart");
Route::get("/cart/show",[CartController::class,'index']);
Route::post("/cart/update",[CartController::class,'changeQty']);
Route::delete("/cart/delete",[CartController::class,'delete']);
Route::get("/cart/totals",[CartController::class,'cartTotal']);
