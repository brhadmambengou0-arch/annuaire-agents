<div>
    {{-- CARTE AGENT --}}
    <div class="agent-card" wire:click="openDetail">
        <div class="agent-status-dot"></div>

        <div class="agent-card-header">
            {{-- Photo / Avatar --}}
            <div class="agent-photo">
                @if($agent->photo_url)
                    <img src="{{ asset('storage/' . $agent->photo_url) }}" alt="{{ $agent->nom }}">
                @else
                    {{ strtoupper(substr($agent->prenom, 0, 1) . substr($agent->nom, 0, 1)) }}
                @endif
            </div>

            <div style="min-width:0;">
                <div class="agent-name">{{ $agent->prenom }} {{ $agent->nom }}</div>
                <div class="agent-matricule">{{ $agent->matricule }}</div>
                @if($agent->bureau)
                <div style="font-size:0.71rem;color:#64748b;margin-top:2px;">
                    <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:inline;vertical-align:middle;">
                        <rect x="3" y="3" width="18" height="18" rx="2"/>
                        <path d="M3 9h18M9 21V9"/>
                    </svg>
                    Bureau {{ $agent->bureau }}
                </div>
                @endif
            </div>
        </div>

        <div class="agent-card-body">
            {{-- Fonction --}}
            <div class="fonction-badge">
                <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
                {{ $agent->fonction->libelle ?? 'Agent' }}
            </div>

            {{-- Entité --}}
            <div class="entity-tag" style="margin-bottom:0.5rem;">
                <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:inline;vertical-align:middle;">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                </svg>
                {{ $agent->entity->nom ?? '-' }}
            </div>

            {{-- Téléphone --}}
            @if($agent->telephone)
            <div class="agent-info-row">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.81 19.79 19.79 0 01.07 2.18 2 2 0 012.03 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/>
                </svg>
                <a href="tel:{{ $agent->telephone }}" onclick="event.stopPropagation()">{{ $agent->telephone }}</a>
            </div>
            @endif

            {{-- Email --}}
            @if($agent->email)
            <div class="agent-info-row">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
                <a href="mailto:{{ $agent->email }}" onclick="event.stopPropagation()" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                    {{ $agent->email }}
                </a>
            </div>
            @endif

            {{-- Poste interne --}}
            @if($agent->telephone_interne)
            <div class="agent-info-row">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="5" y="2" width="14" height="20" rx="2" ry="2"/>
                    <line x1="12" y1="18" x2="12.01" y2="18"/>
                </svg>
                Poste interne : <strong>{{ $agent->telephone_interne }}</strong>
            </div>
            @endif
        </div>
    </div>

    {{-- MODAL DÉTAIL AGENT --}}
    @if($showDetail)
    <div class="modal-overlay" wire:click.self="closeDetail" x-data x-init="$el.style.display='flex'">
        <div class="modal-box" style="max-width:600px;" onclick="event.stopPropagation()">

            {{-- Header modal --}}
            <div class="modal-header">
                <div style="display:flex;align-items:center;gap:0.8rem;">
                    <div style="width:42px;height:42px;background:rgba(255,255,255,0.2);border-radius:10px;display:flex;align-items:center;justify-content:center;font-family:'Sora',sans-serif;font-weight:700;color:white;font-size:1rem;flex-shrink:0;">
                        @if($agent->photo_url)
                            <img src="{{ asset('storage/' . $agent->photo_url) }}" style="width:100%;height:100%;border-radius:10px;object-fit:cover;">
                        @else
                            {{ strtoupper(substr($agent->prenom, 0, 1) . substr($agent->nom, 0, 1)) }}
                        @endif
                    </div>
                    <div>
                        <h5>{{ $agent->prenom }} {{ $agent->nom }}</h5>
                        <div style="font-size:0.76rem;color:rgba(255,255,255,0.75);">{{ $agent->matricule }}</div>
                    </div>
                </div>
                <button wire:click="closeDetail" class="modal-close">×</button>
            </div>

            {{-- Corps modal --}}
            <div class="modal-body">

                {{-- Fonction + Entité --}}
                <div style="display:flex;gap:0.6rem;flex-wrap:wrap;margin-bottom:1.2rem;">
                    <span class="fonction-badge" style="font-size:0.8rem;padding:5px 12px;">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                        {{ $agent->fonction->libelle ?? 'Agent' }}
                        <span style="background:#0284c7;color:white;border-radius:4px;padding:1px 5px;font-size:0.68rem;margin-left:4px;">Niv.{{ $agent->fonction->niveau ?? 1 }}</span>
                    </span>
                </div>

                {{-- Grille infos --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.8rem;">

                    {{-- Email --}}
                    @if($agent->email)
                    <div style="background:#f0f9ff;border-radius:10px;padding:0.8rem;">
                        <div style="font-size:0.72rem;color:#64748b;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:4px;">Email</div>
                        <a href="mailto:{{ $agent->email }}" style="color:#0284c7;font-size:0.84rem;word-break:break-all;text-decoration:none;font-weight:500;">
                            {{ $agent->email }}
                        </a>
                    </div>
                    @endif

                    {{-- Téléphone --}}
                    @if($agent->telephone)
                    <div style="background:#f0f9ff;border-radius:10px;padding:0.8rem;">
                        <div style="font-size:0.72rem;color:#64748b;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:4px;">Téléphone</div>
                        <a href="tel:{{ $agent->telephone }}" style="color:#0f172a;font-size:0.84rem;text-decoration:none;font-weight:500;">
                            {{ $agent->telephone }}
                        </a>
                    </div>
                    @endif

                    {{-- Poste interne --}}
                    @if($agent->telephone_interne)
                    <div style="background:#f0f9ff;border-radius:10px;padding:0.8rem;">
                        <div style="font-size:0.72rem;color:#64748b;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:4px;">Poste interne</div>
                        <div style="font-size:0.9rem;font-weight:700;color:#0369a1;">{{ $agent->telephone_interne }}</div>
                    </div>
                    @endif

                    {{-- Bureau --}}
                    @if($agent->bureau)
                    <div style="background:#f0f9ff;border-radius:10px;padding:0.8rem;">
                        <div style="font-size:0.72rem;color:#64748b;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:4px;">Bureau</div>
                        <div style="font-size:0.84rem;font-weight:500;color:#0f172a;">{{ $agent->bureau }}</div>
                    </div>
                    @endif

                    {{-- Service --}}
                    <div style="background:#f0f9ff;border-radius:10px;padding:0.8rem;grid-column:1/-1;">
                        <div style="font-size:0.72rem;color:#64748b;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:6px;">Structure</div>
                        <div style="display:flex;align-items:center;gap:0.5rem;flex-wrap:wrap;">
                            @if($agent->direction)
                            <span style="background:#0369a1;color:white;border-radius:6px;padding:3px 10px;font-size:0.75rem;font-weight:600;">
                                {{ $agent->direction->nom }}
                            </span>
                            <svg width="12" height="12" fill="none" stroke="#94a3b8" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
                            @endif
                            <span style="background:#e0f2fe;color:#0284c7;border-radius:6px;padding:3px 10px;font-size:0.75rem;font-weight:600;">
                                {{ $agent->entity->nom ?? '-' }}
                            </span>
                        </div>
                    </div>

                    {{-- Date prise de fonction --}}
                    @if($agent->date_prise_fonction)
                    <div style="background:#f0f9ff;border-radius:10px;padding:0.8rem;">
                        <div style="font-size:0.72rem;color:#64748b;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:4px;">Depuis le</div>
                        <div style="font-size:0.84rem;font-weight:500;color:#0f172a;">
                            {{ $agent->date_prise_fonction->format('d/m/Y') }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Footer modal --}}
            <div class="modal-footer" style="justify-content:space-between;">
                <div style="display:flex;gap:0.6rem;">
                    @if(auth()->user()?->role === 'admin')
                    <button
                        wire:click="$dispatch('open-edit', { id: {{ $agent->id }} })"
                        class="btn-warning">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                        Modifier
                    </button>
                    <button
                        wire:click="deactivate"
                        wire:confirm="Confirmer la désactivation de cet agent ?"
                        class="btn-danger">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="3,6 5,6 21,6"/>
                            <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2"/>
                        </svg>
                        Désactiver
                    </button>
                    @endif
                </div>
                <button wire:click="closeDetail" class="btn-ghost">Fermer</button>
            </div>
        </div>
    </div>
    @endif
</div>