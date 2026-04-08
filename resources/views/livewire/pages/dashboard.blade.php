{{-- dashboard admin --}}
<div>
<x-app-layout>

<style>
    /* page principale */
    .page-admin {
        background-color: #f1f5f9;
        min-height: 90vh;
    }

    /* header en haut */
    .top-header {
        background: linear-gradient(to right, #0369a1, #0ea5e9);
        padding: 30px;
        padding-bottom: 50px;
    }
    .top-header h1 {
        color: white;
        font-size: 22px;
        font-weight: bold;
    }
    .top-header p {
        color: rgba(255,255,255,0.7);
        font-size: 13px;
        margin-top: 3px;
    }
    .badge-role {
        background: rgba(255,255,255,0.25);
        color: white;
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 12px;
    }

    /* contenu principal */
    .contenu {
        max-width: 1200px;
        margin: 0 auto;
        margin-top: -25px;
        padding: 0 20px 60px 20px;
        position: relative;
        z-index: 10;
    }

    /* les 4 cartes de stats */
    .grid-stats {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        gap: 15px;
        margin-bottom: 20px;
    }
    .carte-stat {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 20px;
        border-top: 4px solid #0ea5e9;
    }
    .carte-stat.verte { border-top-color: #059669; }
    .carte-stat.orange { border-top-color: #d97706; }
    .carte-stat.violette { border-top-color: #7c3aed; }

    .grand-nombre {
        font-size: 36px;
        font-weight: 900;
        color: #0c4a6e;
    }
    .libelle-stat {
        font-size: 11px;
        text-transform: uppercase;
        color: #64748b;
        font-weight: 600;
        letter-spacing: 1px;
    }
    .sous-libelle {
        font-size: 11px;
        color: #aaa;
        margin-top: 4px;
    }

    /* carte blanche générique */
    .ma-carte {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .titre-carte {
        font-size: 14px;
        font-weight: 700;
        color: #0369a1;
        padding-bottom: 10px;
        border-bottom: 2px solid #e0f2fe;
        margin-bottom: 18px;
    }

    /* grille 2 colonnes */
    .deux-colonnes {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }
    .colonne-gauche {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .colonne-droite {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    /* liste agents/users récents */
    .liste-recente {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .item-recent {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        background: #f8fafc;
        border-radius: 8px;
        border: 1px solid #f1f5f9;
    }
    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
        color: white;
        background: linear-gradient(135deg, #0369a1, #0ea5e9);
        flex-shrink: 0;
    }
    .avatar.vert {
        background: linear-gradient(135deg, #059669, #0d9488);
    }
    .info-principale {
        flex: 1;
    }
    .nom-agent {
        font-size: 13px;
        font-weight: 600;
        color: #0c4a6e;
    }
    .sous-info {
        font-size: 11px;
        color: #64748b;
        margin-top: 2px;
    }
    .date-ajout {
        font-size: 11px;
        color: #aaa;
        white-space: nowrap;
    }

    /* actions rapides */
    .grille-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }
    .btn-action {
        display: flex;
        flex-direction: column;
        gap: 4px;
        padding: 15px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        text-decoration: none;
        background: white;
        transition: 0.15s;
    }
    .btn-action:hover {
        border-color: #0ea5e9;
        background: #f0f9ff;
    }
    .btn-action .titre {
        font-size: 13px;
        font-weight: 700;
        color: #0369a1;
    }
    .btn-action .desc {
        font-size: 11px;
        color: #aaa;
    }

    /* infos systeme */
    .grille-sys {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }
    .info-sys {
        padding: 12px;
        background: #f8fafc;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }
    .label-sys {
        font-size: 11px;
        text-transform: uppercase;
        color: #aaa;
        font-weight: 600;
        margin-bottom: 4px;
    }
    .valeur-sys {
        font-size: 13px;
        font-weight: 600;
        color: #0c4a6e;
    }

    /* tableau repartition */
    .mon-tableau {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    .mon-tableau th {
        text-align: left;
        padding: 8px 12px;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #aaa;
        font-weight: 600;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }
    .mon-tableau td {
        padding: 10px 12px;
        border-bottom: 1px solid #f1f5f9;
        color: #475569;
    }
    .mon-tableau tr:last-child td {
        border-bottom: none;
    }
    .mon-tableau tr:hover td {
        background: #f8fafc;
    }

    /* badges */
    .badge {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }
    .badge-admin { background: #dbeafe; color: #1e40af; }
    .badge-consultant { background: #e0f2fe; color: #0369a1; }
    .badge-direction { background: #dbeafe; color: #1e40af; }
    .badge-service { background: #e0f2fe; color: #0369a1; }
    .badge-departement { background: #f0fdf4; color: #065f46; }

    /* petit bouton */
    .btn-petit {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }
    .btn-bleu { background: #0369a1; color: white; }
    .btn-bleu:hover { background: #0284c7; }

    /* responsive basique */
    @media (max-width: 900px) {
        .grid-stats { grid-template-columns: 1fr 1fr; }
        .deux-colonnes { grid-template-columns: 1fr; }
    }
    @media (max-width: 550px) {
        .grid-stats { grid-template-columns: 1fr; }
        .grille-actions { grid-template-columns: 1fr; }
        .grille-sys { grid-template-columns: 1fr; }
    }
</style>

<div class="page-admin">

    {{-- bandeau du haut --}}
    <div class="top-header">
        <div style="max-width:1200px; margin:0 auto; display:flex; align-items:center; justify-content:space-between;">
            <div>
                <h1>Tableau de bord Admin</h1>
                <p>{{ now()->translatedFormat('l d F Y, H:i') }}</p>
            </div>
            <div class="badge-role">Administrateur</div>
        </div>
    </div>

    <div class="contenu">

        {{-- statistiques --}}
        <div class="grid-stats">
            <div class="carte-stat">
                <div class="grand-nombre">{{ $total_users }}</div>
                <div class="libelle-stat">Utilisateurs</div>
                <div class="sous-libelle">Comptes enregistrés</div>
            </div>
            <div class="carte-stat verte">
                <div class="grand-nombre">{{ $total_agents }}</div>
                <div class="libelle-stat">Agents actifs</div>
                <div class="sous-libelle">Dans l'annuaire</div>
            </div>
            <div class="carte-stat orange">
                <div class="grand-nombre">{{ $total_entities }}</div>
                <div class="libelle-stat">Entités</div>
                <div class="sous-libelle">Directions, services...</div>
            </div>
            <div class="carte-stat violette">
                <div class="grand-nombre">{{ $total_fonctions }}</div>
                <div class="libelle-stat">Fonctions</div>
                <div class="sous-libelle">Postes du référentiel</div>
            </div>
        </div>

        {{-- zone principale avec 2 colonnes --}}
        <div class="deux-colonnes">

            {{-- gauche --}}
            <div class="colonne-gauche">

                {{-- derniers agents ajoutés --}}
                <div class="ma-carte">
                    <div class="titre-carte">Agents récemment ajoutés</div>

                    <div class="liste-recente">
                        @forelse($recent_agents as $agent)
                            <div class="item-recent">
                                <div class="avatar vert">
                                    {{ strtoupper(substr($agent->prenom, 0, 1)) }}{{ strtoupper(substr($agent->nom, 0, 1)) }}
                                </div>
                                <div class="info-principale">
                                    <div class="nom-agent">{{ $agent->prenom }} {{ $agent->nom }}</div>
                                    <div class="sous-info">
                                        {{ $agent->matricule }} —
                                        {{ $agent->fonction->libelle ?? 'Pas de fonction' }} —
                                        {{ $agent->entity->nom ?? 'Pas d\'entité' }}
                                    </div>
                                </div>
                                <div class="date-ajout">{{ $agent->created_at->diffForHumans() }}</div>
                            </div>
                        @empty
                            <p style="color:#aaa; font-size:13px; text-align:center; padding:15px;">
                                Aucun agent pour l'instant.
                            </p>
                        @endforelse
                    </div>

                    <div style="margin-top:15px; text-align:right;">
                        <a href="{{ route('annuaire.index') }}" class="btn-petit btn-bleu">Voir l'annuaire</a>
                    </div>
                </div>

                {{-- derniers utilisateurs --}}
                <div class="ma-carte">
                    <div class="titre-carte">Derniers utilisateurs créés</div>

                    <div class="liste-recente">
                        @forelse($recent_users as $user)
                            <div class="item-recent">
                                <div class="avatar">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div class="info-principale">
                                    <div class="nom-agent">{{ $user->name }}</div>
                                    <div class="sous-info">
                                        {{ $user->email }}
                                        &nbsp;
                                        <span class="badge badge-{{ $user->role }}">{{ ucfirst($user->role) }}</span>
                                    </div>
                                </div>
                                <div class="date-ajout">{{ $user->created_at->diffForHumans() }}</div>
                            </div>
                        @empty
                            <p style="color:#aaa; font-size:13px; text-align:center; padding:15px;">
                                Aucun utilisateur trouvé.
                            </p>
                        @endforelse
                    </div>
                </div>

            </div>

            {{-- droite --}}
            <div class="colonne-droite">

                {{-- raccourcis --}}
                <div class="ma-carte">
                    <div class="titre-carte">Actions rapides</div>
                    <div class="grille-actions">
                        <a href="{{ route('annuaire.index') }}" class="btn-action">
                            <span class="titre">Annuaire</span>
                            <span class="desc">Voir tous les agents</span>
                        </a>
                        <a href="{{ route('admin.entities') }}" class="btn-action">
                            <span class="titre">Entités</span>
                            <span class="desc">Gérer les structures</span>
                        </a>
                        <a href="{{ route('admin.fonctions') }}" class="btn-action">
                            <span class="titre">Fonctions</span>
                            <span class="desc">Liste des postes</span>
                        </a>
                        <a href="{{ route('annuaire.index') }}" class="btn-action">
                            <span class="titre">Ajouter agent</span>
                            <span class="desc">Nouveau agent</span>
                        </a>
                    </div>
                </div>

                {{-- infos sur l'application --}}
                <div class="ma-carte">
                    <div class="titre-carte">Infos système</div>
                    <div class="grille-sys">
                        <div class="info-sys">
                            <div class="label-sys">Framework</div>
                            <div class="valeur-sys">Laravel {{ app()->version() }}</div>
                        </div>
                        <div class="info-sys">
                            <div class="label-sys">Base de données</div>
                            <div class="valeur-sys">{{ strtoupper(config('database.default')) }}</div>
                        </div>
                        <div class="info-sys">
                            <div class="label-sys">PHP</div>
                            <div class="valeur-sys">{{ PHP_VERSION }}</div>
                        </div>
                        <div class="info-sys">
                            <div class="label-sys">Environnement</div>
                            <div class="valeur-sys">{{ ucfirst(app()->environment()) }}</div>
                        </div>
                        <div class="info-sys" style="grid-column: 1 / -1;">
                            <div class="label-sys">Consulté le</div>
                            <div class="valeur-sys">{{ now()->format('d/m/Y à H:i:s') }}</div>
                        </div>
                    </div>
                </div>

                {{-- alerte agents désactivés s'il y en a --}}
                @if($agents_inactifs > 0)
                    <div class="ma-carte" style="border-left: 3px solid #f59e0b;">
                        <div class="titre-carte" style="color:#d97706;">Agents désactivés</div>
                        <p style="font-size:13px; color:#92400e; margin-bottom:12px;">
                            Il y a <strong>{{ $agents_inactifs }}</strong> agent(s) désactivé(s).
                        </p>
                        <a href="{{ route('annuaire.index') }}" class="btn-petit btn-bleu">Voir l'annuaire</a>
                    </div>
                @endif

            </div>
        </div>

        {{-- tableau repartition par direction --}}
        <div class="ma-carte">
            <div class="titre-carte">Agents par direction</div>

            @if($repartition->count() > 0)
                <table class="mon-tableau">
                    <thead>
                        <tr>
                            <th>Entité</th>
                            <th>Type</th>
                            <th>Nb agents</th>
                            <th>Pourcentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($repartition as $row)
                            <tr>
                                <td style="font-weight:600; color:#0c4a6e;">{{ $row->nom }}</td>
                                <td>
                                    <span class="badge badge-{{ $row->type }}">{{ ucfirst($row->type) }}</span>
                                </td>
                                <td>{{ $row->nb_agents }}</td>
                                <td>
                                    @if($total_agents > 0)
                                        @php $pct = round($row->nb_agents / $total_agents * 100) @endphp
                                        <div style="display:flex; align-items:center; gap:8px;">
                                            <div style="width:80px; height:6px; background:#e2e8f0; border-radius:3px;">
                                                <div style="width:{{ $pct }}%; height:6px; background:#0ea5e9; border-radius:3px;"></div>
                                            </div>
                                            <span style="font-size:12px; color:#64748b;">{{ $pct }}%</span>
                                        </div>
                                    @else
                                        0%
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color:#aaa; font-size:13px; text-align:center; padding:15px;">
                    Pas encore de données.
                </p>
            @endif
        </div>

    </div>
</div>

</x-app-layout>
</div>