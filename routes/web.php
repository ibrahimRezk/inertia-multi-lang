<?php

use App\Models\Post;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/home', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        $post = Post::find(1);
        $locale = App::getLocale();


        return Inertia::render('Dashboard', [
            'name' => $post->name,
            'locale' => $locale
        ]);
    })->name('dashboard')->middleware('Lang');

    Route::get('/dashboard2', function () {
        $post = Post::find(1);
        $locale = App::getLocale();


        return Inertia::render('Dashboard2', [
            'name' => $post->name,
            'locale' => $locale
        ]);
    })->name('dashboard2')->middleware('Lang');



    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('/{locale}/{currentPage}', function ($locale, $currentPage) {
        $post = Post::find(1);
        App::setLocale($locale);
        session()->put('lang',$locale);
        return Inertia::render($currentPage, [
            'name' => $post->name,
            'locale' => $locale
        ]);
    })->name('lang');
    ////////////////////////////////////////////////////////////////////////////////////////////////////
});
