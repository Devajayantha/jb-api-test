<?php

namespace App\Models\Concerns\Post;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasRelation
{
    /**
     * Get the user that owns the HasRelation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
