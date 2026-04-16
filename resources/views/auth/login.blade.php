@extends('layouts.app')

@section('content')

<section class="login-section">
    <div class="login-container">

        {{-- LEFT PANEL (logo + big image + small text) --}}
        <div class="login-left">
        
            <div class="login-image-wrapper">
                <img 
                    src="{{ asset('images/login-image.jpg') }}" 
                    alt="Illustration nature photographique" 
                    class="login-image"
                >
            </div>

            {{-- Left panel title --}}
            <h2 class="login-left-title">
                Rejoignez la communauté<br>
                nature photographique
            </h2>

            {{-- Left panel description --}}
            <p class="login-left-text">
                Partagez vos photos, apprenez aux côtés de passionnés, et participez à faire vivre la nature.
            </p>
        </div>

        {{-- RIGHT PANEL (actual login form)--}}
        <div class="login-right">

            {{-- Main page title --}}
            <h1 class="login-title">Connexion</h1>

            {{-- Subtitle under the title --}}
            <p class="login-subtitle">
                Connectez-vous à votre compte
            </p>

            {{-- 
                Login form.
                route('login') is the Fortify POST login route.
            --}}
            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf

                {{-- Email field --}}
                <div class="form-group">
                    <label for="email">ADRESSE EMAIL</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="marie@exemple.fr"
                    >
                </div>

                {{-- Password field + "forgotten password" link row --}}
                <div class="form-group">
                    <label for="password">MOT DE PASSE</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="••••••••"
                    >
                    <div class="forgot-row">
                        <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                    </div>
                </div>

                {{-- Submit button --}}
                <button type="submit" class="login-submit-btn">
                    SE CONNECTER
                </button>
            </form>

            {{-- Link to registration page --}}
            <p class="register-text">
                Pas encore de compte ? <a href="{{ route('register') }}">Inscription</a>
            </p>


        </div>
    </div>
</section>

@endsection