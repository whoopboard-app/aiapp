<?php

namespace App\Modules\Onboarding\Models;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = [
        'key',
        'name',
        'description',
        'icon',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get all active goals ordered by sort_order
     */
    public static function getActive()
    {
        return static::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

    /**
     * Check if goal exists by key
     */
    public static function existsByKey(string $key): bool
    {
        return static::where('key', $key)->where('is_active', true)->exists();
    }
}
