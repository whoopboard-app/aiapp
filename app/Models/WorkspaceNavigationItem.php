<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkspaceNavigationItem extends Model
{
    protected $fillable = [
        'workspace_id',
        'key',
        'label',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }

    public static function getDefaultItems(): array
    {
        return [
            ['key' => 'changelog', 'label' => 'Changelog', 'sort_order' => 1],
            ['key' => 'feedback', 'label' => 'Feedback', 'sort_order' => 2],
            ['key' => 'roadmap', 'label' => 'Roadmap', 'sort_order' => 3],
            ['key' => 'testimonials', 'label' => 'Testimonials', 'sort_order' => 4],
            ['key' => 'knowledge_board', 'label' => 'Knowledge Board', 'sort_order' => 5],
            ['key' => 'research_repo', 'label' => 'Research Repo', 'sort_order' => 6],
        ];
    }
}
