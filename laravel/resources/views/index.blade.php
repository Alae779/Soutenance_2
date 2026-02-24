{{-- resources/views/home.blade.php --}}
@section('title', 'Mes colocations — EasyColoc')
@include('partials.header')

<main class="main">
    <div class="container">

        {{-- Page header --}}
        <div class="page-header">
            <h1 class="page-title">Mes colocations</h1>
            <a href="" class="btn-primary">+ Créer une colocation</a>
        </div>

        {{-- Flash messages --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        {{-- Colocation list --}}
        @if($colocations->isEmpty())

            <div class="empty-state">
                <p class="empty-icon">🏠</p>
                <h2>Aucune colocation</h2>
                <p>Vous n'êtes membre d'aucune colocation pour l'instant.</p>
                <a href="" class="btn-primary">Créer ma première colocation</a>
            </div>

        @else

            <div class="coloc-grid">
                @foreach($colocations as $coloc)
                    <div class="coloc-card">

                        <div class="coloc-card-header">
                            <h2 class="coloc-name">{{ $coloc->name }}</h2>
                            <div class="coloc-badges">
                                @if($coloc->owner_id === auth()->id())
                                    <span class="badge badge-owner">Owner</span>
                                @else
                                    <span class="badge badge-member">Membre</span>
                                @endif

                                @if($coloc->status === 'cancelled')
                                    <span class="badge badge-cancelled">Annulée</span>
                                @else
                                    <span class="badge badge-active">Active</span>
                                @endif
                            </div>
                        </div>

                        @if($coloc->description)
                            <p class="coloc-description">{{ $coloc->description }}</p>
                        @endif

                        <div class="coloc-info">
                            <span>👑 Owner : <strong>{{ $coloc->owner->name }}</strong></span>
                            <span>👥 {{ $coloc->activeMembers->count() }} membres</span>
                            <span>📅 Créée le {{ $coloc->created_at->format('d/m/Y') }}</span>
                        </div>

                        <div class="coloc-members">
                            @foreach($coloc->activeMembers as $member)
                                <span class="member-chip">{{ $member->name }}</span>
                            @endforeach
                        </div>

                        <div class="coloc-card-footer">
                            @if($coloc->status !== 'cancelled')
                                <a href="" class="btn-primary btn-sm">
                                    Voir la colocation →
                                </a>
                            @else
                                <span class="text-muted">Colocation annulée</span>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>

        @endif

    </div>
</main>

@include('partials.footer')