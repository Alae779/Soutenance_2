@section('title', 'Mon profil — EasyColoc')
@include('partials.header')

<main class="main">
    <div class="container">

        <div class="page-header">
            <h1 class="page-title">Mon profil</h1>
        </div>

        {{-- Flash --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="form-page" style="flex-direction: column; align-items: center;">

            {{-- Reputation --}}
            <div class="form-card" style="margin-bottom: 1.25rem;">
                <div class="form-card-header">
                    <h2 class="form-title">Réputation</h2>
                </div>
                <div style="padding: 1.5rem 1.75rem; display: flex; align-items: center; gap: 1rem;">
                    <div class="reputation-score {{ auth()->user()->reputation >= 0 ? 'positive' : 'negative' }}">
                        {{ auth()->user()->reputation }}
                    </div>
                    <p class="text-muted">
                    </p>
                </div>
            </div>

            {{-- Informations --}}
            <div class="form-card" style="margin-bottom: 1.25rem;">
                <div class="form-card-header">
                    <h2 class="form-title">Informations personnelles</h2>
                </div>
                <form method="POST" action="">
                    @csrf @method('PATCH')

                    <div class="form-group">
                        <label class="form-label">Nom</label>
                        <input type="text" name="name" value="{{ auth()->user()->name }}"
                               class="form-input-simple @error('name') is-invalid @enderror" required>
                        @error('name') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ auth()->user()->email }}"
                               class="form-input-simple @error('email') is-invalid @enderror" required>
                        @error('email') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Sauvegarder</button>
                    </div>
                </form>
            </div>

            {{-- Mot de passe --}}
            <div class="form-card">
                <div class="form-card-header">
                    <h2 class="form-title">Changer le mot de passe</h2>
                </div>
                <form method="POST" action="">
                    @csrf @method('PUT')

                    <div class="form-group">
                        <label class="form-label">Mot de passe actuel</label>
                        <input type="password" name="current_password"
                               class="form-input-simple @error('current_password') is-invalid @enderror">
                        @error('current_password') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nouveau mot de passe</label>
                        <input type="password" name="password"
                               class="form-input-simple @error('password') is-invalid @enderror">
                        @error('password') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" class="form-input-simple">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Mettre à jour</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</main>

@include('partials.footer')