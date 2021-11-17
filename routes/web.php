<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Requests;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;
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

Route::middleware('auth')->group(function(){
    Route::resource('/todo', TodoController::class);
    // Route::get('/todos', [TodoController::class, 'index'])->name('todo.index');
    // Route::get('/todos/create',  [TodoController::class, 'create']);
    // Route::post('/todos/create',  [TodoController::class, 'store']);
    // Route::get('/todos/{id}/edit',  [TodoController::class, 'edit']);
    // Route::patch('/todos/{id}/update',  [TodoController::class, 'update'])->name('todo.update');
    // Route::delete('/todos/{id}/delete',  [TodoController::class, 'delete'])->name('todo.delete');
    
    Route::put('/todos/{id}/complete',  [TodoController::class, 'complete'])->name('todo.complete');
    Route::delete('/todos/{id}/incomplete',  [TodoController::class, 'incomplete'])->name('todo.incomplete');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user', [UserController::class, 'index']);

Route::post('/upload', [UserController::class, 'uploadAvatar'] );

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
