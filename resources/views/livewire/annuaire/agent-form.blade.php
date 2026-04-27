<div>
    {{-- MODAL --}}
    <div x-data="{ show: false }"
         x-on:show-modal.window="show = true"
         x-on:hide-modal.window="show = false"
         x-show="show"
         x-cloak
         class="modal-overlay"
         style="display: none;"
         x-transition>
        <div class="modal-box" @click.stop>
            <div class="modal-header">
                <h5>{{ $agentId ? 'Modifier l\'agent' : 'Ajouter un agent' }}</h5>
                <button
                    type="button"
                    class="modal-close"
                    @click="show = false; $wire.resetForm()"
                >×</button>
            </div>

            <form wire:submit.prevent="save">
                <div class="modal-body">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Matricule <span>*</span></label>
                            <input type="text" wire:model="form.matricule" class="form-control">
                            @error('form.matricule') <span class="form-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nom <span>*</span></label>
                            <input type="text" wire:model="form.nom" class="form-control">
                            @error('form.nom') <span class="form-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Prénom <span>*</span></label>
                            <input type="text" wire:model="form.prenom" class="form-control">
                            @error('form.prenom') <span class="form-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email <span>*</span></label>
                            <input type="email" wire:model="form.email" class="form-control">
                            @error('form.email') <span class="form-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Téléphone</label>
                            <input type="text" wire:model="form.telephone" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Téléphone pro</label>
                            <input type="text" wire:model="form.telephone_pro" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Direction/Service <span>*</span></label>
                            <select wire:model="form.entity_id" class="form-control">
                                <option value="">Sélectionner...</option>
                                @foreach($entities as $entity)
                                    <option value="{{ $entity->uuid }}">{{ $entity->nom }}</option>
                                @endforeach
                            </select>
                            @error('form.entity_id') <span class="form-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Fonction <span>*</span></label>
                            <select wire:model="form.fonction_id" class="form-control">
                                <option value="">Sélectionner...</option>
                                @foreach($fonctions as $fonction)
                                    <option value="{{ $fonction->id }}">{{ $fonction->libelle }}</option>
                                @endforeach
                            </select>
                            @error('form.fonction_id') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <input type="checkbox" wire:model="form.is_active" class="mr-2"> Agent actif
                        </label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn-ghost"
                        @click="show = false; $wire.resetForm()"
                    >Annuler</button>
                    <button type="submit" class="btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>