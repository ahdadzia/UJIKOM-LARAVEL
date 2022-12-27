<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExerciseItemsController;
use App\Http\Controllers\ExerciseCategoriesController;

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

Route::get('/items/manage', [ExerciseItemsController::class, 'index'])->name('items.manage');
Route::get('/items/create', [ExerciseItemsController::class, 'create'])->name('items.create');
Route::post('/items/store', [ExerciseItemsController::class, 'store'])->name('items.store');
Route::delete('/items/delete/{items}', [ExerciseItemsController::class, 'destroy'])->name('items.delete');
Route::get('/items/edit/{items}', [ExerciseItemsController::class, 'edit'])->name('items.edit');
Route::post('/items/update/{items}', [ExerciseItemsController::class, 'update'])->name('items.update');

Route::get('/categories/manage', [ExerciseCategoriesController::class, 'index'])->name('categories.manage');
Route::get('/categories/create', [ExerciseCategoriesController::class, 'create'])->name('categories.create');
Route::post('/categories/store', [ExerciseCategoriesController::class, 'store'])->name('categories.store');
Route::delete('/categories/delete/{category}', [ExerciseCategoriesController::class, 'destroy'])->name('categories.delete');
Route::get('/categories/edit/{category}', [ExerciseCategoriesController::class, 'edit'])->name('categories.edit');
Route::post('/categories/update/{category}', [ExerciseCategoriesController::class, 'update'])->name('categories.update');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
