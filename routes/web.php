<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Role\RoleController;
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

Route::get('/', function () {
    return view('welcome');
});

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
    Route::resource("roles", RoleController::class);
});

