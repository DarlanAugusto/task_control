<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Mail\TestMessageMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);
Route::middleware(['auth', 'verified'])->group(function() {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/task/export', [TaskController::class, 'export'])->name('task.export');
    Route::resource('/task', TaskController::class);

    Route::get('/test-message', function() {
        Mail::to('laravel.testes.darlan@gmail.com')->send(new TestMessageMail());

        return "Email enviado com sucesso!";
    });


});

Route::get('/access-denied', [HomeController::class, 'accessDenied'])->name('access.denied');
