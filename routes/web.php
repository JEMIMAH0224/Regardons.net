<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('pages.home');
})->name('homepage');


/*Once email verification is enabled, the "verified" middleware to routes that should
 only be accessible after the user verifies their email. 
 Laravel’s email verification system uses that middleware to block unverified users.
 */
Route::middleware(['auth' , 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // or your gallery/home for logged in users
    })->name('dashboardpage');
});

Route::get('/about', function () {
    return view('pages.about');
})->name('aboutpage');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contactpage');



Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/article', function () {
    return view('pages.article');
})->name('blogpage');

Route::get('/gallery', function () {
    return view('pages.gallery');
})->name('gallerypage');