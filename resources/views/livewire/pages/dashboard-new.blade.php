<div style="display: flex; flex-direction: column; gap: 1.5rem;">
    <!-- PAGE TITLE -->
    <div style="padding-bottom: 1.5rem; border-bottom: 2px solid #e2e8f0;">
        <h1 style="font-family: 'Sora', sans-serif; font-size: 2rem; font-weight: 700; color: #0f172a; margin-bottom: 0.5rem;">
            Tableau de bord
        </h1>
        <p style="color: #64748b; font-size: 0.95rem;">
            Bienvenue dans ANINF — {{ now()->translatedFormat('d F Y') }}
        </p>
    </div>

    <!-- STATS GRID -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
        <!-- Total Users -->
        <div style="background: white; border-radius: 12px; padding: 1.5rem; border: 1px solid #e2e8f0; border-top: 4px solid #0ea5e9; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <div style="margin-bottom: 1rem;">
                <div>
                    <p style="font-size: 0.8rem; text-transform: uppercase; color: #94a3b8; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Utilisateurs</p>
                    <p style="font-size: 2rem; font-weight: 700; color: #0f172a; line-height: 1;">{{ $total_users }}</p>
                </div>
            </div>
            <p style="font-size: 0.8rem; color: #64748b;">Utilisateurs actifs</p>
        </div>

        <!-- Total Agents -->
        <div style="background: white; border-radius: 12px; padding: 1.5rem; border: 1px solid #e2e8f0; border-top: 4px solid #0ea5e9; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <div style="margin-bottom: 1rem;">
                <div>
                    <p style="font-size: 0.8rem; text-transform: uppercase; color: #94a3b8; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Agents</p>
                    <p style="font-size: 2rem; font-weight: 700; color: #0f172a; line-height: 1;">{{ $total_agents }}</p>
                </div>
            </div>
            <p style="font-size: 0.8rem; color: #64748b;">Agents actifs</p>
        </div>

        <!-- Total Entities -->
        <div style="background: white; border-radius: 12px; padding: 1.5rem; border: 1px solid #e2e8f0; border-top: 4px solid #0ea5e9; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <div style="margin-bottom: 1rem;">
                <div>
                    <p style="font-size: 0.8rem; text-transform: uppercase; color: #94a3b8; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Entités</p>
                    <p style="font-size: 2rem; font-weight: 700; color: #0f172a; line-height: 1;">{{ $total_entities }}</p>
                </div>
            </div>
            <p style="font-size: 0.8rem; color: #64748b;">Organisations</p>
        </div>

        <!-- Total Fonctions -->
        <div style="background: white; border-radius: 12px; padding: 1.5rem; border: 1px solid #e2e8f0; border-top: 4px solid #0ea5e9; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <div style="margin-bottom: 1rem;">
                <div>
                    <p style="font-size: 0.8rem; text-transform: uppercase; color: #94a3b8; font-weight: 600; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Fonctions</p>
                    <p style="font-size: 2rem; font-weight: 700; color: #0f172a; line-height: 1;">{{ $total_fonctions }}</p>
                </div>
            </div>
            <p style="font-size: 0.8rem; color: #64748b;">Postes définis</p>
        </div>
    </div>

    <!-- TWO COLUMN SECTION -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1rem;">
        <!-- LEFT: Recent Agents + Inactive Count -->
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <!-- Recent Agents -->
            <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05); overflow: hidden;">
                <div style="padding: 1.5rem; border-bottom: 1px solid #e2e8f0;">
                    <h3 style="font-size: 0.95rem; font-weight: 600; color: #0f172a; margin: 0;">Agents récents</h3>
                </div>
                <div style="padding: 1rem;">
                    @if($recent_agents->count() > 0)
                        @foreach($recent_agents as $agent)
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #f1f5f9;">
                                <div style="flex: 1; min-width: 0;">
                                    <p style="font-size: 0.9rem; font-weight: 600; color: #0f172a; margin: 0;">{{ $agent->nom }} {{ $agent->prenom }}</p>
                                    <p style="font-size: 0.8rem; color: #94a3b8; margin: 0;">
                                        {{ $agent->fonction?->nom ?? 'Sans fonction' }}
                                    </p>
                                </div>
                                <p style="font-size: 0.75rem; color: #cbd5e1;">{{ $agent->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p style="text-align: center; color: #94a3b8; padding: 1rem 0; margin: 0;">Aucun agent récent</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- RIGHT SIDEBAR -->
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <!-- Inactive Agents -->
            <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05); padding: 1.5rem;">
                <div style="margin-bottom: 1rem;">
                    <h3 style="font-size: 0.95rem; font-weight: 600; color: #0f172a; margin: 0;">Agents inactifs</h3>
                </div>
                <p style="font-size: 1.5rem; font-weight: 700; color: #0f172a; margin: 0;">{{ $agents_inactifs }}</p>
                <p style="font-size: 0.8rem; color: #94a3b8; margin: 0.5rem 0 0 0;">Agents à revoir</p>
            </div>

            <!-- Quick Actions -->
            <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05); padding: 1.5rem;">
                <h3 style="font-size: 0.95rem; font-weight: 600; color: #0f172a; margin: 0 0 1rem 0;">Actions rapides</h3>
                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                    <a href="{{ route('annuaire.index') }}" style="display: flex; align-items: center; gap: 10px; padding: 10px 12px; background: #e0f2fe; border-radius: 8px; text-decoration: none; color: #0369a1; font-weight: 600; font-size: 0.9rem; transition: all 0.2s;">
                         Consulter annuaire
                    </a>
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.entities') }}" style="display: flex; align-items: center; gap: 10px; padding: 10px 12px; background: #f0fdf4; border-radius: 8px; text-decoration: none; color: #059669; font-weight: 600; font-size: 0.9rem; transition: all 0.2s;">
                             Gérer entités
                        </a>
                        <a href="{{ route('admin.fonctions') }}" style="display: flex; align-items: center; gap: 10px; padding: 10px 12px; background: #fef3c7; border-radius: 8px; text-decoration: none; color: #d97706; font-weight: 600; font-size: 0.9rem; transition: all 0.2s;">
                            Gérer fonctions
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- DISTRIBUTION SECTION -->
    @if($repartition->count() > 0)
        <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05); overflow: hidden;">
            <div style="padding: 1.5rem; border-bottom: 1px solid #e2e8f0;">
                <h3 style="font-size: 0.95rem; font-weight: 600; color: #0f172a; margin: 0;">Répartition par entité</h3>
            </div>
            <div style="padding: 1.5rem; overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; font-size: 0.9rem;">
                    <thead>
                        <tr style="border-bottom: 2px solid #e2e8f0;">
                            <th style="text-align: left; padding: 0.75rem; font-weight: 600; color: #64748b; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.05em;">Entité</th>
                            <th style="text-align: center; padding: 0.75rem; font-weight: 600; color: #64748b; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.05em;">Type</th>
                            <th style="text-align: right; padding: 0.75rem; font-weight: 600; color: #64748b; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.05em;">Agents</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($repartition as $entity)
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 0.75rem; color: #0f172a; font-weight: 500;">{{ $entity->nom }}</td>
                                <td style="padding: 0.75rem; text-align: center;">
                                    <span style="display: inline-block; padding: 0.25rem 0.75rem; background: #f0fdf4; color: #059669; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                                        {{ $entity->type ?? 'Autre' }}
                                    </span>
                                </td>
                                <td style="padding: 0.75rem; text-align: right; color: #0369a1; font-weight: 700;">{{ $entity->nb_agents }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
