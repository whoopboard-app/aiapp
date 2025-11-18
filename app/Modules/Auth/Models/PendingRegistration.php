<?php

namespace App\Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PendingRegistration extends Model
{
    protected $fillable = [
        'email',
        'token',
        'verified_at',
        'expires_at',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    /**
     * Create a new pending registration
     */
    public static function createForEmail(string $email): self
    {
        // Delete any existing pending registrations for this email
        static::where('email', $email)->delete();

        return static::create([
            'email' => $email,
            'token' => Str::random(64),
            'expires_at' => Carbon::now()->addHours(24),
        ]);
    }

    /**
     * Check if the token is valid
     */
    public function isValid(): bool
    {
        return $this->verified_at === null && $this->expires_at->isFuture();
    }

    /**
     * Check if the token is expired
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    /**
     * Mark the email as verified
     */
    public function markAsVerified(): void
    {
        $this->update(['verified_at' => now()]);
    }

    /**
     * Find a pending registration by token
     */
    public static function findByToken(string $token): ?self
    {
        return static::where('token', $token)->first();
    }
}
