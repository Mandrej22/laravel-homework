<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\ConversationController;


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
});

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});


// Friendship routes

Route::middleware(['auth'])->group(function () {
    Route::get('/friends', [FriendshipController::class, 'index'])->name('friends.index');
    Route::post('/friendships/{user}', [FriendshipController::class, 'sendRequest'])->name('friendships.sendRequest');
    Route::post('/friendships/{user}/accept', [FriendshipController::class, 'acceptRequest'])->name('friendships.acceptRequest');
    Route::post('/friendships/{user}/reject', [FriendshipController::class, 'rejectRequest'])->name('friendships.rejectRequest');
});

// Conversation routes

Route::middleware(['auth'])->group(function () {
    Route::get('/conversations', [ConversationController::class, 'index'])->name('conversations.index');
    Route::get('/conversations/{friend}', [ConversationController::class, 'show'])->name('conversations.show');
    Route::post('/conversations/{friend}/send', [ConversationController::class, 'sendMessage'])->name('conversations.sendMessage');
});


require __DIR__ . '/auth.php';