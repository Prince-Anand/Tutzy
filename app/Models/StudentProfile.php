<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentProfile extends Model
{
    protected $fillable = [
        'user_id', 'avatar', 'bio', 'learning_goals',
        'timezone', 'preferred_subjects', 'weekly_goal_hours',
        'notify_email', 'notify_sms', 'notify_lesson_reminders',
        'notify_new_messages', 'notify_promotions',
    ];

    protected $casts = [
        'notify_email'            => 'boolean',
        'notify_sms'              => 'boolean',
        'notify_lesson_reminders' => 'boolean',
        'notify_new_messages'     => 'boolean',
        'notify_promotions'       => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns a URL for the avatar (storage or placeholder).
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return asset('storage/avatars/' . $this->avatar);
        }
        return '';
    }
}
