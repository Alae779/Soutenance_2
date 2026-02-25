@section('title', 'Inviter un membre')
@include('partials.header')

<main class="main">
    <div class="container">

        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Mes colocations</a>
            <span>/</span>
            <a href="{{ route('show_colocation', $colocation->id) }}">{{ $colocation->name }}</a>
            <span>/</span>
            <span>Inviter un membre</span>
        </nav>

        <div class="form-page">
            <div class="form-card">

                <div class="form-card-header">
                    <h1 class="form-title">Inviter un membre</h1>
                    <p class="form-subtitle">Un lien d'invitation sera envoyé par email.</p>
                </div>

                <form method="POST" action="{{ route('send_invitation', $colocation->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-input-simple @error('email') is-invalid @enderror"
                            placeholder="exemple@email.com"
                            required
                            autofocus
                        >
                        @error('email')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('send_invitation', $colocation->id) }}" class="btn-secondary">Annuler</a>
                        <button type="submit" class="btn-primary">Envoyer l'invitation</button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</main>

@include('partials.footer')