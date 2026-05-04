<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('pages.home');
})->name('homepage');

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

/* Email verification notice. After registration, unverified logged-in users land here. */
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

/* Verify email link .When user clicks the email link, mark as verified and redirect to dashboard.*/
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('dashboardpage')
        ->with('success', 'Votre adresse email a été vérifiée avec succès.');
})->middleware(['auth', 'signed'])->name('verification.verify');

/* Resend verification email */
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Un nouveau lien de vérification a été envoyé.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/* Protected verified area
This is the important part: when an unverified user is sent to 
/dashboard, the verified middleware intercepts the request 
and sends them to the verification notice route instead.
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboardpage');
});
Route::get('testmail',function (){
    Mail::raw('Ceci est le contenu de mon mail en texte brut.', function ($message) {
        $message->to('coucou@moi.com')
                ->subject('Sujet du message');
});
});