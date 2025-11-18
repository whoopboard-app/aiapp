<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Modules\Workspace\Models\Workspace;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Changelog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'workspace_id',
        'changelog_category_id',
        'title',
        'slug',
        'cover_image',
        'short_description',
        'description',
        'author_name',
        'published_at',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    /**
     * Get the workspace that owns the changelog
     */
    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }

    /**
     * Get the category that owns the changelog
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ChangelogCategory::class, 'changelog_category_id');
    }

    /**
     * Get the tags for the changelog
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'changelog_tag');
    }

    /**
     * Generate a unique slug from title
     */
    public static function generateSlug(string $title, ?int $id = null): string
    {
        $slug = Str::slug($title);
        $count = 1;
        $originalSlug = $slug;

        while (true) {
            $query = static::where('slug', $slug);
            if ($id) {
                $query->where('id', '!=', $id);
            }

            if (!$query->exists()) {
                break;
            }

            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }

    /**
     * Update status based on published date
     */
    public function updateStatusBasedOnDate(): void
    {
        if ($this->status === 'draft') {
            return;
        }

        $now = Carbon::now();
        $publishedAt = Carbon::parse($this->published_at);

        if ($publishedAt->isFuture()) {
            $this->status = 'scheduled';
        } elseif ($this->status === 'scheduled') {
            $this->status = 'published';
        }
    }

    /**
     * Check if changelog is published
     */
    public function isPublished(): bool
    {
        return $this->status === 'published' && Carbon::parse($this->published_at)->isPast();
    }

    /**
     * Check if changelog is scheduled
     */
    public function isScheduled(): bool
    {
        return $this->status === 'scheduled' ||
               ($this->status === 'published' && Carbon::parse($this->published_at)->isFuture());
    }
}
