{{--
    FICHIER : resources/views/livewire/admin/fonction-manager.blade.php
    COMPOSANT : App\Livewire\Admin\FonctionManager
    RÔLE : Gestion CRUD du référentiel des fonctions.
           Affiche la liste complète des fonctions avec leur niveau (1 à 6),
           leur code et leur nombre d'agents associés.
           Permet de créer, modifier et désactiver les fonctions.
           Protection : on ne peut désactiver si des agents actifs utilisent la fonction.
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

/* Barre */
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
.fonction-name { font-weight: 600; color: #0c4a6e; }
.fonction-code { font-family: monospace; font-size: 0.78rem; color: #64748b; background: #f1f5f9; padding: 0.1rem 0.4rem; border-radius: 3px; }

/* Niveau visuel */
.niveau-bar { display: flex; gap: 3px; align-items: center; }
.niveau-dot { width: 10px; height: 10px; border-radius: 50%; background: #e2e8f0; }
.niveau-dot.active { background: #0ea5e9; }

/* Badges */
.badge { display: inline-block; padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.72rem; font-weight: 600; }
.badge-active { background: #d1fae5; color: #065f46; }
.badge-inactive { background: #fee2e2; color: #991b1b; }

/* Boutons actions */
.btn-sm { display: inline-block; padding: 0.3rem 0.65rem; border-radius: 5px; font-size: 0.76rem; font-weight: 600; cursor: pointer; border: none; transition: all 0.12s; }
.btn-edit { background: #e0f2fe; color: #0369a1; }
.btn-edit:hover { background: #bae6fd; }
.btn-danger { background: #fee2e2; color: #dc2626; }
.btn-danger:hover { background: #fecaca; }
.btn-success { background: #d1fae5; color: #059669; }
.btn-success:hover { background: #a7f3d0; }

/* Légende niveaux */
.levels-legend {
    background: #fff; border: 1px solid #e2e8f0; border-radius: 10px;
    padding: 1.25rem; margin-bottom: 1.25rem;
}
.levels-legend-title { font-size: 0.82rem; font-weight: 700; color: #0369a1; margin-bottom: 0.75rem; }
.levels-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 0.5rem; }
.level-item { text-align: center; }
.level-num { font-size: 1.3rem; font-weight: 800; color: #0369a1; }
.level-lbl { font-size: 0.68rem; color: #64748b; line-height: 1.3; }

/* Modal */
.modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 200; display: flex; align-items: center; justify-content: center; padding: 1rem; }
.modal { background: #fff; border-radius: 12px; width: 100%; max-width: 480px; box-shadow: 0 20px 60px rgba(0,0,0,0.2); }
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

.level-note { font-size: 0.75rem; color: #94a3b8; font-style: italic; margin-top: 0.25rem; }
</style>

<div class="page-bg">
    <div class="page-header">
        <div class="page-header-inner">
            <div>
                <h1>Référentiel des Fonctions</h1>
                <div class="page-header-sub"></div>
            </div>
            <button wire:click="openCreate" class="btn-primary">+ Nouvelle fonction</button>
        </div>
    </div>

    <div class="page-body">

        {{-- Légende niveaux --}}
        <div class="levels-legend">
            <div class="levels-legend-title">Echelle des niveaux hiérarchiques</div>
            <div class="levels-grid">
                <div class="level-item"><div class="level-num">1</div><div class="level-lbl">Agent / Exécution</div></div>
                <div class="level-item"><div class="level-num">2</div><div class="level-lbl">Technicien</div></div>
                <div class="level-item"><div class="level-num">3</div><div class="level-lbl">Chargé / Chef</div></div>
                <div class="level-item"><div class="level-num">4</div><div class="level-lbl">Conseiller / Sous-dir.</div></div>
                <div class="level-item"><div class="level-num">5</div><div class="level-lbl">Directeur</div></div>
                <div class="level-item"><div class="level-num">6</div><div class="level-lbl">Dir. Général</div></div>
            </div>
        </div>

        {{-- Barre de filtres --}}
        <div class="toolbar">
            <input wire:model.live="search" type="text"
                   placeholder="Rechercher une fonction..." class="search-input">
            <select wire:model.live="filterNiveau" class="filter-select">
                <option value="">Tous les niveaux</option>
                @for($i = 1; $i <= 6; $i++)
                    <option value="{{ $i }}">Niveau {{ $i }}</option>
                @endfor
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
                        <th>Libellé / Code</th>
                        <th>Niveau</th>
                        <th>Description</th>
                        <th>Agents</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grouped = $fonctions->groupBy("niveau")->sortKeys(); @endphp
                    @forelse($grouped as $niveau => $groupe)
                    <tr><td colspan="6" style="background:#f0f9ff;padding:0.6rem 1rem;font-size:0.72rem;font-weight:700;color:#0369a1;text-transform:uppercase;letter-spacing:0.06em;">Niveau {{ $niveau }} — ({{ $groupe->count() }})</td></tr>
                    @foreach($groupe as $fonction)
                    <tr wire:key="fonction-{{ $fonction->id }}">
                        <td>
                            <div class="fonction-name">{{ $fonction->libelle }}</div>
                            <span class="fonction-code">{{ $fonction->code }}</span>
                        </td>
                        <td>
                            <div style="display:flex; align-items:center; gap:0.5rem;">
                                <div class="niveau-bar">
                                    @for($i = 1; $i <= 6; $i++)
                                        <div class="niveau-dot {{ $i <= $fonction->niveau ? 'active' : '' }}"></div>
                                    @endfor
                                </div>
                                <span style="font-size:0.78rem; font-weight:600; color:#0369a1;">{{ $fonction->niveau }}</span>
                            </div>
                        </td>
                        <td style="max-width:260px;">
                            <span style="font-size:0.8rem; color:#64748b;">
                                {{ $fonction->description ? Str::limit($fonction->description, 70) : '—' }}
                            </span>
                        </td>
                        <td>
                            <strong style="color:{{ $fonction->agents_count > 0 ? '#0369a1' : '#94a3b8' }}">
                                {{ $fonction->agents_count }}
                            </strong>
                        </td>
                        <td>
                            <span class="badge badge-{{ $fonction->is_active ? 'active' : 'inactive' }}">
                                {{ $fonction->is_active ? 'Active' : 'Inactive' }}
                            </span>
                  </td>
<td style="white-space:nowrap;">
    <button wire:click="openEdit('{{ $fonction->id }}')" class="btn-sm btn-edit">
        Modifier
    </button>

    @if($fonction->agents_count == 0)
        <button wire:click="toggleActive('{{ $fonction->id }}')"
                wire:confirm="Confirmer cette action ?"
                class="btn-sm {{ $fonction->is_active ? 'btn-danger' : 'btn-success' }}">
            {{ $fonction->is_active ? 'Désactiver' : 'Réactiver' }}
        </button>
    @else
        <span style="font-size:0.72rem; color:#94a3b8; margin-left:0.4rem;">
            (agents liés)
        </span>
    @endif
</td>
                    </tr>
                    @endforeach
                    @empty
                    <tr>
                        <td colspan="6" class="empty-state">Aucune fonction trouvée.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div style="margin-top:1rem;">
            
        </div>

    </div>
</div>

{{-- Model Formulaire --}}
@if($showModal)
<div class="modal-overlay" wire:click.self="closeForm">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title">{{ $fonctionId ? 'Modifier la fonction' : 'Nouvelle fonction' }}</div>
            <button class="modal-close" wire:click="closeForm">×</button>
        </div>
        <div class="modal-body">
            <form wire:submit="save">

                <div class="form-group">
                    <label class="form-label">Code unique *</label>
                    <input wire:model="code" type="text" class="form-control"
                           placeholder="EX: CHEF_SERVICE"
                           {{ $fonctionId ? 'disabled' : '' }}>
                    @if($fonctionId)
                        <p class="level-note">Le code est immuable après création.</p>
                    @endif
                    @error('code') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Libellé *</label>
                    <input wire:model="libelle" type="text" class="form-control"
                           placeholder="Chef de Service">
                    @error('libelle') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Niveau hiérarchique (1 à 6) *</label>
                    <select wire:model="niveau" class="form-control">
                        <option value="1">Niveau 1 — Agent / Exécution</option>
                        <option value="2">Niveau 2 — Technicien</option>
                        <option value="3">Niveau 3 — Chargé / Chef de service</option>
                        <option value="4">Niveau 4 — Conseiller / Sous-directeur</option>
                        <option value="5">Niveau 5 — Directeur</option>
                        <option value="6">Niveau 6 — Directeur Général</option>
                    </select>
                    @error('niveau') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea wire:model="description" class="form-control" rows="3"
                              placeholder="Description du poste et des responsabilités associées..."></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" wire:click="closeForm"
                            style="padding:0.6rem 1.1rem; border:1px solid #e2e8f0; border-radius:7px; font-size:0.85rem; cursor:pointer; background:#fff; color:#64748b;">
                        Annuler
                    </button>
                    <button type="submit" class="btn-primary">
                        {{ $fonctionId ? 'Enregistrer' : 'Créer la fonction' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

</x-app-layout>
</div>