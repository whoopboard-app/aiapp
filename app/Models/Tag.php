<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Modules\Workspace\Models\Workspace;
use Illuminate\Support\Str;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'workspace_id',
        'name',
        'slug',
    ];

    /**
     * Get the workspace that owns the tag
     */
    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }

    /**
     * Get the changelogs for the tag
     */
    public function changelogs(): BelongsToMany
    {
        return $this->belongsToMany(Changelog::class, 'changelog_tag');
    }

    /**
     * Find or create a tag by name
     */
    public static function findOrCreateByName(int $workspaceId, string $name): self
    {
        $slug = Str::slug($name);

        return static::firstOrCreate(
            [
                'workspace_id' => $workspaceId,
                'slug' => $slug,
            ],
            [
                'name' => $name,
            ]
        );
    }
}
