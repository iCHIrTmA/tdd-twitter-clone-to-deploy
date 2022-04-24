<?php

use App\Http\Controllers\ExploreController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
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

Route::middleware('auth')->group(function () {
    Route::get('/tweets', [TweetController::class, 'index'])->name('home');
    Route::post('/tweets', [TweetController::class, 'store'])->name('tweets.store');
    Route::post('/follow/{user:username}', [FollowController::class, 'store'])->name('follows.store');
    Route::patch('/profiles/{user:username}', [ProfileController::class, 'update'])->name('profiles.update');
});

Route::get('/explore', ExploreController::class)->name('explore.index');
Route::get('/profiles/{user:username}', [ProfileController::class, 'show'])->name('profiles.show');
Route::get('/profiles/{user:username}/edit', [ProfileController::class, 'edit'])->middleware('can:edit,user')->name('profiles.edit');


require __DIR__.'/auth.php';
