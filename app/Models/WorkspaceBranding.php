<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkspaceBranding extends Model
{
    protected $table = 'workspace_branding';

    protected $fillable = [
        'workspace_id',
        'display_name',
        'company_name',
        'logo_link_url',
        'logo_light_path',
        'favicon_path',
        'logo_square_path',
        'logo_landscape_path',
        'default_logo_layout',
    ];

    protected $casts = [
        'default_logo_layout' => 'string',
    ];

    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }
}
