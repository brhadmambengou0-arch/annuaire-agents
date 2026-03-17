<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fonction extends Model
{
    protected $table = 'fonctions';

    protected $fillable = [
        'code',
        'libelle',
        'niveau',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'niveau'    => 'integer',
    ];

   
    public function agents(): HasMany
    {
        return $this->hasMany(Agent::class, 'fonction_id');
    }

    
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                     ->orderBy('niveau');
    }

    
    public function hasActiveAgents(): bool
    {
        return $this->agents()
                    ->where('is_active', true)
                    ->exists();
    }
}