<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entity extends Model
{
    // Nom de la table dans la base de données
    protected $table = 'entities';

    // Champs que l'on peut remplir via le formulaire
    protected $fillable = [
        'nom',
        'code',
        'type',
        'parent_id',
        'description',
        'ordre',
        'is_active',
    ];

    // Types des champs
    protected $casts = [
        'is_active' => 'boolean',
        'ordre'     => 'int',
    ];

    // ─── RELATIONS ────────────────────────────────────────

    /**
     * Enfants directs de cette entité
     * Ex: les Services d'une Direction
     */
    public function children(): HasMany
    {
        return $this->hasMany(Entity::class, 'parent_id')
                    ->where('is_active', true)
                    ->orderBy('ordre');
    }

    /**
     * Tous les enfants de façon récursive
     * Ex: Services ET leurs Départements
     */
    public function childrenRecursive(): HasMany
    {
        return $this->children()->with('childrenRecursive');
    }

    
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Entity::class, 'parent_id');
    }

    /**
     * Agents rattachés à cette entité
     */
    public function agents(): HasMany
    {
        return $this->hasMany(Agent::class, 'entity_id');
    }

    // ─── SCOPES ───────────────────────────────────────────

    /**
     * Scope : uniquement les Directions (sans parent)
     */
    public function scopeRoots($query)
    {
        return $query->whereNull('parent_id')
                     ->where('is_active', true)
                     ->orderBy('ordre');
    }

    /**
     * Scope : uniquement les entités actives
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}