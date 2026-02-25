@section('title', 'Ajouter une catégorie')
@include('partials.header')

<main class="main">
    <div class="container">

        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Mes colocations</a>
            <span>/</span>
            <a href="">{{ $colocation->name }}</a>
            <span>/</span>
            <span>Ajouter une catégorie</span>
        </nav>

        <div class="form-page">
            <div class="form-card">

                <div class="form-card-header">
                    <h1 class="form-title">Ajouter une catégorie</h1>
                    <p class="form-subtitle">{{ $colocation->name }}</p>
                </div>

                <form method="POST" action="{{ route('store_category', $colocation->id) }}">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="form-label">Nom de la catégorie</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-input-simple @error('name') is-invalid @enderror"
                            placeholder="Ex : Courses, Loyer, Électricité..."
                            required
                            autofocus
                        >
                        @error('name')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <a href="{{route('home')}}" class="btn-secondary">Annuler</a>
                        <button type="submit" class="btn-primary">Ajouter</button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</main>

@include('partials.footer')