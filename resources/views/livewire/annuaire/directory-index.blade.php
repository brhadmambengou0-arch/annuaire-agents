{{-- PAGE HEADER --}}
<div class="page-header">
    <div class="page-header-inner">
        <div>
            <h1 class="page-title">
                <svg width="22" height="22" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="display:inline;margin-right:6px;vertical-align:middle;">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                </svg>
                Annuaire des Agents
            </h1>
            <div class="page-subtitle">{{ $this->totalAgents }} agents actifs — ANINF</div>
            <div class="breadcrumb-aninf">
                <a href="#">Accueil</a>
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
                <span>Annuaire</span>
            </div>
        </div>

        {{-- Stats rapides --}}
        <div style="display:flex;gap:1rem;">
            <div style="text-align:center;background:rgba(255,255,255,0.12);border-radius:12px;padding:0.7rem 1.2rem;border:1px solid rgba(255,255,255,0.2);">
                <div style="font-family:'Sora',sans-serif;font-size:1.4rem;font-weight:700;color:white;">{{ $this->totalAgents }}</div>
                <div style="font-size:0.72rem;color:rgba(255,255,255,0.7);">Agents</div>
            </div>
            <div style="text-align:center;background:rgba(255,255,255,0.12);border-radius:12px;padding:0.7rem 1.2rem;border:1px solid rgba(255,255,255,0.2);">
                <div style="font-family:'Sora',sans-serif;font-size:1.4rem;font-weight:700;color:white;">{{ $this->totalDirections }}</div>
                <div style="font-size:0.72rem;color:rgba(255,255,255,0.7);">Directions</div>
            </div>
        </div>
    </div>
</div>

{{-- MAIN LAYOUT --}}
<div class="main-layout">

    {{-- SIDEBAR GAUCHE --}}
    <aside class="sidebar-col">
        <div class="sidebar">
            <div class="sidebar-header">
                <h6>
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="display:inline;margin-right:4px;">
                        <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                        <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                    </svg>
                    Structures organisationnelles
                </h6>
            </div>

            <div style="padding:0.6rem;">
                {{-- Tous les agents --}}
                <button wire:click="resetFilters" class="tree-btn {{ !$directionId && !$entityId ? 'active' : '' }}" style="margin-bottom:2px;">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                    </svg>
                    <span>Tous les agents</span>
                    <span style="margin-left:auto;background:#e0f2fe;color:#0284c7;border-radius:10px;padding:1px 8px;font-size:0.7rem;font-weight:600;">
                        {{ $this->totalAgents }}
                    </span>
                </button>

                {{-- Arbre organisationnel --}}
                @foreach($this->entityTree as $direction)
                <div x-data="{ open: {{ $directionId == $direction->id ? 'true' : 'false' }} }">
                    <button
                        @click="open = !open"
                        wire:click="filterByEntity({{ $direction->id }})"
                        class="tree-btn {{ $directionId == $direction->id ? 'active' : '' }}"
                    >
                        <span class="dir-dot"></span>
                        <span style="flex:1;text-align:left;font-size:0.82rem;">{{ $direction->nom }}</span>
                        @if($direction->children->count() > 0)
                        <svg class="tree-icon" :class="{ 'open': open }" width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M9 18l6-6-6-6"/>
                        </svg>
                        @endif
                    </button>

                    {{-- Services --}}
                    <div x-show="open" x-transition class="tree-node">
                        @foreach($direction->children as $service)
                        <div x-data="{ openSvc: {{ $entityId == $service->id ? 'true' : 'false' }} }">
                            <button
                                @click="openSvc = !openSvc"
                                wire:click="filterByEntity({{ $service->id }})"
                                class="tree-btn {{ $entityId == $service->id ? 'active' : '' }}"
                                style="font-size:0.8rem;"
                            >
                                <span class="svc-dot"></span>
                                <span style="flex:1;text-align:left;">{{ $service->nom }}</span>
                                @if($service->children->count() > 0)
                                <svg class="tree-icon" :class="{ 'open': openSvc }" width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path d="M9 18l6-6-6-6"/>
                                </svg>
                                @endif
                            </button>

                            {{-- Départements --}}
                            <div x-show="openSvc" x-transition class="tree-node">
                                @foreach($service->children as $dept)
                                <button
                                    wire:click="filterByEntity({{ $dept->id }})"
                                    class="tree-btn {{ $entityId == $dept->id ? 'active' : '' }}"
                                    style="font-size:0.77rem;"
                                >
                                    <span class="dept-dot"></span>
                                    <span>{{ $dept->nom }}</span>
                                </button>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Filtre Fonctions --}}
        <div class="sidebar" style="margin-top:1rem;">
            <div class="sidebar-header">
                <h6>
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="display:inline;margin-right:4px;">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                    Filtre par Fonction
                </h6>
            </div>
            <div style="padding:0.6rem;">
                <button wire:click="$set('fonctionId', null)" class="tree-btn {{ !$fonctionId ? 'active' : '' }}">
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="22,12 18,12 15,21 9,3 6,12 2,12"/>
                    </svg>
                    Toutes les fonctions
                </button>
                @foreach($this->fonctions as $fonction)
                <button wire:click="$set('fonctionId', {{ $fonction->id }})"
                        class="tree-btn {{ $fonctionId == $fonction->id ? 'active' : '' }}"
                        style="font-size:0.8rem;">
                    <span style="width:6px;height:6px;border-radius:50%;background:var(--aninf-blue);flex-shrink:0;"></span>
                    <span style="flex:1;text-align:left;">{{ $fonction->libelle }}</span>
                    <span style="font-size:0.68rem;color:#94a3b8;background:#f8fafc;padding:1px 5px;border-radius:4px;">Niv.{{ $fonction->niveau }}</span>
                </button>
                @endforeach
            </div>
        </div>
    </aside>

    {{-- CONTENU PRINCIPAL --}}
    <main>

        {{-- BARRE RECHERCHE & FILTRES --}}
        <div class="search-container">
            <div style="display:flex;gap:0.8rem;flex-wrap:wrap;align-items:center;">
                {{-- Recherche --}}
                <div class="search-input-wrap" style="flex:1;min-width:220px;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                    </svg>
                    <input
                        wire:model.live.debounce.300ms="search"
                        type="text"
                        placeholder="Rechercher par nom, prénom, matricule, email..."
                        class="search-input"
                    >
                </div>

                {{-- Filtre direction (mobile) --}}
                <select wire:model.live="directionId" class="filter-select">
                    <option value="">Toutes les directions</option>
                    @foreach($this->entityTree as $dir)
                        <option value="{{ $dir->id }}">{{ $dir->nom }}</option>
                    @endforeach
                </select>

                {{-- Réinitialiser --}}
                @if($search || $directionId || $entityId || $fonctionId)
                <button wire:click="resetFilters" class="btn-ghost">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="1,4 1,10 7,10"/>
                        <path d="M3.51 15a9 9 0 102.13-9.36L1 10"/>
                    </svg>
                    Réinitialiser
                </button>
                @endif

                {{-- Bouton ajout (admin) --}}
                @if(auth()->user()?->role === 'admin')
                <button onclick="Livewire.dispatch('open-create')" class="btn-primary">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Ajouter un agent
                </button>
                @endif
            </div>

            {{-- Résultats actifs --}}
            @if($search || $directionId || $entityId || $fonctionId)
            <div style="margin-top:0.8rem;display:flex;flex-wrap:wrap;gap:0.5rem;align-items:center;">
                <span style="font-size:0.78rem;color:#94a3b8;">Filtres actifs :</span>
                @if($search)
                <span style="background:#e0f2fe;color:#0284c7;border-radius:6px;padding:2px 10px;font-size:0.77rem;font-weight:500;display:inline-flex;align-items:center;gap:4px;">
                    "{{ $search }}"
                    <button wire:click="$set('search','')" style="border:none;background:none;cursor:pointer;color:#0284c7;line-height:1;font-size:0.9rem;">×</button>
                </span>
                @endif
                @if($directionId)
                <span style="background:#e0f2fe;color:#0284c7;border-radius:6px;padding:2px 10px;font-size:0.77rem;font-weight:500;display:inline-flex;align-items:center;gap:4px;">
                    Direction filtrée
                    <button wire:click="$set('directionId',null)" style="border:none;background:none;cursor:pointer;color:#0284c7;line-height:1;font-size:0.9rem;">×</button>
                </span>
                @endif
            </div>
            @endif
        </div>

        {{-- RÉSULTATS COUNT --}}
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
            <div style="font-size:0.84rem;color:#64748b;">
                <span wire:loading.remove>
                    <strong style="color:#0f172a;">{{ $this->agents->total() }}</strong> agent(s) trouvé(s)
                </span>
                <span wire:loading style="display:flex;align-items:center;gap:6px;">
                    <span style="width:14px;height:14px;border:2px solid #0ea5e9;border-top-color:transparent;border-radius:50%;animation:spin 0.7s linear infinite;display:inline-block;"></span>
                    Recherche en cours...
                </span>
            </div>
        </div>

        {{-- GRILLE AGENTS --}}
        <div wire:loading.class="opacity-50" style="transition:opacity 0.2s;">
            @if($this->agents->count() > 0)
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1rem;margin-bottom:1.5rem;">
                @foreach($this->agents as $agent)
                    @livewire('annuaire.agent-card', ['agent' => $agent], key($agent->id))
                @endforeach
            </div>

            {{-- PAGINATION --}}
            <div class="pagination-wrap" style="margin-top:1.5rem;">
                {{ $this->agents->links() }}
            </div>

            @else
            {{-- EMPTY STATE --}}
            <div class="empty-state">
                <svg width="64" height="64" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                </svg>
                <h5>Aucun agent trouvé</h5>
                <p style="font-size:0.85rem;margin-bottom:1rem;">Essayez de modifier vos critères de recherche.</p>
                <button wire:click="resetFilters" class="btn-primary">
                    Réinitialiser les filtres
                </button>
            </div>
            @endif
        </div>

    </main>
</div>

{{-- COMPOSANTS MODAUX --}}
@livewire('annuaire.agent-form')

<style>
@keyframes spin { to { transform: rotate(360deg); } }
.opacity-50 { opacity: 0.5; }
</style>