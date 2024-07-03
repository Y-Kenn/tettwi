<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\FairEvaluationController;
use App\Http\Controllers\SlanderousTweetRankingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PersonalSlanderTweetController;
use App\Http\Controllers\SlanderousEvaluationController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/mypage/tweets',[PersonalSlanderTweetController::class, 'index'])
        ->name('my-tweets.index');
    Route::post('/mypage/tweets',[PersonalSlanderTweetController::class, 'store'])
        ->name('my-tweets.store');

    Route::post('/slanderous-eval',[SlanderousEvaluationController::class, 'store']);
    Route::post('/fair-eval',[FairEvaluationController::class, 'store']);
    Route::post('/bookmark',[BookmarkController::class, 'store']);

    Route::get('/ranking',[SlanderousTweetRankingController::class, 'index'])
        ->name('ranking.index');;
});

Route::get('/stest', [\App\Http\Controllers\TestController::class, 'sindex']);
Route::get('/test2', function(){
   $m = print_r(get_class_methods(\Illuminate\Support\Str::uuid()), true);
   return print_r(\Illuminate\Support\Str::uuid()->toString(), true);
});

Route::get('/test', [\App\Http\Controllers\TestController::class, 'index']);
Route::get('/next', [\App\Http\Controllers\TestController::class, 'next']);

require __DIR__.'/auth.php';


