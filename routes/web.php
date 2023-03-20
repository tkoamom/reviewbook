<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/reviews', function () {
        return Inertia::render('Reviews/container')->with('user', Auth::user());
    })->name('reviews');
});

Route::middleware('auth:sanctum')->get('/reviews_data', [\App\Http\Controllers\ReviewController::class, 'reviews']);
Route::middleware('auth:sanctum')->get('/reviews_answers_data', [\App\Http\Controllers\ReviewAnswerController::class, 'answers']);
Route::middleware('auth:sanctum')->post('/review_send', [\App\Http\Controllers\ReviewController::class, 'newReview']);
Route::middleware('auth:sanctum')->post('/review_answer_send', [\App\Http\Controllers\ReviewAnswerController::class, 'newReviewAnswer']);
Route::middleware('auth:sanctum')->get('/user_data', [\App\Http\Controllers\UserController::class, 'user']);
