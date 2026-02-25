{{-- resources/views/colocation/create.blade.php --}}
@section('title', 'Créer une colocation — EasyColoc')
@include('partials.header')

<main class="main">
    <div class="container">

        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Mes colocations</a>
            <span>/</span>
            <span>Créer une colocation</span>
        </nav>

        <div class="form-page">
            <div class="form-card">

                <div class="form-card-header">
                    <h1 class="form-title">Créer une colocation</h1>
                    <p class="form-subtitle">Vous deviendrez automatiquement le propriétaire.</p>
                </div>

                <form method="POST" action="{{ route('store_colocation') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="form-label">Nom de la colocation</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-input-simple @error('name') is-invalid @enderror"
                            placeholder="Ex : Appart Lyon 2, Coloc Centrale..."
                            required
                            autofocus
                        >
                        @error('name')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('home') }}" class="btn-secondary">Annuler</a>
                        <button type="submit" class="btn-primary">Créer la colocation</button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</main>

@include('partials.footer')