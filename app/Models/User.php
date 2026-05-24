<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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
            'password' => 'hashed',
        ];
    }

    // ─── Relationships ───────────────────────────────────────────

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    public function studentProfile(): HasOne
    {
        return $this->hasOne(StudentProfile::class);
    }

    public function tutorProfile(): HasOne
    {
        return $this->hasOne(Tutor::class);
    }

    // ─── Helpers ─────────────────────────────────────────────────

    /**
     * Returns user avatar URL or empty string.
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->role === 'tutor' && $this->tutorProfile?->image) {
            return str_starts_with($this->tutorProfile->image, 'http')
                ? $this->tutorProfile->image
                : '/storage/' . $this->tutorProfile->image;
        }
        return $this->studentProfile?->avatar_url ?? '';
    }

    /**
     * Returns user initials (up to 2 chars).
     */
    public function getInitialsAttribute(): string
    {
        $parts = explode(' ', trim($this->name));
        if (count($parts) >= 2) {
            return strtoupper($parts[0][0] . $parts[1][0]);
        }
        return strtoupper(substr($this->name, 0, 2));
    }
}
