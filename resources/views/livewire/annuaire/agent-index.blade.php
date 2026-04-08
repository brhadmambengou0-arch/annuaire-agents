<div>

    {{-- FILTRES --}}
    <div class="grid grid-cols-4 gap-4 mb-4">

        <input type="text"
               wire:model.live="search"
               placeholder="Rechercher..."
               class="border p-2 rounded">

       

        <select wire:model.live="fonction_id" class="border p-2 rounded">
            <option value="">Toutes les fonctions</option>
            @foreach($fonctions as $f)
                <option value="{{ $f->id }}">{{ $f->libelle }}</option>
            @endforeach
        </select>

        <select wire:model.live="is_active" class="border p-2 rounded">
            <option value="">Tous</option>
            <option value="1">Actifs</option>
            <option value="0">Inactifs</option>
        </select>

    </div>

    {{-- TABLE --}}
    <table class="w-full border">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Entité</th>
                <th>Fonction</th>
                <th>Statut</th>
            </tr>
        </thead>

        <tbody>
            @forelse($agents as $agent)
                <tr>
                    <td>{{ $agent->nom_complet }}</td>
                    <td>{{ $agent->email }}</td>
                    <td>{{ $agent->entity->nom ?? '-' }}</td>
                    <td>{{ $agent->fonction->libelle ?? '-' }}</td>
                    <td>
                        {{ $agent->is_active ? 'Actif' : 'Inactif' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Aucun résultat</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- PAGINATION --}}
    <div class="mt-4">
        {{ $agents->links() }}
    </div>

</div>