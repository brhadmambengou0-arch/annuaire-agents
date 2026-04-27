<div class="annuaire-wrap">
<style>
    .annuaire-wrap { min-height: 100vh; background: #f0f9ff; font-family: 'DM Sans', sans-serif; }
    .ann-header { background: linear-gradient(135deg, #0369a1 0%, #0ea5e9 100%); padding: 2.5rem 2rem; color: white; box-shadow: 0 4px 20px rgba(3,105,161,0.25); }
    .ann-header h1 { font-family: 'Sora', sans-serif; font-size: 2rem; font-weight: 700; margin: 0 0 0.4rem 0; }
    .ann-header p { margin: 0; opacity: 0.8; font-size: 0.95rem; }
    .ann-body { padding: 2rem; max-width: 1400px; margin: 0 auto; }
    .filters-card { background: white; border-radius: 16px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; }
    .filters-grid { display: grid; grid-template-columns: 1fr 1fr 1fr 1.4fr; gap: 1rem; align-items: end; }
    .filter-group { display: flex; flex-direction: column; gap: 0.4rem; }
    .filter-group label { font-size: 0.72rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; }
    .f-select, .f-input { padding: 0.65rem 1rem; border: 1.5px solid #e2e8f0; border-radius: 10px; font-size: 0.86rem; color: #0f172a; background: #f8fafc; outline: none; font-family: 'DM Sans', sans-serif; transition: all 0.2s; width: 100%; }
    .f-select:focus, .f-input:focus { border-color: #0ea5e9; background: white; box-shadow: 0 0 0 3px rgba(14,165,233,0.1); }
    .f-select:disabled { opacity: 0.45; cursor: not-allowed; background: #f1f5f9; }
    .search-wrap { position: relative; }
    .search-wrap svg { position: absolute; left: 0.85rem; top: 50%; transform: translateY(-50%); color: #94a3b8; pointer-events: none; }
    .search-wrap .f-input { padding-left: 2.4rem; }
    .filter-hint { font-size: 0.72rem; color: #94a3b8; margin-top: 0.25rem; }
    .stats-row { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap; }
    .stat-pill { background: white; border: 1px solid #bae6fd; color: #0369a1; padding: 0.5rem 1.1rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600; }
    .stat-pill-green { background: #f0fdf4; border-color: #bbf7d0; color: #15803d; }
    .agents-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(290px, 1fr)); gap: 1.25rem; }
    .agent-card { background: white; border-radius: 14px; border: 1.5px solid #e2e8f0; padding: 1.4rem; cursor: pointer; transition: all 0.22s; box-shadow: 0 1px 4px rgba(0,0,0,0.05); display: flex; flex-direction: column; gap: 1rem; }
    .agent-card:hover { border-color: #0ea5e9; box-shadow: 0 8px 24px rgba(14,165,233,0.14); transform: translateY(-3px); }
    .card-top { display: flex; align-items: center; gap: 0.9rem; }
    .card-avatar { width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, #0ea5e9, #0369a1); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 1.1rem; flex-shrink: 0; overflow: hidden; }
    .card-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .card-name { font-size: 0.97rem; font-weight: 700; color: #0f172a; margin: 0; }
    .card-matricule { font-size: 0.78rem; color: #94a3b8; margin: 0.15rem 0 0 0; }
    .card-body { border-top: 1px solid #f1f5f9; padding-top: 0.9rem; display: flex; flex-direction: column; gap: 0.5rem; }
    .card-row { display: flex; align-items: baseline; gap: 0.5rem; font-size: 0.82rem; }
    .card-lbl { color: #94a3b8; font-weight: 600; min-width: 56px; flex-shrink: 0; }
    .card-val { color: #475569; word-break: break-word; }
    .card-footer { display: flex; align-items: center; justify-content: space-between; padding-top: 0.2rem; }
    .badge { display: inline-flex; align-items: center; gap: 0.3rem; padding: 0.28rem 0.75rem; border-radius: 20px; font-size: 0.73rem; font-weight: 700; }
    .badge-green { background: #dcfce7; color: #15803d; }
    .badge-red { background: #fee2e2; color: #b91c1c; }
    .btn-profil { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.42rem 0.9rem; background: #f0f9ff; color: #0369a1; border: 1.5px solid #bae6fd; border-radius: 8px; font-size: 0.78rem; font-weight: 700; cursor: pointer; font-family: 'DM Sans', sans-serif; transition: all 0.18s; }
    .btn-profil:hover { background: #0ea5e9; color: white; border-color: #0ea5e9; }
    .empty-state { text-align: center; padding: 4rem 2rem; background: white; border-radius: 14px; border: 1px solid #e2e8f0; grid-column: 1/-1; }
    .empty-icon { font-size: 3rem; margin-bottom: 1rem; }
    .empty-state h3 { font-size: 1.1rem; color: #374151; margin: 0 0 0.5rem 0; }
    .empty-state p { color: #94a3b8; margin: 0; font-size: 0.88rem; }
    .pagination-wrap { display: flex; justify-content: center; margin-top: 2rem; }
    .modal-bg { position: fixed; inset: 0; background: rgba(0,0,0,0.45); display: flex; align-items: center; justify-content: center; z-index: 1000; padding: 1.5rem; backdrop-filter: blur(2px); }
    .modal-box { background: white; border-radius: 18px; width: 100%; max-width: 460px; max-height: 88vh; overflow-y: auto; box-shadow: 0 28px 56px rgba(0,0,0,0.18); }
    .modal-head { padding: 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 1rem; }
    .modal-avatar { width: 58px; height: 58px; border-radius: 14px; background: linear-gradient(135deg, #0ea5e9, #0369a1); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 1.3rem; flex-shrink: 0; overflow: hidden; }
    .modal-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .modal-name { font-family: 'Sora', sans-serif; font-size: 1.15rem; font-weight: 700; color: #0f172a; margin: 0; }
    .modal-sub { font-size: 0.8rem; color: #94a3b8; margin: 0.2rem 0 0 0; }
    .modal-close { margin-left: auto; background: #f1f5f9; border: none; border-radius: 8px; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #64748b; font-size: 1rem; transition: all 0.2s; flex-shrink: 0; }
    .modal-close:hover { background: #fee2e2; color: #dc2626; }
    .modal-body { padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem; }
    .modal-field label { display: block; font-size: 0.7rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.3rem; }
    .modal-field p { margin: 0; color: #0f172a; font-size: 0.9rem; }
    .modal-field a { color: #0369a1; text-decoration: none; }
    .modal-divider { height: 1px; background: #f1f5f9; }
    .modal-foot { padding: 1rem 1.5rem; border-top: 1px solid #f1f5f9; }
    .btn-fermer { width: 100%; padding: 0.78rem; background: linear-gradient(135deg, #0ea5e9, #0369a1); color: white; border: none; border-radius: 10px; font-weight: 700; font-size: 0.9rem; cursor: pointer; font-family: 'DM Sans', sans-serif; box-shadow: 0 3px 10px rgba(14,165,233,0.3); }
    .btn-fermer:hover { opacity: 0.9; }
    @media (max-width: 900px) { .filters-grid { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 600px) { .filters-grid { grid-template-columns: 1fr; } .agents-grid { grid-template-columns: 1fr; } .ann-body { padding: 1rem; } }
</style>
<div class="ann-header">
    <h1>Annuaire des Agents</h1>
    <p>Consultez la liste complète des agents de l'ANINF</p>
</div>
<div class="ann-body">
    <div class="filters-card">
        <div class="filters-grid">
            <div class="filter-group">
                <label>Direction</label>
                <select wire:model.live="directionId" class="f-select">
                    <option value="">Toutes les directions</option>
                    @foreach($directions as $dir)
                        <option value="{{ $dir->id }}">{{ $dir->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group">
                <label>Service</label>
                <select wire:model.live="serviceId" class="f-select" {{ $services->isEmpty() ? 'disabled' : '' }}>
                    <option value="">{{ $directionId ? 'Tous les services' : 'Choisir une direction' }}</option>
                    @foreach($services as $svc)
                        <option value="{{ $svc->id }}">{{ $svc->nom }}</option>
                    @endforeach
                </select>
                @if(!$directionId)<span class="filter-hint">↑ Sélectionnez une direction d'abord</span>@endif
            </div>
            <div class="filter-group">
                <label>Fonction</label>
                <select wire:model.live="fonctionId" class="f-select">
                    <option value="">Toutes les fonctions</option>
                    @foreach($fonctions as $fn)
                        <option value="{{ $fn->id }}">{{ $fn->libelle }}</option>
                    @endforeach
                </select>
                @if($directionId && $fonctions->count() > 0)
                    <span class="filter-hint" style="color:#15803d;">{{ $fonctions->count() }} fonction(s) dans cette direction</span>
                @endif
            </div>
            <div class="filter-group">
                <label>Recherche</label>
                <div class="search-wrap">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Nom, matricule, email…" class="f-input">
                </div>
            </div>
        </div>
    </div>
    <div class="stats-row">
        <div class="stat-pill">{{ $agents->total() }} agent(s) trouvé(s)</div>
        @if($directionId)<div class="stat-pill stat-pill-green">✓ Direction</div>@endif
        @if($serviceId)<div class="stat-pill stat-pill-green">✓ Service</div>@endif
        @if($fonctionId)<div class="stat-pill stat-pill-green">✓ Fonction</div>@endif
    </div>
    @if($agents->count() > 0)
        <div class="agents-grid">
            @foreach($agents as $agent)
                <div class="agent-card" wire:click="openDetail({{ $agent->id }})">
                    <div class="card-top">
                        <div class="card-avatar">
                            @if($agent->photo_url)
                                <img src="{{ asset('storage/' . $agent->photo_url) }}" alt="Photo">
                            @else
                                {{ strtoupper(substr($agent->prenom ?? '', 0, 1) . substr($agent->nom ?? '', 0, 1)) }}
                            @endif
                        </div>
                        <div>
                            <p class="card-name">{{ $agent->prenom }} {{ $agent->nom }}</p>
                            <p class="card-matricule">{{ $agent->matricule ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($agent->fonction)
                            <div class="card-row"><span class="card-lbl">Fonction</span><span class="card-val">{{ $agent->fonction->libelle }}</span></div>
                        @endif
                        @if($agent->entity)
                            <div class="card-row"><span class="card-lbl">Entité</span><span class="card-val">{{ $agent->entity->nom }}</span></div>
                        @endif
                        @if($agent->email)
                            <div class="card-row"><span class="card-lbl">Email</span><span class="card-val">{{ $agent->email }}</span></div>
                        @endif
                    </div>
                    <div class="card-footer">
                        @if($agent->is_active)
                            <span class="badge badge-green">● Actif</span>
                        @else
                            <span class="badge badge-red">● Inactif</span>
                        @endif
                        <button type=<button type="button" class="btn-profil"
                            wire:click.stop="openDetail('1702ce4e-1447-4aaf-816b-405e1e2c2248')">>
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                            Voir profil


                            
                            
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
        @if($agents->hasPages())
            <div class="pagination-wrap">{{ $agents->links() }}</div>
        @endif
    @else
        <div class="agents-grid">
            <div class="empty-state">
                <div class="empty-icon">🔍</div>
                <h3>Aucun agent trouvé</h3>
                <p>Essayez de modifier votre recherche ou vos filtres</p>
            </div>
        </div>
    @endif
</div>
@if($showDetail && $selectedAgent)
    <div class="modal-bg" wire:click.self="closeDetail">
        <div class="modal-box">
            <div class="modal-head">
                <div class="modal-avatar">
                    @if($selectedAgent->photo_url)
                        <img src="{{ asset('storage/' . $selectedAgent->photo_url) }}" alt="Photo">
                    @else
                        {{ strtoupper(substr($selectedAgent->prenom ?? '', 0, 1) . substr($selectedAgent->nom ?? '', 0, 1)) }}
                    @endif
                </div>
                <div>
                    <p class="modal-name">{{ $selectedAgent->prenom }} {{ $selectedAgent->nom }}</p>
                    <p class="modal-sub">{{ $selectedAgent->matricule }}</p>
                </div>
                <button type="button" class="modal-close" wire:click="closeDetail">✕</button>
            </div>
            <div class="modal-body">
                @if($selectedAgent->fonction)
                    <div class="modal-field"><label>Fonction</label><p>{{ $selectedAgent->fonction->libelle }}</p></div>
                    <div class="modal-divider"></div>
                @endif
                @if($selectedAgent->entity)
                    <div class="modal-field"><label>Entité</label><p>{{ $selectedAgent->entity->nom }}</p></div>
                    @if($selectedAgent->entity->parent)
                        <div class="modal-field"><label>Direction</label><p>{{ $selectedAgent->entity->parent->nom }}</p></div>
                    @endif
                    <div class="modal-divider"></div>
                @endif
                @if($selectedAgent->email)
                    <div class="modal-field"><label>Email</label><p><a href="mailto:{{ $selectedAgent->email }}">{{ $selectedAgent->email }}</a></p></div>
                @endif
                @if($selectedAgent->telephone_professionnel)
                    <div class="modal-field"><label>Téléphone</label><p>{{ $selectedAgent->telephone_professionnel }}</p></div>
                @endif
                @if($selectedAgent->bureau)
                    <div class="modal-field"><label>Bureau</label><p>{{ $selectedAgent->bureau }}</p></div>
                @endif
                @if($selectedAgent->date_prise_fonction)
                    <div class="modal-field"><label>Prise de fonction</label><p>{{ \Carbon\Carbon::parse($selectedAgent->date_prise_fonction)->format('d/m/Y') }}</p></div>
                @endif
                <div class="modal-divider"></div>
                <div class="modal-field">
                    <label>Statut</label>
                    <p>
                        @if($selectedAgent->is_active)
                            <span class="badge badge-green">● Actif</span>
                        @else
                            <span class="badge badge-red">● Inactif</span>
                        @endif
                    </p>
                </div>
            </div>
            <div class="modal-foot">
                <button type="button" class="btn-fermer" wire:click="closeDetail">Fermer</button>
            </div>
        </div>
    </div>
@endif
</div>
