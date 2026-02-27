{{-- resources/views/partials/header.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EasyColoc')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<header class="site-header">
    <div class="header-inner">

        <a href="{{ route('home') }}" class="header-logo">
            <span class="logo-emoji">🏠</span>
            <span class="logo-text">EasyColoc</span>
        </a>

        <nav class="header-nav">
            <a href="{{ route('home') }}" class="nav-link">Mes colocations</a>
        </nav>

        <div class="header-actions">
            <span class="header-username">Hey</span>
            <a href="{{ route('profile_edit') }}" class="btn-ghost">Profil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-ghost">Déconnexion</button>
            </form>
        </div>

    </div>
</header>