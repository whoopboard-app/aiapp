<?php

namespace App\Modules\Workspace\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkspacePreference extends Model
{
    protected $fillable = [
        'workspace_id',
        'goal_key',
    ];

    /**
     * Get the workspace
     */
    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }

    /**
     * Save selected goals for a workspace
     */
    public static function saveGoalsForWorkspace(int $workspaceId, array $goalKeys): void
    {
        // Delete existing preferences
        static::where('workspace_id', $workspaceId)->delete();

        // Insert new preferences
        foreach ($goalKeys as $goalKey) {
            static::create([
                'workspace_id' => $workspaceId,
                'goal_key' => $goalKey,
            ]);
        }
    }

    /**
     * Get selected goal keys for a workspace
     */
    public static function getGoalsForWorkspace(int $workspaceId): array
    {
        return static::where('workspace_id', $workspaceId)
            ->pluck('goal_key')
            ->toArray();
    }
}
