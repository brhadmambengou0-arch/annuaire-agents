<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;                   // ← AJOUT
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable;

    // ← AJOUT : génération automatique du UUID à la création
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (self $model): void {
            if (empty($model->uuid)) {
                $model->uuid = Str::uuid()->toString();
            }
        });
    }

    protected $primaryKey = 'uuid';
    protected $keyType    = 'string';
    public    $incrementing = false;

    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
        'role',
        'agent_id',  // ← AJOUT : liaison avec l'agent
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // ← AJOUT : relation avec l'agent
    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id', 'id');
    }

    // ← AJOUT : scope pour les utilisateurs actifs
    public function scopeActive($query)
    {
        return $query->whereHas('agent', function($q) {
            $q->where('is_active', true);
        });
    }
}