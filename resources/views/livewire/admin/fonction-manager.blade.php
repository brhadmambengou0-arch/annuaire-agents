<div>
    <h1>Gestion des Fonctions</h1>
    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Libellé</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fonctions as $fonction)
            <tr>
                <td>{{ $fonction->code }}</td>
                <td>{{ $fonction->libelle }}</td>
                <td>
                    <button wire:click="edit({{ $fonction->id }})">Modifier</button>
                    <button wire:click="delete({{ $fonction->id }})">Supprimer</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>