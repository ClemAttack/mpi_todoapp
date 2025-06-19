<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'completed',
        'due_date',
        'user_id'
    ];

    protected $casts = [
        'completed' => 'boolean',
        'due_date' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getIsOverdueAttribute(): bool
    {
        return $this->due_date && $this->due_date->isPast() && !$this->completed;
    }
}
