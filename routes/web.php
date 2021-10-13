<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::redirect('/', '/login');

Auth::routes();

// Route::get('/api', [ApiController::class, 'index'])->name('index');
// Route::post('/api', [ApiController::class, 'create'])->name('create');
// Route::post('/api', [ApiController::class, 'store'])->name('store');
// Route::get('/api/{cities}', [ApiController::class, 'edit'])->name('edit');
// Route::put('/api/{cities}', [ApiController::class, 'update'])->name('update');
// Route::delete('/api/{cities}', [ApiController::class, 'destroy'])->name('destroy');
Route::resource('/api', ApiController::class);
