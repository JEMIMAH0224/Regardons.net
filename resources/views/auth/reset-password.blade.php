@extends('layouts.app')

@section('title', 'Réinitialiser le mot de passe')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <p class="auth-eyebrow">Sécurité du compte</p>

        <h1 class="auth-title">Réinitialiser le mot de passe</h1>

        <p class="auth-text">
            Choisissez un nouveau mot de passe sécurisé pour accéder à nouveau à votre compte.
        </p>

        <form method="POST" action="{{ route('password.update') }}" class="auth-form">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="form-group">
                <label for="email">Adresse email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email', $request->email) }}"
                    placeholder="votreemail@exemple.com"
                    required
                >

                @error('email')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Nouveau mot de passe</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Entrez votre nouveau mot de passe"
                    required
                >

                @error('password')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    placeholder="Confirmez votre nouveau mot de passe"
                    required
                >
            </div>

            <button type="submit" class="auth-btn">
                Réinitialiser le mot de passe
            </button>
        </form>

        <p class="auth-footer-text">
            Retour à la page de
            <a href="{{ route('login') }}">connexion</a>
        </p>
    </div>
</div>
@endsection