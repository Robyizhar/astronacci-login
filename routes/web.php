<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\SocialiteController;

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
/* Google Login */
Route::get('auth/google/redirect', [SocialiteController::class, 'googleRedirect'])
    ->middleware(['guest'])
    ->name('google-redirect');

Route::get('auth/google/callback', [SocialiteController::class, 'googleCallback'])
    ->middleware(['guest'])
    ->name('google-callback');
/* Google Login */

/* Facebook Login */
Route::get('auth/facebook/redirect', [SocialiteController::class, 'facebookRedirect'])
    ->middleware(['guest'])
    ->name('facebook-redirect');

Route::get('auth/facebook/callback', [SocialiteController::class, 'facebookCallback'])
    ->middleware(['guest'])
    ->name('facebook-callback');
/* Facebook Login */

Route::get('/', function () { return redirect('dashboard'); });

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
