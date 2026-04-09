{{--
    FICHIER : resources/views/livewire/admin/dashboard.blade.php
    INSTITUTION : ANINF — Agence Nationale des Infrastructures Numériques et des Fréquences
    COMPOSANT : App\Livewire\Admin\Dashboard
--}}
<div>
<x-app-layout>

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
@endpush

<style>
/* ═══════════════════════════════════════════
   VARIABLES & RESET
═══════════════════════════════════════════ */
:root {
    --aninf-navy:    #0a1628;
    --aninf-blue:    #0d47a1;
    --aninf-sky:     #1976d2;
    --aninf-accent:  #00bcd4;
    --aninf-gold:    #ffc107;
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

.aninf-db {
    font-family: var(--font-body);
    background: var(--aninf-surface);
    min-height: 100vh;
    color: var(--aninf-text);
}

/* ═══════════════════════════════════════════
   HEADER HERO
═══════════════════════════════════════════ */
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
    content: 'ANINF';
    position: absolute;
    right: -1rem;
    top: 50%;
    transform: translateY(-50%);
    font-family: var(--font-display);
    font-size: 9rem;
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

.db-hero-logo {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.db-hero-emblem {
    width: 52px;
    height: 52px;
    background: linear-gradient(135deg, var(--aninf-accent), var(--aninf-sky));
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--font-display);
    font-size: 1rem;
    font-weight: 800;
    color: #fff;
    letter-spacing: 0.05em;
    box-shadow: 0 4px 16px rgba(0,188,212,0.35);
    flex-shrink: 0;
}

.db-hero-brand {
    display: flex;
    flex-direction: column;
}

.db-hero-brand-name {
    font-family: var(--font-display);
    font-size: 1rem;
    font-weight: 700;
    color: #fff;
    letter-spacing: 0.08em;
}

.db-hero-brand-full {
    font-size: 0.72rem;
    color: rgba(255,255,255,0.5);
    margin-top: 0.1rem;
    max-width: 320px;
    line-height: 1.3;
}

.db-hero-center {
    text-align: center;
    flex: 1;
}

.db-hero-title {
    font-family: var(--font-display);
    font-size: 1.5rem;
    font-weight: 800;
    color: #fff;
    letter-spacing: -0.01em;
}

.db-hero-subtitle {
    font-size: 0.82rem;
    color: rgba(255,255,255,0.55);
    margin-top: 0.3rem;
}

.db-hero-right {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 0.4rem;
}

.db-badge-admin {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.15);
    color: #fff;
    padding: 0.35rem 0.9rem;
    border-radius: 20px;
    font-size: 0.78rem;
    font-weight: 600;
    backdrop-filter: blur(8px);
}

.db-badge-admin::before {
    content: '';
    width: 7px;
    height: 7px;
    background: var(--aninf-accent);
    border-radius: 50%;
    display: inline-block;
}

.db-hero-date {
    font-size: 0.75rem;
    color: rgba(255,255,255,0.4);
}

/* ═══════════════════════════════════════════
   BODY
═══════════════════════════════════════════ */
.db-body {
    max-width: 1320px;
    margin: -2.5rem auto 0;
    padding: 0 1.5rem 3rem;
    position: relative;
    z-index: 10;
}

/* ═══════════════════════════════════════════
   STAT CARDS
═══════════════════════════════════════════ */
.stats-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.stat-card {
    background: var(--aninf-card);
    border-radius: var(--radius-lg);
    padding: 1.5rem 1.4rem;
    box-shadow: var(--shadow-card);
    border: 1px solid var(--aninf-border);
    position: relative;
    overflow: hidden;
    transition: transform 0.2s, box-shadow 0.2s;
    animation: fadeUp 0.5s ease both;
}

.stat-card:nth-child(1) { animation-delay: 0.05s; }
.stat-card:nth-child(2) { animation-delay: 0.10s; }
.stat-card:nth-child(3) { animation-delay: 0.15s; }
.stat-card:nth-child(4) { animation-delay: 0.20s; }

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-hover);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    border-radius: var(--radius-lg) var(--radius-lg) 0 0;
}

.stat-card.sc-users::before   { background: linear-gradient(90deg, var(--aninf-sky), var(--aninf-accent)); }
.stat-card.sc-agents::before  { background: linear-gradient(90deg, var(--aninf-green), #26a69a); }
.stat-card.sc-entities::before{ background: linear-gradient(90deg, #f57c00, var(--aninf-gold)); }
.stat-card.sc-fonctions::before{ background: linear-gradient(90deg, #7b1fa2, #ab47bc); }

.stat-card::after {
    content: '';
    position: absolute;
    right: -12px;
    bottom: -12px;
    width: 72px;
    height: 72px;
    border-radius: 50%;
    opacity: 0.06;
}

.stat-card.sc-users::after    { background: var(--aninf-sky); }
.stat-card.sc-agents::after   { background: var(--aninf-green); }
.stat-card.sc-entities::after { background: #f57c00; }
.stat-card.sc-fonctions::after{ background: #7b1fa2; }

.stat-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    margin-bottom: 1rem;
}

.stat-card.sc-users .stat-icon    { background: #e3f2fd; }
.stat-card.sc-agents .stat-icon   { background: #e0f2f1; }
.stat-card.sc-entities .stat-icon { background: #fff3e0; }
.stat-card.sc-fonctions .stat-icon{ background: #f3e5f5; }

.stat-num {
    font-family: var(--font-display);
    font-size: 2.6rem;
    font-weight: 800;
    color: var(--aninf-navy);
    line-height: 1;
    letter-spacing: -0.03em;
}

.stat-label {
    font-size: 0.78rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    color: var(--aninf-muted);
    margin-top: 0.35rem;
}

.stat-desc {
    font-size: 0.73rem;
    color: #b0bec5;
    margin-top: 0.2rem;
}

/* ═══════════════════════════════════════════
   LAYOUT GRILLE
═══════════════════════════════════════════ */
.content-grid {
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 1.25rem;
    margin-bottom: 1.25rem;
}

/* ═══════════════════════════════════════════
   CARD BASE
═══════════════════════════════════════════ */
.card {
    background: var(--aninf-card);
    border-radius: var(--radius-lg);
    border: 1px solid var(--aninf-border);
    box-shadow: var(--shadow-card);
    overflow: hidden;
    animation: fadeUp 0.5s ease both;
    animation-delay: 0.25s;
}

.card-header {
    padding: 1.1rem 1.5rem;
    border-bottom: 1px solid var(--aninf-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fafbfe;
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
    width: 3px;
    height: 14px;
    background: var(--aninf-accent);
    border-radius: 2px;
    display: inline-block;
}

.card-link {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--aninf-sky);
    text-decoration: none;
    padding: 0.3rem 0.75rem;
    border-radius: 6px;
    background: var(--aninf-light);
    transition: background 0.15s;
}

.card-link:hover { background: #d0e4fa; }

.card-body { padding: 1.25rem 1.5rem; }

/* ═══════════════════════════════════════════
   RECENT LIST
═══════════════════════════════════════════ */
.recent-list {
    display: flex;
    flex-direction: column;
    gap: 0;
}

.recent-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.9rem 1.5rem;
    border-bottom: 1px solid #f0f4fa;
    transition: background 0.15s;
}

.recent-item:last-child { border-bottom: none; }
.recent-item:hover { background: #fafbfe; }

.r-avatar {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--font-display);
    font-size: 0.82rem;
    font-weight: 700;
    color: #fff;
    flex-shrink: 0;
    letter-spacing: 0.02em;
}

.r-avatar.blue   { background: linear-gradient(135deg, var(--aninf-blue), var(--aninf-sky)); }
.r-avatar.teal   { background: linear-gradient(135deg, var(--aninf-green), #26c6da); }
.r-avatar.purple { background: linear-gradient(135deg, #7b1fa2, #ab47bc); }

.r-info { flex: 1; min-width: 0; }

.r-name {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--aninf-text);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.r-sub {
    font-size: 0.75rem;
    color: var(--aninf-muted);
    margin-top: 0.1rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.r-time {
    font-size: 0.7rem;
    color: #b0bec5;
    white-space: nowrap;
    flex-shrink: 0;
}

.empty-state {
    text-align: center;
    padding: 2rem 1rem;
    color: var(--aninf-muted);
    font-size: 0.85rem;
}

.empty-state-icon {
    font-size: 2rem;
    margin-bottom: 0.5rem;
    opacity: 0.4;
}

/* ═══════════════════════════════════════════
   SIDEBAR — ACTIONS
═══════════════════════════════════════════ */
.actions-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
    padding: 1.25rem 1.5rem;
}

.action-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 1.1rem 0.75rem;
    border-radius: var(--radius-md);
    text-decoration: none;
    border: 1.5px solid var(--aninf-border);
    background: #fafbfe;
    transition: all 0.18s;
    text-align: center;
}

.action-btn:hover {
    border-color: var(--aninf-accent);
    background: #e0f7fa;
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(0,188,212,0.12);
}

.action-btn-icon {
    width: 38px;
    height: 38px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    background: var(--aninf-light);
}

.action-btn:hover .action-btn-icon { background: rgba(0,188,212,0.15); }

.action-btn-label {
    font-size: 0.76rem;
    font-weight: 700;
    color: var(--aninf-blue);
    line-height: 1.2;
}

.action-btn-desc {
    font-size: 0.68rem;
    color: var(--aninf-muted);
}

/* ═══════════════════════════════════════════
   SYSTÈME INFO
═══════════════════════════════════════════ */
.sys-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.6rem;
    padding: 1.25rem 1.5rem;
}

.sys-item {
    background: var(--aninf-surface);
    border-radius: var(--radius-md);
    padding: 0.7rem 0.85rem;
    border: 1px solid var(--aninf-border);
}

.sys-label {
    font-size: 0.68rem;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    color: var(--aninf-muted);
    font-weight: 600;
    margin-bottom: 0.2rem;
}

.sys-value {
    font-size: 0.82rem;
    font-weight: 700;
    color: var(--aninf-navy);
}

/* ═══════════════════════════════════════════
   ALERTE INACTIFS
═══════════════════════════════════════════ */
.alert-card {
    background: #fffbf0;
    border: 1.5px solid #ffe082;
    border-left: 4px solid var(--aninf-gold);
    border-radius: var(--radius-lg);
    padding: 1rem 1.25rem;
    display: flex;
    align-items: center;
    gap: 0.9rem;
    animation: fadeUp 0.5s ease both;
    animation-delay: 0.3s;
}

.alert-icon {
    font-size: 1.4rem;
    flex-shrink: 0;
}

.alert-body { flex: 1; }

.alert-title {
    font-size: 0.85rem;
    font-weight: 700;
    color: #b45309;
}

.alert-text {
    font-size: 0.78rem;
    color: #92400e;
    margin-top: 0.15rem;
}

.btn-sm {
    display: inline-flex;
    align-items: center;
    padding: 0.35rem 0.85rem;
    border-radius: 7px;
    font-size: 0.76rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.15s;
    border: none;
    cursor: pointer;
}

.btn-primary { background: var(--aninf-blue); color: #fff; }
.btn-primary:hover { background: var(--aninf-sky); }
.btn-gold { background: var(--aninf-gold); color: #78350f; }
.btn-gold:hover { background: #ffb300; }

/* ═══════════════════════════════════════════
   TABLE RÉPARTITION
═══════════════════════════════════════════ */
.rep-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.85rem;
}

.rep-table th {
    padding: 0.65rem 1rem;
    text-align: left;
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    color: var(--aninf-muted);
    font-weight: 700;
    background: #f7f9fc;
    border-bottom: 1px solid var(--aninf-border);
}

.rep-table th:first-child { padding-left: 1.5rem; }
.rep-table th:last-child  { padding-right: 1.5rem; }

.rep-table td {
    padding: 0.85rem 1rem;
    border-bottom: 1px solid #f0f4fa;
    color: var(--aninf-text);
    vertical-align: middle;
}

.rep-table td:first-child { padding-left: 1.5rem; }
.rep-table td:last-child  { padding-right: 1.5rem; }

.rep-table tr:last-child td { border-bottom: none; }
.rep-table tbody tr:hover td { background: #fafbfe; }

.entity-name {
    font-weight: 600;
    color: var(--aninf-navy);
    font-size: 0.86rem;
}

.badge {
    display: inline-block;
    padding: 0.2rem 0.6rem;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 600;
}

.badge-direction   { background: #dbeafe; color: #1e40af; }
.badge-service     { background: #d1fae5; color: #065f46; }
.badge-departement { background: #fce7f3; color: #9d174d; }
.badge-admin       { background: #dbeafe; color: #1e40af; }
.badge-consultant  { background: #d1fae5; color: #065f46; }
.badge-active      { background: #d1fae5; color: #065f46; }
.badge-inactive    { background: #fee2e2; color: #991b1b; }

.progress-bar {
    height: 6px;
    background: #e2e8f0;
    border-radius: 3px;
    overflow: hidden;
    max-width: 120px;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--aninf-sky), var(--aninf-accent));
    border-radius: 3px;
    transition: width 0.6s ease;
}

.progress-row {
    display: flex;
    align-items: center;
    gap: 0.6rem;
}

.progress-pct {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--aninf-muted);
    min-width: 34px;
}

/* ═══════════════════════════════════════════
   FOOTER DASHBOARD
═══════════════════════════════════════════ */
.db-footer {
    text-align: center;
    padding: 1.5rem 0 0;
    font-size: 0.73rem;
    color: #b0bec5;
    border-top: 1px solid var(--aninf-border);
    margin-top: 0.5rem;
}

.db-footer strong { color: var(--aninf-muted); }

/* ═══════════════════════════════════════════
   ANIMATIONS
═══════════════════════════════════════════ */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ═══════════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════════ */
@media(max-width: 1100px) {
    .content-grid { grid-template-columns: 1fr; }
    .stats-row    { grid-template-columns: repeat(2, 1fr); }
}

@media(max-width: 640px) {
    .stats-row    { grid-template-columns: 1fr; }
    .actions-grid { grid-template-columns: 1fr 1fr; }
    .sys-grid     { grid-template-columns: 1fr; }
    .db-hero      { padding: 1.5rem 1rem 4rem; }
    .db-hero-center { display: none; }
}
</style>

<div class="aninf-db">

    {{-- ══ HERO HEADER ══ --}}
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
                <div class="db-hero-title">Tableau de bord</div>
                <div class="db-hero-subtitle">Administration — Gestion des agents et des structures</div>
            </div>
            <div class="db-hero-right">
                <div class="db-badge-admin">Administrateur</div>
                <div class="db-hero-date">{{ now()->translatedFormat('l d F Y — H:i') }}</div>
            </div>
        </div>
    </div>

    <div class="db-body">

        {{-- ══ STATISTIQUES ══ --}}
        <div class="stats-row">
            <div class="stat-card sc-users">
                <div class="stat-icon"></div>
                <div class="stat-num">{{ $total_users }}</div>
                <div class="stat-label">Utilisateurs</div>
                <div class="stat-desc">Comptes enregistrés</div>
            </div>
            <div class="stat-card sc-agents">
                <div class="stat-icon"></div>
                <div class="stat-num">{{ $total_agents }}</div>
                <div class="stat-label">Agents actifs</div>
                <div class="stat-desc">Dans l'annuaire</div>
            </div>
            <div class="stat-card sc-entities">
                <div class="stat-icon"></div>
                <div class="stat-num">{{ $total_entities }}</div>
                <div class="stat-label">Entités</div>
                <div class="stat-desc">Directions & services</div>
            </div>
            <div class="stat-card sc-fonctions">
                <div class="stat-icon"></div>
                <div class="stat-num">{{ $total_fonctions }}</div>
                <div class="stat-label">Fonctions</div>
                <div class="stat-desc">Postes du référentiel</div>
            </div>
        </div>

        {{-- ══ ALERTE INACTIFS ══ --}}
        @if(isset($agents_inactifs) && $agents_inactifs > 0)
        <div class="alert-card" style="margin-bottom:1.25rem;">
            <div class="alert-icon"></div>
            <div class="alert-body">
                <div class="alert-title">Agents désactivés</div>
                <div class="alert-text">
                    <strong>{{ $agents_inactifs }}</strong> agent(s) désactivé(s) ne figurent pas dans l'annuaire public.
                </div>
            </div>
            <a href="{{ route('annuaire.index') }}" class="btn-sm btn-gold">Gérer</a>
        </div>
        @endif

        {{-- ══ GRILLE PRINCIPALE ══ --}}
        <div class="content-grid">

            {{-- COLONNE GAUCHE --}}
            <div style="display:flex; flex-direction:column; gap:1.25rem;">

                {{-- Agents récents --}}
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title">Agents récemment ajoutés</div>
                        <a href="{{ route('annuaire.index') }}" class="card-link">Voir tout →</a>
                    </div>
                    <div class="recent-list">
                        @forelse($recent_agents as $agent)
                        <div class="recent-item">
                            <div class="r-avatar teal">
                                {{ strtoupper(substr($agent->prenom, 0, 1) . substr($agent->nom, 0, 1)) }}
                            </div>
                            <div class="r-info">
                                <div class="r-name">{{ $agent->prenom }} {{ $agent->nom }}</div>
                                <div class="r-sub">
                                    {{ $agent->matricule ?? '—' }}
                                    &nbsp;·&nbsp; {{ $agent->fonction->libelle ?? 'Sans fonction' }}
                                    &nbsp;·&nbsp; {{ $agent->entity->nom ?? 'Sans entité' }}
                                </div>
                            </div>
                            <div class="r-time">{{ $agent->created_at->diffForHumans() }}</div>
                        </div>
                        @empty
                        <div class="empty-state">
                            <div class="empty-state-icon"></div>
                            Aucun agent enregistré.
                        </div>
                        @endforelse
                    </div>
                </div>

                {{-- Utilisateurs récents --}}
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title">Utilisateurs récemment créés</div>
                    </div>
                    <div class="recent-list">
                        @forelse($recent_users as $user)
                        <div class="recent-item">
                            <div class="r-avatar blue">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <div class="r-info">
                                <div class="r-name">{{ $user->name }}</div>
                                <div class="r-sub">
                                    {{ $user->email }}
                                    &nbsp;
                                    <span class="badge badge-{{ $user->role ?? 'consultant' }}">{{ ucfirst($user->role ?? 'consultant') }}</span>
                                </div>
                            </div>
                            <div class="r-time">{{ $user->created_at->diffForHumans() }}</div>
                        </div>
                        @empty
                        <div class="empty-state">
                            <div class="empty-state-icon"></div>
                            Aucun utilisateur.
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>

            {{-- COLONNE DROITE --}}
            <div style="display:flex; flex-direction:column; gap:1.25rem;">

                {{-- Actions rapides --}}
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title">Actions rapides</div>
                    </div>
                    <div class="actions-grid">
                        <a href="{{ route('annuaire.index') }}" class="action-btn">
                            <div class="action-btn-icon"></div>
                            <div class="action-btn-label">Annuaire</div>
                            <div class="action-btn-desc">Consulter les agents</div>
                        </a>
                        <a href="{{ route('admin.entities') }}" class="action-btn">
                            <div class="action-btn-icon"></div>
                            <div class="action-btn-label">Entités</div>
                            <div class="action-btn-desc">Gérer les structures</div>
                        </a>
                        <a href="{{ route('admin.fonctions') }}" class="action-btn">
                            <div class="action-btn-icon"></div>
                            <div class="action-btn-label">Fonctions</div>
                            <div class="action-btn-desc">Référentiel postes</div>
                        </a>
                        <a href="{{ route('annuaire.index') }}" class="action-btn">
                            <div class="action-btn-icon"></div>
                            <div class="action-btn-label">Ajouter</div>
                            <div class="action-btn-desc">Nouvel agent</div>
                        </a>
                    </div>
                </div>

                
               
                

            
    

        {{-- ══ RÉPARTITION PAR ENTITÉ ══ --}}
        <div class="card" style="animation-delay:0.35s;">
            <div class="card-header">
                <div class="card-header-title">Répartition des agents par direction</div>
            </div>
            @if(isset($repartition) && $repartition->count() > 0)
            <table class="rep-table">
                <thead>
                    <tr>
                        <th>Direction / Entité</th>
                        <th>Type</th>
                        <th>Agents</th>
                        <th>Part du total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($repartition as $row)
                    <tr>
                        <td><span class="entity-name">{{ $row->nom }}</span></td>
                        <td><span class="badge badge-{{ $row->type }}">{{ ucfirst($row->type) }}</span></td>
                        <td style="font-weight:700; color:var(--aninf-navy);">{{ $row->nb_agents }}</td>
                        <td>
                            @if($total_agents > 0)
                            <div class="progress-row">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width:{{ round($row->nb_agents / $total_agents * 100) }}%"></div>
                                </div>
                                <span class="progress-pct">{{ round($row->nb_agents / $total_agents * 100) }}%</span>
                            </div>
                            @else
                            <span style="color:#b0bec5; font-size:0.78rem;">—</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state" style="padding:2.5rem;">
                <div class="empty-state-icon"></div>
                Aucune donnée de répartition disponible.
            </div>
            @endif
        </div>

       

    </div>
</div>

</x-app-layout>
</div>