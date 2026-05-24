<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    protected $fillable = [
        'user_id', 'tutor_id', 'title', 'subject',
        'scheduled_at', 'duration_minutes', 'status',
        'cancellation_reason',
        'cancelled_by',
        'meeting_link', 'notes', 'rating', 'feedback',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    // Status constants
    const STATUS_UPCOMING   = 'upcoming';
    const STATUS_COMPLETED  = 'completed';
    const STATUS_CANCELLED  = 'cancelled';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tutor(): BelongsTo
    {
        return $this->belongsTo(Tutor::class);
    }

    public function isUpcoming(): bool
    {
        return $this->status === self::STATUS_UPCOMING;
    }

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function isCancelled(): bool
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    /**
     * Human-readable duration, e.g. "1h 30m"
     */
    public function getDurationLabelAttribute(): string
    {
        $h = intdiv($this->duration_minutes, 60);
        $m = $this->duration_minutes % 60;
        if ($h && $m) return "{$h}h {$m}m";
        if ($h) return "{$h}h";
        return "{$m}m";
    }

    public function reports()
    {
        return $this->hasMany(LessonReport::class);
    }
}
