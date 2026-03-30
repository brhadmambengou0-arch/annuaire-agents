@if($show && $agent)
<div style="position:fixed;inset:0;z-index:50;display:flex;align-items:center;justify-content:center;padding:16px;background:rgba(13,79,124,.2);"
     wire:click.self="close">

    <div style="width:100%;max-width:500px;background:#fff;border-radius:18px;border:1px solid #c8e1f5;overflow:hidden;max-height:90vh;overflow-y:auto;">

        <!-- En-tête -->
        <div class="flex items-center justify-between px-6 py-4"
             style="background:linear-gradient(135deg,#1a7fc1,#0d6fa8);position:sticky;top:0;z-index:1;">
            <div>
                <div class="aninf-display font-semibold text-white" style="font-size:15px;">
                    Fiche agent
                </div>
                <div style="font-size:11px;color:rgba(255,255,255,.7);margin-top:1px;">
                    Matricule : {{ $agent->matricule }}
                </div>
            </div>
            <button wire:click="close"
                    style="width:26px;height:26px;border-radius:50%;background:rgba(255,255,255,.2);
                           border:none;color:#fff;cursor:pointer;font-size:14px;display:flex;align-items:center;justify-content:center;">
                ✕
            </button>
        </div>

        <div class="px-6 py-5">
            <!-- Avatar + identité -->
            <div class="flex items-center gap-4 mb-5">
                <div class="rounded-full flex items-center justify-center font-bold flex-shrink-0"
                     style="width:60px;height:60px;font-size:20px;background:{{ $avatarBg }};color:{{ $avatarColor }};border:3px solid #e8f4fd;">
                    {{ strtoupper(substr($agent->prenom,0,1).substr($agent->nom,0,1)) }}
                </div>
                <div>
                    <div class="aninf-display font-semibold" style="font-size:17px;color:#0d4f7c;">
                        {{ $agent->prenom }} {{ $agent->nom }}
                    </div>
                    <div style="font-size:12px;color:#7aaecc;margin-top:2px;">
                        {{ $agent->fonction->libelle }} — Niveau {{ $agent->fonction->niveau }}
                    </div>
                    <div class="flex items-center gap-1.5 mt-1.5">
                        <div style="width:7px;height:7px;border-radius:50%;background:{{ $agent->is_active ? '#22c55e' : '#f87171' }};"></div>
                        <span style="font-size:11px;font-weight:500;color:{{ $agent->is_active ? '#16a34a' : '#dc2626' }};">
                            {{ $agent->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Chemin hiérarchique -->
            <div class="rounded-xl px-4 py-3 mb-5" style="background:#e8f4fd;">
                <div style="font-size:9px;font-weight:600;text-transform:uppercase;letter-spacing:.07em;color:#7aaecc;margin-bottom:6px;">
                    Structure d'appartenance
                </div>
                <div class="flex items-center flex-wrap gap-1" style="font-size:13px;font-weight:500;color:#0d4f7c;">
                    @if($agent->direction && $agent->direction->id !== $agent->entity->id)
                        <span>{{ $agent->direction->nom }}</span>
                        <span style="color:#9bbdd4;font-size:11px;">›</span>
                    @endif
                    @if($agent->entity->parent && $agent->entity->parent->id !== $agent->direction?->id)
                        <span>{{ $agent->entity->parent->nom }}</span>
                        <span style="color:#9bbdd4;font-size:11px;">›</span>
                    @endif
                    <span style="color:#1a7fc1;">{{ $agent->entity->nom }}</span>
                </div>
            </div>

            <!-- Grille infos -->
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:16px;">
                <div class="rounded-xl p-3" style="background:#f7fbff;border:0.5px solid #d0e8f8;">
                    <div style="font-size:9px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#7aaecc;margin-bottom:3px;">Téléphone</div>
                    @if($agent->telephone)
                        <a href="tel:{{ $agent->telephone }}" style="font-size:12px;font-weight:500;color:#1a7fc1;text-decoration:none;">{{ $agent->telephone }}</a>
                    @else
                        <span style="font-size:12px;color:#b0cfe0;">Non renseigné</span>
                    @endif
                </div>

                <div class="rounded-xl p-3" style="background:#f7fbff;border:0.5px solid #d0e8f8;">
                    <div style="font-size:9px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#7aaecc;margin-bottom:3px;">Poste interne</div>
                    <span style="font-size:12px;font-weight:500;color:#0d4f7c;">{{ $agent->telephone_interne ?? 'N/D' }}</span>
                </div>

                <div class="rounded-xl p-3" style="grid-column:1/-1;background:#f7fbff;border:0.5px solid #d0e8f8;">
                    <div style="font-size:9px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#7aaecc;margin-bottom:3px;">Email</div>
                    @if($agent->email)
                        <a href="mailto:{{ $agent->email }}" style="font-size:12px;font-weight:500;color:#1a7fc1;text-decoration:none;">{{ $agent->email }}</a>
                    @else
                        <span style="font-size:12px;color:#b0cfe0;">Non renseigné</span>
                    @endif
                </div>

                <div class="rounded-xl p-3" style="background:#f7fbff;border:0.5px solid #d0e8f8;">
                    <div style="font-size:9px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#7aaecc;margin-bottom:3px;">Bureau</div>
                    <span style="font-size:12px;font-weight:500;color:#0d4f7c;">{{ $agent->bureau ?? 'N/D' }}</span>
                </div>

                <div class="rounded-xl p-3" style="background:#f7fbff;border:0.5px solid #d0e8f8;">
                    <div style="font-size:9px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#7aaecc;margin-bottom:3px;">Prise de fonction</div>
                    <span style="font-size:12px;font-weight:500;color:#0d4f7c;">
                        {{ $agent->date_prise_fonction?->format('d/m/Y') ?? 'N/D' }}
                    </span>
                </div>
            </div>

            <!-- Actions admin -->
            @if(auth()->user()->role === 'admin')
                <div class="flex justify-end gap-2 pt-3" style="border-top:0.5px solid #d0e8f8;">
                    @if($agent->is_active)
                        <button wire:click="desactiver"
                                wire:confirm="Confirmer la désactivation de cet agent ?"
                                style="height:36px;padding:0 14px;background:#fef2f2;color:#dc2626;border:none;
                                       border-radius:9px;font-size:13px;font-weight:500;cursor:pointer;
                                       font-family:'DM Sans',sans-serif;"
                                onmouseover="this.style.background='#fee2e2'"
                                onmouseout="this.style.background='#fef2f2'">
                            Désactiver
                        </button>
                    @else
                        <button wire:click="reactiver"
                                style="height:36px;padding:0 14px;background:#f0fdf4;color:#16a34a;border:none;
                                       border-radius:9px;font-size:13px;font-weight:500;cursor:pointer;
                                       font-family:'DM Sans',sans-serif;"
                                onmouseover="this.style.background='#dcfce7'"
                                onmouseout="this.style.background='#f0fdf4'">
                            Réactiver
                        </button>
                    @endif
                    <button wire:click="modifier"
                            style="height:36px;padding:0 14px;background:#fff;color:#0d6fa8;
                                   border:1px solid #c8e1f5;border-radius:9px;font-size:13px;font-weight:500;
                                   cursor:pointer;font-family:'DM Sans',sans-serif;"
                            onmouseover="this.style.background='#e8f4fd'"
                            onmouseout="this.style.background='#fff'">
                        Modifier
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
@endif