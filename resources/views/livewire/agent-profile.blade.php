<div class="min-h-screen bg-gradient-to-br from-sky-800 via-sky-700 to-sky-500 py-10">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-6 lg:grid-cols-12">
            <div class="lg:col-span-4">
                <div class="rounded-3xl bg-white p-6 shadow-2xl shadow-slate-900/10">
                    <div class="text-center">
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-sky-600">Mon Profil</p>
                        <h1 class="mt-3 text-3xl font-bold text-slate-900">Mon compte ANINF</h1>
                        <p class="mt-3 text-sm leading-6 text-slate-600">Sélectionne une photo, vérifie l’aperçu puis clique sur Confirmer.</p>
                    </div>

                    <div class="mt-8 rounded-3xl border border-slate-200 bg-slate-50 p-6 text-center">
                        <div class="mx-auto mb-4 h-32 w-32 overflow-hidden rounded-full bg-slate-200 shadow-inner">
                            @if($photo)
                                <img src="{{ $photo->temporaryUrl() }}" alt="Aperçu de la photo" class="h-full w-full object-cover" />
                            @elseif(optional($agent)->photo_url)
                                <img src="{{ asset('storage/' . $agent->photo_url) }}" alt="Photo de profil" class="h-full w-full object-cover" />
                            @else
                                <div class="flex h-full w-full items-center justify-center bg-slate-300 text-4xl font-semibold text-slate-600">
                                    {{ strtoupper(substr(optional($agent)->prenom ?? $name, 0, 1) . substr(optional($agent)->nom ?? '', 0, 1)) }}
                                </div>
                            @endif
                        </div>

                        @if($photo)
                            <div class="space-y-2">
                                <p class="text-sm font-semibold text-slate-900">Aperçu réel</p>
                                <p class="text-sm text-slate-500">{{ $photo->getClientOriginalName() }}</p>
                                <p class="text-xs text-slate-500">La vraie image sélectionnée s’affiche ici avant la confirmation.</p>
                            </div>
                        @elseif(optional($agent)->photo_url)
                            <p class="text-sm text-slate-500">Photo enregistrée</p>
                        @else
                            <p class="text-sm text-slate-500">Aucune photo enregistrée</p>
                        @endif
                    </div>

                    <div class="mt-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <label class="block text-sm font-semibold text-slate-700">Changer la photo</label>
                        <p class="mt-2 text-xs text-slate-500">Choisis un fichier depuis ton téléphone ou ton ordinateur. L’image s’affiche immédiatement.</p>
                        <input type="file" wire:model="photo" accept="image/*" class="mt-4 w-full rounded-2xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700" />
                        @error('photo') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="mt-6 rounded-3xl border border-slate-200 bg-slate-50 p-5 text-left text-sm text-slate-600">
                        <p class="font-semibold text-slate-800">Actions</p>
                        <ul class="mt-3 space-y-2">
                            <li class="flex items-start gap-3">
                                <span class="mt-1 inline-flex h-2.5 w-2.5 rounded-full bg-sky-500"></span>
                                <span>Choisir une photo visible avant enregistrement.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-1 inline-flex h-2.5 w-2.5 rounded-full bg-sky-500"></span>
                                <span>Changer email et numéros en cliquant sur Modifier.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-1 inline-flex h-2.5 w-2.5 rounded-full bg-sky-500"></span>
                                <span>Cliquer sur Confirmer pour enregistrer.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8">
                <form wire:submit.prevent="saveProfile">
                    <div class="rounded-3xl bg-white p-6 shadow-2xl shadow-slate-900/10">
                        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                            <div>
                                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-sky-600">Informations modifiables</p>
                                <h2 class="mt-3 text-2xl font-bold text-slate-900">Modifier mes coordonnées</h2>
                            </div>
                            <div class="flex flex-wrap items-center gap-3">
                                <button type="button" wire:click.prevent="enableEditing" class="rounded-full bg-sky-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-300">Modifier</button>
                                <button type="submit" wire:loading.attr="disabled" class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-sky-600 via-cyan-500 to-emerald-500 px-6 py-3 text-sm font-semibold text-white shadow-2xl shadow-cyan-500/20 transition duration-200 hover:from-sky-700 hover:via-cyan-600 hover:to-emerald-600 focus:outline-none focus:ring-4 focus:ring-cyan-200">Confirmer</button>
                                <span class="rounded-full bg-sky-50 px-3 py-2 text-xs font-semibold uppercase tracking-[0.18em] text-sky-700">{{ $editMode ? 'Édition activée' : 'Lecture seule' }}</span>
                            </div>
                        </div>

                    <div class="mt-8 grid gap-6 lg:grid-cols-2">
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                            <p class="text-sm font-semibold text-slate-700">Prénom</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">{{ optional($agent)->prenom ?? $name }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                            <p class="text-sm font-semibold text-slate-700">Nom</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">{{ optional($agent)->nom ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="mt-8 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="grid gap-6 lg:grid-cols-2">
                            <div>
                                <label for="email" class="block text-sm font-semibold text-slate-700">Email</label>
                                <input type="email" wire:model="email" id="email" @if(!$editMode) readonly @endif class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-700 focus:border-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                                @error('email') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="telephone_professionnel" class="block text-sm font-semibold text-slate-700">Téléphone professionnel</label>
                                <input type="tel" wire:model="telephone_professionnel" id="telephone_professionnel" @if(!$editMode) readonly @endif class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-700 focus:border-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                                @error('telephone_professionnel') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="telephone_prive" class="block text-sm font-semibold text-slate-700">Téléphone privé</label>
                                <input type="tel" wire:model="telephone_prive" id="telephone_prive" @if(!$editMode) readonly @endif class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-700 focus:border-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                                @error('telephone_prive') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700">Photo sélectionnée</label>
                                <div class="mt-2 rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm text-slate-500">
                                    @if($photo)
                                        {{ $photo->getClientOriginalName() }}
                                    @elseif(optional($agent)->photo_url)
                                        {{ basename($agent->photo_url) }}
                                    @else
                                        Aucune photo sélectionnée
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900">Changer le mot de passe</h3>
                                <p class="text-sm text-slate-500">Seulement si tu veux le mettre à jour.</p>
                            </div>
                            <button type="button" onclick="togglePasswordVisibility()" class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Afficher / masquer</button>
                        </div>

                        <div class="mt-6 grid gap-6 lg:grid-cols-2">
                            <div>
                                <label for="current_password" class="block text-sm font-semibold text-slate-700">Mot de passe actuel</label>
                                <input type="password" wire:model="current_password" id="current_password" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-700 focus:border-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                                @error('current_password') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-semibold text-slate-700">Nouveau mot de passe</label>
                                <input type="password" wire:model="password" id="password" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-700 focus:border-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                                @error('password') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                            </div>
                            <div class="lg:col-span-2">
                                <label for="password_confirmation" class="block text-sm font-semibold text-slate-700">Confirmer le mot de passe</label>
                                <input type="password" wire:model="password_confirmation" id="password_confirmation" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-700 focus:border-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 lg:flex-row lg:justify-end">
                        <button type="button" wire:click.prevent="cancelEditing" class="inline-flex items-center justify-center rounded-3xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">Annuler</button>
                        <button type="submit" wire:loading.attr="disabled" class="inline-flex items-center justify-center rounded-3xl bg-sky-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-sky-500/10 transition hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-400">Confirmer</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        const fields = ['current_password', 'password', 'password_confirmation'];
        fields.forEach((fieldId) => {
            const field = document.getElementById(fieldId);
            if (!field) return;
            field.type = field.type === 'password' ? 'text' : 'password';
        });
    }
</script>
