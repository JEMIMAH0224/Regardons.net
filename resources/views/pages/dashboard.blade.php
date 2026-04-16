{{-- resources/views/pages/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="dashboard-wrapper">
        {{-- Top welcome header --}}
        <header class="dashboard-header">
            <div>
                <p class="dashboard-eyebrow">Tableau de bord</p>
                <h1 class="dashboard-title">
                    Bonjour, {{ auth()->user()->first_name ?? auth()->user()->name }} 👋
                </h1>
                <p class="dashboard-subtitle">
                    Vous êtes connecté en tant que
                    <span class="dashboard-role">
                        {{ auth()->user()->role ?? 'membre' }}
                    </span>.
                </p>
            </div>

            <div class="dashboard-meta">
                <p>Dernière connexion :</p>
                <p class="dashboard-meta__value">
                    {{ auth()->user()->last_login_at ?? now()->format('d/m/Y H:i') }}
                </p>
            </div>
        </header>

        {{-- Section: actions for every logged-in member --}}
        <section class="dashboard-section">
            <h2 class="dashboard-section__title">Pour vous</h2>
            <p class="dashboard-section__text">
                Accédez rapidement aux principales pages du blog.
            </p>

            <div class="dashboard-grid">
                <a href="{{ route('blogpage') }}" class="dashboard-card">
                    <h3 class="dashboard-card__title">Derniers articles</h3>
                    <p class="dashboard-card__text">
                        Parcourez les publications récentes du blog
                        et découvrez les nouveautés.
                    </p>
                    <span class="dashboard-card__link">Voir les articles →</span>
                </a>

                <a href="{{ route('gallerypage') }}" class="dashboard-card">
                    <h3 class="dashboard-card__title">Galerie</h3>
                    <p class="dashboard-card__text">
                        Retrouvez la sélection d’images, projets
                        et visuels créatifs.
                    </p>
                    <span class="dashboard-card__link">Aller à la galerie →</span>
                </a>

                <a href="{{ route('dashboardpage') }}" class="dashboard-card">
                    <h3 class="dashboard-card__title">Mon profil</h3>
                    <p class="dashboard-card__text">
                        Mettez à jour vos informations personnelles
                        et vos préférences.
                    </p>
                    <span class="dashboard-card__link">Gérer mon profil →</span>
                </a>
            </div>
        </section>

        {{-- Section: author/admin zone (only for users allowed to post) --}}
        @if(in_array(auth()->user()->role ?? 'user', ['author', 'admin']))
            <section class="dashboard-section dashboard-section--highlight">
                <h2 class="dashboard-section__title">Espace rédaction</h2>
                <p class="dashboard-section__text">
                    Vous avez les droits pour créer et gérer des articles.
                </p>

                <div class="dashboard-grid">
                    <a href="{{ route('articles.create') }}" class="dashboard-card dashboard-card--primary">
                        <h3 class="dashboard-card__title">Nouvel article</h3>
                        <p class="dashboard-card__text">
                            Écrivez et publiez un nouvel article sur le blog.
                        </p>
                        <span class="dashboard-card__link">Créer un article →</span>
                    </a>

                    <a href="{{ route('articles.index') }}" class="dashboard-card">
                        <h3 class="dashboard-card__title">Mes articles</h3>
                        <p class="dashboard-card__text">
                            Consultez, modifiez ou supprimez vos publications existantes.
                        </p>
                        <span class="dashboard-card__link">Gérer mes articles →</span>
                    </a>

                    <a href="{{ route('categories.index') }}" class="dashboard-card">
                        <h3 class="dashboard-card__title">Catégories & tags</h3>
                        <p class="dashboard-card__text">
                            Organisez les sujets du blog avec des catégories
                            et des mots‑clés.
                        </p>
                        <span class="dashboard-card__link">Organiser le contenu →</span>
                    </a>
                </div>
            </section>
        @endif

        {{-- Optional: activity placeholder --}}
        <section class="dashboard-section">
            <h2 class="dashboard-section__title">Activité récente</h2>
            <p class="dashboard-section__text">
                Bientôt : liste des derniers articles publiés, commentaires ou actions
                liées à votre compte.
            </p>

            <div class="dashboard-empty">
                <p class="dashboard-empty__title">Aucune activité pour le moment</p>
                <p class="dashboard-empty__text">
                    Dès que vous interagirez avec le blog, vos dernières actions
                    apparaîtront ici.
                </p>
            </div>
        </section>
    </div>
@endsection