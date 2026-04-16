@extends('layouts.app')

@section('title', 'Mot de passe oublié')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <p class="auth-eyebrow">Accès au compte</p>

        <h1 class="auth-title">Mot de passe oublié ?</h1>

        <p class="auth-text">
            Saisissez votre adresse email et nous vous enverrons un lien
            pour réinitialiser votre mot de passe.
        </p>

        @if (session('status'))
            <div class="auth-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label for="email">Adresse email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    placeholder="votreemail@exemple.com"
                    required
                    autofocus
                >

                @error('email')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="auth-btn">
                Envoyer le lien de réinitialisation
            </button>
        </form>

        <p class="auth-footer-text">
            Vous vous souvenez de votre mot de passe ?
            <a href="{{ route('login') }}">Retour à la connexion</a>
        </p>
    </div>
</div>
@endsection