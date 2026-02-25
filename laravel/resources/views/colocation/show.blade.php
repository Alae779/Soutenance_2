{{-- resources/views/colocation/show.blade.php --}}
@section('title', $colocation->name . ' — EasyColoc')
@include('partials.header')

<main class="main">
    <div class="container">

        {{-- Breadcrumb --}}
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Mes colocations</a>
            <span>/</span>
            <span>{{ $colocation->name }}</span>
        </nav>

        {{-- Page header --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">{{ $colocation->name }}</h1>
                <p class="text-muted">
                    Propriétaire : <strong>{{ $colocation->name }}</strong>
                    · {{ $colocation->activeMembers->count() }} membres
                </p>
            </div>
            <div class="page-header-actions">
                @if($isOwner)
                    <a href="{{ route('invite', $colocation) }}" class="btn-secondary">
                        Inviter un membre
                    </a>
                    <form method="POST" action="{{ route('cancel', $colocation) }}"
                          onsubmit="return confirm('Annuler définitivement cette colocation ?')">
                        @csrf
                        <button type="submit" class="btn-danger">Annuler la colocation</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('leave', $colocation) }}"
                          onsubmit="return confirm('Quitter cette colocation ?')">
                        @csrf
                        <button type="submit" class="btn-danger">Quitter la colocation</button>
                    </form>
                @endif
            </div>
        </div>

        {{-- Main layout --}}
        <div class="show-layout">

            {{-- LEFT: Members --}}
            <aside class="show-sidebar">
                <div class="card">
                    <div class="card-header">
                        <h3>Membres</h3>
                        <span class="badge badge-member">{{ $colocation->activeMembers->count() }}</span>
                    </div>
                    <ul class="member-list">
                        @foreach($colocation->activeMembers as $member)
                            <li class="member-item">
                                <div class="member-avatar-initial">
                                    {{ strtoupper(substr($member->name, 0, 1)) }}
                                </div>
                                <div class="member-details">
                                    <span class="member-name">
                                        {{ $member->name }}
                                        @if($member->id === auth()->id())
                                            <em>(vous)</em>
                                        @endif
                                    </span>
                                    <span class="member-role">
                                        {{ $member->id === $colocation->owner_id ? 'Owner' : 'Membre' }}
                                    </span>
                                </div>
                                @if($isOwner && $member->id !== $colocation->owner_id)
                                    <form method="POST"
                                          action="{{ route('colocation.kick', [$colocation, $member]) }}"
                                          onsubmit="return confirm('Retirer ce membre ?')">
                                        @csrf
                                        <button type="submit" class="btn-link danger">Retirer</button>
                                    </form>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            {{-- RIGHT: Categories + Expenses --}}
            <div class="show-main">

                <div class="section-header">
                    <h2 class="section-title">Catégories & Dépenses</h2>
                    @if($isOwner)
                        <a href="{{ route('create_category', $colocation) }}" class="btn-primary">
                            + Ajouter une catégorie
                        </a>
                    @endif
                </div>

                @if($colocation->categories->isEmpty())
                    <div class="empty-state-sm">
                        <p>Aucune catégorie pour l'instant.</p>
                        @if($isOwner)
                            <a href="{{ route('create_category', $colocation) }}" class="btn-link">
                                Créer la première catégorie
                            </a>
                        @endif
                    </div>
                @else
                    <div class="categories-list">
                        @foreach($colocation->categories as $category)
                            <div class="category-block">

                                <div class="category-header">
                                    <h3 class="category-name">{{ $category->name }}</h3>
                                    <div class="category-actions">
                                        <a href=""
                                           class="btn-primary btn-sm">
                                            + Dépense
                                        </a>
                                        @if($isOwner)
                                            <form method="POST"
                                                  action=""
                                                  onsubmit="return confirm('Supprimer cette catégorie et ses dépenses ?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-link danger btn-sm">Supprimer</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>

                                @if($category->exponses->isEmpty())
                                    <p class="category-empty">Aucune dépense dans cette catégorie.</p>
                                @else
                                    <table class="expense-table">
                                        <thead>
                                            <tr>
                                                <th>Titre</th>
                                                <th>Payé par</th>
                                                <th>Date</th>
                                                <th>Montant</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($category->expenses as $expense)
                                                <tr>
                                                    <td>{{ $expense->title }}</td>
                                                    <td>{{ $expense->payer->name }}</td>
                                                    <td>{{ $expense->date->format('d/m/Y') }}</td>
                                                    <td><strong>{{ number_format($expense->amount, 2, ',', ' ') }} €</strong></td>
                                                    <td>
                                                        @if($isOwner || $expense->payer_id === auth()->id())
                                                            <form method="POST"
                                                                  action="{{ route('colocation.expenses.destroy', [$colocation, $expense]) }}"
                                                                  onsubmit="return confirm('Supprimer cette dépense ?')">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="btn-link danger">Supprimer</button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3" class="tfoot-label">Total</td>
                                                <td colspan="2" class="tfoot-total">
                                                    {{ number_format($category->expenses->sum('amount'), 2, ',', ' ') }} €
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                @endif

                            </div>
                        @endforeach
                    </div>
                @endif

            </div>

        </div>

    </div>
</main>

@include('partials.footer')