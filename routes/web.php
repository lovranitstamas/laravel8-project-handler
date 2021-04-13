<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\ContactPersonController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\ProjectController;
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

/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [DefaultController::class, 'index'])->name('index');
Route::delete('/contact_person/{id}', [ContactPersonController::class, 'destroy'])->name('contact_person.destroyWithJson');
Route::resource('contact_person', ContactPersonController::class);

Route::delete('/project/{id}', [ProjectController::class, 'destroy'])->name('project.destroyWithJson');
Route::resource('project', ProjectController::class);


Route::namespace('Admin')->name('admin.')->prefix('admin')->group(function () {
    Route::namespace('Auth')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.create');
        Route::post('/login', [LoginController::class, 'login'])->name('login.store');
    });

    Route::middleware('admin_auth')->group(function () {
        Route::get('/index', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
