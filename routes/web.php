<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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
    $contents = [];
    $person = [];
    $user = Auth::user();
    if (auth()->check()){
        $contents = auth()->user()->usersPosts()->latest()->get();  //shows only the logged in user's post sorted by newest post
        $person = auth()->user()->get();
    }
    // $contents = Post::where('user_id', auth()->id())->get();  //shows only the logged in user's post
    // $contents = Post::all(); //shows all posts
    return view('home', ['posts' => $contents], ['users' => $person], ['currentUser' => $user]);
});

Route::get('/sign-up', function () {
    return view('sign-up');
});

Route::get('/sign-in', function () {
    return view('sign-in');
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);


// Blog post related routes 
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'updatedPost']);   //put->update
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);
