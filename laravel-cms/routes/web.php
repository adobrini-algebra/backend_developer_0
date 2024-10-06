<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UsersController;
use App\Models\Article;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/articles', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/articles/tag/{tag}', [ArticleController::class, 'byTags'])->name('tag.articles');
Route::get('/articles/category/{category}', [ArticleController::class, 'byCategory'])->name('category.articles');
Route::get('/articles/user/{author}', [ArticleController::class, 'byAuthor'])->name('user.articles');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/articles', ArticleController::class);

    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
});

require __DIR__.'/auth.php';
