{{--
    FICHIER : resources/views/livewire/annuaire/directory-index.blade.php
    COMPOSANT : App\Livewire\Annuaire\DirectoryIndex
    RÔLE : Page principale de l'annuaire.
           Recherche temps réel (wire:model.live.debounce.300ms),
           filtres par direction / entité / fonction,
           grille de cartes agents paginée (24 par page),
           sidebar organisationnelle,
           bouton Ajouter réservé aux admins.
    ACCÈS : Tout utilisateur authentifié (consultant + admin)
--}}
<div>
<x-app-layout>
<style>
.annuaire-page { background: #f1f5f9; min-height: calc(100vh - 60px); }

/* En-tête */
.annuaire-header {
    background: linear-gradient(135deg, #0369a1 0%, #0ea5e9 100%);
    padding: 1.5rem 2rem;
}
.annuaire-header-inner { max-width: 1280px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; }
.annuaire-header h1 { color: #fff; font-size: 1.3rem; font-weight: 700; }
.annuaire-header-sub { color: rgba(255,255,255,0.75); font-size: 0.82rem; }

/* Corps */
.annuaire-body { max-width: 1280px; margin: 0 auto; padding: 1.5rem; display: grid; grid-template-columns: 240px 1fr; gap: 1.5rem; }

/* Barre de recherche & filtres */
.search-bar {
    display: flex; flex-wrap: wrap; gap: 0.75rem;
    background: #fff; border: 1px solid #e2e8f0; border-radius: 10px;
    padding: 1rem; margin-bottom: 1.25rem; box-shadow: 0 1px 4px rgba(0,0,0,0.05);
}
.search-input {
    flex: 1; min-width: 200px;
    padding: 0.6rem 0.9rem; border: 1px solid #e2e8f0; border-radius: 8px;
    font-size: 0.9rem; color: #334155; outline: none; transition: border-color 0.15s;
}
.search-input:focus { border-color: #0ea5e9; box-shadow: 0 0 0 3px rgba(14,165,233,0.12); }
.filter-select {
    padding: 0.6rem 0.8rem; border: 1px solid #e2e8f0; border-radius: 8px;
    font-size: 0.85rem; color: #334155; background: #fff; outline: none;
    cursor: pointer; min-width: 160px;
}
.filter-select:focus { border-color: #0ea5e9; }
.btn-reset {
    padding: 0.6rem 1rem; border: 1px solid #e2e8f0; border-radius: 8px;
    font-size: 0.85rem; color: #64748b; background: #fff; cursor: pointer;
    transition: all 0.15s;
}
.btn-reset:hover { border-color: #0ea5e9; color: #0369a1; }
.btn-add {
    padding: 0.6rem 1.1rem; background: #0369a1; color: #fff;
    border: none; border-radius: 8px; font-size: 0.85rem; font-weight: 600;
    cursor: pointer; transition: background 0.15s;
}
.btn-add:hover { background: #0284c7; }

/* Compteur résultats */
.results-count { font-size: 0.82rem; color: #64748b; margin-bottom: 1rem; }
.results-count strong { color: #0369a1; }

/* Grille agents */
.agents-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1rem; }

/* Carte agent */
.agent-card {
    background: #fff; border: 1px solid #e2e8f0; border-radius: 10px;
    padding: 1.25rem; box-shadow: 0 1px 4px rgba(0,0,0,0.05);
    transition: box-shadow 0.2s, transform 0.15s; cursor: pointer;
}
.agent-card:hover { box-shadow: 0 4px 16px rgba(14,165,233,0.15); transform: translateY(-1px); }
.agent-card-header { display: flex; align-items: center; gap: 0.9rem; margin-bottom: 1rem; }
.agent-card-avatar {
    width: 44px; height: 44px; border-radius: 8px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.95rem; font-weight: 700; color: #fff;
    background: linear-gradient(135deg, #0369a1, #0ea5e9);
}
.agent-card-name { font-size: 0.95rem; font-weight: 700; color: #0c4a6e; line-height: 1.3; }
.agent-card-matricule { font-size: 0.72rem; color: #94a3b8; font-family: monospace; }
.agent-card-body { font-size: 0.8rem; }
.agent-card-row { display: flex; align-items: baseline; gap: 0.4rem; padding: 0.3rem 0; border-bottom: 1px solid #f1f5f9; }
.agent-card-row:last-child { border-bottom: none; }
.agent-card-lbl { color: #94a3b8; font-size: 0.72rem; font-weight: 600; min-width: 70px; text-transform: uppercase; letter-spacing: 0.04em; }
.agent-card-val { color: #334155; flex: 1; }
.agent-card-val a { color: #0ea5e9; text-decoration: none; }
.agent-card-val a:hover { text-decoration: underline; }
.agent-card-entity {
    display: inline-block; background: #e0f2fe; color: #0369a1;
    font-size: 0.7rem; font-weight: 600; padding: 0.15rem 0.5rem;
    border-radius: 4px; margin-top: 0.5rem;
}
.agent-card-actions { margin-top: 0.9rem; display: flex; gap: 0.5rem; }
.btn-detail {
    flex: 1; padding: 0.4rem; border: 1px solid #e2e8f0; border-radius: 6px;
    font-size: 0.78rem; font-weight: 600; color: #0369a1; background: #f0f9ff;
    cursor: pointer; text-align: center; transition: all 0.15s; text-decoration: none;
    display: block;
}
.btn-detail:hover { background: #e0f2fe; }
.btn-edit {
    padding: 0.4rem 0.7rem; border: 1px solid #e2e8f0; border-radius: 6px;
    font-size: 0.78rem; color: #64748b; background: #fff;
    cursor: pointer; transition: all 0.15s;
}
.btn-edit:hover { border-color: #0ea5e9; color: #0369a1; }

/* Aucun résultat */
.no-results {
    grid-column: 1 / -1; text-align: center; padding: 3rem;
    color: #94a3b8; font-size: 0.9rem;
}

/* Sidebar organisationnelle */
.sidebar { }
.sidebar-card {
    background: #fff; border: 1px solid #e2e8f0; border-radius: 10px;
    padding: 1.25rem; box-shadow: 0 1px 4px rgba(0,0,0,0.05);
    position: sticky; top: 1.5rem;
}
.sidebar-title {
    font-size: 0.88rem; font-weight: 700; color: #0369a1;
    margin-bottom: 1rem; border-bottom: 2px solid #e0f2fe; padding-bottom: 0.5rem;
}
.tree-node { font-size: 0.82rem; }
.tree-direction {
    padding: 0.45rem 0.6rem; border-radius: 6px; font-weight: 700;
    color: #0369a1; cursor: pointer; margin-bottom: 0.2rem;
    transition: background 0.12s; border: 1px solid transparent;
}
.tree-direction:hover { background: #e0f2fe; border-color: #bae6fd; }
.tree-direction.selected { background: #e0f2fe; border-color: #0ea5e9; }
.tree-children { padding-left: 0.9rem; margin-bottom: 0.3rem; }
.tree-service {
    padding: 0.35rem 0.5rem; border-radius: 5px; color: #475569;
    cursor: pointer; transition: background 0.12s; font-size: 0.78rem;
    margin-bottom: 0.1rem;
}
.tree-service:hover { background: #f0f9ff; color: #0369a1; }
.tree-service.selected { background: #e0f2fe; color: #0369a1; font-weight: 600; }
.tree-dept {
    padding: 0.25rem 0.5rem; padding-left: 0.9rem; border-radius: 4px;
    color: #64748b; cursor: pointer; font-size: 0.75rem; transition: background 0.12s;
}
.tree-dept:hover { background: #f8fafc; color: #0369a1; }

/* Pagination */
.pagination-wrap { margin-top: 1.5rem; display: flex; justify-content: center; }

/* Modal overlay */
.modal-overlay {
    position: fixed; inset: 0; background: rgba(0,0,0,0.4);
    z-index: 200; display: flex; align-items: center; justify-content: center;
    padding: 1rem;
}
.modal {
    background: #fff; border-radius: 12px; width: 100%; max-width: 600px;
    max-height: 90vh; overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
}
.modal-header {
    padding: 1.25rem 1.5rem; border-bottom: 1px solid #e2e8f0;
    display: flex; align-items: center; justify-content: space-between;
}
.modal-title { font-size: 1rem; font-weight: 700; color: #0369a1; }
.modal-close {
    background: none; border: none; font-size: 1.2rem; color: #94a3b8;
    cursor: pointer; padding: 0.2rem 0.5rem; border-radius: 4px;
}
.modal-close:hover { background: #f1f5f9; color: #334155; }
.modal-body { padding: 1.5rem; }
.modal-info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
.modal-info-item { }
.modal-info-label { font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.05em; color: #94a3b8; font-weight: 600; margin-bottom: 0.2rem; }
.modal-info-value { font-size: 0.88rem; font-weight: 600; color: #0c4a6e; }
.modal-info-value a { color: #0ea5e9; text-decoration: none; }

@media(max-width: 900px) {
    .annuaire-body { grid-template-columns: 1fr; }
    .sidebar { order: -1; }
    .sidebar-card { position: static; }
}
</style>

<div class="annuaire-page">

    {{-- En-tête --}}
    <div class="annuaire-header">
        <div class="annuaire-header-inner">
            <div>
                <h1>Annuaire des Agents</h1>
                <div class="annuaire-header-sub">Recherchez et consultez les fiches des agents de l'institution</div>
            </div>
            @auth
                @if(auth()->user()->role === 'admin')
                    <button wire:click="openCreate" class="btn-add">+ Ajouter un agent</button>
                @endif
            @endauth
        </div>
    </div>

    <div class="annuaire-body">

        
                {{-- Toutes les directions --}}
                <div class="tree-direction {{ !$directionId && !$entityId ? 'selected' : '' }}"
                     wire:click="$set('directionId', null); $set('entityId', null)">
                    Toutes les directions
                </div>

                @foreach($this->entityTree as $direction)
                <div class="tree-node">
                    <div class="tree-direction {{ $directionId == $direction->id ? 'selected' : '' }}"
                         wire:click="$set('directionId', {{ $direction->id }}); $set('entityId', null)">
                        {{ $direction->nom }}
                    </div>

                    @if($direction->children->count() > 0)
                    <div class="tree-children">
                        @foreach($direction->children as $service)
                        <div class="tree-service {{ $entityId == $service->id ? 'selected' : '' }}"
                             wire:click="$set('entityId', {{ $service->id }}); $set('directionId', null)">
                            {{ $service->nom }}
                        </div>
                        @if($service->children->count() > 0)
                        @foreach($service->children as $dept)
                        <div class="tree-dept {{ $entityId == $dept->id ? 'selected' : '' }}"
                             wire:click="$set('entityId', {{ $dept->id }}); $set('directionId', null)">
                            — {{ $dept->nom }}
                        </div>
                        @endforeach
                        @endif
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        {{-- Contenu principal --}}
        <div>

            {{-- Barre de recherche --}}
            <div class="search-bar">
                <input wire:model.live.debounce.300ms="search"
                       type="text" placeholder="Rechercher par nom, prénom, email, matricule..."
                       class="search-input">
                <select wire:model.live="fonctionId" class="filter-select">
                    <option value="">Toutes les fonctions</option>
                    @foreach($this->fonctions as $f)
                        <option value="{{ $f->id }}">{{ $f->libelle }}</option>
                    @endforeach
                </select>
                <button wire:click="resetFilters" class="btn-reset">Réinitialiser</button>
            </div>

            {{-- Compteur --}}
            <div class="results-count">
                <strong>{{ $this->agents->total() }}</strong> agent(s) trouvé(s)
                @if($search) pour "<strong>{{ $search }}</strong>"@endif
            </div>

            {{-- Grille agents --}}
            <div class="agents-grid">
                @forelse($this->agents as $agent)
                <div class="agent-card" wire:key="agent-{{ $agent->id }}">
                    <div class="agent-card-header">
                        <div class="agent-card-avatar">
                            {{ strtoupper(substr($agent->prenom, 0, 1) . substr($agent->nom, 0, 1)) }}
                        </div>
                        <div>
                            <div class="agent-card-name">{{ $agent->prenom }} {{ $agent->nom }}</div>
                            <div class="agent-card-matricule">{{ $agent->matricule }}</div>
                        </div>
                    </div>
                    <div class="agent-card-body">
                        <div class="agent-card-row">
                            <span class="agent-card-lbl">Fonction</span>
                            <span class="agent-card-val">{{ $agent->fonction->libelle ?? '-' }}</span>
                        </div>
                        <div class="agent-card-row">
                            <span class="agent-card-lbl">Téléphone</span>
                            <span class="agent-card-val">
                                @if($agent->telephone)
                                    <a href="tel:{{ $agent->telephone }}">{{ $agent->telephone }}</a>
                                @else
                                    <span style="color:#94a3b8">—</span>
                                @endif
                            </span>
                        </div>
                        <div class="agent-card-row">
                            <span class="agent-card-lbl">Email</span>
                            <span class="agent-card-val">
                                @if($agent->email)
                                    <a href="mailto:{{ $agent->email }}">{{ $agent->email }}</a>
                                @else
                                    <span style="color:#94a3b8">—</span>
                                @endif
                            </span>
                        </div>
                        <div class="agent-card-row">
                            <span class="agent-card-lbl">Bureau</span>
                            <span class="agent-card-val">{{ $agent->bureau ?? '—' }}</span>
                        </div>
                        <div>
                            <span class="agent-card-entity">{{ $agent->entity->nom ?? 'Sans entité' }}</span>
                        </div>
                    </div>
                    <div class="agent-card-actions">
                        <button wire:click="openDetail({{ $agent->id }})" class="btn-detail">
                            Voir la fiche
                        </button>
                        @auth
                            @if(auth()->user()->role === 'admin')
                            <button wire:click="openEdit({{ $agent->id }})" class="btn-edit">
                                Modifier
                            </button>
                            @endif
                        @endauth
                    </div>
                </div>
                @empty
                <div class="no-results">
                    Aucun agent trouvé pour cette recherche.
                </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="pagination-wrap">
                {{ $this->agents->links() }}
            </div>
        </div>

    </div>
</div>

{{-- ── Modal Fiche Agent ── --}}
@if($showDetail && $selectedAgent)
<div class="modal-overlay" wire:click.self="closeDetail">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title">Fiche Agent — {{ $selectedAgent->prenom }} {{ $selectedAgent->nom }}</div>
            <button class="modal-close" wire:click="closeDetail">×</button>
        </div>
        <div class="modal-body">
            <div class="modal-info-grid">
                <div class="modal-info-item">
                    <div class="modal-info-label">Matricule</div>
                    <div class="modal-info-value" style="font-family:monospace;">{{ $selectedAgent->matricule }}</div>
                </div>
                <div class="modal-info-item">
                    <div class="modal-info-label">Statut</div>
                    <div class="modal-info-value">
                        @if($selectedAgent->is_active)
                            <span style="color:#059669;">Actif</span>
                        @else
                            <span style="color:#dc2626;">Inactif</span>
                        @endif
                    </div>
                </div>
                <div class="modal-info-item">
                    <div class="modal-info-label">Prénom</div>
                    <div class="modal-info-value">{{ $selectedAgent->prenom }}</div>
                </div>
                <div class="modal-info-item">
                    <div class="modal-info-label">Nom</div>
                    <div class="modal-info-value">{{ $selectedAgent->nom }}</div>
                </div>
                <div class="modal-info-item">
                    <div class="modal-info-label">Email</div>
                    <div class="modal-info-value">
                        @if($selectedAgent->email)
                            <a href="mailto:{{ $selectedAgent->email }}">{{ $selectedAgent->email }}</a>
                        @else —
                        @endif
                    </div>
                </div>
                <div class="modal-info-item">
                    <div class="modal-info-label">Téléphone</div>
                    <div class="modal-info-value">
                        @if($selectedAgent->telephone)
                            <a href="tel:{{ $selectedAgent->telephone }}">{{ $selectedAgent->telephone }}</a>
                        @else —
                        @endif
                    </div>
                </div>
                <div class="modal-info-item">
                    <div class="modal-info-label">Téléphone interne</div>
                    <div class="modal-info-value">{{ $selectedAgent->telephone_interne ?? '—' }}</div>
                </div>
                <div class="modal-info-item">
                    <div class="modal-info-label">Bureau</div>
                    <div class="modal-info-value">{{ $selectedAgent->bureau ?? '—' }}</div>
                </div>
                <div class="modal-info-item">
                    <div class="modal-info-label">Fonction</div>
                    <div class="modal-info-value">{{ $selectedAgent->fonction->libelle ?? '—' }}</div>
                </div>
                <div class="modal-info-item">
                    <div class="modal-info-label">Niveau hiérarchique</div>
                    <div class="modal-info-value">Niveau {{ $selectedAgent->fonction->niveau ?? '—' }} / 6</div>
                </div>
                <div class="modal-info-item">
                    <div class="modal-info-label">Entité</div>
                    <div class="modal-info-value">{{ $selectedAgent->entity->nom ?? '—' }}</div>
                </div>
                <div class="modal-info-item">
                    <div class="modal-info-label">Date de prise de fonction</div>
                    <div class="modal-info-value">
                        {{ $selectedAgent->date_prise_fonction?->format('d/m/Y') ?? '—' }}
                    </div>
                </div>
            </div>

            {{-- Hiérarchie organisationnelle --}}
            @php $e = $selectedAgent->entity; @endphp
            @if($e)
            <div style="margin-top:1.25rem; padding:0.9rem; background:#f0f9ff; border-radius:8px; border:1px solid #bae6fd;">
                <div class="modal-info-label" style="margin-bottom:0.5rem;">Position dans l'organisation</div>
                <div style="display:flex; align-items:center; gap:0.5rem; flex-wrap:wrap; font-size:0.82rem;">
                    @if($e->type === 'departement' && $e->parent?->parent)
                        <span style="background:#e0f2fe; color:#0369a1; padding:0.25rem 0.6rem; border-radius:5px; font-weight:600;">{{ $e->parent->parent->nom }}</span>
                        <span style="color:#94a3b8;">›</span>
                        <span style="background:#e0f2fe; color:#0369a1; padding:0.25rem 0.6rem; border-radius:5px; font-weight:600;">{{ $e->parent->nom }}</span>
                        <span style="color:#94a3b8;">›</span>
                        <span style="background:#e0f2fe; color:#0369a1; padding:0.25rem 0.6rem; border-radius:5px; font-weight:600;">{{ $e->nom }}</span>
                    @elseif($e->type === 'service' && $e->parent)
                        <span style="background:#e0f2fe; color:#0369a1; padding:0.25rem 0.6rem; border-radius:5px; font-weight:600;">{{ $e->parent->nom }}</span>
                        <span style="color:#94a3b8;">›</span>
                        <span style="background:#e0f2fe; color:#0369a1; padding:0.25rem 0.6rem; border-radius:5px; font-weight:600;">{{ $e->nom }}</span>
                    @else
                        <span style="background:#e0f2fe; color:#0369a1; padding:0.25rem 0.6rem; border-radius:5px; font-weight:600;">{{ $e->nom }}</span>
                    @endif
                </div>
            </div>
            @endif

            {{-- Actions admin --}}
            @auth
                @if(auth()->user()->role === 'admin')
                <div style="margin-top:1.25rem; display:flex; gap:0.75rem; flex-wrap:wrap;">
                    <button wire:click="openEdit({{ $selectedAgent->id }})" class="btn-sm btn-sm-primary">
                        Modifier cet agent
                    </button>
                    <button wire:click="toggleActive({{ $selectedAgent->id }})"
                            onclick="return confirm('Confirmer cette action ?')"
                            class="btn-sm {{ $selectedAgent->is_active ? 'btn-sm-danger' : 'btn-sm-success' }}">
                        {{ $selectedAgent->is_active ? 'Désactiver' : 'Réactiver' }}
                    </button>
                </div>
                @endif
            @endauth
        </div>
    </div>
</div>
@endif

{{-- ── Modal Formulaire Agent (Admin) ── --}}
@auth
@if(auth()->user()->role === 'admin' && $showForm)
<div class="modal-overlay" wire:click.self="closeForm">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title">
                {{ $agentId ? 'Modifier l\'agent' : 'Ajouter un agent' }}
            </div>
            <button class="modal-close" wire:click="closeForm">×</button>
        </div>
        <div class="modal-body">
            <form wire:submit="save">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">

                    <div style="grid-column: 1 / -1;">
                        <label style="font-size:0.8rem; font-weight:600; color:#334155; display:block; margin-bottom:0.3rem;">Matricule *</label>
                        <input wire:model="matricule" type="text" placeholder="EX: MAT001"
                               style="width:100%; padding:0.6rem; border:1px solid #e2e8f0; border-radius:7px; font-size:0.88rem; outline:none;"
                               {{ $agentId ? 'disabled' : '' }}>
                        @error('matricule') <p style="color:#dc2626; font-size:0.75rem; margin-top:0.25rem;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label style="font-size:0.8rem; font-weight:600; color:#334155; display:block; margin-bottom:0.3rem;">Nom *</label>
                        <input wire:model="nom" type="text" placeholder="NOM"
                               style="width:100%; padding:0.6rem; border:1px solid #e2e8f0; border-radius:7px; font-size:0.88rem; outline:none;">
                        @error('nom') <p style="color:#dc2626; font-size:0.75rem; margin-top:0.25rem;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label style="font-size:0.8rem; font-weight:600; color:#334155; display:block; margin-bottom:0.3rem;">Prénom *</label>
                        <input wire:model="prenom" type="text" placeholder="Prénom"
                               style="width:100%; padding:0.6rem; border:1px solid #e2e8f0; border-radius:7px; font-size:0.88rem; outline:none;">
                        @error('prenom') <p style="color:#dc2626; font-size:0.75rem; margin-top:0.25rem;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label style="font-size:0.8rem; font-weight:600; color:#334155; display:block; margin-bottom:0.3rem;">Email</label>
                        <input wire:model="email" type="email" placeholder="prenom.nom@institution.sn"
                               style="width:100%; padding:0.6rem; border:1px solid #e2e8f0; border-radius:7px; font-size:0.88rem; outline:none;">
                        @error('email') <p style="color:#dc2626; font-size:0.75rem; margin-top:0.25rem;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label style="font-size:0.8rem; font-weight:600; color:#334155; display:block; margin-bottom:0.3rem;">Téléphone</label>
                        <input wire:model="telephone" type="text" placeholder="+241 77 000 000"
                               style="width:100%; padding:0.6rem; border:1px solid #e2e8f0; border-radius:7px; font-size:0.88rem; outline:none;">
                    </div>

                    <div>
                        <label style="font-size:0.8rem; font-weight:600; color:#334155; display:block; margin-bottom:0.3rem;">Téléphone interne</label>
                        <input wire:model="telephone_interne" type="text" placeholder="201"
                               style="width:100%; padding:0.6rem; border:1px solid #e2e8f0; border-radius:7px; font-size:0.88rem; outline:none;">
                    </div>

                    <div>
                        <label style="font-size:0.8rem; font-weight:600; color:#334155; display:block; margin-bottom:0.3rem;">Bureau</label>
                        <input wire:model="bureau" type="text" placeholder="A-201"
                               style="width:100%; padding:0.6rem; border:1px solid #e2e8f0; border-radius:7px; font-size:0.88rem; outline:none;">
                    </div>

                    <div>
                        <label style="font-size:0.8rem; font-weight:600; color:#334155; display:block; margin-bottom:0.3rem;">Date de prise de fonction</label>
                        <input wire:model="date_prise_fonction" type="date"
                               style="width:100%; padding:0.6rem; border:1px solid #e2e8f0; border-radius:7px; font-size:0.88rem; outline:none;">
                    </div>

                    <div>
                        <label style="font-size:0.8rem; font-weight:600; color:#334155; display:block; margin-bottom:0.3rem;">Entité *</label>
                        <select wire:model="entityId"
                                style="width:100%; padding:0.6rem; border:1px solid #e2e8f0; border-radius:7px; font-size:0.88rem; outline:none; background:#fff;">
                            <option value="">-- Sélectionner --</option>
                            @foreach($this->allEntities as $entity)
                                <option value="{{ $entity->id }}">{{ $entity->nom }} ({{ $entity->type }})</option>
                            @endforeach
                        </select>
                        @error('entityId') <p style="color:#dc2626; font-size:0.75rem; margin-top:0.25rem;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label style="font-size:0.8rem; font-weight:600; color:#334155; display:block; margin-bottom:0.3rem;">Fonction *</label>
                        <select wire:model="fonctionIdForm"
                                style="width:100%; padding:0.6rem; border:1px solid #e2e8f0; border-radius:7px; font-size:0.88rem; outline:none; background:#fff;">
                            @foreach($this->fonctions as $f)
                                <option value="{{ $f->id }}">Niv.{{ $f->niveau }} — {{ $f->libelle }}</option>
                            @endforeach
                        </select>
                        @error('fonctionIdForm') <p style="color:#dc2626; font-size:0.75rem; margin-top:0.25rem;">{{ $message }}</p> @enderror
                    </div>

                </div>

                <div style="margin-top:1.5rem; display:flex; gap:0.75rem; justify-content:flex-end;">
                    <button type="button" wire:click="closeForm"
                            style="padding:0.6rem 1.2rem; border:1px solid #e2e8f0; border-radius:7px; font-size:0.88rem; cursor:pointer; background:#fff; color:#64748b;">
                        Annuler
                    </button>
                    <button type="submit"
                            style="padding:0.6rem 1.4rem; background:#0369a1; color:#fff; border:none; border-radius:7px; font-size:0.88rem; font-weight:600; cursor:pointer;">
                        {{ $agentId ? 'Enregistrer les modifications' : 'Créer l\'agent' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endauth

</x-app-layout>
</div>