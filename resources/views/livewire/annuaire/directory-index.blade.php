<div>
    <x-app-layout>
        <div style="display: flex; flex-direction: column; gap: 2rem;">
            <!-- PAGE HEADER -->
            <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 1.5rem; border-bottom: 2px solid #e2e8f0; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <h1 style="font-family: 'Sora', sans-serif; font-size: 2rem; font-weight: 700; color: #0f172a; margin-bottom: 0.5rem;">Annuaire des agents</h1>
                    <p style="color: #64748b; font-size: 0.95rem;">Consultez la liste complète des agents de l'institution</p>
                </div>
                <div style="display: flex; gap: 1rem;">

                </div>
            </div>
            <div style="display:flex;justify-content:space-between">
                <div style="display:flex; gap: 0.5rem;">
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                 <label for="direction">Direction</label>   
                 <select wire:model.live="directionId" name="direction" id="direction">
                        <option value="">choisir une direction</option>
                        @foreach($directions as $direction)
                            <option value="{{ $direction->id }}">{{ $direction->nom }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                     <label for="service">Services</label>   
                     <select wire:model.live="entityId" name="service" id="service">
                        <option value="">choisir un service</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->nom }}</option>
                        @endforeach
                      </select>
                   </div>
                  <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                     <label for="fonction">Fonctions</label>   
                     <select wire:model.live="fonctionId" name="fonction" id="fonction">
                        <option value="">choisir une fonction</option>
                        @foreach($fonctions as $fonction)
                            <option value="{{ $fonction->id }}">{{ $fonction->libelle }}</option>
                        @endforeach
                      </select>
                   </div>
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                     <label for="recherche" style="opacity: 0;">Recherche</label>
                    <div style="display: flex; align-items: center; gap: 0.5rem; background: white; border: 1.5px solid #e2e8f0; border-radius: 8px; min-width: 300px;">
                        <input wire:model.live="search" type="text" placeholder="Rechercher un agent..." style="border: none; outline: none; flex: 1; font-size: 0.9rem; background: transparent;" />
                    </div>
                </div>
            </div>
            <!-- TWO COLUMN LAYOUT -->
            <div>
                <!-- SIDEBAR FILTERS -->
  

                <!-- MAIN CONTENT -->
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <!-- RESULTS INFO -->
                    <div style="padding: 1rem; background: #f0f9ff; border-radius: 8px; border: 1px solid #bae6fd; color: #0369a1; font-size: 0.9rem;">
                        Affichage de <strong>{{ $agents->count() }}</strong> agent(s)
                    </div>

                    <!-- AGENTS GRID -->
                    @if($agents->count() > 0)
                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
                            @foreach($agents as $agent)
                                <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 1.5rem; color: inherit; transition: all 0.2s; box-shadow: 0 1px 3px rgba(0,0,0,0.05); display: flex; flex-direction: column; gap: 1rem; cursor: pointer;" wire:click="openDetail('{{ $agent->id }}')">
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
                                            @if($agent->fonction)
                                                <div>
                                                    <p style="color: #94a3b8; margin: 0; font-weight: 600;">Fonction</p>
                                                    <p style="color: #475569; margin: 0.25rem 0 0 0;">{{ $agent->fonction->nom }}</p>
                                                </div>
                                            @endif
                                            @if($agent->entity)
                                                <div>
                                                    <p style="color: #94a3b8; margin: 0; font-weight: 600;">Entité</p>
                                                    <p style="color: #475569; margin: 0.25rem 0 0 0;">{{ $agent->entity->nom }}</p>
                                                </div>
                                            @endif
                                            @if($agent->email)
                                                <div>
                                                    <p style="color: #94a3b8; margin: 0; font-weight: 600;">Email</p>
                                                    <p style="color: #475569; margin: 0.25rem 0 0 0; word-break: break-all;">{{ $agent->email }}</p>
                                                </div>
                                            @endif
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
                                </div>
                            @endforeach
                        </div>

                        <!-- PAGINATION -->
                        @if($agents->hasPages())
                            <div style="display:flex; justify-content:center; margin-top:2rem;">
                                {{ $agents->links() }}
                            </div>
                        @endif
                    @else
                        <div style="text-align: center; padding: 3rem 2rem; background: white; border-radius: 12px; border: 1px solid #e2e8f0;">
                            <p style="font-size: 1.1rem; color: #64748b; margin: 0;">Aucun agent trouvé</p>
                            <p style="color: #94a3b8; margin: 0.5rem 0 0 0;">Essayez de modifier votre recherche ou vos filtres</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Detail Modal -->
        @if($showDetail && $selectedAgent)
            <div style="position: fixed; inset: 0; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; z-index: 50;">
                <div style="background: white; border-radius: 12px; padding: 2rem; max-width: 500px; width: 90%; max-height: 80vh; overflow-y: auto;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                        <h2 style="font-size: 1.5rem; font-weight: 700; color: #0f172a; margin: 0;">{{ $selectedAgent->nom }}</h2>
                        <button wire:click="closeDetail()" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #94a3b8;">✕</button>
                    </div>

                    <div style="display: grid; gap: 1rem;">
                        <div>
                            <label style="color: #94a3b8; font-size: 0.8rem; text-transform: uppercase; font-weight: 600;">Matricule</label>
                            <p style="color: #0f172a; margin: 0.25rem 0 0 0;">{{ $selectedAgent->matricule }}</p>
                        </div>
                        <div>
                            <label style="color: #94a3b8; font-size: 0.8rem; text-transform: uppercase; font-weight: 600;">Fonction</label>
                            <p style="color: #0f172a; margin: 0.25rem 0 0 0;">{{ $selectedAgent->fonction?->nom ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label style="color: #94a3b8; font-size: 0.8rem; text-transform: uppercase; font-weight: 600;">Entité</label>
                            <p style="color: #0f172a; margin: 0.25rem 0 0 0;">{{ $selectedAgent->entity?->nom ?? 'N/A' }}</p>
                        </div>
                        @if($selectedAgent->email)
                            <div>
                                <label style="color: #94a3b8; font-size: 0.8rem; text-transform: uppercase; font-weight: 600;">Email</label>
                                <p style="color: #0369a1; margin: 0.25rem 0 0 0;"><a href="mailto:{{ $selectedAgent->email }}" style="color: inherit; text-decoration: none;">{{ $selectedAgent->email }}</a></p>
                            </div>
                        @endif
                        @if($selectedAgent->telephone)
                            <div>
                                <label style="color: #94a3b8; font-size: 0.8rem; text-transform: uppercase; font-weight: 600;">Téléphone</label>
                                <p style="color: #0f172a; margin: 0.25rem 0 0 0;">{{ $selectedAgent->telephone }}</p>
                            </div>
                        @endif
                    </div>

                    <button wire:click="closeDetail()" style="width: 100%; padding: 0.75rem; background: #e0f2fe; color: #0369a1; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; margin-top: 1.5rem;">
                        Fermer
                    </button>
                </div>
            </div>
        @endif
    </x-app-layout>
</div>
