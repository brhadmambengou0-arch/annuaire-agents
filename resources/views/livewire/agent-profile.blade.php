<div>
<style>
@import url('https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap');

:root {
    --navy:   #0a1628;
    --blue:   #0d47a1;
    --sky:    #1976d2;
    --accent: #00bcd4;
    --gold:   #ffc107;
    --green:  #00897b;
    --surface:#f4f6fb;
    --card:   #ffffff;
    --border: #e1e7f0;
    --text:   #1a2340;
    --muted:  #6b7a99;
    --light:  #eaf1fb;
    --radius: 14px;
    --shadow: 0 2px 16px rgba(13,71,161,0.07), 0 1px 4px rgba(0,0,0,0.04);
    --shadow-hover: 0 8px 32px rgba(13,71,161,0.13);
    --font-display: 'Syne', sans-serif;
    --font-body:    'DM Sans', sans-serif;
}

.profile-page {
    font-family: var(--font-body);
    background: var(--surface);
    min-height: 100vh;
    color: var(--text);
}

/* ── HERO ── */
.profile-hero {
    background: var(--navy);
    position: relative;
    overflow: hidden;
    padding: 2.5rem 2rem 6rem;
}
.profile-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 60% 80% at 80% 50%, rgba(13,71,161,0.55) 0%, transparent 70%),
        radial-gradient(ellipse 40% 60% at 10% 80%, rgba(0,188,212,0.18) 0%, transparent 60%);
}
.profile-hero::after {
    content: 'PROFIL';
    position: absolute;
    right: -1rem;
    top: 50%;
    transform: translateY(-50%);
    font-family: var(--font-display);
    font-size: 8rem;
    font-weight: 800;
    color: rgba(255,255,255,0.03);
    pointer-events: none;
}
.profile-hero-inner {
    max-width: 1100px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
}
.profile-hero-left {
    display: flex;
    align-items: center;
    gap: 1.25rem;
}
.profile-hero-avatar {
    width: 64px;
    height: 64px;
    border-radius: 16px;
    background: linear-gradient(135deg, var(--accent), var(--sky));
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--font-display);
    font-size: 1.4rem;
    font-weight: 800;
    color: #fff;
    box-shadow: 0 4px 20px rgba(0,188,212,0.35);
    overflow: hidden;
    flex-shrink: 0;
}
.profile-hero-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.profile-hero-info h1 {
    font-family: var(--font-display);
    font-size: 1.5rem;
    font-weight: 800;
    color: #fff;
}
.profile-hero-info p {
    font-size: 0.82rem;
    color: rgba(255,255,255,0.55);
    margin-top: 0.2rem;
}
.profile-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.15);
    color: #fff;
    padding: 0.35rem 0.9rem;
    border-radius: 20px;
    font-size: 0.78rem;
    font-weight: 600;
    backdrop-filter: blur(8px);
}
.profile-badge::before {
    content: '';
    width: 7px;
    height: 7px;
    background: var(--accent);
    border-radius: 50%;
}

/* ── BODY ── */
.profile-body {
    max-width: 1100px;
    margin: -3rem auto 0;
    padding: 0 1.5rem 3rem;
    position: relative;
    z-index: 10;
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 1.25rem;
}

/* ── CARD ── */
.pcard {
    background: var(--card);
    border-radius: var(--radius);
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
    overflow: hidden;
    animation: fadeUp 0.5s ease both;
}
.pcard-header {
    padding: 1.1rem 1.5rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fafbfe;
}
.pcard-title {
    font-family: var(--font-display);
    font-size: 0.88rem;
    font-weight: 700;
    color: var(--blue);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.pcard-title::before {
    content: '';
    width: 3px;
    height: 14px;
    background: var(--accent);
    border-radius: 2px;
}
.pcard-body { padding: 1.25rem 1.5rem; }

/* ── PHOTO ── */
.photo-wrap {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
}
.photo-circle {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--light), #dbeafe);
    border: 3px solid var(--border);
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--font-display);
    font-size: 2rem;
    font-weight: 800;
    color: var(--blue);
}
.photo-circle img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.photo-name {
    font-family: var(--font-display);
    font-size: 1rem;
    font-weight: 700;
    color: var(--navy);
    text-align: center;
}
.photo-role {
    font-size: 0.75rem;
    color: var(--muted);
    text-align: center;
    margin-top: -0.5rem;
}

/* ── INFO ITEMS ── */
.info-item {
    padding: 0.75rem 0;
    border-bottom: 1px solid #f0f4fa;
}
.info-item:last-child { border-bottom: none; }
.info-label {
    font-size: 0.68rem;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    color: var(--muted);
    font-weight: 600;
    margin-bottom: 0.2rem;
}
.info-value {
    font-size: 0.88rem;
    font-weight: 600;
    color: var(--navy);
}

/* ── UPLOAD ── */
.upload-zone {
    border: 2px dashed var(--border);
    border-radius: var(--radius);
    padding: 1.25rem;
    text-align: center;
    background: #fafbfe;
    transition: all 0.2s;
    cursor: pointer;
}
.upload-zone:hover {
    border-color: var(--accent);
    background: #e0f7fa;
}
.upload-zone label {
    cursor: pointer;
    font-size: 0.82rem;
    color: var(--sky);
    font-weight: 600;
}
.upload-zone input[type="file"] {
    display: none;
}
.upload-zone p {
    font-size: 0.72rem;
    color: var(--muted);
    margin-top: 0.4rem;
}

/* ── FORM ── */
.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}
.form-group { display: flex; flex-direction: column; gap: 0.35rem; }
.form-group.full { grid-column: 1 / -1; }
.form-label {
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
.form-input {
    padding: 0.6rem 0.9rem;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-size: 0.88rem;
    color: var(--text);
    background: #fafbfe;
    outline: none;
    transition: border-color 0.15s, box-shadow 0.15s;
    font-family: var(--font-body);
}
.form-input:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(0,188,212,0.1);
    background: #fff;
}
.form-input[readonly] {
    background: var(--surface);
    color: var(--muted);
    cursor: default;
}
.form-error { font-size: 0.75rem; color: #e53935; }

/* ── MODE BADGE ── */
.mode-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-size: 0.72rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.07em;
}
.mode-badge.edit   { background: #e0f7fa; color: #00838f; }
.mode-badge.read   { background: var(--light); color: var(--sky); }

/* ── BUTTONS ── */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.55rem 1.2rem;
    border-radius: 8px;
    font-size: 0.82rem;
    font-weight: 600;
    cursor: pointer;
    border: none;
    transition: all 0.15s;
    font-family: var(--font-body);
}
.btn-primary {
    background: var(--blue);
    color: #fff;
}
.btn-primary:hover { background: var(--sky); }
.btn-accent {
    background: var(--accent);
    color: #fff;
}
.btn-accent:hover { background: #00acc1; }
.btn-ghost {
    background: #fff;
    color: var(--muted);
    border: 1.5px solid var(--border);
}
.btn-ghost:hover { background: var(--surface); color: var(--text); }
.btn-row {
    display: flex;
    gap: 0.75rem;
    justify-content: flex-end;
    margin-top: 1.25rem;
}

/* ── PASSWORD SECTION ── */
.pwd-toggle {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
}
.pwd-toggle h3 {
    font-family: var(--font-display);
    font-size: 0.88rem;
    font-weight: 700;
    color: var(--blue);
}
.pwd-toggle p {
    font-size: 0.75rem;
    color: var(--muted);
}

/* ── ANIMATIONS ── */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
}
.pcard:nth-child(1) { animation-delay: 0.05s; }
.pcard:nth-child(2) { animation-delay: 0.10s; }
.pcard:nth-child(3) { animation-delay: 0.15s; }

/* ── RESPONSIVE ── */
@media(max-width: 900px) {
    .profile-body { grid-template-columns: 1fr; }
}
</style>

<div class="profile-page">

    {{-- ── HERO ── --}}
    <div class="profile-hero">
        <div class="profile-hero-inner">
            <div class="profile-hero-left">
                <div class="profile-hero-avatar">
                    @if(optional($agent)->photo_url)
                        <img src="{{ asset('storage/' . $agent->photo_url) }}" alt="Photo">
                    @else
                        {{ strtoupper(substr(optional($agent)->prenom ?? $name, 0, 1) . substr(optional($agent)->nom ?? '', 0, 1)) }}
                    @endif
                </div>
                <div class="profile-hero-info">
                    <h1>{{ optional($agent)->prenom ?? $name }} {{ optional($agent)->nom ?? '' }}</h1>
                    <p>{{ optional($agent)->fonction->libelle ?? 'Agent ANINF' }} &nbsp;·&nbsp; {{ optional($agent)->entity->nom ?? '' }}</p>
                </div>
            </div>
            <div class="profile-badge">Mon profil</div>
        </div>
    </div>

    <div class="profile-body">

        {{-- ── COLONNE GAUCHE ── --}}
        <div style="display:flex; flex-direction:column; gap:1.25rem;">

            {{-- Photo --}}
            <div class="pcard">
                <div class="pcard-header">
                    <div class="pcard-title">Photo de profil</div>
                </div>
                <div class="pcard-body">
                    <div class="photo-wrap">
                        <div class="photo-circle">
                            @if($photo)
                                <img src="{{ $photo->temporaryUrl() }}" alt="Aperçu">
                            @elseif(optional($agent)->photo_url)
                                <img src="{{ asset('storage/' . $agent->photo_url) }}" alt="Photo">
                            @else
                                {{ strtoupper(substr(optional($agent)->prenom ?? $name, 0, 1) . substr(optional($agent)->nom ?? '', 0, 1)) }}
                            @endif
                        </div>
                        <div class="photo-name">{{ optional($agent)->prenom ?? $name }} {{ optional($agent)->nom ?? '' }}</div>
                        <div class="photo-role">{{ optional($agent)->matricule ?? '—' }}</div>
                    </div>

                    <div class="upload-zone" style="margin-top:1.25rem;">
                        <label for="photo-input">Choisir une photo</label>
                        <input type="file" id="photo-input" wire:model="photo" accept="image/*">
                        <p></p>
                        @if($photo)
                            <p style="color:var(--green);font-weight:600;margin-top:0.5rem;">✓ {{ $photo->getClientOriginalName() }}</p>
                        @endif
                        @error('photo') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Infos fixes --}}
            <div class="pcard">
                <div class="pcard-header">
                    <div class="pcard-title">Informations</div>
                </div>
                <div class="pcard-body">
                    <div class="info-item">
                        <div class="info-label">Fonction</div>
                        <div class="info-value">{{ optional($agent)->fonction->libelle ?? '—' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Entité</div>
                        <div class="info-value">{{ optional($agent)->entity->nom ?? '—' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Matricule</div>
                        <div class="info-value" style="font-family:monospace;">{{ optional($agent)->matricule ?? '—' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Bureau</div>
                        <div class="info-value">{{ optional($agent)->bureau ?? '—' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Prise de fonction</div>
                        <div class="info-value">{{ optional($agent)->date_prise_fonction?->format('d/m/Y') ?? '—' }}</div>
                    </div>
                </div>
            </div>

        </div>

        {{-- ── COLONNE DROITE ── --}}
        <div style="display:flex; flex-direction:column; gap:1.25rem;">

            {{-- Coordonnées --}}
            <div class="pcard">
                <div class="pcard-header">
                    <div class="pcard-title">Mes coordonnées</div>
                    <div style="display:flex;align-items:center;gap:0.75rem;">
                        <span class="mode-badge {{ $editMode ? 'edit' : 'read' }}">
                            {{ $editMode ? ' Édition' : ' Lecture' }}
                        </span>
                        @if(!$editMode)
                            <button type="button" wire:click="enableEditing" class="btn btn-primary">Modifier</button>
                        @endif
                    </div>
                </div>
                <div class="pcard-body">
                    <form wire:submit.prevent="saveProfile">
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Prénom</label>
                                <input type="text" class="form-input" value="{{ optional($agent)->prenom ?? $name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nom</label>
                                <input type="text" class="form-input" value="{{ optional($agent)->nom ?? '—' }}" readonly>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" wire:model="email" class="form-input" @if(!$editMode) readonly @endif>
                                @error('email') <span class="form-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Téléphone professionnel</label>
                                <input type="tel" wire:model="telephone_professionnel" class="form-input" @if(!$editMode) readonly @endif>
                                @error('telephone_professionnel') <span class="form-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Téléphone privé</label>
                                <input type="tel" wire:model="telephone_prive" class="form-input" @if(!$editMode) readonly @endif>
                                @error('telephone_prive') <span class="form-error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        @if($editMode)
                        <div class="btn-row">
                            <button type="button" wire:click="cancelEditing" class="btn btn-ghost">Annuler</button>
                            <button type="submit" class="btn btn-accent">Enregistrer</button>
                        </div>
                        @endif
                    </form>
                </div>
            </div>

            {{-- Mot de passe --}}
            <div class="pcard">
                <div class="pcard-header">
                    <div class="pcard-title">Sécurité</div>
                    <button type="button" onclick="togglePwd()" class="btn btn-ghost" style="font-size:0.78rem;">Afficher / Masquer</button>
                </div>
                <div class="pcard-body">
                    <div class="pwd-toggle">
                        <div>
                            <h3>Changer le mot de passe</h3>
                            <p>Laissez vide si vous ne souhaitez pas le modifier.</p>
                        </div>
                    </div>
                    <form wire:submit.prevent="saveProfile">
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Mot de passe actuel</label>
                                <input type="password" wire:model="current_password" id="pwd1" class="form-input">
                                @error('current_password') <span class="form-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nouveau mot de passe</label>
                                <input type="password" wire:model="password" id="pwd2" class="form-input">
                                @error('password') <span class="form-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group full">
                                <label class="form-label">Confirmer le mot de passe</label>
                                <input type="password" wire:model="password_confirmation" id="pwd3" class="form-input">
                            </div>
                        </div>
                        <div class="btn-row">
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function togglePwd() {
    ['pwd1','pwd2','pwd3'].forEach(id => {
        const f = document.getElementById(id);
        if (f) f.type = f.type === 'password' ? 'text' : 'password';
    });
}
</script>