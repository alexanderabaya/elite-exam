<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\CompanySuperAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PHPTestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserSuperAdminController;
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

Route::group(['middleware' => ['guest']], function() {
    Route::get('/', function () {
        return view('auth.login');
    });
    Route::get('/forgot-password/index', [ForgotPasswordController::class, 'index'])->name('guest.forgot-password.index');
    Route::get('/reset-password/{uuid}/{token}', [ForgotPasswordController::class, 'reset'])->name('guest.forgot-password.reset');
});

Route::get('/redirect-alert/{type}/{title}/{message}/{buttonText}/{route}/{parameters?}', [DashboardController::class, 'redirectAlert'])->name('redirectAlert.index');

Route::group(['middleware' => ['auth', 'is_disabled']], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile.index');

    Route::get('/php-test/shortest-word', [PHPTestController::class, 'shortestWord'])->name('php-test.shortest-word');
    Route::get('/php-test/word-search', [PHPTestController::class, 'wordSearch'])->name('php-test.word-search');
    Route::get('/php-test/count-the-islands', [PHPTestController::class, 'countTheIslands'])->name('php-test.count-the-islands');

    //Artist
    Route::get('/artist/index', [ArtistController::class, 'index'])->name('artist.index');
    Route::get('/artist/create', [ArtistController::class, 'create'])->name('artist.create');
    Route::post('/artist/store', [ArtistController::class, 'store'])->name('artist.store');
    Route::get('/artist/show/{id}', [ArtistController::class, 'show'])->name('artist.show');
    Route::get('/artist/edit/{id}', [ArtistController::class, 'edit'])->name('artist.edit');
    Route::post('/artist/update/{id}', [ArtistController::class, 'update'])->name('artist.update');
    Route::post('/artist/delete', [ArtistController::class, 'delete'])->name('artist.delete');



    Route::group(['middleware' => ['role:Admin'], 'prefix' => 'admin'], function () {

    });
});
