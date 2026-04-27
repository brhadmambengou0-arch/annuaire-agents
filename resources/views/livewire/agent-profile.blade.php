<div class="max-w-2xl mx-auto p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Mon Profil</h2>

        @if (!$hasAgent)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <p>Votre profil agent n'a pas été trouvé. Veuillez contacter un administrateur.</p>
            </div>
            <div class="mt-4">
                <a href="{{ route('agent.index') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Retour à l'annuaire
                </a>
            </div>
        @else

        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="saveProfile" enctype="multipart/form-data">
            {{-- Photo de profil --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Photo de profil</label>
                <div class="flex items-start space-x-4">
                    <div class="flex flex-col">
                        <div class="w-24 h-24 rounded-lg overflow-hidden bg-gray-200 flex items-center justify-center border-2 border-gray-300">
                            @if($photo)
                                <img src="{{ $photo->temporaryUrl() }}" alt="Aperçu" class="w-full h-full object-cover">
                            @elseif($agent->photo_url)
                                <img src="{{ asset('storage/' . $agent->photo_url) }}" alt="Photo de profil" class="w-full h-full object-cover">
                            @else
                                <span class="text-3xl font-bold text-gray-500">
                                    {{ strtoupper(substr($agent->prenom, 0, 1) . substr($agent->nom, 0, 1)) }}
                                </span>
                            @endif
                        </div>
                        @if($photo)
                            <button type="button" wire:click="$set('photo', null)" class="mt-2 text-xs text-red-500 hover:text-red-700">
                                Annuler la sélection
                            </button>
                        @endif
                    </div>
                    <div class="flex-1">
                        <label class="inline-block px-4 py-2 bg-blue-50 text-blue-700 rounded-lg border border-blue-200 cursor-pointer hover:bg-blue-100 transition font-medium text-sm">
                            Sélectionner une photo
                            <input type="file" wire:model="photo" accept="image/*" class="hidden">
                        </label>
                        @error('photo') <span class="text-red-500 text-sm block mt-2">{{ $message }}</span> @enderror
                        <p class="text-xs text-gray-500 mt-2">JPG, PNG ou GIF. Max 2MB.</p>
                        <p class="text-xs text-gray-400 mt-1">Format recommandé : carré (1:1)</p>
                    </div>
                </div>
            </div>

            {{-- Informations personnelles --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                    <input type="text" value="{{ $agent->prenom }}" readonly class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                    <input type="text" value="{{ $agent->nom }}" readonly class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-500">
                </div>
            </div>

            {{-- Email --}}
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" wire:model="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Téléphones --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="telephone_professionnel" class="block text-sm font-medium text-gray-700 mb-2">Téléphone professionnel</label>
                    <input type="tel" wire:model="telephone_professionnel" id="telephone_professionnel" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('telephone_professionnel') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="telephone_prive" class="block text-sm font-medium text-gray-700 mb-2">Téléphone privé</label>
                    <input type="tel" wire:model="telephone_prive" id="telephone_prive" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('telephone_prive') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Changement de mot de passe --}}
            <div class="border-t pt-6">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Changer le mot de passe</h3>

                <div class="mb-4">
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe actuel</label>
                    <input type="password" wire:model="current_password" id="current_password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('current_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Nouveau mot de passe</label>
                        <input type="password" wire:model="password" id="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirmer le mot de passe</label>
                        <input type="password" wire:model="password_confirmation" id="password_confirmation" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            {{-- Boutons --}}
            <div class="flex justify-end space-x-4 pt-6 border-t">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Sauvegarder
                </button>
            </div>
        </form>
        @endif
    </div>
</div>
