<div>
    <h1>Gestion des Entités (Directions/Services)</h1>

    <button wire:click="openCreate" class="btn-primary">Ajouter une entité</button>

    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Code</th>
                <th>Type</th>
                <th>Parent</th>
                <th>Ordre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entities as $entity)
            <tr>
                <td>{{ $entity->nom }}</td>
                <td>{{ $entity->code }}</td>
                <td>{{ $entity->type }}</td>
                <td>{{ $entity->parent->nom ?? '-' }}</td>
                <td>{{ $entity->ordre }}</td>
                <td>
                    <button wire:click="edit('{{ $entity->uuid }}')">Modifier</button>
                    <button wire:click="delete('{{ $entity->uuid }}')">Supprimer</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>