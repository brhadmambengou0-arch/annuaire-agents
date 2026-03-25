{{-- Modal formulaire agent — AgentForm --}}
@if($showModal)
<div class="fixed inset-0 z-50 flex items-center justify-center p-4"
     style="background:rgba(13,79,124,.18);"
     x-data @click.self="$wire.set('showModal', false)">

    <div class="w-full overflow-hidden rounded-2xl" style="max-width:560px;background:#fff;border:1px solid #c8e1f5;max-height:90vh;overflow-y:auto;">

        {{-- En-tête --}}
        <div class="flex items-center justify-between px-6 py-4 sticky top-0 z-10"
             style="background:linear-gradient(135deg,#1a7fc1,#0d6fa8);">
            <h2 class="font-display font-semibold text-white" style="font-size:16px;">
                {{ $agentId ? 'Modifier l\'agent' : 'Ajouter un agent' }}
            </h2>
            <button wire:click="$set('showModal', false)"
                    class="flex items-center justify-center rounded-full text-white text-lg"
                    style="width:28px;height:28px;background:rgba(255,255,255,.2);border:none;cursor:pointer;">
                ✕
            </button>
        </div>

        <div class="px-6 py-5">
            <form wire:submit="save">

                {{-- Section : Identité --}}
                <div class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#4a7fa0;">
                    Identité
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    {{-- Matricule --}}
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-widest mb-1.5" style="color:#4a7fa0;">
                            Matricule *
                        </label>
                        <input wire:model="matricule"
                               type="text"
                               placeholder="MAT001"
                               {{ $agentId ? 'readonly' : '' }}
                               class="w-full rounded-xl text-sm outline-none px-3"
                               style="height:42px;border:1px solid {{ $errors->has('matricule') ? '#fca5a5' : '#d0e8f8' }};
                                      background:{{ $agentId ? '#f1f5f9' : '#f9fcff' }};
                                      color:#0d4f7c;font-family:'DM Sans',sans-serif;"
                               onfocus="if(!this.readOnly){this.style.borderColor='#1a7fc1';this.style.boxShadow='0 0 0 3px rgba(26,143,209,.1)'}"
                               onblur="this.style.borderColor='{{ $errors->has('matricule') ? '#fca5a5' : '#d0e8f8' }}';this.style.boxShadow='none'" />
                        @error('matricule')
                            <span class="text-xs mt-1" style="color:#dc2626;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Prénom --}}
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-widest mb-1.5" style="color:#4a7fa0;">
                            Prénom *
                        </label>
                        <input wire:model="prenom" type="text" placeholder="Ibrahima"
                               class="w-full rounded-xl text-sm outline-none px-3"
                               style="height:42px;border:1px solid {{ $errors->has('prenom') ? '#fca5a5' : '#d0e8f8' }};background:#f9fcff;color:#0d4f7c;font-family:'DM Sans',sans-serif;"
                               onfocus="this.style.borderColor='#1a7fc1';this.style.boxShadow='0 0 0 3px rgba(26,143,209,.1)'"
                               onblur="this.style.borderColor='#d0e8f8';this.style.boxShadow='none'" />
                        @error('prenom')
                            <span class="text-xs mt-1" style="color:#dc2626;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Nom --}}
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-widest mb-1.5" style="color:#4a7fa0;">
                            Nom *
                        </label>
                        <input wire:model="nom" type="text" placeholder="SOW"
                               class="w-full rounded-xl text-sm outline-none px-3"
                               style="height:42px;border:1px solid {{ $errors->has('nom') ? '#fca5a5' : '#d0e8f8' }};background:#f9fcff;color:#0d4f7c;font-family:'DM Sans',sans-serif;"
                               onfocus="this.style.borderColor='#1a7fc1';this.style.boxShadow='0 0 0 3px rgba(26,143,209,.1)'"
                               onblur="this.style.borderColor='#d0e8f8';this.style.boxShadow='none'" />
                        @error('nom')
                            <span class="text-xs mt-1" style="color:#dc2626;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Bureau --}}
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-widest mb-1.5" style="color:#4a7fa0;">
                            Bureau
                        </label>
                        <input wire:model="bureau" type="text" placeholder="A-201"
                               class="w-full rounded-xl text-sm outline-none px-3"
                               style="height:42px;border:1px solid #d0e8f8;background:#f9fcff;color:#0d4f7c;font-family:'DM Sans',sans-serif;"
                               onfocus="this.style.borderColor='#1a7fc1';this.style.boxShadow='0 0 0 3px rgba(26,143,209,.1)'"
                               onblur="this.style.borderColor='#d0e8f8';this.style.boxShadow='none'" />
                    </div>
                </div>

                {{-- Section : Contact --}}
                <div class="text-xs font-semibold uppercase tracking-widest mb-3 mt-1" style="color:#4a7fa0;border-top:0.5px solid #e0eff8;padding-top:16px;">
                    Contact
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-widest mb-1.5" style="color:#4a7fa0;">
                            Email
                        </label>
                        <input wire:model="email" type="email" placeholder="i.sow@aninf.ga"
                               class="w-full rounded-xl text-sm outline-none px-3"
                               style="height:42px;border:1px solid {{ $errors->has('email') ? '#fca5a5' : '#d0e8f8' }};background:#f9fcff;color:#0d4f7c;font-family:'DM Sans',sans-serif;"
                               onfocus="this.style.borderColor='#1a7fc1';this.style.boxShadow='0 0 0 3px rgba(26,143,209,.1)'"
                               onblur="this.style.borderColor='#d0e8f8';this.style.boxShadow='none'" />
                        @error('email')
                            <span class="text-xs mt-1" style="color:#dc2626;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-widest mb-1.5" style="color:#4a7fa0;">
                            Téléphone
                        </label>
                        <input wire:model="telephone" type="text" placeholder="+241 77 100 001"
                               class="w-full rounded-xl text-sm outline-none px-3"
                               style="height:42px;border:1px solid #d0e8f8;background:#f9fcff;color:#0d4f7c;font-family:'DM Sans',sans-serif;"
                               onfocus="this.style.borderColor='#1a7fc1';this.style.boxShadow='0 0 0 3px rgba(26,143,209,.1)'"
                               onblur="this.style.borderColor='#d0e8f8';this.style.boxShadow='none'" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-widest mb-1.5" style="color:#4a7fa0;">
                            Poste interne
                        </label>
                        <input wire:model="telephone_interne" type="text" placeholder="201"
                               class="w-full rounded-xl text-sm outline-none px-3"
                               style="height:42px;border:1px solid #d0e8f8;background:#f9fcff;color:#0d4f7c;font-family:'DM Sans',sans-serif;"
                               onfocus="this.style.borderColor='#1a7fc1';this.style.boxShadow='0 0 0 3px rgba(26,143,209,.1)'"
                               onblur="this.style.borderColor='#d0e8f8';this.style.boxShadow='none'" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-widest mb-1.5" style="color:#4a7fa0;">
                            Date de prise de fonction
                        </label>
                        <input wire:model="date_prise_fonction" type="date"
                               class="w-full rounded-xl text-sm outline-none px-3"
                               style="height:42px;border:1px solid #d0e8f8;background:#f9fcff;color:#0d4f7c;font-family:'DM Sans',sans-serif;"
                               onfocus="this.style.borderColor='#1a7fc1'"
                               onblur="this.style.borderColor='#d0e8f8'" />
                    </div>
                </div>

                {{-- Section : Rattachement --}}
                <div class="text-xs font-semibold uppercase tracking-widest mb-3 mt-1" style="color:#4a7fa0;border-top:0.5px solid #e0eff8;padding-top:16px;">
                    Rattachement organisationnel
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    {{-- Entité --}}
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-widest mb-1.5" style="color:#4a7fa0;">
                            Structure *
                        </label>
                        <select wire:model="entityId"
                                class="w-full rounded-xl text-sm outline-none px-3"
                                style="height:42px;border:1px solid {{ $errors->has('entityId') ? '#fca5a5' : '#d0e8f8' }};background:#f9fcff;color:#0d4f7c;font-family:'DM Sans',sans-serif;">
                            <option value="">Sélectionner...</option>
                            @foreach(\App\Models\Entity::where('is_active',true)->orderBy('nom')->get() as $entity)
                                <option value="{{ $entity->id }}">{{ $entity->nom }}</option>
                            @endforeach
                        </select>
                        @error('entityId')
                            <span class="text-xs mt-1" style="color:#dc2626;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Fonction --}}
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-widest mb-1.5" style="color:#4a7fa0;">
                            Fonction *
                        </label>
                        <select wire:model="fonctionId"
                                class="w-full rounded-xl text-sm outline-none px-3"
                                style="height:42px;border:1px solid {{ $errors->has('fonctionId') ? '#fca5a5' : '#d0e8f8' }};background:#f9fcff;color:#0d4f7c;font-family:'DM Sans',sans-serif;">
                            @foreach(\App\Models\Fonction::where('is_active',true)->orderBy('niveau')->get() as $f)
                                <option value="{{ $f->id }}">Niv.{{ $f->niveau }} — {{ $f->libelle }}</option>
                            @endforeach
                        </select>
                        @error('fonctionId')
                            <span class="text-xs mt-1" style="color:#dc2626;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Boutons --}}
                <div class="flex justify-end gap-3">
                    <button type="button"
                            wire:click="$set('showModal', false)"
                            class="text-sm px-5 py-2.5 rounded-xl transition"
                            style="border:1px solid #d0e8f8;background:#fff;color:#7aaecc;cursor:pointer;font-family:'DM Sans',sans-serif;"
                            onmouseover="this.style.background='#f0f7fd'"
                            onmouseout="this.style.background='#fff'">
                        Annuler
                    </button>
                    <button type="submit"
                            class="text-sm font-semibold px-6 py-2.5 rounded-xl text-white transition flex items-center gap-2"
                            style="background:#1a7fc1;border:none;cursor:pointer;font-family:'DM Sans',sans-serif;"
                            onmouseover="this.style.opacity='.9'"
                            onmouseout="this.style.opacity='1'">
                        <div wire:loading wire:target="save">
                            <svg class="w-4 h-4 animate-spin fill-white" viewBox="0 0 24 24"><path d="M12 4V1L8 5l4 4V6c3.31 0 6 2.69 6 6s-2.69 6-6 6-6-2.69-6-6H4c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8z"/></svg>
                        </div>
                        {{ $agentId ? 'Enregistrer les modifications' : 'Créer l\'agent' }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endif
