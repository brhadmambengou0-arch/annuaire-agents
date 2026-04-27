<div style="display: flex; flex-direction: column; gap: 2rem;">
    <!-- PAGE HEADER -->
    <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 1.5rem; border-bottom: 2px solid #e2e8f0; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 style="font-family: 'Sora', sans-serif; font-size: 2rem; font-weight: 700; color: #0f172a; margin-bottom: 0.5rem;">Annuaire des agents</h1>
            <p style="color: #64748b; font-size: 0.95rem;">Consultez la liste complète des agents de l'institution</p>
        </div>
        <div style="display: flex; gap: 1rem;">
            <div style="display: flex; align-items: center; gap: 0.5rem; background: white; border: 1.5px solid #e2e8f0; border-radius: 8px; padding: 0.5rem 1rem; flex: 1; min-width: 300px;">
                <span style="color: #94a3b8; font-size: 1.2rem;"></span>
                <input wire:model.live="search" type="text" placeholder="Rechercher un agent..." style="border: none; outline: none; flex: 1; font-size: 0.9rem; background: transparent;" />
            </div>
        </div>
    </div>

    <!-- TWO COLUMN LAYOUT -->
    <div style="display: grid; grid-template-columns: 250px 1fr; gap: 1.5rem;">
        <!-- SIDEBAR FILTERS -->
        <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05); padding: 1.5rem; height: fit-content; position: sticky; top: 100px;">
            <h3 style="font-size: 0.95rem; font-weight: 600; color: #0f172a; margin: 0 0 1.5rem 0; padding-bottom: 1rem; border-bottom: 2px solid #e2e8f0;">Filtres</h3>

            <!-- Filter by Entity -->
            <div style="margin-bottom: 1.5rem;">
                <label style="font-size: 0.8rem; font-weight: 600; color: #64748b; text-transform: uppercase; display: block; margin-bottom: 0.75rem;">Entité</label>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    @foreach($directions as $direction)
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; padding: 0.5rem; border-radius: 6px; transition: background 0.2s;">
                            <input wire:model.live="selectedEntity" type="radio" value="{{ $direction->uuid }}" style="cursor: pointer;" />
                            <span style="font-size: 0.9rem; color: #475569;">{{ $direction->nom }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Filter by Fonction -->
            <div style="margin-bottom: 1.5rem;">
                <label style="font-size: 0.8rem; font-weight: 600; color: #64748b; text-transform: uppercase; display: block; margin-bottom: 0.75rem;">Fonction</label>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    @foreach($fonctions as $fonction)
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; padding: 0.5rem; border-radius: 6px; transition: background 0.2s;">
                            <input wire:model.live="selectedFonction" type="radio" value="{{ $fonction->uuid }}" style="cursor: pointer;" />
                            <span style="font-size: 0.9rem; color: #475569;">{{ $fonction->nom }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Clear Filters -->
            @if($selectedEntity || $selectedFonction || $search)
                <button wire:click="resetFilters()" style="width: 100%; padding: 0.75rem; background: #fee2e2; color: #ef4444; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s;">
                     Réinitialiser filtres
                </button>
            @endif
        </div>

        <!-- MAIN CONTENT -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <!-- RESULTS INFO -->
            <div style="padding: 1rem; background: #f0f9ff; border-radius: 8px; border: 1px solid #bae6fd; color: #0369a1; font-size: 0.9rem;">
                 Affichage de <strong>{{ $agents->count() }}</strong> agent(s) sur <strong>{{ $totalAgents }}</strong>
            </div>

            <!-- AGENTS GRID -->
            @if($agents->count() > 0)
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
                    @foreach($agents as $agent)
                        <a href="#" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 1.5rem; text-decoration: none; color: inherit; transition: all 0.2s; box-shadow: 0 1px 3px rgba(0,0,0,0.05); display: flex; flex-direction: column; gap: 1rem;">
                            <!-- AGENT HEADER -->
                            <div>
                                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #0ea5e9, #0369a1); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 1.2rem; margin-bottom: 1rem;">
                                    {{ substr($agent->nom, 0, 1) }}
                                </div>
                                <h4 style="font-size: 1rem; font-weight: 700; color: #0f172a; margin: 0;">{{ $agent->nom }}</h4>
                                <p style="font-size: 0.85rem; color: #94a3b8; margin: 0.5rem 0 0 0;">{{ $agent->matricule ?? 'N/A' }}</p>
                            </div>

                            <!-- AGENT INFO -->
                            <div style="border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; padding: 1rem 0;">
                                <div style="display: flex; flex-direction: column; gap: 0.75rem; font-size: 0.85rem;">
                                    <div>
                                        <p style="color: #94a3b8; margin: 0; font-weight: 600;">Fonction</p>
                                        <p style="color: #475569; margin: 0.25rem 0 0 0;">{{ $agent->fonction?->nom ?? 'Pas de fonction' }}</p>
                                    </div>
                                    <div>
                                        <p style="color: #94a3b8; margin: 0; font-weight: 600;">Entité</p>
                                        <p style="color: #475569; margin: 0.25rem 0 0 0;">{{ $agent->entity?->nom ?? 'Pas d\'entité' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- STATUS -->
                            <div>
                                @if($agent->is_active)
                                    <span style="display: inline-block; padding: 0.5rem 0.75rem; background: #d1fae5; color: #065f46; border-radius: 6px; font-size: 0.75rem; font-weight: 600;">✓ Actif</span>
                                @else
                                    <span style="display: inline-block; padding: 0.5rem 0.75rem; background: #fee2e2; color: #991b1b; border-radius: 6px; font-size: 0.75rem; font-weight: 600;">✗ Inactif</span>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 3rem 2rem; background: white; border-radius: 12px; border: 1px solid #e2e8f0;">
                    <p style="font-size: 1.1rem; color: #64748b; margin: 0;">Aucun agent trouvé</p>
                    <p style="color: #94a3b8; margin: 0.5rem 0 0 0;">Essayez de modifier votre recherche ou vos filtres</p>
                </div>
            @endif
        </div>
    </div>
</div>
