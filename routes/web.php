<?php

use App\Http\Controllers\PostDashboardController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title' => 'Home']);
});

Route::get('/posts', function() {
    // $posts = Post::with('author', 'category')->latest()->get();
    $posts = Post::latest()->filter(request(['search', 'category', 'author']))->paginate(5)->withQueryString();
    return view('posts', ['title' => 'Blog', 'posts' => $posts]);
});

Route::get('/posts/{post:slug}', function(Post $post) {
    return view('post', ['title' => $post->title, 'post' => $post]);
});

Route::get('/about', function () {
    return view('about', ['title' => 'About']);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', [PostDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
// Route::post('/dashboard', [PostDashboardController::class, 'store'])->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/dashboard/create', [PostDashboardController::class, 'create'])->middleware(['auth', 'verified']);
// Route::delete('/dashboard/{post:slug}', [PostDashboardController::class, 'destroy'])->middleware(['auth', 'verified']);
// Route::get('/dashboard/{post:slug}', [PostDashboardController::class, 'show'])->middleware(['auth', 'verified']);

// route group
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [PostDashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [PostDashboardController::class, 'store']);
    Route::get('/dashboard/create', [PostDashboardController::class, 'create']);
    Route::delete('/dashboard/{post:slug}', [PostDashboardController::class, 'destroy']);
    Route::get('/dashboard/{post:slug}', [PostDashboardController::class, 'show']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
