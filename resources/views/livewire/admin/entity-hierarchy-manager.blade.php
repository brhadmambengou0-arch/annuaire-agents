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
        .admin-header h1 { font-family: 'Sora', sans-serif; font-size: 1.8rem; font-weight: 700; margin: 0; }
        .admin-header p { margin: 0.5rem 0 0 0; opacity: 0.9; font-size: 0.9rem; }
        .admin-content { padding: 2rem; max-width: 1200px; margin: 0 auto; }
        .action-bar {
            background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e2e8f0;
            display: flex; justify-content: space-between; align-items: center;
        }
        .btn-primary {
            background: #0ea5e9; color: white; border: none; border-radius: 10px;
            padding: 0.68rem 1.5rem; font-size: 0.87rem; font-weight: 600; cursor: pointer;
            transition: all 0.2s; font-family: 'DM Sans', sans-serif;
            display: inline-flex; align-items: center; gap: 0.4rem;
        }
        .btn-primary:hover { background: #0284c7; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(14,165,233,0.3); }
        .action-btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 0.3rem;
            height: 32px; min-width: 100px; padding: 0 12px; border-radius: 8px;
            font-size: 0.75rem; font-weight: 600; cursor: pointer; border: 1.5px solid transparent;
            transition: all 0.15s; font-family: 'DM Sans', sans-serif; white-space: nowrap;
        }
        .btn-edit { background: #0ea5e9; color: white; border-color: #0ea5e9; }
        .btn-edit:hover { background: #0284c7; border-color: #0284c7; }
        .btn-toggle-off { background: white; color: #0369a1; border-color: #0ea5e9; }
        .btn-toggle-off:hover { background: #f0f9ff; }
        .btn-toggle-on { background: white; color: #0369a1; border-color: #0ea5e9; }
        .btn-toggle-on:hover { background: #f0f9ff; }
        .btn-delete { background: #ef4444; color: white; border-color: #ef4444; }
        .btn-delete:hover { background: #dc2626; border-color: #dc2626; }
        .action-btn-sm { height: 28px; min-width: 88px; padding: 0 10px; font-size: 0.7rem; }
        .hierarchy-tree { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; }
        .entity-item { border-bottom: 1px solid #f1f5f9; padding: 1rem 1.5rem; }
        .entity-item:last-child { border-bottom: none; }
        .entity-header { display: flex; align-items: center; justify-content: space-between; gap: 1rem; }
        .entity-info { display: flex; align-items: center; gap: 1rem; }
        .entity-icon { width: 40px; height: 40px; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; flex-shrink: 0; }
        .entity-direction { background: #0369a1; }
        .entity-service { background: #0ea5e9; }
        .entity-departement { background: #64748b; }
        .entity-details h3 { margin: 0; font-size: 1rem; font-weight: 600; color: #0f172a; }
        .entity-details p { margin: 0.25rem 0 0 0; font-size: 0.8rem; color: #64748b; }
        .entity-actions { display: flex; align-items: center; gap: 0.5rem; flex-shrink: 0; }
        .entity-children { margin-left: 3rem; border-left: 2px solid #e2e8f0; padding-left: 1rem; margin-top: 0.75rem; }
        .entity-child { background: #f8fafc; border-radius: 8px; padding: 0.75rem 1rem; margin-bottom: 0.5rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem; }
        .entity-child:last-child { margin-bottom: 0; }
        .status-badge { padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.72rem; font-weight: 600; flex-shrink: 0; }
        .status-active { background: #dcfce7; color: #166534; }
        .status-inactive { background: #fee2e2; color: #991b1b; }
        .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; z-index: 1000; padding: 2rem; }
        .modal-content { background: white; border-radius: 12px; width: 100%; max-width: 500px; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 40px rgba(0,0,0,0.15); }
        .modal-content-sm { max-width: 420px; }
        .modal-header { padding: 1.5rem; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; }
        .modal-title { font-family: 'Sora', sans-serif; font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0; }
        .modal-close { background: none; border: none; font-size: 1.5rem; color: #64748b; cursor: pointer; padding: 0.25rem 0.5rem; border-radius: 6px; transition: all 0.2s; line-height: 1; }
        .modal-close:hover { background: #f1f5f9; color: #374151; }
        .modal-body { padding: 1.5rem; }
        .form-group { margin-bottom: 1rem; }
        .form-label { display: block; font-size: 0.8rem; font-weight: 600; color: #1e293b; margin-bottom: 0.5rem; }
        .form-input, .form-select { width: 100%; padding: 0.68rem 1rem; border: 1.5px solid #e2e8f0; border-radius: 10px; font-size: 0.87rem; color: #0f172a; background: white; transition: all 0.2s; outline: none; font-family: 'DM Sans', sans-serif; }
        .form-input:focus, .form-select:focus { border-color: #0ea5e9; box-shadow: 0 0 0 3px rgba(14,165,233,0.12); }
        .checkbox-group { display: flex; align-items: center; gap: 0.5rem; }
        .checkbox-group input { width: 16px; height: 16px; accent-color: #0ea5e9; }
        .alert { padding: 1rem; border-radius: 10px; margin-bottom: 1rem; }
        .alert-success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
        .confirm-icon { width: 52px; height: 52px; background: #fef2f2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem auto; }
    </style>

    <div class="admin-header">
        <h1>Hiérarchie des Entités</h1>
        <p>Gérer les directions, services et départements</p>
    </div>

    <div class="admin-content">

        @if (session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <div class="action-bar">
            <div>
                <h3 style="margin:0;font-size:1.1rem;font-weight:600;color:#0f172a;">Structure organisationnelle</h3>
                <p style="margin:0.25rem 0 0 0;font-size:0.85rem;color:#64748b;">Directions → Services → Départements</p>
            </div>
            <button wire:click="createEntity" class="btn-primary">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
                Nouvelle entité
            </button>
        </div>

        <div class="hierarchy-tree">
            @forelse($directions as $direction)
                <div class="entity-item">
                    <div class="entity-header">
                        <div class="entity-info">
                            <div class="entity-icon entity-direction">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
                            </div>
                            <div class="entity-details">
                                <h3>{{ $direction->nom }}</h3>
                                <p>Direction • {{ $direction->children->count() }} service(s)</p>
                            </div>
                        </div>
                        <div class="entity-actions">
                            <span class="status-badge {{ $direction->is_active ? 'status-active' : 'status-inactive' }}">
                                {{ $direction->is_active ? 'Actif' : 'Inactif' }}
                            </span>
                            <button wire:click="editEntity({{ $direction->id }})" class="action-btn btn-edit">
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Modifier
                            </button>
                            <button wire:click="toggleActive({{ $direction->id }})" class="action-btn {{ $direction->is_active ? 'btn-toggle-off' : 'btn-toggle-on' }}">
                                @if($direction->is_active)
                                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Désactiver
                                @else
                                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Activer
                                @endif
                            </button>
                            <button wire:click="$set('confirmDeleteId', {{ $direction->id }})" class="action-btn btn-delete">
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Supprimer
                            </button>
                        </div>
                    </div>

                    @if($direction->children->count() > 0)
                        <div class="entity-children">
                            @foreach($direction->children as $service)
                                <div class="entity-child">
                                    <div class="entity-info">
                                        <div class="entity-icon entity-service" style="width:34px;height:34px;">
                                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M12 1v6m0 6v6m11-7h-6m-6 0H1"/></svg>
                                        </div>
                                        <div class="entity-details">
                                            <h3 style="font-size:0.9rem;">{{ $service->nom }}</h3>
                                            <p style="font-size:0.75rem;">Service • {{ $service->children->count() }} département(s)</p>
                                        </div>
                                    </div>
                                    <div class="entity-actions">
                                        <span class="status-badge {{ $service->is_active ? 'status-active' : 'status-inactive' }}" style="font-size:0.68rem;padding:0.2rem 0.6rem;">
                                            {{ $service->is_active ? 'Actif' : 'Inactif' }}
                                        </span>
                                        <button wire:click="editEntity({{ $service->id }})" class="action-btn action-btn-sm btn-edit">
                                            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            Modifier
                                        </button>
                                        <button wire:click="toggleActive({{ $service->id }})" class="action-btn action-btn-sm {{ $service->is_active ? 'btn-toggle-off' : 'btn-toggle-on' }}">
                                            {{ $service->is_active ? 'Désactiver' : 'Activer' }}
                                        </button>
                                        <button wire:click="$set('confirmDeleteId', {{ $service->id }})" class="action-btn action-btn-sm btn-delete">
                                            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            Supprimer
                                        </button>
                                    </div>
                                </div>

                                @if($service->children->count() > 0)
                                    <div style="margin-left:2rem;margin-top:0.5rem;margin-bottom:0.5rem;">
                                        @foreach($service->children as $departement)
                                            <div class="entity-child" style="background:#f1f5f9;">
                                                <div class="entity-info">
                                                    <div class="entity-icon entity-departement" style="width:30px;height:30px;">
                                                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
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
                                                    <button wire:click="editEntity({{ $departement->id }})" class="action-btn action-btn-sm btn-edit">
                                                        <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                        Modifier
                                                    </button>
                                                    <button wire:click="toggleActive({{ $departement->id }})" class="action-btn action-btn-sm {{ $departement->is_active ? 'btn-toggle-off' : 'btn-toggle-on' }}">
                                                        {{ $departement->is_active ? 'Désactiver' : 'Activer' }}
                                                    </button>
                                                    <button wire:click="$set('confirmDeleteId', {{ $departement->id }})" class="action-btn action-btn-sm btn-delete">
                                                        <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
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
                    <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24" style="margin:0 auto 1rem auto;opacity:0.4;display:block;"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
                    <p>Aucune entité trouvée. Créez votre première direction pour commencer.</p>
                </div>
            @endforelse
        </div>

        @if($showForm)
            <div class="modal-overlay" wire:click.self="$set('showForm', false)">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">{{ $editingEntity ? 'Modifier l\'entité' : 'Nouvelle entité' }}</h2>
                        <button wire:click="$set('showForm', false)" class="modal-close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="saveEntity">
                            <div class="form-group">
                                <label class="form-label">Nom</label>
                                <input type="text" wire:model="form.nom" placeholder="Nom de l'entité" class="form-input">
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
                            <div class="form-group">
                                <label class="form-label">
                                    Entité parente
                                    @if($form['type'] === 'direction') <small style="color:#64748b;font-weight:400;">(non applicable pour les directions)</small>
                                    @elseif($form['type'] === 'service') <small style="color:#64748b;font-weight:400;">(doit être une direction)</small>
                                    @else <small style="color:#64748b;font-weight:400;">(doit être un service)</small>
                                    @endif
                                </label>
                                <select wire:model="form.parent_uuid" class="form-select" {{ $form['type'] === 'direction' ? 'disabled' : '' }}>
                                    <option value="">
                                        @if($form['type'] === 'direction') Aucune (direction racine)
                                        @elseif($form['type'] === 'service') Sélectionner une direction
                                        @else Sélectionner un service
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
                                @error('form.parent_uuid') <span style="color:#ef4444;font-size:0.75rem;margin-top:0.25rem;display:block;">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="checkbox-group">
                                    <input type="checkbox" wire:model="form.is_active">
                                    <span style="font-size:0.87rem;color:#1e293b;">Entité active</span>
                                </label>
                            </div>
                            <div style="display:flex;gap:0.75rem;margin-top:1.5rem;">
                                <button type="submit" class="btn-primary" style="flex:1;justify-content:center;">
                                    {{ $editingEntity ? 'Enregistrer les modifications' : 'Créer l\'entité' }}
                                </button>
                                <button type="button" wire:click="$set('showForm', false)" class="action-btn btn-toggle-off" style="height:40px;min-width:90px;">
                                    Annuler
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        @if(isset($confirmDeleteId) && $confirmDeleteId)
            <div class="modal-overlay">
                <div class="modal-content modal-content-sm">
                    <div class="modal-body" style="text-align:center;padding:2rem 1.5rem;">
                        <div class="confirm-icon">
                            <svg width="26" height="26" fill="none" stroke="#dc2626" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <h3 style="font-family:'Sora',sans-serif;font-size:1.1rem;font-weight:700;color:#0f172a;margin:0 0 0.5rem 0;">Confirmer la suppression</h3>
                        <p style="font-size:0.85rem;color:#64748b;margin:0 0 1.5rem 0;">Cette action est irréversible. L'entité et ses éventuelles sous-entités seront supprimées définitivement.</p>
                        <div style="display:flex;gap:0.75rem;justify-content:center;">
                            <button wire:click="$set('confirmDeleteId', null)" class="action-btn btn-toggle-off" style="height:38px;min-width:100px;">Annuler</button>
                            <button wire:click="deleteEntity({{ $confirmDeleteId }})" class="action-btn btn-delete" style="height:38px;min-width:120px;">
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Oui, supprimer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>