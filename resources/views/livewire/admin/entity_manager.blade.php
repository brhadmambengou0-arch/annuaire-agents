{{--
    FICHIER : resources/views/livewire/admin/entity-manager.blade.php
    COMPOSANT : App\Livewire\Admin\EntityManager
    RÔLE : Gestion CRUD des entités organisationnelles.
           Affiche la liste des entités (directions, services, départements)
           avec leur hiérarchie et leur nombre d'agents.
           Permet de créer, modifier et désactiver les entités.
           Protection : on ne peut désactiver une entité qui a des agents actifs.
    ACCÈS : Admin uniquement (middleware AdminOnly)
--}}
<div>
<x-app-layout>
<style>
.page-bg { background: #f1f5f9; min-height: calc(100vh - 60px); }

/* En-tête */
.page-header {
    background: linear-gradient(135deg, #0369a1 0%, #0ea5e9 100%);
    padding: 1.5rem 2rem;
}
.page-header-inner { max-width: 1100px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; }
.page-header h1 { color: #fff; font-size: 1.3rem; font-weight: 700; }
.page-header-sub { color: rgba(255,255,255,0.75); font-size: 0.82rem; margin-top:0.2rem; }

/* Corps */
.page-body { max-width: 1100px; margin: 1.5rem auto; padding: 0 1.5rem 3rem; }

/* Barre d'outils */
.toolbar {
    display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;
    background: #fff; border: 1px solid #e2e8f0; border-radius: 10px;
    padding: 1rem; margin-bottom: 1.25rem;
}
.search-input {
    flex: 1; min-width: 200px;
    padding: 0.55rem 0.9rem; border: 1px solid #e2e8f0; border-radius: 7px;
    font-size: 0.88rem; outline: none;
}
.search-input:focus { border-color: #0ea5e9; }
.filter-select {
    padding: 0.55rem 0.8rem; border: 1px solid #e2e8f0; border-radius: 7px;
    font-size: 0.85rem; background: #fff; outline: none;
}
.btn-primary {
    padding: 0.55rem 1.1rem; background: #0369a1; color: #fff;
    border: none; border-radius: 7px; font-size: 0.85rem; font-weight: 600;
    cursor: pointer; transition: background 0.15s; white-space: nowrap;
}
.btn-primary:hover { background: #0284c7; }

/* Tableau */
.card { background: #fff; border: 1px solid #e2e8f0; border-radius: 10px; box-shadow: 0 1px 4px rgba(0,0,0,0.06); overflow: hidden; }
.table { width: 100%; border-collapse: collapse; font-size: 0.85rem; }
.table th {
    text-align: left; padding: 0.75rem 1rem;
    font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.05em;
    color: #94a3b8; font-weight: 600; background: #f8fafc; border-bottom: 1px solid #e2e8f0;
}
.table td { padding: 0.85rem 1rem; border-bottom: 1px solid #f1f5f9; color: #475569; vertical-align: middle; }
.table tr:last-child td { border-bottom: none; }
.table tr:hover td { background: #f8fafc; }
.entity-name { font-weight: 600; color: #0c4a6e; }
.entity-code { font-family: monospace; font-size: 0.78rem; color: #64748b; background: #f1f5f9; padding: 0.1rem 0.4rem; border-radius: 3px; }
.entity-parent { font-size: 0.75rem; color: #94a3b8; margin-top: 0.15rem; }

/* Badges */
.badge { display: inline-block; padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.72rem; font-weight: 600; }
.badge-direction { background: #dbeafe; color: #1e40af; }
.badge-service { background: #e0f2fe; color: #0369a1; }
.badge-departement { background: #f0fdf4; color: #065f46; }
.badge-active { background: #d1fae5; color: #065f46; }
.badge-inactive { background: #fee2e2; color: #991b1b; }

/* Boutons actions */
.btn-sm {
    display: inline-block; padding: 0.3rem 0.65rem; border-radius: 5px;
    font-size: 0.76rem; font-weight: 600; cursor: pointer; border: none;
    transition: all 0.12s; text-decoration: none;
}
.btn-edit { background: #e0f2fe; color: #0369a1; }
.btn-edit:hover { background: #bae6fd; }
.btn-danger { background: #fee2e2; color: #dc2626; }
.btn-danger:hover { background: #fecaca; }
.btn-success { background: #d1fae5; color: #059669; }
.btn-success:hover { background: #a7f3d0; }

/* Modal */
.modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 200; display: flex; align-items: center; justify-content: center; padding: 1rem; }
.modal { background: #fff; border-radius: 12px; width: 100%; max-width: 520px; box-shadow: 0 20px 60px rgba(0,0,0,0.2); }
.modal-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; }
.modal-title { font-size: 1rem; font-weight: 700; color: #0369a1; }
.modal-close { background: none; border: none; font-size: 1.2rem; color: #94a3b8; cursor: pointer; }
.modal-body { padding: 1.5rem; }
.form-group { margin-bottom: 1rem; }
.form-label { font-size: 0.8rem; font-weight: 600; color: #334155; display: block; margin-bottom: 0.3rem; }
.form-control { width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #e2e8f0; border-radius: 7px; font-size: 0.88rem; outline: none; }
.form-control:focus { border-color: #0ea5e9; box-shadow: 0 0 0 3px rgba(14,165,233,0.12); }
.form-error { font-size: 0.75rem; color: #dc2626; margin-top: 0.25rem; }
.modal-footer { display: flex; gap: 0.75rem; justify-content: flex-end; margin-top: 1.25rem; }

.empty-state { text-align: center; padding: 3rem; color: #94a3b8; font-size: 0.9rem; }
.alert { padding: 0.75rem 1rem; border-radius: 7px; font-size: 0.85rem; margin-bottom: 1rem; }
.alert-warning { background: #fef3c7; border: 1px solid #fde68a; color: #92400e; }
</style>

<div class="page-bg">
    <div class="page-header">
        <div class="page-header-inner">
            <div>
                <h1>Gestion des Entités</h1>
                <div class="page-header-sub">Directions, services et départements de l'institution</div>
            </div>
            <button wire:click="openCreate" class="btn-primary">+ Nouvelle entité</button>
        </div>
    </div>

    <div class="page-body">

        {{-- Barre de filtres --}}
        <div class="toolbar">
            <input wire:model.live.debounce.300ms="search" type="text"
                   placeholder="Rechercher une entité..." class="search-input">
            <select wire:model.live="filterType" class="filter-select">
                <option value="">Tous les types</option>
                <option value="direction">Direction</option>
                <option value="service">Service</option>
                <option value="departement">Département</option>
            </select>
            <select wire:model.live="filterActif" class="filter-select">
                <option value="">Tous les statuts</option>
                <option value="1">Actives</option>
                <option value="0">Inactives</option>
            </select>
        </div>

        {{-- Tableau --}}
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom / Code</th>
                        <th>Type</th>
                        <th>Rattachement</th>
                        <th>Agents</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($this->entities as $entity)
                    <tr wire:key="entity-{{ $entity->id }}">
                        <td>
                            <div class="entity-name">{{ $entity->nom }}</div>
                            <span class="entity-code">{{ $entity->code }}</span>
                            @if($entity->description)
                            <div class="entity-parent">{{ Str::limit($entity->description, 60) }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-{{ $entity->type }}">{{ ucfirst($entity->type) }}</span>
                        </td>
                        <td>
                            @if($entity->parent)
                                <span style="font-size:0.82rem; color:#475569;">{{ $entity->parent->nom }}</span>
                            @else
                                <span style="color:#94a3b8; font-size:0.8rem;">— Racine —</span>
                            @endif
                        </td>
                        <td>
                            <strong style="color:{{ $entity->agents_count > 0 ? '#0369a1' : '#94a3b8' }}">
                                {{ $entity->agents_count }}
                            </strong>
                        </td>
                        <td>
                            <span class="badge badge-{{ $entity->is_active ? 'active' : 'inactive' }}">
                                {{ $entity->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td style="white-space:nowrap;">
                            <button wire:click="openEdit({{ $entity->id }})" class="btn-sm btn-edit">
                                Modifier
                            </button>
                            @if($entity->agents_count == 0)
                                <button wire:click="toggleActive({{ $entity->id }})"
                                        onclick="return confirm('Confirmer cette action ?')"
                                        class="btn-sm {{ $entity->is_active ? 'btn-danger' : 'btn-success' }}">
                                    {{ $entity->is_active ? 'Désactiver' : 'Réactiver' }}
                                </button>
                            @else
                                <span style="font-size:0.72rem; color:#94a3b8; margin-left:0.4rem;">
                                    (agents liés)
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="empty-state">Aucune entité trouvée.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div style="margin-top:1rem;">
            {{ $this->entities->links() }}
        </div>

    </div>
</div>

{{-- Modal Formulaire --}}
@if($showModal)
<div class="modal-overlay" wire:click.self="closeForm">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title">{{ $entityId ? 'Modifier l\'entité' : 'Nouvelle entité' }}</div>
            <button class="modal-close" wire:click="closeForm">×</button>
        </div>
        <div class="modal-body">
            <form wire:submit="save">
                <div class="form-group">
                    <label class="form-label">Nom de l'entité *</label>
                    <input wire:model="nom" type="text" class="form-control" placeholder="Direction des Ressources Humaines">
                    @error('nom') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                    <div class="form-group">
                        <label class="form-label">Code unique *</label>
                        <input wire:model="code" type="text" class="form-control" placeholder="DRH">
                        @error('code') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Type *</label>
                        <select wire:model.live="type" class="form-control">
                            <option value="direction">Direction</option>
                            <option value="service">Service</option>
                            <option value="departement">Département</option>
                        </select>
                        @error('type') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                @if($type !== 'direction')
                <div class="form-group">
                    <label class="form-label">Entité parente *</label>
                    <select wire:model="parentId" class="form-control">
                        <option value="">-- Sélectionner --</option>
                        @foreach($this->parentOptions as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->nom }} ({{ $parent->type }})</option>
                        @endforeach
                    </select>
                    @error('parentId') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                @endif

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea wire:model="description" class="form-control" rows="3"
                              placeholder="Description optionnelle de l'entité..."></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Ordre d'affichage</label>
                    <input wire:model="ordre" type="number" class="form-control" placeholder="0" min="0">
                </div>

                <div class="modal-footer">
                    <button type="button" wire:click="closeForm"
                            style="padding:0.6rem 1.1rem; border:1px solid #e2e8f0; border-radius:7px; font-size:0.85rem; cursor:pointer; background:#fff; color:#64748b;">
                        Annuler
                    </button>
                    <button type="submit" class="btn-primary">
                        {{ $entityId ? 'Enregistrer' : 'Créer l\'entité' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

</x-app-layout>
</div>