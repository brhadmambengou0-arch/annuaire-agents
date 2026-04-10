<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Entity extends Model
{
    protected $table = 'entities';

    // UUID
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (self $model): void {
            if (empty($model->id)) {
                $model->id = Str::uuid()->toString();
            }
        });
    }

    protected $fillable = [
        'id',
        'nom',
        'code',
        'type',
        'parent_id',
        'description',
        'ordre',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'ordre'     => 'integer',
        ];
    }

    // ✅ CORRECTION ICI
    public function agents(): HasMany
    {
        return $this->hasMany(Agent::class, 'entity_id', 'id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Entity::class, 'parent_id', 'id')
                    ->where('is_active', true)
                    ->orderBy('ordre');
    }

    public function childrenRecursive(): HasMany
    {
        return $this->children()->with('childrenRecursive');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Entity::class, 'parent_id', 'id');
    }

    // SCOPES
    public function scopeRoots($query)
    {
        return $query->whereNull('parent_id')
                     ->where('is_active', true)
                     ->orderBy('ordre');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}