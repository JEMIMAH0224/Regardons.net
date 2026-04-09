@extends('layouts.app')

@section('content')
<section class="verify-section">
    <div class="verify-container">

        {{-- Page title --}}
        <h1>Vérifiez votre adresse e-mail</h1>

        {{-- Short explanation for the user --}}
        <p>
            Nous avons envoyé un lien de vérification à votre adresse e-mail.
            Veuillez cliquer sur ce lien avant de continuer.
        </p>

        {{-- If a new verification email has just been sent, show a success message --}}
        @if (session('status') == 'verification-link-sent')
            <div class="success-message">
                Un nouveau lien de vérification a été envoyé.
            </div>
        @endif

        {{-- Form to resend the verification email --}}
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit">Renvoyer l'e-mail de vérification</button>
        </form>

    </div>
</section>
@endsection