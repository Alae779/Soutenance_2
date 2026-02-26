@include('partials.header')

<main class="main">
    <div class="container">

        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Mes colocations</a>
            <span>/</span>
            <a href="{{ route('show_colocation', $category->colocation_id) }}"></a>
            <span>/</span>
            <span>Ajouter une dépense — {{ $category->name }}</span>
        </nav>

        <div class="form-page">
            <div class="form-card">

                <div class="form-card-header">
                    <h1 class="form-title">Ajouter une dépense</h1>
                    <p class="form-subtitle">Catégorie : {{ $category->name }}</p>
                </div>

                <form method="POST" action="{{ route('store_exponse', $category->id) }}">
                    @csrf
    
                    <div class="form-group">
                        <label for="title" class="form-label">Titre</label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            class="form-input-simple @error('title') is-invalid @enderror"
                            placeholder="Ex : Courses, Loyer..."
                            required
                            autofocus
                        >
                        @error('title')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="amount" class="form-label">Montant (€)</label>
                        <input
                            type="number"
                            id="amount"
                            name="amount"
                            value="{{ old('amount') }}"
                            class="form-input-simple @error('amount') is-invalid @enderror"
                            placeholder="0.00"
                            step="0.01"
                            min="0"
                            required
                        >
                        @error('amount')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date" class="form-label">Date</label>
                        <input
                            type="date"
                            id="date"
                            name="date"
                            value="{{ old('date', now()->format('Y-m-d')) }}"
                            class="form-input-simple @error('date') is-invalid @enderror"
                            required
                        >
                        @error('date')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('show_colocation', $category->colocation_id) }}" class="btn-secondary">Annuler</a>
                        <button type="submit" class="btn-primary">Ajouter</button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</main>

@include('partials.footer')