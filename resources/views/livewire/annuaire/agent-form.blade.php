<div>
    @if($showModal)
    <div class="modal-overlay" wire:click.self="closeModal">
        <div class="modal-box" onclick="event.stopPropagation()">

            {{-- Header --}}
            <div class="modal-header">
                <h5>
                    @if($isEdit)
                    <svg width="16" height="16" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="display:inline;margin-right:6px;">
                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                    Modifier l'agent
                    @else
                    <svg width="16" height="16" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="display:inline;margin-right:6px;">
                        <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                        <circle cx="8.5" cy="7" r="4"/>
                        <line x1="20" y1="8" x2="20" y2="14"/>
                        <line x1="23" y1="11" x2="17" y2="11"/>
                    </svg>
                    Ajouter un agent
                    @endif
                </h5>
                <button wire:click="closeModal" class="modal-close">×</button>
            </div>

            {{-- Body --}}
            <div class="modal-body">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">

                    {{-- Matricule --}}
                    @if(!$isEdit)
                    <div class="form-group" style="grid-column:1/-1;">
                        <label class="form-label">Matricule <span>*</span></label>
                        <input wire:model="matricule" type="text" placeholder="Ex: MAT001"
                               class="form-control {{ $errors->has('matricule') ? 'error' : '' }}"
                               style="text-transform:uppercase;">
                        @error('matricule') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                    @endif

                    {{-- Nom --}}
                    <div class="form-group">
                        <label class="form-label">Nom <span>*</span></label>
                        <input wire:model="nom" type="text" placeholder="NOM"
                               class="form-control {{ $errors->has('nom') ? 'error' : '' }}"
                               style="text-transform:uppercase;">
                        @error('nom') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    {{-- Prénom --}}
                    <div class="form-group">
                        <label class="form-label">Prénom <span>*</span></label>
                        <input wire:model="prenom" type="text" placeholder="Prénom"
                               class="form-control {{ $errors->has('prenom') ? 'error' : '' }}">
                        @error('prenom') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group" style="grid-column:1/-1;">
                        <label class="form-label">Email</label>
                        <input wire:model="email" type="email" placeholder="prenom.nom@aninf.ga"
                               class="form-control {{ $errors->has('email') ? 'error' : '' }}">
                        @error('email') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    {{-- Téléphone --}}
                    <div class="form-group">
                        <label class="form-label">Téléphone</label>
                        <input wire:model="telephone" type="text" placeholder="+241 XX XX XX XX"
                               class="form-control {{ $errors->has('telephone') ? 'error' : '' }}">
                        @error('telephone') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    {{-- Poste interne --}}
                    <div class="form-group">
                        <label class="form-label">Poste interne</label>
                        <input wire:model="telephone_interne" type="text" placeholder="Ex: 201"
                               class="form-control {{ $errors->has('telephone_interne') ? 'error' : '' }}">
                        @error('telephone_interne') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    {{-- Entité --}}
                    <div class="form-group" style="grid-column:1/-1;">
                        <label class="form-label">Service / Département <span>*</span></label>
                        <select wire:model="entity_id"
                                class="form-control {{ $errors->has('entity_id') ? 'error' : '' }}">
                            <option value="">— Sélectionner une structure —</option>
                            @foreach($this->entities->groupBy('type') as $type => $entities)
                            <optgroup label="{{ ucfirst($type) }}s">
                                @foreach($entities as $entity)
                                <option value="{{ $entity->id }}">{{ $entity->nom }}</option>
                                @endforeach
                            </optgroup>
                            @endforeach
                        </select>
                        @error('entity_id') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    {{-- Fonction --}}
                    <div class="form-group" style="grid-column:1/-1;">
                        <label class="form-label">Fonction <span>*</span></label>
                        <select wire:model="fonction_id"
                                class="form-control {{ $errors->has('fonction_id') ? 'error' : '' }}">
                            @foreach($this->fonctions as $fonction)
                            <option value="{{ $fonction->id }}">
                                [Niv.{{ $fonction->niveau }}] {{ $fonction->libelle }}
                            </option>
                            @endforeach
                        </select>
                        @error('fonction_id') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    {{-- Bureau --}}
                    <div class="form-group">
                        <label class="form-label">Bureau</label>
                        <input wire:model="bureau" type="text" placeholder="Ex: A-201"
                               class="form-control {{ $errors->has('bureau') ? 'error' : '' }}">
                        @error('bureau') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    {{-- Date prise de fonction --}}
                    <div class="form-group">
                        <label class="form-label">Date de prise de fonction</label>
                        <input wire:model="date_prise_fonction" type="date"
                               class="form-control {{ $errors->has('date_prise_fonction') ? 'error' : '' }}">
                        @error('date_prise_fonction') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                </div>
            </div>

            {{-- Footer --}}
            <div class="modal-footer">
                <button wire:click="closeModal" class="btn-ghost">Annuler</button>
                <button wire:click="save" wire:loading.attr="disabled" class="btn-primary">
                    <span wire:loading.remove wire:target="save">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="display:inline;margin-right:4px;">
                            <polyline points="20,6 9,17 4,12"/>
                        </svg>
                        {{ $isEdit ? 'Enregistrer les modifications' : 'Ajouter l\'agent' }}
                    </span>
                    <span wire:loading wire:target="save" style="display:flex;align-items:center;gap:6px;">
                        <span style="width:14px;height:14px;border:2px solid rgba(255,255,255,0.4);border-top-color:white;border-radius:50%;animation:spin 0.7s linear infinite;display:inline-block;"></span>
                        Enregistrement...
                    </span>
                </button>
            </div>
        </div>
    </div>
    @endif
</div>