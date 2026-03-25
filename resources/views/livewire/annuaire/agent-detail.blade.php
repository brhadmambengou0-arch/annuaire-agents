{{-- Modal fiche détaillée — AgentDetail --}}
@if($show && $agent)
<div class="fixed inset-0 z-50 flex items-center justify-center p-4"
     style="background:rgba(13,79,124,.18);"
     x-data @click.self="$wire.close()">

    <div class="w-full overflow-hidden rounded-2xl" style="max-width:520px;background:#fff;border:1px solid #c8e1f5;">

        {{-- En-tête colorée --}}
        <div class="flex items-center justify-between px-6 py-5"
             style="background:linear-gradient(135deg,#1a7fc1,#0d6fa8);">
            <div>
                <h2 class="font-display font-semibold text-white" style="font-size:16px;">
                    Fiche agent
                </h2>
                <p class="text-xs mt-0.5" style="color:rgba(255,255,255,.7);">
                    Matricule : {{ $agent->matricule }}
                </p>
            </div>
            <button wire:click="close"
                    class="flex items-center justify-center rounded-full text-white text-lg leading-none"
                    style="width:28px;height:28px;background:rgba(255,255,255,.2);border:none;cursor:pointer;">
                ✕
            </button>
        </div>

        <div class="px-6 py-5">

            {{-- Avatar + identité --}}
            <div class="flex items-center gap-4 mb-5">
                <div class="rounded-full flex items-center justify-center font-bold flex-shrink-0"
                     style="width:64px;height:64px;font-size:22px;background:{{ $avatarBg }};color:{{ $avatarColor }};border:3px solid #e8f4fd;">
                    {{ strtoupper(substr($agent->prenom, 0, 1) . substr($agent->nom, 0, 1)) }}
                </div>
                <div>
                    <div class="font-display font-semibold" style="font-size:18px;color:#0d4f7c;">
                        {{ $agent->prenom }} {{ $agent->nom }}
                    </div>
                    <div class="text-sm mt-0.5" style="color:#7aaecc;">
                        {{ $agent->fonction->libelle }} — Niveau {{ $agent->fonction->niveau }}
                    </div>
                    <div class="flex items-center gap-1.5 mt-1.5">
                        <div class="w-2 h-2 rounded-full" style="background:{{ $agent->is_active ? '#22c55e' : '#f87171' }};"></div>
                        <span class="text-xs font-medium" style="color:{{ $agent->is_active ? '#16a34a' : '#dc2626' }};">
                            {{ $agent->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Chemin hiérarchique --}}
            <div class="rounded-xl px-4 py-3 mb-5" style="background:#e8f4fd;">
                <div class="text-xs font-semibold uppercase tracking-widest mb-2" style="color:#7aaecc;">
                    Structure d'appartenance
                </div>
                <div class="flex items-center flex-wrap gap-1.5 text-sm font-medium" style="color:#0d4f7c;">
                    @if($agent->direction && $agent->direction->id !== $agent->entity->id)
                        <span>{{ $agent->direction->nom }}</span>
                        <span style="color:#9bbdd4;">›</span>
                    @endif
                    @if($agent->entity->parent && $agent->entity->parent->id !== $agent->direction?->id)
                        <span>{{ $agent->entity->parent->nom }}</span>
                        <span style="color:#9bbdd4;">›</span>
                    @endif
                    <span style="color:#1a7fc1;">{{ $agent->entity->nom }}</span>
                </div>
            </div>

            {{-- Grille des informations --}}
            <div class="grid grid-cols-2 gap-3 mb-5">
                <div class="rounded-xl p-3" style="background:#f7fbff;border:0.5px solid #d0e8f8;">
                    <div class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#7aaecc;">Téléphone</div>
                    @if($agent->telephone)
                        <a href="tel:{{ $agent->telephone }}" class="text-sm font-medium" style="color:#1a7fc1;text-decoration:none;">
                            {{ $agent->telephone }}
                        </a>
                    @else
                        <span class="text-sm" style="color:#b0cfe0;">Non renseigné</span>
                    @endif
                </div>

                <div class="rounded-xl p-3" style="background:#f7fbff;border:0.5px solid #d0e8f8;">
                    <div class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#7aaecc;">Poste interne</div>
                    <span class="text-sm font-medium" style="color:#0d4f7c;">
                        {{ $agent->telephone_interne ?? 'N/D' }}
                    </span>
                </div>

                <div class="rounded-xl p-3 col-span-2" style="background:#f7fbff;border:0.5px solid #d0e8f8;">
                    <div class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#7aaecc;">Email</div>
                    @if($agent->email)
                        <a href="mailto:{{ $agent->email }}" class="text-sm font-medium" style="color:#1a7fc1;text-decoration:none;">
                            {{ $agent->email }}
                        </a>
                    @else
                        <span class="text-sm" style="color:#b0cfe0;">Non renseigné</span>
                    @endif
                </div>

                <div class="rounded-xl p-3" style="background:#f7fbff;border:0.5px solid #d0e8f8;">
                    <div class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#7aaecc;">Bureau</div>
                    <span class="text-sm font-medium" style="color:#0d4f7c;">{{ $agent->bureau ?? 'N/D' }}</span>
                </div>

                <div class="rounded-xl p-3" style="background:#f7fbff;border:0.5px solid #d0e8f8;">
                    <div class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#7aaecc;">Prise de fonction</div>
                    <span class="text-sm font-medium" style="color:#0d4f7c;">
                        {{ $agent->date_prise_fonction?->format('d M Y') ?? 'N/D' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        @if(auth()->user()->role === 'admin')
            <div class="flex justify-end gap-2 px-6 pb-5 pt-0">
                @if($agent->is_active)
                    <button wire:click="desactiver"
                            wire:confirm="Confirmer la désactivation de cet agent ?"
                            class="text-sm font-medium px-4 py-2 rounded-xl transition"
                            style="background:#fef2f2;color:#dc2626;border:none;cursor:pointer;font-family:'DM Sans',sans-serif;"
                            onmouseover="this.style.background='#fee2e2'"
                            onmouseout="this.style.background='#fef2f2'">
                        Désactiver
                    </button>
                @else
                    <button wire:click="reactiver"
                            class="text-sm font-medium px-4 py-2 rounded-xl transition"
                            style="background:#f0fdf4;color:#16a34a;border:none;cursor:pointer;font-family:'DM Sans',sans-serif;"
                            onmouseover="this.style.background='#dcfce7'"
                            onmouseout="this.style.background='#f0fdf4'">
                        Réactiver
                    </button>
                @endif
                <button wire:click="modifier"
                        class="text-sm font-medium px-4 py-2 rounded-xl transition"
                        style="background:#fff;color:#0d6fa8;border:1px solid #c8e1f5;cursor:pointer;font-family:'DM Sans',sans-serif;"
                        onmouseover="this.style.background='#e8f4fd'"
                        onmouseout="this.style.background='#fff'">
                    Modifier
                </button>
            </div>
        @endif
    </div>
</div>
@endif
