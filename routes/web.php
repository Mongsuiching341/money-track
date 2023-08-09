<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\JwtTokenVerify;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//auth
Route::get('/register', [UserController::class, 'show']);
Route::post('/register', [UserController::class, 'create']);
Route::get('/login', [UserController::class, 'loginPage']);
Route::post('/login', [UserController::class, 'userLogin']);
Route::post('/logout', [UserController::class, 'logout']);


//
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware(JwtTokenVerify::class);

Route::post('/add-balance', [IncomeController::class, 'addBalance'])->middleware(JwtTokenVerify::class);
Route::post('/add-expense', [ExpenseController::class, 'addExpense'])->middleware(JwtTokenVerify::class);

Route::get('/expenseList', [ExpenseController::class, 'expenseList'])->middleware(JwtTokenVerify::class);
