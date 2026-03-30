{{-- PAGE HEADER --}}
<div class="page-header">
    <div class="page-header-inner">
        <div>
            <h1 class="page-title">
                <svg width="20" height="20" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="display:inline;margin-right:6px;vertical-align:middle;">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                </svg>
                Gestion des Structures
            </h1>
            <div class="page-subtitle">Directions, Services, Départements — ANINF</div>
            <div class="breadcrumb-aninf">
                <a href="{{ route('annuaire.index') }}">Accueil</a>
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
                <span>Administration</span>
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
                <span>Structures</span>
            </div>
        </div>
        <button wire:click="openCreate" class="btn-primary" style="background:rgba(255,255,255,0.2);border:1.5px solid rgba(255,255,255,0.35);box-shadow:none;">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Nouvelle structure
        </button>
    </div>
</div>

<div style="max-width:1200px;margin:0 auto;padding:1.5rem;">

    {{-- Tableau --}}
    <div class="table-wrap">
        <div class="section-card-header" style="padding:1rem 1.4rem;">
            <h5>
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                </svg>
                Toutes les structures
            </h5>
            <span style="font-size:0.8rem;color:#64748b;">{{ $this->entities->count() }} structures</span>
        </div>
        <table class="aninf-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Parent</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($this->entities as $entity)
                <tr>
                    <td>
                        <span style="font-family:'Sora',sans-serif;font-size:0.78rem;font-weight:600;color:#0284c7;background:#e0f2fe;padding:2px 8px;border-radius:5px;">
                            {{ $entity->code }}
                        </span>
                    </td>
                    <td style="font-weight:500;">{{ $entity->nom }}</td>
                    <td>
                        @php
                            $typeColors = [
                                'direction'   => ['bg'=>'#0369a1','text'=>'white'],
                                'service'     => ['bg'=>'#e0f2fe','text'=>'#0284c7'],
                                'departement' => ['bg'=>'#f1f5f9','text'=>'#64748b'],
                            ];
                            $tc = $typeColors[$entity->type] ?? ['bg'=>'#f1f5f9','text'=>'#64748b'];
                        @endphp
                        <span style="background:{{ $tc['bg'] }};color:{{ $tc['text'] }};padding:2px 10px;border-radius:6px;font-size:0.75rem;font-weight:600;text-transform:capitalize;">
                            {{ $entity->type }}
                        </span>
                    </td>
                    <td style="font-size:0.82rem;color:#64748b;">{{ $entity->parent?->nom ?? '—' }}</td>
                    <td>
                        @if($entity->is_active)
                        <span style="display:inline-flex;align-items:center;gap:4px;color:#16a34a;font-size:0.78rem;font-weight:600;">
                            <span style="width:7px;height:7px;border-radius:50%;background:#22c55e;"></span> Actif
                        </span>
                        @else
                        <span style="display:inline-flex;align-items:center;gap:4px;color:#dc2626;font-size:0.78rem;font-weight:600;">
                            <span style="width:7px;height:7px;border-radius:50%;background:#ef4444;"></span> Inactif
                        </span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;gap:0.4rem;">
                            <button wire:click="openEdit({{ $entity->id }})" class="btn-warning" style="padding:4px 10px;font-size:0.75rem;">
                                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                                Modifier
                            </button>
                            <button
                                wire:click="toggleActive({{ $entity->id }})"
                                wire:confirm="Confirmer ce changement de statut ?"
                                class="{{ $entity->is_active ? 'btn-danger' : 'btn-primary' }}"
                                style="padding:4px 10px;font-size:0.75rem;">
                                {{ $entity->is_active ? 'Désactiver' : 'Activer' }}
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;padding:2rem;color:#94a3b8;">Aucune structure trouvée.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL --}}
@if($showModal)
<div class="modal-overlay" wire:click.self="$set('showModal', false)">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h5>{{ $editId ? 'Modifier la structure' : 'Nouvelle structure' }}</h5>
            <button wire:click="$set('showModal', false)" class="modal-close">×</button>
        </div>
        <div class="modal-body">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">

                <div class="form-group">
                    <label class="form-label">Nom <span>*</span></label>
                    <input wire:model="nom" type="text" placeholder="Nom de la structure"
                           class="form-control {{ $errors->has('nom') ? 'error' : '' }}">
                    @error('nom') <span class="form-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Code <span>*</span></label>
                    <input wire:model="code" type="text" placeholder="Ex: DRH"
                           class="form-control {{ $errors->has('code') ? 'error' : '' }}"
                           style="text-transform:uppercase;">
                    @error('code') <span class="form-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Type <span>*</span></label>
                    <select wire:model.live="type" class="form-control {{ $errors->has('type') ? 'error' : '' }}">
                        <option value="direction">Direction</option>
                        <option value="service">Service</option>
                        <option value="departement">Département</option>
                    </select>
                    @error('type') <span class="form-error">{{ $message }}</span> @enderror
                </div>

                @if($type !== 'direction')
                <div class="form-group">
                    <label class="form-label">Structure parente <span>*</span></label>
                    <select wire:model="parent_id" class="form-control {{ $errors->has('parent_id') ? 'error' : '' }}">
                        <option value="">— Sélectionner —</option>
                        @foreach($this->parents as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->nom }}</option>
                        @endforeach
                    </select>
                    @error('parent_id') <span class="form-error">{{ $message }}</span> @enderror
                </div>
                @endif

                <div class="form-group" style="grid-column:1/-1;">
                    <label class="form-label">Description</label>
                    <textarea wire:model="description" rows="2" placeholder="Description optionnelle..."
                              class="form-control {{ $errors->has('description') ? 'error' : '' }}"></textarea>
                    @error('description') <span class="form-error">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button wire:click="$set('showModal', false)" class="btn-ghost">Annuler</button>
            <button wire:click="save" class="btn-primary">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <polyline points="20,6 9,17 4,12"/>
                </svg>
                {{ $editId ? 'Enregistrer' : 'Créer la structure' }}
            </button>
        </div>
    </div>
</div>
@endif