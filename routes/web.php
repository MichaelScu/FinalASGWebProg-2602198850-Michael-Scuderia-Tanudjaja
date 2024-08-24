<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get("/register", function(){
    return view("auth.register");
});
Route::post("/register",[AuthenticationController::class,"register"])->name("saveRegister");

Route::get("/login", function(){
    return view("auth.login");
});
Route::post("/login",[AuthenticationController::class,"login"])->name("saveLogin");
Route::post("/logout",[AuthenticationController::class,"logout"]);

Route::get('/pay', function () {
    $user = Auth::user();
    $price = $user->register_price;
    return view('pay', compact('price'));
})->name('pay');

Route::post('/updatePaid', [AuthenticationController::class, 'update_paid'])->name('updatePaid');

Route::get('/overpayment', [AuthenticationController::class, 'handleOverpayment'])->name('handle.overpayment');
Route::post('/overpayment', [AuthenticationController::class, 'processOverpayment'])->name('process.overpayment');

Route::middleware(['auth', 'paid'])->group(function () {
    Route::get('/', function () {
        return view('home');
    });

    Route::resource("user", UserController::class);
    Route::resource("friend-request", FriendRequestController::class);
    Route::resource("friend", FriendController::class);
});