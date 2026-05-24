<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    protected $fillable = [
        'slug', 'name', 'hero_title', 'hero_highlight',
        'hero_description', 'hero_icon',
    ];

    public function tutors(): HasMany
    {
        return $this->hasMany(Tutor::class);
    }

    public static function findBySlug(string $slug): ?self
    {
        return static::where('slug', $slug)->first();
    }
}
