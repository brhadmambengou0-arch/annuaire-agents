<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agent extends Model
{
    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'email',
        'telephone',
        'telephone_interne',
        'entity_id',
        'fonction_id',       
        'bureau',
        'date_prise_fonction',
        'is_active',
    ];

    protected $casts = [
        'date_prise_fonction' => 'date',
        'is_active'           => 'boolean ',
    ];

    // ─── RELATIONS ────────────────────────────────────────

    /**
     * L'entité (service/direction) de l'agent
     */
    public function entity(): BelongsTo
    {
        return $this->belongsTo(Entity::class);
    }

    /**
     * La fonction (poste) de l'agent
     */
    public function fonction(): BelongsTo
    {
        return $this->belongsTo(Fonction::class);
    }

    // ─── ACCESSORS ────────────────────────────────────────

    /**
     * Retourne la Direction parente de l'agent
     * en remontant l'arbre selon le type de son entité
     */
    public function getDirectionAttribute(): ?Entity
    {
        $e = $this->entity;
        if (!$e) return null; 

        return match($e->type) {
            'direction'   => $e,
            'service'     => $e->parent,
            'departement' => $e->parent?->parent ?? $e->parent,
            default       => null,
        };
    }

    /**
     * Retourne le nom complet de l'agent
     */
    public function getNomCompletAttribute(): string
    {
        return $this->prenom . ' ' . $this->nom;
    }

    // ─── SCOPES ───────────────────────────────────────────

    /**
     * Recherche sur nom, prénom, email, matricule
     */
    public function scopeSearch($query, string $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('nom',       'ILIKE', "%{$term}%")
              ->orWhere('prenom',  'ILIKE', "%{$term}%")
              ->orWhere('email',   'ILIKE', "%{$term}%")
              ->orWhere('matricule', 'ILIKE', "%{$term}%");
        });
    }

    /**
     * Seulement les agents actifs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Filtrer par fonction
     */
    public function scopeByFonction($query, int $fonctionId)
    {
        return $query->where('fonction_id', $fonctionId);
    }
}