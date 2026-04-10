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
            max-width: 1200px;
            margin: 0 auto;
        }

        .action-bar {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
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
            border-radius: 8px;
            padding: 0.4rem 0.8rem;
            font-size: 0.75rem;
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
            border-radius: 8px;
            padding: 0.4rem 0.8rem;
            font-size: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .hierarchy-tree {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border: 1px solid #e2e8f0;
        }

        .entity-item {
            border-bottom: 1px solid #f1f5f9;
            padding: 1rem 1.5rem;
        }

        .entity-item:last-child {
            border-bottom: none;
        }

        .entity-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .entity-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .entity-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: white;
            flex-shrink: 0;
        }

        .entity-direction { background: #0369a1; }
        .entity-service { background: #0ea5e9; }
        .entity-departement { background: #64748b; }

        .entity-details h3 {
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
            color: #0f172a;
        }

        .entity-details p {
            margin: 0.25rem 0 0 0;
            font-size: 0.8rem;
            color: #64748b;
        }

        .entity-actions {
            display: flex;
            gap: 0.5rem;
        }

        .entity-children {
            margin-left: 3rem;
            border-left: 2px solid #e2e8f0;
            padding-left: 1rem;
        }

        .entity-child {
            background: #f8fafc;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .entity-child:last-child {
            margin-bottom: 0;
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
            max-width: 500px;
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

        .form-group {
            margin-bottom: 1rem;
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
    </style>

    {{-- Header --}}
    <div class="admin-header">
        <h1>Hiérarchie des Entités</h1>
        <p>Gérer les directions, services et départements</p>
    </div>

    <div class="admin-content">
        {{-- Messages --}}
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        {{-- Barre d'actions --}}
        <div class="action-bar">
            <div>
                <h3 style="margin:0;font-size:1.1rem;font-weight:600;color:#0f172a;">Structure organisationnelle</h3>
                <p style="margin:0.25rem 0 0 0;font-size:0.85rem;color:#64748b;">Directions → Services → Départements</p>
            </div>
            <button wire:click="createEntity" class="btn-primary">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:inline;margin-right:0.5rem;">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Nouvelle Entité
            </button>
        </div>

        {{-- Arbre hiérarchique --}}
        <div class="hierarchy-tree">
            @forelse($directions as $direction)
                <div class="entity-item">
                    <div class="entity-header">
                        <div class="entity-info">
                            <div class="entity-icon entity-direction">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                    <path d="M3 9h18M9 21V9"/>
                                </svg>
                            </div>
                            <div class="entity-details">
                                <h3>{{ $direction->nom }}</h3>
                                <p>Direction • {{ $direction->children->count() }} services</p>
                            </div>
                        </div>
                        <div class="entity-actions">
                            <span class="status-badge {{ $direction->is_active ? 'status-active' : 'status-inactive' }}">
                                {{ $direction->is_active ? 'Actif' : 'Inactif' }}
                            </span>
                            <button wire:click="editEntity({{ $direction->id }})" class="btn-secondary">Modifier</button>
                            <button wire:click="toggleActive({{ $direction->id }})" class="btn-success">
                                {{ $direction->is_active ? 'Désactiver' : 'Activer' }}
                            </button>
                            <button wire:click="deleteEntity({{ $direction->id }})"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette direction ?')"
                                    class="btn-danger">
                                Supprimer
                            </button>
                        </div>
                    </div>

                    {{-- Services de cette direction --}}
                    @if($direction->children->count() > 0)
                        <div class="entity-children">
                            @foreach($direction->children as $service)
                                <div class="entity-child">
                                    <div class="entity-info">
                                        <div class="entity-icon entity-service">
                                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="3"/>
                                                <path d="M12 1v6m0 6v6m11-7h-6m-6 0H1"/>
                                            </svg>
                                        </div>
                                        <div class="entity-details">
                                            <h3 style="font-size:0.9rem;">{{ $service->nom }}</h3>
                                            <p style="font-size:0.75rem;">Service • {{ $service->children->count() }} départements</p>
                                        </div>
                                    </div>
                                    <div class="entity-actions">
                                        <span class="status-badge {{ $service->is_active ? 'status-active' : 'status-inactive' }}" style="font-size:0.7rem;padding:0.2rem 0.6rem;">
                                            {{ $service->is_active ? 'Actif' : 'Inactif' }}
                                        </span>
                                        <button wire:click="editEntity({{ $service->id }})" class="btn-secondary" style="padding:0.3rem 0.6rem;font-size:0.7rem;">Modifier</button>
                                        <button wire:click="toggleActive({{ $service->id }})" class="btn-success" style="padding:0.3rem 0.6rem;font-size:0.7rem;">
                                            {{ $service->is_active ? 'Désactiver' : 'Activer' }}
                                        </button>
                                        <button wire:click="deleteEntity({{ $service->id }})"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce service ?')"
                                                class="btn-danger"
                                                style="padding:0.3rem 0.6rem;font-size:0.7rem;">
                                            Supprimer
                                        </button>
                                    </div>
                                </div>

                                {{-- Départements de ce service --}}
                                @if($service->children->count() > 0)
                                    <div style="margin-left:2rem;margin-top:0.5rem;">
                                        @foreach($service->children as $departement)
                                            <div class="entity-child" style="background:#f1f5f9;">
                                                <div class="entity-info">
                                                    <div class="entity-icon entity-departement" style="width:32px;height:32px;">
                                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                            <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                        </svg>
                                                    </div>
                                                    <div class="entity-details">
                                                        <h3 style="font-size:0.85rem;">{{ $departement->nom }}</h3>
                                                        <p style="font-size:0.7rem;">Département</p>
                                                    </div>
                                                </div>
                                                <div class="entity-actions">
                                                    <span class="status-badge {{ $departement->is_active ? 'status-active' : 'status-inactive' }}" style="font-size:0.65rem;padding:0.15rem 0.5rem;">
                                                        {{ $departement->is_active ? 'Actif' : 'Inactif' }}
                                                    </span>
                                                    <button wire:click="editEntity({{ $departement->id }})" class="btn-secondary" style="padding:0.25rem 0.5rem;font-size:0.65rem;">Modifier</button>
                                                    <button wire:click="toggleActive({{ $departement->id }})" class="btn-success" style="padding:0.25rem 0.5rem;font-size:0.65rem;">
                                                        {{ $departement->is_active ? 'Désactiver' : 'Activer' }}
                                                    </button>
                                                    <button wire:click="deleteEntity({{ $departement->id }})"
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce département ?')"
                                                            class="btn-danger"
                                                            style="padding:0.25rem 0.5rem;font-size:0.65rem;">
                                                        Supprimer
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <div style="padding:3rem;text-align:center;color:#64748b;">
                    <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24" style="margin:0 auto 1rem auto;opacity:0.5;">
                        <rect x="3" y="3" width="18" height="18" rx="2"/>
                        <path d="M3 9h18M9 21V9"/>
                    </svg>
                    <p>Aucune entité trouvée. Créez votre première direction pour commencer.</p>
                </div>
            @endforelse
        </div>

        {{-- Modal Formulaire --}}
        @if($showForm)
            <div class="modal-overlay" wire:click.self="showForm = false">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">
                            {{ $editingEntity ? 'Modifier l\'entité' : 'Nouvelle entité' }}
                        </h2>
                        <button wire:click="showForm = false" class="modal-close">&times;</button>
                    </div>

                    <div class="modal-body">
                        <form wire:submit.prevent="saveEntity">
                            <div class="form-group">
                                <label class="form-label">Nom</label>
                                <input type="text" wire:model="form.nom" class="form-input">
                                @error('form.nom') <span style="color:#ef4444;font-size:0.75rem;margin-top:0.25rem;display:block;">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Type</label>
                                <select wire:model.live="form.type" class="form-select">
                                    <option value="direction">Direction</option>
                                    <option value="service">Service</option>
                                    <option value="departement">Département</option>
                                </select>
                                @error('form.type') <span style="color:#ef4444;font-size:0.75rem;margin-top:0.25rem;display:block;">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group" wire:ignore>
                                <label class="form-label">
                                    Entité parente
                                    @if($form['type'] === 'direction')
                                        <small style="color:#64748b;font-weight:400;">(non applicable pour les directions)</small>
                                    @elseif($form['type'] === 'service')
                                        <small style="color:#64748b;font-weight:400;">(doit être une direction)</small>
                                    @else
                                        <small style="color:#64748b;font-weight:400;">(doit être un service)</small>
                                    @endif
                                </label>
                                <select wire:model="form.parent_id" class="form-select" {{ $form['type'] === 'direction' ? 'disabled' : '' }}>
                                    <option value="">
                                        @if($form['type'] === 'direction')
                                            Aucune (direction racine)
                                        @elseif($form['type'] === 'service')
                                            Sélectionner une direction
                                        @else
                                            Sélectionner un service
                                        @endif
                                    </option>
                                    @foreach($availableParents as $parent)
                                        @if($form['type'] === 'service' && $parent->type === 'direction')
                                            <option value="{{ $parent->id }}">{{ $parent->nom }} (Direction)</option>
                                        @elseif($form['type'] === 'departement' && $parent->type === 'service')
                                            <option value="{{ $parent->id }}">{{ $parent->nom }} (Service)</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('form.parent_id') <span style="color:#ef4444;font-size:0.75rem;margin-top:0.25rem;display:block;">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="checkbox-group">
                                    <input type="checkbox" wire:model="form.is_active">
                                    <span>Entité active</span>
                                </label>
                            </div>

                            <div style="display:flex;gap:1rem;margin-top:2rem;">
                                <button type="submit" class="btn-primary" style="flex:1;">
                                    {{ $editingEntity ? 'Modifier' : 'Créer' }} l'entité
                                </button>
                                <button type="button" wire:click="showForm = false" class="btn-secondary">
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
