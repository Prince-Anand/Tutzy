<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tutor extends Model
{
    protected $fillable = [
        'user_id', 'subject_id', 'name', 'slug', 'image', 'bio',
        'country', 'country_flag', 'rating', 'reviews_count',
        'students_count', 'lessons_count', 'hourly_rate',
        'languages', 'tutor_type', 'speciality', 'availability',
        'is_verified', 'is_online', 'badge',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_online'   => 'boolean',
        'rating'      => 'float',
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function availabilities()
    {
        return $this->hasMany(TutorAvailability::class);
    }

    public function getBadgeLabelAttribute(): ?string
    {
        return match ($this->badge) {
            'top_rated'   => 'Top Rated',
            'super_tutor' => 'Super Tutor',
            'rising'      => 'Rising Tutor',
            default       => null,
        };
    }

    public function getStarsAttribute(): string
    {
        $full  = floor($this->rating);
        $half  = ($this->rating - $full) >= 0.5 ? 1 : 0;
        return str_repeat('★', $full) . ($half ? '½' : '');
    }
}
