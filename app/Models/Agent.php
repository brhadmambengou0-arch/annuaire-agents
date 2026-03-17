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

  protected function casts(): array
{
    return [
        'date_prise_fonction' => 'date',
        'is_active'           => 'boolean',
    ];
}

   
    public function entity(): BelongsTo 
    {
        return $this->belongsTo(Entity::class);
    }

    
    public function fonction(): BelongsTo
    {
        return $this->belongsTo(Fonction::class);
    }

    
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

    
    public function getNomCompletAttribute(): string
    {
        return $this->prenom . ' ' . $this->nom;
    }

    
    public function scopeSearch($query, string $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('nom',       'ILIKE', "%{$term}%")
              ->orWhere('prenom',  'ILIKE', "%{$term}%")
              ->orWhere('email',   'ILIKE', "%{$term}%")
              ->orWhere('matricule',  'ILIKE', "%{$term}%");
        });
    }

    
    public function scopeActive($query) 
    {
        return $query->where('is_active', true);
    }

    public function scopeByFonction($query, int $fonctionId)
    {
        return $query->where('fonction_id', $fonctionId);
    }
}