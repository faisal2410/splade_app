<?php

use ProtoneMedia\Splade\Facades\SEO;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;



Route::middleware('splade')->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::get('/', function () {

SEO::title('Laravel Splade Course')
            ->description('Become the Splade expert!')
            ->keywords('laravel, splade, course');


        return view('welcome');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['verified'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::resource('categories',CategoryController::class);
    Route::resource('posts',PostController::class);

    require __DIR__.'/auth.php';
});
