<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;


Route::get('/', [MovieController::class, 'showHomepage'])->name('home');

Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::prefix('logins')->name('logins.')->group(function () {
    Route::get('', [LoginController::class, 'showLoginForm'])->name('form');
    Route::post('', [LoginController::class, 'login'])->name('login');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});



Route::prefix('movies')->name('movies.')->group(function () {


    Route::get('', [MovieController::class, 'list'])->name('list');


    Route::middleware('auth')->group(function () {
        Route::get('/create', [MovieController::class, 'createForm'])->name('create-form'); // ถูกย้ายมาไว้ในกลุ่มที่ถูกต้อง
        Route::post('/create', [MovieController::class, 'create'])->name('create');
        Route::get('/{movie}/edit', [MovieController::class, 'updateForm'])->name('update-form');
        Route::post('/{movie}/edit', [MovieController::class, 'update'])->name('update');
        Route::post('/{movie}/delete', [MovieController::class, 'delete'])->name('delete');
    });


    Route::get('/{movie}', [MovieController::class, 'view'])->name('view');
});



Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [UserController::class, 'showSelfEditForm'])->name('profile.edit');
    Route::post('/profile', [UserController::class, 'updateSelf'])->name('profile.update');


    Route::prefix('genres')->name('genres.')->group(function () {
        Route::get('', [GenreController::class, 'list'])->name('list');
        Route::get('/create', [GenreController::class, 'createForm'])->name('create-form');
        Route::post('/create', [GenreController::class, 'create'])->name('create');
        Route::get('/{genre}/edit', [GenreController::class, 'updateForm'])->name('update-form');
        Route::post('/{genre}/edit', [GenreController::class, 'update'])->name('update');
        Route::post('/{genre}/delete', [GenreController::class, 'delete'])->name('delete');
    });


    Route::prefix('reviews')->name('reviews.')->group(function () {
        Route::post('/movies/{movie}', [ReviewController::class, 'create'])->name('create');
        Route::post('/{review}/delete', [ReviewController::class, 'delete'])->name('delete');
        Route::get('/{review}/edit', [ReviewController::class, 'showEditForm'])->name('edit-form');
        Route::post('/{review}/edit', [ReviewController::class, 'update'])->name('update');
    });


    Route::prefix('providers')->name('providers.')->group(function () {
        Route::get('', [ProviderController::class, 'list'])->name('list');
        Route::get('/create', [ProviderController::class, 'createForm'])->name('create-form');
        Route::post('/create', [ProviderController::class, 'create'])->name('create');
        Route::get('/{provider}/edit', [ProviderController::class, 'updateForm'])->name('update-form');
        Route::post('/{provider}/edit', [ProviderController::class, 'update'])->name('update');
        Route::post('/{provider}/delete', [ProviderController::class, 'delete'])->name('delete');
    });


    Route::prefix('admin/users')->name('admin.users.')->group(function () {
        Route::get('', [AdminUserController::class, 'list'])->name('list');
        Route::get('/create', [AdminUserController::class, 'showCreateForm'])->name('create-form');
        Route::post('/create', [AdminUserController::class, 'create'])->name('create');
        Route::get('/{user}/edit', [AdminUserController::class, 'updateForm'])->name('update-form');
        Route::post('/{user}/edit', [AdminUserController::class, 'update'])->name('update');
        Route::post('/{user}/delete', [AdminUserController::class, 'delete'])->name('delete');
    });
});
