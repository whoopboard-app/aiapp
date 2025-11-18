<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Modules\Workspace\Models\Workspace;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'workspace_id',
        'name',
        'first_name',
        'last_name',
        'email',
        'profile_image',
        'password',
        'role',
        'timezone',
        'is_active',
        'can_login',
        'onboarded_at',
        'last_active_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'onboarded_at' => 'datetime',
            'last_active_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'can_login' => 'boolean',
        ];
    }

    /**
     * Get the workspace that owns the user
     */
    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }

    /**
     * Check if user has completed onboarding
     */
    public function hasCompletedOnboarding(): bool
    {
        return $this->onboarded_at !== null;
    }
}
