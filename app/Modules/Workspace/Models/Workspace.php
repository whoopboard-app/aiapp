<?php

namespace App\Modules\Workspace\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class Workspace extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'website_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get all users in this workspace
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the workspace owner (first user created)
     */
    public function owner()
    {
        return $this->users()->oldest()->first();
    }

    /**
     * Generate a unique slug from workspace name
     */
    public static function generateSlug(string $name): string
    {
        $slug = \Illuminate\Support\Str::slug($name);
        $count = 1;
        
        while (static::where('slug', $slug)->exists()) {
            $slug = \Illuminate\Support\Str::slug($name) . '-' . $count;
            $count++;
        }
        
        return $slug;
    }
}
