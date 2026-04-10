<div>
    <x-app-layout>
        <div style="display: flex; flex-direction: column; gap: 2rem;">
            <!-- PAGE HEADER -->
            <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 1.5rem; border-bottom: 2px solid #e2e8f0; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <h1 style="font-family: 'Sora', sans-serif; font-size: 2rem; font-weight: 700; color: #0f172a; margin-bottom: 0.5rem;">Gestion des fonctions</h1>
                    <p style="color: #64748b; font-size: 0.95rem;">Postes et rôles dans l'organisation</p>
                </div>
                <button wire:click="openCreate()" style="padding: 0.7rem 1.5rem; background: linear-gradient(135deg, #0369a1, #0ea5e9); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.9rem; transition: all 0.2s;">
                     Ajouter fonction
                </button>
            </div>

            <!-- SEARCH BAR -->
            <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 1rem; display: flex; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 0.5rem; flex: 1; border-right: 1px solid #e2e8f0;">
                    <span style="color: #94a3b8;">🔍</span>
                    <input wire:model.live="search" type="text" placeholder="Rechercher une fonction..." style="border: none; outline: none; flex: 1; font-size: 0.9rem;" />
                </div>
                @if($search)
                    <button wire:click="resetSearch()" style="padding: 0.5rem 1rem; background: #fee2e2; color: #ef4444; border: none; border-radius: 6px; font-size: 0.85rem; font-weight: 600; cursor: pointer;">
                        ✕ Réinitialiser
                    </button>
                @endif
            </div>

            <!-- FONCTIONS TABLE -->
            <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                            <th style="text-align: left; padding: 1rem; font-weight: 600; color: #64748b; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.05em;">Fonction</th>
                            <th style="text-align: left; padding: 1rem; font-weight: 600; color: #64748b; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.05em;">Description</th>
                            <th style="text-align: center; padding: 1rem; font-weight: 600; color: #64748b; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.05em;">Agents</th>
                            <th style="text-align: center; padding: 1rem; font-weight: 600; color: #64748b; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.05em;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($fonctions as $fonction)
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 1rem; color: #0f172a; font-weight: 600;">{{ $fonction->nom }}</td>
                                <td style="padding: 1rem; color: #475569; font-size: 0.9rem;">{{ $fonction->description ?? '-' }}</td>
                                <td style="padding: 1rem; text-align: center; color: #0369a1; font-weight: 600;">
                                    {{ $fonction->agents()->where('is_active', true)->count() }}
                                </td>
                                <td style="padding: 1rem; text-align: center;">
                                    <button wire:click="edit({{ $fonction->id }})" style="padding: 0.4rem 0.8rem; background: #e0f2fe; color: #0369a1; border: none; border-radius: 6px; font-size: 0.8rem; font-weight: 600; cursor: pointer; margin-right: 0.5rem;">
                                         Éditer
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="padding: 2rem; text-align: center; color: #94a3b8;">
                                    Aucune fonction trouvée
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            @if($fonctions->hasPages())
                <div style="display: flex; justify-content: center;">
                    {{ $fonctions->links() }}
                </div>
            @endif
        </div>

        <!-- CREATE/EDIT MODAL -->
        @if($showModal)
            <div style="position: fixed; inset: 0; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; z-index: 50;">
                <div style="background: white; border-radius: 12px; padding: 2rem; max-width: 500px; width: 90%;">
                    <h2 style="font-size: 1.5rem; font-weight: 700; color: #0f172a; margin: 0 0 1.5rem 0;">
                        {{ $editingId ? 'Éditer fonction' : 'Nouvelle fonction' }}
                    </h2>

                    <div style="display: grid; gap: 1rem;">
                        <div>
                            <label style="display: block; color: #64748b; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">Nom</label>
                            <input wire:model="form.nom" type="text" style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 0.9rem; outline: none;" />
                            @error('form.nom') <span style="color: #ef4444; font-size: 0.8rem;">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label style="display: block; color: #64748b; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">Description</label>
                            <textarea wire:model="form.description" style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 0.9rem; outline: none; min-height: 100px;"></textarea>
                        </div>

                        <div>
                            <label style="display: block; color: #64748b; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">Niveau</label>
                            <input wire:model="form.niveau" type="number" style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 0.9rem; outline: none;" />
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                        <button wire:click="closeModal()" style="flex: 1; padding: 0.75rem; border: 1px solid #e2e8f0; background: white; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">
                            Annuler
                        </button>
                        <button wire:click="save()" style="flex: 1; padding: 0.75rem; background: linear-gradient(135deg, #0369a1, #0ea5e9); color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">
                            {{ $editingId ? 'Mettre à jour' : 'Créer' }}
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </x-app-layout>
</div>
