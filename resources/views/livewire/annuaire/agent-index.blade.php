<div>
<x-app-layout>

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
@endpush

<style>
:root {
    --aninf-navy:    #0a1628;
    --aninf-blue:    #0d47a1;
    --aninf-sky:     #1976d2;
    --aninf-accent:  #00bcd4;
    --aninf-green:   #00897b;
    --aninf-red:     #e53935;
    --aninf-surface: #f4f6fb;
    --aninf-card:    #ffffff;
    --aninf-border:  #e1e7f0;
    --aninf-text:    #1a2340;
    --aninf-muted:   #6b7a99;
    --aninf-light:   #eaf1fb;
    --radius-lg:     14px;
    --radius-md:     10px;
    --shadow-card:   0 2px 16px rgba(13,71,161,0.07), 0 1px 4px rgba(0,0,0,0.04);
    --shadow-hover:  0 8px 32px rgba(13,71,161,0.13), 0 2px 8px rgba(0,0,0,0.06);
    --font-display:  'Syne', sans-serif;
    --font-body:     'DM Sans', sans-serif;
}

* { box-sizing: border-box; margin: 0; padding: 0; }

.aninf-annuaire {
    font-family: var(--font-body);
    background: var(--aninf-surface);
    min-height: 100vh;
    color: var(--aninf-text);
}

/* ── HERO ── */
.db-hero {
    background: var(--aninf-navy);
    position: relative;
    overflow: hidden;
    padding: 2.5rem 2rem 5rem;
}
.db-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 60% 80% at 80% 50%, rgba(13,71,161,0.55) 0%, transparent 70%),
        radial-gradient(ellipse 40% 60% at 10% 80%, rgba(0,188,212,0.18) 0%, transparent 60%);
}
.db-hero::after {
    content: 'ANNUAIRE';
    position: absolute;
    right: -1rem;
    top: 50%;
    transform: translateY(-50%);
    font-family: var(--font-display);
    font-size: 7rem;
    font-weight: 800;
    color: rgba(255,255,255,0.03);
    letter-spacing: -0.02em;
    pointer-events: none;
    user-select: none;
}
.db-hero-inner {
    max-width: 1320px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    flex-wrap: wrap;
}
.db-hero-logo { display: flex; align-items: center; gap: 1rem; }
.db-hero-emblem {
    width: 52px; height: 52px;
    background: linear-gradient(135deg, var(--aninf-accent), var(--aninf-sky));
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-family: var(--font-display);
    font-size: 1rem; font-weight: 800; color: #fff;
    letter-spacing: 0.05em;
    box-shadow: 0 4px 16px rgba(0,188,212,0.35);
    flex-shrink: 0;
}
.db-hero-brand { display: flex; flex-direction: column; }
.db-hero-brand-name { font-family: var(--font-display); font-size: 1rem; font-weight: 700; color: #fff; letter-spacing: 0.08em; }
.db-hero-brand-full { font-size: 0.72rem; color: rgba(255,255,255,0.5); margin-top: 0.1rem; max-width: 320px; line-height: 1.3; }
.db-hero-center { text-align: center; flex: 1; }
.db-hero-title { font-family: var(--font-display); font-size: 1.5rem; font-weight: 800; color: #fff; letter-spacing: -0.01em; }
.db-hero-subtitle { font-size: 0.82rem; color: rgba(255,255,255,0.55); margin-top: 0.3rem; }
.db-hero-right { display: flex; flex-direction: column; align-items: flex-end; gap: 0.4rem; }
.db-badge {
    display: inline-flex; align-items: center; gap: 0.4rem;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.15);
    color: #fff;
    padding: 0.35rem 0.9rem; border-radius: 20px;
    font-size: 0.78rem; font-weight: 600;
    backdrop-filter: blur(8px);
}
.db-badge::before {
    content: ''; width: 7px; height: 7px;
    background: var(--aninf-accent); border-radius: 50%; display: inline-block;
}
.db-hero-date { font-size: 0.75rem; color: rgba(255,255,255,0.4); }

/* ── BODY ── */
.annuaire-body {
    max-width: 1320px;
    margin: -2.5rem auto 0;
    padding: 0 1.5rem 3rem;
    position: relative;
    z-index: 10;
}

/* ── CARD ── */
.card {
    background: var(--aninf-card);
    border-radius: var(--radius-lg);
    border: 1px solid var(--aninf-border);
    box-shadow: var(--shadow-card);
    overflow: hidden;
    animation: fadeUp 0.5s ease both;
}

.card-header {
    padding: 1.1rem 1.5rem;
    border-bottom: 1px solid var(--aninf-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fafbfe;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.card-header-title {
    font-family: var(--font-display);
    font-size: 0.88rem;
    font-weight: 700;
    color: var(--aninf-blue);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.card-header-title::before {
    content: '';
    width: 3px; height: 14px;
    background: var(--aninf-accent);
    border-radius: 2px;
    display: inline-block;
}

/* ── FILTRES ── */
.filters-bar {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.filter-input,
.filter-select {
    padding: 0.5rem 0.85rem;
    border: 1.5px solid var(--aninf-border);
    border-radius: var(--radius-md);
    font-family: var(--font-body);
    font-size: 0.82rem;
    color: var(--aninf-text);
    background: #fff;
    outline: none;
    transition: border-color 0.15s, box-shadow 0.15s;
    min-width: 160px;
}

.filter-input:focus,
.filter-select:focus {
    border-color: var(--aninf-accent);
    box-shadow: 0 0 0 3px rgba(0,188,212,0.1);
}

.filter-input::placeholder { color: #b0bec5; }

.filter-search-wrap {
    position: relative;
    flex: 1;
    min-width: 200px;
    max-width: 320px;
}

.filter-search-icon {
    position: absolute;
    left: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: 0.85rem;
    color: var(--aninf-muted);
    pointer-events: none;
}

.filter-search-wrap .filter-input {
    padding-left: 2.2rem;
    width: 100%;
}

/* ── TABLE ── */
.agents-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.855rem;
}

.agents-table thead tr {
    background: #f7f9fc;
    border-bottom: 1px solid var(--aninf-border);
}

.agents-table th {
    padding: 0.7rem 1.2rem;
    text-align: left;
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    color: var(--aninf-muted);
    font-weight: 700;
    white-space: nowrap;
}

.agents-table td {
    padding: 0.85rem 1.2rem;
    border-bottom: 1px solid #f0f4fa;
    color: var(--aninf-text);
    vertical-align: middle;
}

.agents-table tbody tr:last-child td { border-bottom: none; }
.agents-table tbody tr:hover td { background: #fafbfe; }

/* Avatar dans la table */
.t-avatar {
    width: 36px; height: 36px;
    border-radius: 9px;
    background: linear-gradient(135deg, var(--aninf-blue), var(--aninf-sky));
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-family: var(--font-display);
    font-size: 0.75rem;
    font-weight: 700;
    color: #fff;
    flex-shrink: 0;
    letter-spacing: 0.02em;
}

.t-agent-cell {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.t-agent-name {
    font-weight: 600;
    color: var(--aninf-navy);
    font-size: 0.875rem;
}

.t-agent-mat {
    font-size: 0.7rem;
    color: var(--aninf-muted);
    margin-top: 0.1rem;
}

.t-email {
    color: var(--aninf-muted);
    font-size: 0.82rem;
}

/* Badges */
.badge {
    display: inline-block;
    padding: 0.2rem 0.65rem;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 600;
}
.badge-active   { background: #d1fae5; color: #065f46; }
.badge-inactive { background: #fee2e2; color: #991b1b; }

/* Empty state */
.empty-state {
    text-align: center;
    padding: 3rem 1rem;
    color: var(--aninf-muted);
    font-size: 0.875rem;
}
.empty-icon { font-size: 2.5rem; margin-bottom: 0.75rem; opacity: 0.4; }

/* ── PAGINATION ── */
.pagination-wrap {
    padding: 1rem 1.5rem;
    border-top: 1px solid var(--aninf-border);
    background: #fafbfe;
    display: flex;
    align-items: center;
    justify-content: flex-end;
}

/* ── ANIMATIONS ── */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
}

@media(max-width: 768px) {
    .filters-bar { flex-direction: column; align-items: stretch; }
    .filter-search-wrap { max-width: 100%; }
    .db-hero { padding: 1.5rem 1rem 4rem; }
    .db-hero-center { display: none; }
    .agents-table th:nth-child(3),
    .agents-table td:nth-child(3) { display: none; }
}
</style>

<div class="aninf-annuaire">

    {{-- ══ HERO ══ --}}
    <div class="db-hero">
        <div class="db-hero-inner">
            <div class="db-hero-logo">
                <div class="db-hero-emblem">AN</div>
                <div class="db-hero-brand">
                    <div class="db-hero-brand-name">ANINF</div>
                    <div class="db-hero-brand-full">Agence Nationale des Infrastructures Numériques et des Fréquences</div>
                </div>
            </div>
            <div class="db-hero-center">
                <div class="db-hero-title">Annuaire des agents</div>
                <div class="db-hero-subtitle">Consultez et recherchez les agents de l'ANINF</div>
            </div>
            <div class="db-hero-right">
                <div class="db-badge">Annuaire</div>
                <div class="db-hero-date">{{ now()->translatedFormat('l d F Y') }}</div>
            </div>
        </div>
    </div>

    <div class="annuaire-body">
        <div class="card">

            {{-- ══ HEADER + FILTRES ══ --}}
            <div class="card-header">
                <div class="card-header-title">Liste des agents</div>

                <div class="filters-bar">
                    {{-- Recherche --}}
                    <div class="filter-search-wrap">
                        <span class="filter-search-icon"></span>
                        <input
                            type="text"
                            wire:model.live="search"
                            placeholder="Rechercher un agent..."
                            class="filter-input"
                        >
                    </div>

                    {{-- Filtre fonction --}}
                    <select wire:model.live="fonction_id" class="filter-select">
                        <option value="">Toutes les fonctions</option>
                        @foreach($fonctions as $f)
                            <option value="{{ $f->id }}">{{ $f->libelle }}</option>
                        @endforeach
                    </select>

                    {{-- Filtre statut --}}
                    <select wire:model.live="is_active" class="filter-select">
                        <option value="">Tous les statuts</option>
                        <option value="1">Actifs</option>
                        <option value="0">Inactifs</option>
                    </select>
                </div>
            </div>

            {{-- ══ TABLE ══ --}}
            <table class="agents-table">
                <thead>
                    <tr>
                        <th>Agent</th>
                        <th>Email</th>
                        <th>Entité</th>
                        <th>Fonction</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agents as $agent)
                        <tr>
                            <td>
                                <div class="t-agent-cell">
                                    @if($agent->photo_url)
                                        <img src="{{ asset('storage/' . $agent->photo_url) }}"
                                             alt="{{ $agent->nom_complet }}"
                                             style="width:36px;height:36px;border-radius:9px;object-fit:cover;flex-shrink:0;">
                                    @else
                                        <div class="t-avatar">
                                            {{ strtoupper(substr($agent->prenom ?? '', 0, 1) . substr($agent->nom ?? '', 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="t-agent-name">{{ $agent->nom_complet }}</div>
                                        @if($agent->matricule)
                                            <div class="t-agent-mat">{{ $agent->matricule }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="t-email">{{ $agent->email ?: '—' }}</td>
                            <td>{{ $agent->entity->nom ?? '—' }}</td>
                            <td>{{ $agent->fonction->libelle ?? '—' }}</td>
                            <td>
                                @if($agent->is_active)
                                    <span class="badge badge-active">Actif</span>
                                @else
                                    <span class="badge badge-inactive">Inactif</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-icon"></div>
                                    Aucun agent trouvé pour ces critères.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- ══ PAGINATION ══ --}}
            <div class="pagination-wrap">
                {{ $agents->links() }}
            </div>

        </div>
    </div>

</div>

</x-app-layout>
</div>