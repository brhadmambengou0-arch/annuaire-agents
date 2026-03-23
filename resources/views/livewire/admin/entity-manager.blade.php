<div class="p-6">

    {{-- Titre + bouton ajouter --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Gestion des Structures Organisationnelles
        </h1>
        <button wire:click="openCreate"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            + Nouvelle entité
        </button>
    </div>

    {{-- Messages flash --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Tableau des entités --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-gray-600">Nom</th>
                    <th class="px-6 py-3 text-gray-600">Code</th>
                    <th class="px-6 py-3 text-gray-600">Type</th>
                    <th class="px-6 py-3 text-gray-600">Parent</th>
                    <th class="px-6 py-3 text-gray-600">Statut</th>
                    <th class="px-6 py-3 text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($entities as $entity)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium">{{ $entity->nom }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $entity->code }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded text-xs font-medium
                            {{ $entity->type === 'direction' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $entity->type === 'service' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $entity->type === 'departement' ? 'bg-yellow-100 text-yellow-700' : '' }}">
                            {{ ucfirst($entity->type) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-500">
                        {{ $entity->parent?->nom ?? '—' }}
                    </td>
                    <td class="px-6 py-4">
                        @if($entity->is_active)
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">
                                Actif
                            </span>
                        @else
                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs">
                                Inactif
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 space-x-2">
                        <button wire:click="openEdit({{ $entity->id }})"
                                class="text-blue-600 hover:underline text-sm">
                            Modifier
                        </button>
                        @if($entity->is_active)
                        <button wire:click="deactivate({{ $entity->id }})"
                                wire:confirm="Désactiver cette entité ?"
                                class="text-red-600 hover:underline text-sm">
                            Désactiver
                        </button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                        Aucune entité trouvée.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal formulaire --}}
    @if($showModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg">

            <h2 class="text-xl font-bold mb-4">
                {{ $entityId ? 'Modifier l\'entité' : 'Nouvelle entité' }}
            </h2>

            {{-- Nom --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nom *
                </label>
                <input wire:model="nom" type="text"
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                       placeholder="Ex: Direction des Ressources Humaines" />
                @error('nom')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Code --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Code *
                </label>
                <input wire:model="code" type="text"
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                       placeholder="Ex: DRH" />
                @error('code')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Type --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Type *
                </label>
                <select wire:model="type"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="direction">Direction</option>
                    <option value="service">Service</option>
                    <option value="departement">Département</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Parent --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Entité parente
                </label>
                <select wire:model="parentId"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">— Aucun parent (Direction racine) —</option>
                    @foreach($parents as $parent)
                        <option value="{{ $parent->id }}">
                            {{ $parent->nom }} ({{ $parent->type }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Ordre --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Ordre d'affichage
                </label>
                <input wire:model="ordre" type="number"
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                       placeholder="0" />
            </div>

            {{-- Boutons --}}
            <div class="flex justify-end space-x-3 mt-6">
                <button wire:click="$set('showModal', false)"
                        class="px-4 py-2 border rounded-lg text-gray-600 hover:bg-gray-50">
                    Annuler
                </button>
                <button wire:click="save"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    {{ $entityId ? 'Modifier' : 'Créer' }}
                </button>
            </div>
        </div>
    </div>
    @endif

</div>
