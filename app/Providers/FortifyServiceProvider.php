<?php

namespace App\Providers;

// Fortify action classes that handle user creation, password reset, etc.
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;

// Used to configure rate limiting for Fortify routes (e.g., login attempts)
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

// Base service provider class that all service providers extend
use Illuminate\Support\ServiceProvider;

// Main Fortify facade used to configure Fortify behavior and views
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * This method is used to bind things into the service container.
     */
    public function register(): void
    {
        // Nothing to register for Fortify in this project.
    }

    /**
     * Bootstrap any application services.
     *
     * This method runs when the app boots and is where we tell
     * Fortify which Blade views and actions it should use.
     */
    public function boot(): void
    {
        /* Login view
          When a user visits GET /login, Fortify will call this closure
          and render the Blade view we return here.
          In this case: resources/views/auth/login.blade.php
         */
        Fortify::loginView(function () {
            return view('auth.login');
        });

        /* Register view
          When a user visits GET /register, Fortify will call this closure
          and render our custom registration form view.
          Here: resources/views/auth/register.blade.php
         */
        Fortify::registerView(function () {
            return view('auth.register');
        });

        /* Email verification notice view
          When an authenticated user is NOT verified and hits a route
          that uses the "verified" middleware, Laravel will redirect
          them to the verification notice route (verification.notice).
         
          Fortify uses this closure to know which view to show there.
          Here: resources/views/auth/verify-email.blade.php
         */
        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });

        /* Forgot password view (request reset link)
          When a user visits GET /forgot-password (password.request),
          Fortify needs to know which view will display the form where
          they enter their email to request a reset link.
         
          Here: resources/views/auth/forgot-password.blade.php
         */
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });

        /* Reset password view (form from email link)
          When a user clicks the reset link from the email, they are
          sent to a URL that contains the token. Fortify passes the
          current Request to this closure, so we forward it to the view.
         
          Here: resources/views/auth/reset-password.blade.php
         */
        Fortify::resetPasswordView(function ($request) {
            // We pass the $request so the view can access the token and email
            return view('auth.reset-password', ['request' => $request]);
        });

        /* Fortify actions configuration
          These lines tell Fortify which "action" classes should handle
          the core auth operations: creating users, updating profile
          information, changing passwords, and resetting passwords.
         
          Each of these classes lives in app/Actions/Fortify.
         */

        // Called when a new user registers
        Fortify::createUsersUsing(CreateNewUser::class);

        // Called when a user updates their name/email/etc. on the profile page
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);

        // Called when a user changes their password from the profile page
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);

        // Called when a user resets their password via the "forgot password" flow
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        /* Rate limiting for login
          Here we define a named rate limiter called "login". Fortify
          uses this to limit how many login attempts a single email/IP
          combination can make per minute (to slow down brute‑force attacks).
         */
        RateLimiter::for('login', function (Request $request) {
            // Allow 5 login attempts per minute for each (email + IP) pair
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });
    }
}