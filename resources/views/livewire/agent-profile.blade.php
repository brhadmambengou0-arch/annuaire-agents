<div>
<x-app-layout>

<style>
:root {
    --aninf-navy:#0a1628;--aninf-blue:#0d47a1;--aninf-sky:#1976d2;--aninf-accent:#00bcd4;
    --aninf-green:#00897b;--aninf-red:#e53935;--aninf-surface:#f4f6fb;--aninf-card:#ffffff;
    --aninf-border:#e1e7f0;--aninf-text:#1a2340;--aninf-muted:#6b7a99;--aninf-light:#eaf1fb;
    --radius-lg:14px;--radius-md:10px;
    --shadow-card:0 2px 16px rgba(13,71,161,0.07),0 1px 4px rgba(0,0,0,0.04);
    --font-display:'Syne',sans-serif;--font-body:'DM Sans',sans-serif;
}
*{box-sizing:border-box;margin:0;padding:0;}
.aninf-profile{font-family:var(--font-body);background:var(--aninf-surface);min-height:100vh;color:var(--aninf-text);}
.db-hero{background:var(--aninf-navy);position:relative;overflow:hidden;padding:2.5rem 2rem 5rem;}
.db-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at 80% 50%,rgba(13,71,161,0.55) 0%,transparent 70%),radial-gradient(ellipse 40% 60% at 10% 80%,rgba(0,188,212,0.18) 0%,transparent 60%);}
.db-hero::after{content:'PROFIL';position:absolute;right:-1rem;top:50%;transform:translateY(-50%);font-family:var(--font-display);font-size:9rem;font-weight:800;color:rgba(255,255,255,0.03);pointer-events:none;user-select:none;}
.db-hero-inner{max-width:1100px;margin:0 auto;position:relative;z-index:2;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;}
.db-hero-logo{display:flex;align-items:center;gap:1rem;}
.db-hero-emblem{width:52px;height:52px;background:linear-gradient(135deg,var(--aninf-accent),var(--aninf-sky));border-radius:12px;display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:1rem;font-weight:800;color:#fff;box-shadow:0 4px 16px rgba(0,188,212,0.35);}
.db-hero-brand-name{font-family:var(--font-display);font-size:1rem;font-weight:700;color:#fff;letter-spacing:0.08em;}
.db-hero-brand-full{font-size:0.72rem;color:rgba(255,255,255,0.5);margin-top:0.1rem;max-width:320px;line-height:1.3;}
.db-hero-center{text-align:center;flex:1;}
.db-hero-title{font-family:var(--font-display);font-size:1.5rem;font-weight:800;color:#fff;}
.db-hero-subtitle{font-size:0.82rem;color:rgba(255,255,255,0.55);margin-top:0.3rem;}
.db-hero-right{display:flex;flex-direction:column;align-items:flex-end;gap:0.4rem;}
.db-badge{display:inline-flex;align-items:center;gap:0.4rem;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.15);color:#fff;padding:0.35rem 0.9rem;border-radius:20px;font-size:0.78rem;font-weight:600;}
.db-badge::before{content:'';width:7px;height:7px;background:var(--aninf-accent);border-radius:50%;display:inline-block;}
.db-hero-date{font-size:0.75rem;color:rgba(255,255,255,0.4);}
.profile-body{max-width:1100px;margin:-2.5rem auto 0;padding:0 1.5rem 3rem;position:relative;z-index:10;}
.profile-grid{display:grid;grid-template-columns:300px 1fr;gap:1.25rem;align-items:start;}
.card{background:var(--aninf-card);border-radius:var(--radius-lg);border:1px solid var(--aninf-border);box-shadow:var(--shadow-card);overflow:hidden;animation:fadeUp 0.5s ease both;}
.card-header{padding:1.1rem 1.5rem;border-bottom:1px solid var(--aninf-border);display:flex;align-items:center;justify-content:space-between;background:#fafbfe;}
.card-header-title{font-family:var(--font-display);font-size:0.88rem;font-weight:700;color:var(--aninf-blue);display:flex;align-items:center;gap:0.5rem;}
.card-header-title::before{content:'';width:3px;height:14px;background:var(--aninf-accent);border-radius:2px;display:inline-block;}
.avatar-zone{display:flex;flex-direction:column;align-items:center;padding:2rem 1.5rem 1.5rem;text-align:center;border-bottom:1px solid var(--aninf-border);}
.avatar-wrap{position:relative;width:100px;height:100px;margin-bottom:1rem;}
.avatar-img{width:100px;height:100px;border-radius:50%;object-fit:cover;border:3px solid var(--aninf-accent);box-shadow:0 4px 16px rgba(0,188,212,0.25);}
.avatar-initials{width:100px;height:100px;border-radius:50%;background:linear-gradient(135deg,var(--aninf-blue),var(--aninf-sky));display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:2rem;font-weight:800;color:#fff;border:3px solid var(--aninf-accent);}
.avatar-upload-btn{position:absolute;bottom:2px;right:2px;width:28px;height:28px;background:var(--aninf-accent);border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;border:2px solid #fff;font-size:1rem;color:#fff;font-weight:700;}
.identity-name{font-family:var(--font-display);font-size:1.15rem;font-weight:800;color:var(--aninf-navy);margin-bottom:0.25rem;}
.identity-fonction{font-size:0.78rem;color:var(--aninf-muted);margin-bottom:0.5rem;}
.identity-matricule{display:inline-block;background:var(--aninf-light);color:var(--aninf-blue);font-size:0.72rem;font-weight:700;padding:0.2rem 0.7rem;border-radius:20px;}
.identity-info-list{padding:1rem 1.5rem;display:flex;flex-direction:column;gap:0.85rem;}
.info-row{display:flex;align-items:flex-start;gap:0.75rem;}
.info-icon{width:32px;height:32px;border-radius:8px;background:var(--aninf-surface);border:1px solid var(--aninf-border);flex-shrink:0;}
.info-content{flex:1;min-width:0;}
.info-label{font-size:0.68rem;text-transform:uppercase;letter-spacing:0.07em;color:var(--aninf-muted);font-weight:600;margin-bottom:0.1rem;}
.info-value{font-size:0.82rem;font-weight:600;color:var(--aninf-navy);word-break:break-all;}
.info-value.muted{color:var(--aninf-muted);font-weight:400;font-style:italic;}
.photo-upload-zone{padding:1rem 1.5rem;border-top:1px solid var(--aninf-border);background:#fafbfe;}
.photo-upload-label{display:flex;align-items:center;justify-content:center;gap:0.5rem;padding:0.6rem 1rem;border:1.5px dashed var(--aninf-border);border-radius:var(--radius-md);cursor:pointer;font-size:0.78rem;font-weight:600;color:var(--aninf-sky);background:var(--aninf-light);}
.photo-upload-label:hover{border-color:var(--aninf-accent);background:#e0f7fa;}
.photo-cancel-btn{display:block;width:100%;text-align:center;margin-top:0.5rem;font-size:0.72rem;color:var(--aninf-red);cursor:pointer;background:none;border:none;font-family:var(--font-body);font-weight:600;}
.form-card{animation-delay:0.1s;}
.form-section{padding:1.5rem;border-bottom:1px solid var(--aninf-border);}
.form-section-title{font-family:var(--font-display);font-size:0.82rem;font-weight:700;color:var(--aninf-muted);text-transform:uppercase;letter-spacing:0.08em;margin-bottom:1.25rem;display:flex;align-items:center;gap:0.5rem;}
.form-section-title::after{content:'';flex:1;height:1px;background:var(--aninf-border);}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem;}
.form-grid.full{grid-template-columns:1fr;}
.form-group{display:flex;flex-direction:column;gap:0.4rem;}
.form-label{font-size:0.75rem;font-weight:600;color:var(--aninf-text);}
.form-input{width:100%;padding:0.65rem 0.9rem;border:1.5px solid var(--aninf-border);border-radius:var(--radius-md);font-family:var(--font-body);font-size:0.875rem;color:var(--aninf-text);background:#fff;outline:none;transition:border-color 0.15s,box-shadow 0.15s;}
.form-input:focus{border-color:var(--aninf-accent);box-shadow:0 0 0 3px rgba(0,188,212,0.12);}
.form-input.readonly{background:var(--aninf-surface);color:var(--aninf-muted);cursor:not-allowed;border-style:dashed;}
.form-error{font-size:0.72rem;color:var(--aninf-red);font-weight:500;}
.form-actions{padding:1.25rem 1.5rem;background:#fafbfe;border-top:1px solid var(--aninf-border);display:flex;justify-content:flex-end;gap:0.75rem;}
.btn{display:inline-flex;align-items:center;gap:0.4rem;padding:0.6rem 1.4rem;border-radius:var(--radius-md);font-family:var(--font-body);font-size:0.82rem;font-weight:600;cursor:pointer;border:none;transition:all 0.18s;text-decoration:none;}
.btn-primary{background:linear-gradient(135deg,var(--aninf-blue),var(--aninf-sky));color:#fff;box-shadow:0 2px 8px rgba(13,71,161,0.25);}
.btn-primary:hover{transform:translateY(-1px);}
.btn-ghost{background:transparent;color:var(--aninf-muted);border:1.5px solid var(--aninf-border);}
.btn-ghost:hover{background:var(--aninf-surface);}
.alert{display:flex;align-items:flex-start;gap:0.75rem;padding:0.9rem 1.1rem;border-radius:var(--radius-md);font-size:0.82rem;margin-bottom:1.25rem;}
.alert-success{background:#e8f5e9;border:1px solid #a5d6a7;border-left:4px solid var(--aninf-green);color:#1b5e20;}
.alert-danger{background:#ffebee;border:1px solid #ef9a9a;border-left:4px solid var(--aninf-red);color:#b71c1c;}
@keyframes fadeUp{from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:translateY(0);}}
@media(max-width:900px){.profile-grid{grid-template-columns:1fr;}}
@media(max-width:640px){.form-grid{grid-template-columns:1fr;}.db-hero{padding:1.5rem 1rem 4rem;}.db-hero-center{display:none;}}
</style>

<div class="aninf-profile">

    <div class="db-hero">
        <div class="db-hero-inner">
            <div class="db-hero-logo">
                <div class="db-hero-emblem">AN</div>
                <div>
                    <div class="db-hero-brand-name">ANINF</div>
                    <div class="db-hero-brand-full">Agence Nationale des Infrastructures Numériques et des Fréquences</div>
                </div>
            </div>
            <div class="db-hero-center">
                <div class="db-hero-title">Mon Profil</div>
                <div class="db-hero-subtitle">Gérez vos informations personnelles et de contact</div>
            </div>
            <div class="db-hero-right">
                <div class="db-badge">Agent</div>
                <div class="db-hero-date">{{ now()->translatedFormat('l d F Y') }}</div>
            </div>
        </div>
    </div>

    <div class="profile-body">

        @if(!$hasAgent)
            <div class="alert alert-danger">
                <div>Votre profil agent n'a pas été trouvé. Veuillez contacter un administrateur.</div>
            </div>
            <a href="{{ route('annuaire.index') }}" class="btn btn-ghost">← Retour à l'annuaire</a>
        @else

        @if(session()->has('message'))
            <div class="alert alert-success">
                <div>{{ session('message') }}</div>
            </div>
        @endif

        {{-- Stocke l'URL de la photo pour JS --}}
        <span id="current-photo-url"
              data-url="{{ $agent->photo_url ? asset('storage/' . $agent->photo_url) : '' }}"
              style="display:none;"></span>

        <form wire:submit.prevent="saveProfile">
            <div class="profile-grid">

                {{-- COLONNE GAUCHE --}}
                <div style="display:flex;flex-direction:column;gap:1.25rem;">
                    <div class="card">
                        <div class="avatar-zone">
                            <div class="avatar-wrap">
                                <div wire:ignore id="avatar-container">
                                    @if($agent->photo_url)
                                        <img id="avatar-preview" src="{{ asset('storage/' . $agent->photo_url) }}" alt="Photo" class="avatar-img">
                                    @else
                                        <div id="avatar-preview" class="avatar-initials">
                                            {{ strtoupper(substr($agent->prenom, 0, 1) . substr($agent->nom, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <label for="photo-input" class="avatar-upload-btn" title="Changer la photo">+</label>
                            </div>
                            <div class="identity-name">{{ $agent->prenom }} {{ $agent->nom }}</div>
                            <div class="identity-fonction">{{ $agent->fonction->libelle ?? 'Fonction non définie' }}</div>
                            @if($agent->matricule)
                                <span class="identity-matricule">{{ $agent->matricule }}</span>
                            @endif
                        </div>

                        <div class="identity-info-list">
                            <div class="info-row">
                                <div class="info-icon"></div>
                                <div class="info-content">
                                    <div class="info-label">Entité</div>
                                    <div class="info-value">{{ $agent->entity->nom ?? '—' }}</div>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-icon"></div>
                                <div class="info-content">
                                    <div class="info-label">Email</div>
                                    <div class="info-value">{{ $agent->email ?? '—' }}</div>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-icon"></div>
                                <div class="info-content">
                                    <div class="info-label">Tél. professionnel</div>
                                    <div class="info-value {{ !$agent->telephone_professionnel ? 'muted' : '' }}">
                                        {{ $agent->telephone_professionnel ?? 'Non renseigné' }}
                                    </div>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-icon"></div>
                                <div class="info-content">
                                    <div class="info-label">Tél. privé</div>
                                    <div class="info-value {{ !$agent->telephone_prive ? 'muted' : '' }}">
                                        {{ $agent->telephone_prive ?? 'Non renseigné' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="photo-upload-zone">
                            <label class="photo-upload-label" for="photo-input">
                                Choisir une photo
                            </label>
                            <input type="file" id="photo-input" wire:model="photo"
                                   accept="image/*" class="hidden" onchange="previewPhoto(this)">
                            @error('photo')
                                <div class="form-error" style="margin-top:0.4rem;text-align:center;">{{ $message }}</div>
                            @enderror
                            @if($photo)
                                <button type="button" wire:click="$set('photo', null)" class="photo-cancel-btn">
                                    ✕ Annuler la sélection
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- COLONNE DROITE --}}
                <div>
                    <div class="card form-card">
                        <div class="card-header">
                            <div class="card-header-title">Modifier mes informations</div>
                        </div>

                        <div class="form-section">
                            <div class="form-section-title">Informations personnelles</div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Prénom</label>
                                    <input type="text" value="{{ $agent->prenom }}" readonly class="form-input readonly">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nom</label>
                                    <input type="text" value="{{ $agent->nom }}" readonly class="form-input readonly">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Fonction</label>
                                    <input type="text" value="{{ $agent->fonction->libelle ?? '—' }}" readonly class="form-input readonly">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Entité</label>
                                    <input type="text" value="{{ $agent->entity->nom ?? '—' }}" readonly class="form-input readonly">
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="form-section-title">Coordonnées</div>
                            <div class="form-grid full" style="gap:1rem;">
                                <div class="form-group">
                                    <label class="form-label" for="email">Adresse email</label>
                                    <input type="email" wire:model="email" id="email" class="form-input" placeholder="exemple@aninf.ga">
                                    @error('email') <span class="form-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-grid" style="margin-top:1rem;">
                                <div class="form-group">
                                    <label class="form-label" for="telephone_professionnel">Téléphone professionnel</label>
                                    <input type="tel" wire:model="telephone_professionnel" id="telephone_professionnel" class="form-input" placeholder="+241 XX XX XX XX">
                                    @error('telephone_professionnel') <span class="form-error">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="telephone_prive">Téléphone privé</label>
                                    <input type="tel" wire:model="telephone_prive" id="telephone_prive" class="form-input" placeholder="+241 XX XX XX XX">
                                    @error('telephone_prive') <span class="form-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="form-section-title">Changer le mot de passe</div>
                            <div class="form-grid full" style="gap:1rem;">
                                <div class="form-group">
                                    <label class="form-label" for="current_password">Mot de passe actuel</label>
                                    <input type="password" wire:model="current_password" id="current_password" class="form-input" placeholder="Votre mot de passe actuel">
                                    @error('current_password') <span class="form-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-grid" style="margin-top:1rem;">
                                <div class="form-group">
                                    <label class="form-label" for="password">Nouveau mot de passe</label>
                                    <input type="password" wire:model="password" id="password" class="form-input" placeholder="Minimum 8 caractères">
                                    @error('password') <span class="form-error">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="password_confirmation">Confirmer le mot de passe</label>
                                    <input type="password" wire:model="password_confirmation" id="password_confirmation" class="form-input" placeholder="Répétez le mot de passe">
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="{{ route('annuaire.index') }}" class="btn btn-ghost">Annuler</a>
                            <button type="submit" class="btn btn-primary">
                                Sauvegarder les modifications
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>

        @endif
    </div>
</div>

<script>
// Preview JS avant upload
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('avatar-preview');
            if (preview) {
                if (preview.tagName === 'IMG') {
                    preview.src = e.target.result;
                } else {
                    const img = document.createElement('img');
                    img.id = 'avatar-preview';
                    img.src = e.target.result;
                    img.className = 'avatar-img';
                    img.alt = 'Aperçu';
                    preview.parentNode.replaceChild(img, preview);
                }
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Après sauvegarde Livewire, met à jour l'avatar avec la nouvelle URL
document.addEventListener('livewire:request', function() {});
document.addEventListener('livewire:response', function() {
    setTimeout(function() {
        const urlEl = document.getElementById('current-photo-url');
        if (urlEl && urlEl.dataset.url) {
            const preview = document.getElementById('avatar-preview');
            if (preview) {
                if (preview.tagName === 'IMG') {
                    preview.src = urlEl.dataset.url + '?t=' + Date.now();
                } else {
                    const img = document.createElement('img');
                    img.id = 'avatar-preview';
                    img.src = urlEl.dataset.url + '?t=' + Date.now();
                    img.className = 'avatar-img';
                    img.alt = 'Photo';
                    preview.parentNode.replaceChild(img, preview);
                }
            }
        }
    }, 100);
});
</script>

</x-app-layout>
</div>