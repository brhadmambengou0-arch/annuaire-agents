<div class="admin-container">
    <style>
        .admin-container {
            min-height: 100vh;
            background: #f0f9ff;
            font-family: 'DM Sans', sans-serif;
        }

        .admin-header {
            background: #0369a1;
            color: white;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .admin-header h1 {
            font-family: 'Sora', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
        }

        .admin-header p {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .admin-content {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .action-bar {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border: 1px solid #e2e8f0;
        }

        .search-filters {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto;
            gap: 1rem;
            align-items: end;
        }

        .form-group {
            margin-bottom: 0;
        }

        .form-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .form-input, .form-select {
            width: 100%;
            padding: 0.68rem 1rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.87rem;
            color: #0f172a;
            background: white;
            transition: all 0.2s;
            outline: none;
            font-family: 'DM Sans', sans-serif;
        }

        .form-input:focus, .form-select:focus {
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14,165,233,0.12);
        }

        .btn-primary {
            background: #0ea5e9;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.68rem 1.5rem;
            font-size: 0.87rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-primary:hover {
            background: #0284c7;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(14,165,233,0.3);
        }

        .btn-secondary {
            background: white;
            color: #64748b;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.68rem 1.5rem;
            font-size: 0.87rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-secondary:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .btn-success {
            background: #10b981;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-success:hover {
            background: #059669;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .agents-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border: 1px solid #e2e8f0;
        }

        .table-header {
            background: #f8fafc;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            font-weight: 600;
            color: #374151;
            font-size: 0.9rem;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr auto;
            gap: 1rem;
        }

        .table-row {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr auto;
            align-items: center;
            gap: 1rem;
        }

        .table-row:last-child {
            border-bottom: none;
        }

        .table-row:hover {
            background: #f8fafc;
        }

        .agent-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .agent-avatar {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: #e0f2fe;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #0369a1;
            flex-shrink: 0;
        }

        .agent-details h4 {
            margin: 0;
            font-size: 0.9rem;
            font-weight: 600;
            color: #0f172a;
        }

        .agent-details p {
            margin: 0.25rem 0 0 0;
            font-size: 0.8rem;
            color: #64748b;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-align: center;
        }

        .status-active {
            background: #dcfce7;
            color: #166534;
        }

        .status-inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            padding: 2rem;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-family: 'Sora', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #64748b;
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .modal-close:hover {
            background: #f1f5f9;
            color: #374151;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-full {
            grid-column: 1 / -1;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .checkbox-group input {
            width: 16px;
            height: 16px;
            accent-color: #0ea5e9;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .page-link {
            padding: 0.5rem 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            text-decoration: none;
            color: #64748b;
            transition: all 0.2s;
        }

        .page-link:hover, .page-link.active {
            background: #0ea5e9;
            color: white;
            border-color: #0ea5e9;
        }

        .alert {
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        @media (max-width: 768px) {
            .search-filters {
                grid-template-columns: 1fr;
            }

            .table-row {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    {{-- Header --}}
    <div class="admin-header">
        <h1>Gestion des Agents</h1>
        <p>Gérer les agents, leurs informations et leurs comptes utilisateur</p>
    </div>

    <div class="admin-content">
        {{-- Messages --}}
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        {{-- Barre d'actions --}}
        <div class="action-bar">
            <div class="search-filters">
                <div class="form-group">
                    <label class="form-label">Rechercher</label>
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Nom, prénom, email, matricule..." class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Entité</label>
                    <select wire:model.live="selectedEntity" class="form-select">
                        <option value="">Toutes les entités</option>
                        @foreach($allEntities as $entity)
                            <option value="{{ $entity->id }}">{{ $entity->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Fonction</label>
                    <select wire:model.live="selectedFonction" class="form-select">
                        <option value="">Toutes les fonctions</option>
                        @foreach($allFonctions as $fonction)
                            <option value="{{ $fonction->id }}">{{ $fonction->libelle }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <button wire:click="createAgent" class="btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:inline;margin-right:0.5rem;">
                            <path d="M12 5v14M5 12h14"/>
                        </svg>
                        Nouveau Agent
                    </button>
                </div>
            </div>
        </div>

        {{-- Table des agents --}}
        <div class="agents-table">
            <div class="table-header">
                <div>Agent</div>
                <div>Contact</div>
                <div>Entité</div>
                <div>Fonction</div>
                <div>Statut</div>
                <div>Actions</div>
            </div>

            @forelse($agents as $agent)
                <div class="table-row">
                    <div class="agent-info">
                        <div class="agent-avatar">
                            @if($agent->photo_url)
                                <img src="{{ asset('storage/' . $agent->photo_url) }}" alt="Photo" style="width:100%;height:100%;border-radius:6px;object-fit:cover;">
                            @else
                                {{ strtoupper(substr($agent->prenom, 0, 1) . substr($agent->nom, 0, 1)) }}
                            @endif
                        </div>
                        <div class="agent-details">
                            <h4>{{ $agent->nom_complet }}</h4>
                            <p>{{ $agent->matricule }}</p>
                        </div>
                    </div>

                    <div>
                        @if($agent->email)
                            <div style="font-size:0.85rem;color:#374151;margin-bottom:0.25rem;">{{ $agent->email }}</div>
                        @endif
                        @if($agent->telephone_professionnel)
                            <div style="font-size:0.8rem;color:#64748b;">{{ $agent->telephone_professionnel }}</div>
                        @endif
                    </div>

                    <div>
                        <div style="font-size:0.85rem;color:#374151;">{{ $agent->entity?->nom ?? '-' }}</div>
                        @if($agent->bureau)
                            <div style="font-size:0.8rem;color:#64748b;">Bureau {{ $agent->bureau }}</div>
                        @endif
                    </div>

                    <div style="font-size:0.85rem;color:#374151;">
                        {{ $agent->fonction?->libelle ?? '-' }}
                    </div>

                    <div>
                        <span class="status-badge {{ $agent->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $agent->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </div>

                    <div class="action-buttons">
                        <button wire:click="editAgent('{{ $agent->id }}')" class="btn-secondary" style="padding:0.4rem 0.8rem;font-size:0.75rem;">
                            Modifier
                        </button>
                        <button wire:click="toggleActive('{{ $agent->id }}')" class="btn-success" style="padding:0.4rem 0.8rem;font-size:0.75rem;">
                            {{ $agent->is_active ? 'Désactiver' : 'Activer' }}
                        </button>
                        <button wire:click="deleteAgent('{{ $agent->id }}')"
                                wire:confirm="Êtes-vous sûr de vouloir supprimer cet agent ?"
                                class="btn-danger"
                                style="padding:0.4rem 0.8rem;font-size:0.75rem;">
                            Supprimer
                        </button>
                    </div>
                </div>
            @empty
                <div class="table-row">
                    <div style="grid-column:1/-1;text-align:center;color:#64748b;padding:2rem;">
                        Aucun agent trouvé
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($agents->hasPages())
            <div class="pagination">
                {{ $agents->links() }}
            </div>
        @endif

        {{-- Modal Formulaire --}}
        @if($showForm)
            <div class="modal-overlay" wire:click.self="closeForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">
                            {{ $editingAgent ? 'Modifier l\'agent' : 'Nouveau agent' }}
                        </h2>
                        <button wire:click="closeForm" class="modal-close">&times;</button>
                    </div>

                    <div class="modal-body">
                        <form wire:submit.prevent="saveAgent">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Matricule</label>
                                    <input type="text" wire:model="form.matricule" readonly class="form-input" style="background:#f8fafc;">
                                    @error('form.matricule') <span style="color:#ef4444;font-size:0.75rem;margin-top:0.25rem;display:block;">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Nom</label>
                                    <input type="text" wire:model="form.nom" class="form-input">
                                    @error('form.nom') <span style="color:#ef4444;font-size:0.75rem;margin-top:0.25rem;display:block;">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Prénom</label>
                                    <input type="text" wire:model="form.prenom" class="form-input">
                                    @error('form.prenom') <span style="color:#ef4444;font-size:0.75rem;margin-top:0.25rem;display:block;">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" wire:model="form.email" class="form-input">
                                    @error('form.email') <span style="color:#ef4444;font-size:0.75rem;margin-top:0.25rem;display:block;">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Téléphone professionnel</label>
                                    <input type="tel" wire:model="form.telephone_professionnel" class="form-input">
                                    @error('form.telephone_professionnel') <span style="color:#ef4444;font-size:0.75rem;margin-top:0.25rem;display:block;">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Téléphone privé</label>
                                    <input type="tel" wire:model="form.telephone_prive" class="form-input">
                                    @error('form.telephone_prive') <span style="color:#ef4444;font-size:0.75rem;margin-top:0.25rem;display:block;">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Direction</label>
                                    <select wire:model.live="form.direction_id" class="form-select">
                                        <option value="">Sélectionner une direction</option>
                                        @foreach($directions as $direction)
                                            <option value="{{ $direction->id }}">{{ $direction->nom }}</option>
                                        @endforeach
                                    </select>
                                    @error('form.direction_id') <span style="color:#ef4444;font-size:0.75rem;margin-top:0.25rem;display:block;">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Service</label>
                                    <select wire:model="form.service_id" class="form-select" {{ empty($services) ? 'disabled' : '' }}>
                                        <option value="">Sélectionner un service (optionnel)</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Fonction</label>
                                    <select wire:model="form.fonction_id" class="form-select">
                                        <option value="">Sélectionner une fonction</option>
                                        @foreach($fonctions as $fonction)
                                            <option value="{{ $fonction->id }}">{{ $fonction->libelle }}</option>
                                        @endforeach
                                    </select>
                                    @error('form.fonction_id') <span style="color:#ef4444;font-size:0.75rem;margin-top:0.25rem;display:block;">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Bureau</label>
                                    <input type="text" wire:model="form.bureau" class="form-input" placeholder="Ex: 101">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Date de prise de fonction</label>
                                    <input type="date" wire:model="form.date_prise_fonction" class="form-input">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Photo de profil</label>
                                    <input type="file" wire:model="photo" accept="image/*" class="form-input">
                                    @error('photo') <span style="color:#ef4444;font-size:0.75rem;margin-top:0.25rem;display:block;">{{ $message }}</span> @enderror
                                    <small style="color:#64748b;font-size:0.75rem;margin-top:0.25rem;display:block;">Formats acceptés : JPG, PNG, GIF. Taille max : 2MB</small>
                                </div>

                                <div class="form-group form-full">
                                    <label class="checkbox-group">
                                        <input type="checkbox" wire:model="form.is_active">
                                        <span>Agent actif</span>
                                    </label>
                                </div>
                            </div>

                            <div style="display:flex;gap:1rem;margin-top:2rem;">
                                <button type="submit" class="btn-primary" style="flex:1;">
                                    {{ $editingAgent ? 'Modifier' : 'Créer' }} l'agent
                                </button>
                                <button type="button" wire:click="closeForm" class="btn-secondary">
                                    Annuler
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
