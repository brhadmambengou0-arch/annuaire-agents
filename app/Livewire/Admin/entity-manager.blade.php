<div>

    <div class="p-6">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Gestion des entités</h1>

            <button wire:click="create"
                    class="bg-blue-600 text-white px-4 py-2 rounded">
                 Nouvelle entité
            </button>
        </div>

        {{-- MESSAGE --}}
        @if (session()->has('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- TABLE --}}
        <div class="bg-white shadow rounded overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Nom</th>
                        <th class="p-3 text-left">Type</th>
                        <th class="p-3 text-left">Parent</th>
                        <th class="p-3 text-left">Statut</th>
                        <th class="p-3 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($entities as $entity)
                        <tr class="border-t">
                            <td class="p-3">{{ $entity->nom }}</td>

                            <td class="p-3">{{ $entity->type }}</td>

                            <td class="p-3">
                                {{ $entity->parent?->nom ?? '-' }}
                            </td>

                            <td class="p-3">
                                {{ $entity->is_active ? 'Actif' : 'Inactif' }}
                            </td>

                            <td class="p-3 text-right space-x-2">
                                <button wire:click="edit('{{ $entity->uuid }}')"
                                        class="text-blue-600">
                                    Modifier
                                </button>

                                <button wire:click="toggle('{{ $entity->uuid }}')"
                                        class="text-yellow-600">
                                    Statut
                                </button>

                                <button wire:click="delete('{{ $entity->uuid }}')"
                                        class="text-red-600">
                                    Supprimer
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center">
                                Aucune entité trouvée
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    {{-- MODAL (EN DEHORS DU CONTENT MAIS DANS LE ROOT) --}}
    @if($showModal ?? false)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">

            <div class="bg-white p-6 rounded w-full max-w-lg">

                <h2 class="text-xl mb-4">
                    {{ $editing ? 'Modifier' : 'Créer' }}
                </h2>

                <div class="space-y-3">

                    <input type="text"
                           wire:model="nom"
                           placeholder="Nom"
                           class="w-full border p-2 rounded">

                    <select wire:model="type"
                            class="w-full border p-2 rounded">
                        <option value="">Type</option>
                        <option value="direction">Direction</option>
                        <option value="service">Service</option>
                        <option value="division">Division</option>
                    </select>

                    <select wire:model="parent_id"
                            class="w-full border p-2 rounded">
                        <option value="">Aucun parent</option>

                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}">
                                {{ $parent->nom }}
                            </option>
                        @endforeach
                    </select>

                </div>

                <div class="flex justify-end mt-4 space-x-2">
                    <button wire:click="$set('showModal', false)"
                            class="border px-4 py-2 rounded">
                        Annuler
                    </button>

                    <button wire:click="save"
                            class="bg-blue-600 text-white px-4 py-2 rounded">
                        Enregistrer
                    </button>
                </div>

            </div>
        </div>
    @endif

</div>