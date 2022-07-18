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

Route::get('/', function () {
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
        // App::setLocale('en');
        $locale = App::getLocale();

        return Inertia::render('Dashboard',[
            'name' =>$post->name,
            'locale' => $locale
        ]);
    })->name('dashboard');

    Route::get('/dashboard2/{locale}', function ($locale) {
        $post = Post::find(1);
        App::setLocale($locale);
        $locale = App::getLocale();

        // return redirect()->back(); // not working

        return Inertia::render('Dashboard',[
            'name' =>$post->name,
            'locale' => $locale
        ]);
    })->name('dashboard2');
    // remember we are in the same page dashboard but url is different to call the locale , later we can make it as main route with closure of all other routes like mcamara :)
});
