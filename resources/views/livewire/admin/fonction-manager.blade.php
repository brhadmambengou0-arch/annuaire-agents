{{-- PAGE HEADER --}}
<div class="page-header">
    <div class="page-header-inner">
        <div>
            <h1 class="page-title">
                <svg width="20" height="20" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="display:inline;margin-right:6px;vertical-align:middle;">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
                Référentiel des Fonctions
            </h1>
            <div class="page-subtitle">Niveaux hiérarchiques 1 à 6 — ANINF</div>
            <div class="breadcrumb-aninf">
                <a href="{{ route('annuaire.index') }}">Accueil</a>
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
                <span>Administration</span>
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
                <span>Fonctions</span>
            </div>
        </div>
        <button wire:click="openCreate" class="btn-primary" style="background:rgba(255,255,255,0.2);border:1.5px solid rgba(255,255,255,0.35);box-shadow:none;">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Nouvelle fonction
        </button>
    </div>
</div>

<div style="max-width:1000px;margin:0 auto;padding:1.5rem;">

    {{-- Niveaux --}}
    <div style="display:grid;grid-template-columns:repeat(6,1fr);gap:0.6rem;margin-bottom:1.5rem;">
        @foreach(range(1,6) as $niv)
        @php $count = $this->fonctions->where('niveau', $niv)->count(); @endphp
        <div style="background:white;border-radius:12px;border:1px solid #e0f2fe;padding:0.8rem;text-align:center;">
            <div style="font-family:'Sora',sans-serif;font-size:1.2rem;font-weight:700;color:#0284c7;">{{ $count }}</div>
            <div style="font-size:0.7rem;color:#64748b;">Niveau {{ $niv }}</div>
        </div>
        @endforeach
    </div>

    <div class="table-wrap">
        <div class="section-card-header" style="padding:1rem 1.4rem;">
            <h5>
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
                Toutes les fonctions
            </h5>
            <span style="font-size:0.8rem;color:#64748b;">{{ $this->fonctions->count() }} fonctions</span>
        </div>
        <table class="aninf-table">
            <thead>
                <tr>
                    <th>Niveau</th>
                    <th>Code</th>
                    <th>Libellé</th>
                    <th>Description</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($this->fonctions as $fonction)
                <tr>
                    <td>
                        @php
                            $niveauColors = ['#0369a1','#0284c7','#0ea5e9','#38bdf8','#7dd3fc','#bae6fd'];
                            $nc = $niveauColors[($fonction->niveau - 1)] ?? '#0ea5e9';
                        @endphp
                        <span style="background:{{ $nc }};color:white;width:28px;height:28px;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;font-family:'Sora',sans-serif;font-weight:700;font-size:0.82rem;">
                            {{ $fonction->niveau }}
                        </span>
                    </td>
                    <td>
                        <span style="font-family:'Sora',sans-serif;font-size:0.76rem;font-weight:600;color:#0284c7;background:#e0f2fe;padding:2px 8px;border-radius:5px;">
                            {{ $fonction->code }}
                        </span>
                    </td>
                    <td style="font-weight:500;">{{ $fonction->libelle }}</td>
                    <td style="font-size:0.8rem;color:#64748b;max-width:250px;">
                        {{ Str::limit($fonction->description ?? '—', 60) }}
                    </td>
                    <td>
                        @if($fonction->is_active)
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
                            <button wire:click="openEdit({{ $fonction->id }})" class="btn-warning" style="padding:4px 10px;font-size:0.75rem;">
                                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                                Modifier
                            </button>
                            <button
                                wire:click="toggleActive({{ $fonction->id }})"
                                wire:confirm="Confirmer ce changement de statut ?"
                                class="{{ $fonction->is_active ? 'btn-danger' : 'btn-primary' }}"
                                style="padding:4px 10px;font-size:0.75rem;">
                                {{ $fonction->is_active ? 'Désactiver' : 'Activer' }}
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;padding:2rem;color:#94a3b8;">Aucune fonction trouvée.</td></tr>
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
            <h5>{{ $editId ? 'Modifier la fonction' : 'Nouvelle fonction' }}</h5>
            <button wire:click="$set('showModal', false)" class="modal-close">×</button>
        </div>
        <div class="modal-body">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">

                @if(!$editId)
                <div class="form-group">
                    <label class="form-label">Code <span>*</span></label>
                    <input wire:model="code" type="text" placeholder="Ex: CHEF_SERVICE"
                           class="form-control {{ $errors->has('code') ? 'error' : '' }}"
                           style="text-transform:uppercase;">
                    @error('code') <span class="form-error">{{ $message }}</span> @enderror
                </div>
                @endif

                <div class="form-group" style="{{ !$editId ? '' : 'grid-column:1/-1;' }}">
                    <label class="form-label">Niveau (1-6) <span>*</span></label>
                    <select wire:model="niveau" class="form-control {{ $errors->has('niveau') ? 'error' : '' }}">
                        @foreach(range(1,6) as $n)
                        <option value="{{ $n }}">Niveau {{ $n }}</option>
                        @endforeach
                    </select>
                    @error('niveau') <span class="form-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group" style="grid-column:1/-1;">
                    <label class="form-label">Libellé <span>*</span></label>
                    <input wire:model="libelle" type="text" placeholder="Ex: Chef de Service"
                           class="form-control {{ $errors->has('libelle') ? 'error' : '' }}">
                    @error('libelle') <span class="form-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group" style="grid-column:1/-1;">
                    <label class="form-label">Description</label>
                    <textarea wire:model="description" rows="2" placeholder="Description optionnelle..."
                              class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button wire:click="$set('showModal', false)" class="btn-ghost">Annuler</button>
            <button wire:click="save" class="btn-primary">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <polyline points="20,6 9,17 4,12"/>
                </svg>
                {{ $editId ? 'Enregistrer' : 'Créer la fonction' }}
            </button>
        </div>
    </div>
</div>
@endif