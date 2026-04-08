{{-- annuaire des agents --}}
<div>
<x-app-layout>

<style>
    /* page annuaire */
    .page-annuaire {
        background: #f1f5f9;
        min-height: 90vh;
    }

    /* header */
    .header-annuaire {
        background: linear-gradient(to right, #0369a1, #0ea5e9);
        padding: 25px 30px;
    }
    .header-annuaire-inner {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }
    .header-annuaire h1 {
        color: white;
        font-size: 20px;
        font-weight: bold;
        margin: 0;
    }
    .header-annuaire .sous-titre {
        color: rgba(255,255,255,0.7);
        font-size: 13px;
        margin-top: 4px;
    }
    .btn-ajouter {
        padding: 8px 16px;
        background: white;
        color: #0369a1;
        border: none;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }
    .btn-ajouter:hover {
        background: #e0f2fe;
    }

    /* corps avec 2 colonnes */
    .corps-annuaire {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        display: grid;
        grid-template-columns: 220px 1fr;
        gap: 20px;
    }

    /* sidebar */
    .sidebar {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 18px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        position: sticky;
        top: 20px;
        height: fit-content;
    }
    .sidebar-titre {
        font-size: 13px;
        font-weight: 700;
        color: #0369a1;
        border-bottom: 2px solid #e0f2fe;
        padding-bottom: 8px;
        margin-bottom: 12px;
    }
    .direction-item {
        padding: 7px 10px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 700;
        color: #0369a1;
        cursor: pointer;
        margin-bottom: 3px;
        border: 1px solid transparent;
    }
    .direction-item:hover {
        background: #e0f2fe;
    }
    .direction-item.actif {
        background: #e0f2fe;
        border-color: #0ea5e9;
    }
    .enfants {
        padding-left: 12px;
        margin-bottom: 5px;
    }
    .service-item {
        padding: 5px 8px;
        border-radius: 5px;
        font-size: 12px;
        color: #475569;
        cursor: pointer;
        margin-bottom: 2px;
    }
    .service-item:hover {
        background: #f0f9ff;
        color: #0369a1;
    }
    .service-item.actif {
        background: #e0f2fe;
        color: #0369a1;
        font-weight: 600;
    }
    .dept-item {
        padding: 4px 8px;
        padding-left: 16px;
        border-radius: 4px;
        font-size: 11px;
        color: #64748b;
        cursor: pointer;
    }
    .dept-item:hover {
        background: #f8fafc;
        color: #0369a1;
    }
    .dept-item.actif {
        background: #e0f2fe;
        color: #0369a1;
        font-weight: 600;
    }

    /* zone recherche */
    .barre-recherche {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }
    .champ-recherche {
        flex: 1;
        min-width: 200px;
        padding: 8px 12px;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        font-size: 14px;
        color: #334155;
        outline: none;
    }
    .champ-recherche:focus {
        border-color: #0ea5e9;
    }
    .filtre-select {
        padding: 8px 10px;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        font-size: 13px;
        color: #334155;
        background: white;
        outline: none;
        min-width: 160px;
        cursor: pointer;
    }
    .btn-reset {
        padding: 8px 14px;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        font-size: 13px;
        color: #64748b;
        background: white;
        cursor: pointer;
    }
    .btn-reset:hover {
        border-color: #0ea5e9;
        color: #0369a1;
    }

    /* compteur resultats */
    .nb-resultats {
        font-size: 13px;
        color: #64748b;
        margin-bottom: 12px;
    }
    .nb-resultats strong {
        color: #0369a1;
    }

    /* grille cartes agents */
    .grille-agents {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
        gap: 15px;
    }

    /* carte agent */
    .carte-agent {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 18px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        transition: 0.2s;
        cursor: pointer;
    }
    .carte-agent:hover {
        box-shadow: 0 4px 15px rgba(14,165,233,0.15);
        transform: translateY(-1px);
    }
    .entete-carte {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 14px;
    }
    .avatar-agent {
        width: 42px;
        height: 42px;
        border-radius: 8px;
        background: linear-gradient(135deg, #0369a1, #0ea5e9);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
        color: white;
        flex-shrink: 0;
    }
    .nom-agent {
        font-size: 14px;
        font-weight: 700;
        color: #0c4a6e;
        line-height: 1.3;
    }
    .matricule-agent {
        font-size: 11px;
        color: #aaa;
        font-family: monospace;
    }
    .infos-agent {
        font-size: 12px;
    }
    .ligne-info {
        display: flex;
        align-items: baseline;
        gap: 6px;
        padding: 5px 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .ligne-info:last-child {
        border-bottom: none;
    }
    .label-info {
        color: #aaa;
        font-size: 11px;
        font-weight: 600;
        min-width: 65px;
        text-transform: uppercase;
    }
    .valeur-info {
        color: #334155;
        flex: 1;
    }
    .valeur-info a {
        color: #0ea5e9;
        text-decoration: none;
    }
    .valeur-info a:hover {
        text-decoration: underline;
    }
    .tag-entite {
        display: inline-block;
        background: #e0f2fe;
        color: #0369a1;
        font-size: 11px;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 4px;
        margin-top: 8px;
    }
    .actions-carte {
        margin-top: 12px;
        display: flex;
        gap: 8px;
    }
    .btn-voir {
        flex: 1;
        padding: 6px;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        color: #0369a1;
        background: #f0f9ff;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        display: block;
    }
    .btn-voir:hover {
        background: #e0f2fe;
    }
    .btn-modifier {
        padding: 6px 10px;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        font-size: 12px;
        color: #64748b;
        background: white;
        cursor: pointer;
    }
    .btn-modifier:hover {
        border-color: #0ea5e9;
        color: #0369a1;
    }

    /* vide */
    .aucun-resultat {
        grid-column: 1 / -1;
        text-align: center;
        padding: 50px;
        color: #aaa;
        font-size: 14px;
    }

    /* pagination */
    .pagination-zone {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }

    /* modal */
    .fond-modal {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.4);
        z-index: 200;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px;
    }
    .modal {
        background: white;
        border-radius: 12px;
        width: 100%;
        max-width: 580px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 50px rgba(0,0,0,0.2);
    }
    .modal-entete {
        padding: 18px 22px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .modal-titre {
        font-size: 15px;
        font-weight: 700;
        color: #0369a1;
    }
    .modal-fermer {
        background: none;
        border: none;
        font-size: 20px;
        color: #aaa;
        cursor: pointer;
        padding: 2px 8px;
        border-radius: 4px;
    }
    .modal-fermer:hover {
        background: #f1f5f9;
        color: #334155;
    }
    .modal-corps {
        padding: 22px;
    }
    .grille-infos-modal {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }
    .bloc-info {
        /* rien de special */
    }
    .label-modal {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #aaa;
        font-weight: 600;
        margin-bottom: 3px;
    }
    .valeur-modal {
        font-size: 13px;
        font-weight: 600;
        color: #0c4a6e;
    }
    .valeur-modal a {
        color: #0ea5e9;
        text-decoration: none;
    }

    /* champ formulaire */
    .champ-form {
        width: 100%;
        padding: 8px 10px;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        font-size: 13px;
        outline: none;
    }
    .champ-form:focus {
        border-color: #0ea5e9;
    }
    .label-form {
        font-size: 12px;
        font-weight: 600;
        color: #334155;
        display: block;
        margin-bottom: 5px;
    }
    .erreur-form {
        color: #dc2626;
        font-size: 11px;
        margin-top: 3px;
    }

    /* boutons dans modal */
    .btn-annuler {
        padding: 8px 18px;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        font-size: 13px;
        cursor: pointer;
        background: white;
        color: #64748b;
    }
    .btn-enregistrer {
        padding: 8px 20px;
        background: #0369a1;
        color: white;
        border: none;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }
    .btn-enregistrer:hover {
        background: #0284c7;
    }
    .btn-desactiver {
        padding: 8px 18px;
        background: #fee2e2;
        color: #dc2626;
        border: none;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
    }
    .btn-reactiver {
        padding: 8px 18px;
        background: #d1fae5;
        color: #059669;
        border: none;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
    }

    /* responsive */
    @media (max-width: 900px) {
        .corps-annuaire { grid-template-columns: 1fr; }
        .sidebar { position: static; }
    }
    @media (max-width: 550px) {
        .grille-infos-modal { grid-template-columns: 1fr; }
    }
</style>

<div class="page-annuaire">

    {{-- header --}}
    <div class="header-annuaire">
        <div class="header-annuaire-inner">
            <div>
                <h1>Annuaire des Agents</h1>
                <div class="sous-titre">Recherchez et consultez les fiches des agents</div>
            </div>
            @auth
                @if(auth()->user()->role === 'admin')
                    <button wire:click="openCreate" class="btn-ajouter">+ Ajouter un agent</button>
                @endif
            @endauth
        </div>
    </div>

    <div class="corps-annuaire">

        {{-- sidebar arborescence --}}
        <div class="sidebar">
            <div class="sidebar-titre">Structure organisationnelle</div>

            <div class="direction-item {{ !$directionId && !$entityId ? 'actif' : '' }}"
                 wire:click="$set('directionId', null); $set('entityId', null)">
                Toutes les directions
            </div>

            @foreach($this->entityTree as $direction)
                <div>
                    <div class="direction-item {{ $directionId == $direction->id ? 'actif' : '' }}"
                         wire:click="$set('directionId', {{ $direction->id }}); $set('entityId', null)">
                        {{ $direction->nom }}
                    </div>

                    @if($direction->children->count() > 0)
                        <div class="enfants">
                            @foreach($direction->children as $service)
                                <div class="service-item {{ $entityId == $service->id ? 'actif' : '' }}"
                                     wire:click="$set('entityId', {{ $service->id }}); $set('directionId', null)">
                                    {{ $service->nom }}
                                </div>
                                @if($service->children->count() > 0)
                                    @foreach($service->children as $dept)
                                        <div class="dept-item {{ $entityId == $dept->id ? 'actif' : '' }}"
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

        {{-- contenu principal --}}
        <div>

            {{-- barre de recherche --}}
            <div class="barre-recherche">
                <input wire:model.live.debounce.300ms="search"
                       type="text"
                       placeholder="Rechercher par nom, prénom, email, matricule..."
                       class="champ-recherche">

                <select wire:model.live="fonctionId" class="filtre-select">
                    <option value="">Toutes les fonctions</option>
                    @foreach($this->fonctions as $f)
                        <option value="{{ $f->id }}">{{ $f->libelle }}</option>
                    @endforeach
                </select>

                <button wire:click="resetFilters" class="btn-reset">Réinitialiser</button>
            </div>

            {{-- nombre de resultats --}}
            <div class="nb-resultats">
                <strong>{{ $this->agents->total() }}</strong> agent(s) trouvé(s)
                @if($search) pour "<strong>{{ $search }}</strong>" @endif
            </div>

            {{-- grille des agents --}}
            <div class="grille-agents">
                @forelse($this->agents as $agent)
                    <div class="carte-agent" wire:key="agent-{{ $agent->id }}">
                        <div class="entete-carte">
                            <div class="avatar-agent">
                                {{ strtoupper(substr($agent->prenom, 0, 1)) }}{{ strtoupper(substr($agent->nom, 0, 1)) }}
                            </div>
                            <div>
                                <div class="nom-agent">{{ $agent->prenom }} {{ $agent->nom }}</div>
                                <div class="matricule-agent">{{ $agent->matricule }}</div>
                            </div>
                        </div>

                        <div class="infos-agent">
                            <div class="ligne-info">
                                <span class="label-info">Fonction</span>
                                <span class="valeur-info">{{ $agent->fonction->libelle ?? '-' }}</span>
                            </div>
                            <div class="ligne-info">
                                <span class="label-info">Téléphone</span>
                                <span class="valeur-info">
                                    @if($agent->telephone)
                                        <a href="tel:{{ $agent->telephone }}">{{ $agent->telephone }}</a>
                                    @else
                                        <span style="color:#aaa">—</span>
                                    @endif
                                </span>
                            </div>
                            <div class="ligne-info">
                                <span class="label-info">Email</span>
                                <span class="valeur-info">
                                    @if($agent->email)
                                        <a href="mailto:{{ $agent->email }}">{{ $agent->email }}</a>
                                    @else
                                        <span style="color:#aaa">—</span>
                                    @endif
                                </span>
                            </div>
                            <div class="ligne-info">
                                <span class="label-info">Bureau</span>
                                <span class="valeur-info">{{ $agent->bureau ?? '—' }}</span>
                            </div>
                            <div>
                                <span class="tag-entite">{{ $agent->entity->nom ?? 'Sans entité' }}</span>
                            </div>
                        </div>

                        <div class="actions-carte">
                            <button wire:click="openDetail({{ $agent->id }})" class="btn-voir">
                                Voir la fiche
                            </button>
                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <button wire:click="openEdit({{ $agent->id }})" class="btn-modifier">
                                        Modifier
                                    </button>
                                @endif
                            @endauth
                        </div>
                    </div>
                @empty
                    <div class="aucun-resultat">
                        Aucun agent trouvé pour cette recherche.
                    </div>
                @endforelse
            </div>

            {{-- pagination --}}
            <div class="pagination-zone">
                {{ $this->agents->links() }}
            </div>

        </div>

    </div>
</div>

{{-- modal fiche agent --}}
@if($showDetail && $selectedAgent)
    <div class="fond-modal" wire:click.self="closeDetail">
        <div class="modal">
            <div class="modal-entete">
                <div class="modal-titre">Fiche — {{ $selectedAgent->prenom }} {{ $selectedAgent->nom }}</div>
                <button class="modal-fermer" wire:click="closeDetail">×</button>
            </div>
            <div class="modal-corps">
                <div class="grille-infos-modal">
                    <div class="bloc-info">
                        <div class="label-modal">Matricule</div>
                        <div class="valeur-modal" style="font-family:monospace;">{{ $selectedAgent->matricule }}</div>
                    </div>
                    <div class="bloc-info">
                        <div class="label-modal">Statut</div>
                        <div class="valeur-modal">
                            @if($selectedAgent->is_active)
                                <span style="color:#059669;">Actif</span>
                            @else
                                <span style="color:#dc2626;">Inactif</span>
                            @endif
                        </div>
                    </div>
                    <div class="bloc-info">
                        <div class="label-modal">Prénom</div>
                        <div class="valeur-modal">{{ $selectedAgent->prenom }}</div>
                    </div>
                    <div class="bloc-info">
                        <div class="label-modal">Nom</div>
                        <div class="valeur-modal">{{ $selectedAgent->nom }}</div>
                    </div>
                    <div class="bloc-info">
                        <div class="label-modal">Email</div>
                        <div class="valeur-modal">
                            @if($selectedAgent->email)
                                <a href="mailto:{{ $selectedAgent->email }}">{{ $selectedAgent->email }}</a>
                            @else —
                            @endif
                        </div>
                    </div>
                    <div class="bloc-info">
                        <div class="label-modal">Téléphone</div>
                        <div class="valeur-modal">
                            @if($selectedAgent->telephone)
                                <a href="tel:{{ $selectedAgent->telephone }}">{{ $selectedAgent->telephone }}</a>
                            @else —
                            @endif
                        </div>
                    </div>
                    <div class="bloc-info">
                        <div class="label-modal">Tél. interne</div>
                        <div class="valeur-modal">{{ $selectedAgent->telephone_interne ?? '—' }}</div>
                    </div>
                    <div class="bloc-info">
                        <div class="label-modal">Bureau</div>
                        <div class="valeur-modal">{{ $selectedAgent->bureau ?? '—' }}</div>
                    </div>
                    <div class="bloc-info">
                        <div class="label-modal">Fonction</div>
                        <div class="valeur-modal">{{ $selectedAgent->fonction->libelle ?? '—' }}</div>
                    </div>
                    <div class="bloc-info">
                        <div class="label-modal">Niveau hiérarchique</div>
                        <div class="valeur-modal">Niveau {{ $selectedAgent->fonction->niveau ?? '—' }} / 6</div>
                    </div>
                    <div class="bloc-info">
                        <div class="label-modal">Entité</div>
                        <div class="valeur-modal">{{ $selectedAgent->entity->nom ?? '—' }}</div>
                    </div>
                    <div class="bloc-info">
                        <div class="label-modal">Prise de fonction</div>
                        <div class="valeur-modal">
                            {{ $selectedAgent->date_prise_fonction?->format('d/m/Y') ?? '—' }}
                        </div>
                    </div>
                </div>

                {{-- position dans l'organisation --}}
                @php $e = $selectedAgent->entity; @endphp
                @if($e)
                    <div style="margin-top:18px; padding:12px; background:#f0f9ff; border-radius:8px; border:1px solid #bae6fd;">
                        <div class="label-modal" style="margin-bottom:8px;">Position dans l'organisation</div>
                        <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap; font-size:12px;">
                            @if($e->type === 'departement' && $e->parent?->parent)
                                <span style="background:#e0f2fe; color:#0369a1; padding:3px 8px; border-radius:5px; font-weight:600;">{{ $e->parent->parent->nom }}</span>
                                <span style="color:#aaa;">›</span>
                                <span style="background:#e0f2fe; color:#0369a1; padding:3px 8px; border-radius:5px; font-weight:600;">{{ $e->parent->nom }}</span>
                                <span style="color:#aaa;">›</span>
                                <span style="background:#e0f2fe; color:#0369a1; padding:3px 8px; border-radius:5px; font-weight:600;">{{ $e->nom }}</span>
                            @elseif($e->type === 'service' && $e->parent)
                                <span style="background:#e0f2fe; color:#0369a1; padding:3px 8px; border-radius:5px; font-weight:600;">{{ $e->parent->nom }}</span>
                                <span style="color:#aaa;">›</span>
                                <span style="background:#e0f2fe; color:#0369a1; padding:3px 8px; border-radius:5px; font-weight:600;">{{ $e->nom }}</span>
                            @else
                                <span style="background:#e0f2fe; color:#0369a1; padding:3px 8px; border-radius:5px; font-weight:600;">{{ $e->nom }}</span>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- boutons admin --}}
                @auth
                    @if(auth()->user()->role === 'admin')
                        <div style="margin-top:18px; display:flex; gap:10px; flex-wrap:wrap;">
                            <button wire:click="openEdit({{ $selectedAgent->id }})" class="btn-enregistrer">
                                Modifier cet agent
                            </button>
                            <button wire:click="toggleActive({{ $selectedAgent->id }})"
                                    onclick="return confirm('Confirmer cette action ?')"
                                    class="{{ $selectedAgent->is_active ? 'btn-desactiver' : 'btn-reactiver' }}">
                                {{ $selectedAgent->is_active ? 'Désactiver' : 'Réactiver' }}
                            </button>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
@endif

{{-- modal formulaire ajout/edition (admin seulement) --}}
@auth
    @if(auth()->user()->role === 'admin' && $showForm)
        <div class="fond-modal" wire:click.self="closeForm">
            <div class="modal">
                <div class="modal-entete">
                    <div class="modal-titre">
                        {{ $agentId ? "Modifier l'agent" : 'Ajouter un agent' }}
                    </div>
                    <button class="modal-fermer" wire:click="closeForm">×</button>
                </div>
                <div class="modal-corps">
                    <form wire:submit="save">
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">

                            <div style="grid-column: 1 / -1;">
                                <label class="label-form">Matricule *</label>
                                <input wire:model="matricule" type="text" placeholder="EX: MAT001"
                                       class="champ-form" {{ $agentId ? 'disabled' : '' }}>
                                @error('matricule') <p class="erreur-form">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="label-form">Nom *</label>
                                <input wire:model="nom" type="text" placeholder="NOM" class="champ-form">
                                @error('nom') <p class="erreur-form">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="label-form">Prénom *</label>
                                <input wire:model="prenom" type="text" placeholder="Prénom" class="champ-form">
                                @error('prenom') <p class="erreur-form">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="label-form">Email</label>
                                <input wire:model="email" type="email" placeholder="prenom.nom@institution.sn" class="champ-form">
                                @error('email') <p class="erreur-form">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="label-form">Téléphone</label>
                                <input wire:model="telephone" type="text" placeholder="+241 77 000 000" class="champ-form">
                            </div>

                            <div>
                                <label class="label-form">Téléphone interne</label>
                                <input wire:model="telephone_interne" type="text" placeholder="201" class="champ-form">
                            </div>

                            <div>
                                <label class="label-form">Bureau</label>
                                <input wire:model="bureau" type="text" placeholder="A-201" class="champ-form">
                            </div>

                            <div>
                                <label class="label-form">Date de prise de fonction</label>
                                <input wire:model="date_prise_fonction" type="date" class="champ-form">
                            </div>

                            <div>
                                <label class="label-form">Entité *</label>
                                <select wire:model="entityId" class="champ-form">
                                    <option value="">-- Sélectionner --</option>
                                    @foreach($this->allEntities as $entity)
                                        <option value="{{ $entity->id }}">{{ $entity->nom }} ({{ $entity->type }})</option>
                                    @endforeach
                                </select>
                                @error('entityId') <p class="erreur-form">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="label-form">Fonction *</label>
                                <select wire:model="fonctionIdForm" class="champ-form">
                                    @foreach($this->fonctions as $f)
                                        <option value="{{ $f->id }}">Niv.{{ $f->niveau }} — {{ $f->libelle }}</option>
                                    @endforeach
                                </select>
                                @error('fonctionIdForm') <p class="erreur-form">{{ $message }}</p> @enderror
                            </div>

                        </div>

                        <div style="margin-top:20px; display:flex; gap:10px; justify-content:flex-end;">
                            <button type="button" wire:click="closeForm" class="btn-annuler">Annuler</button>
                            <button type="submit" class="btn-enregistrer">
                                {{ $agentId ? 'Enregistrer les modifications' : "Créer l'agent" }}
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