<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MarkController;
use App\Http\Controllers\Admin\StudentController;
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

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [LoginController::class, 'showLogin'])->name('showLogin');
    Route::get('/login', [LoginController::class, 'showLogin']);
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/logout', [LoginController::class,'logout'])->name('logout');
        Route::any('/dashboard', [StudentController::class,'showDashboard'])->name('dashboard');
        //students
        Route::get('/students/{id?}', [StudentController::class, 'list'])->name('showStudents');
        Route::post('/students/save', [StudentController::class, 'save'])->name('saveStudents');
        Route::get('/students/delete/{id}',[StudentController::class, 'delete'])->name('deleteStudents');
        //students
        Route::get('/marks/{id?}', [MarkController::class, 'list'])->name('showMarks');
        Route::post('/marks/save', [MarkController::class, 'save'])->name('saveMarks');
        Route::get('/marks/delete/{id}',[MarkController::class, 'delete'])->name('deleteMarks');
    });
});
