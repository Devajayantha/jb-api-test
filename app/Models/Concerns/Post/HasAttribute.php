<?php

namespace App\Models\Concerns\Post;

use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @property-read string $user_name
 *
 * @see \App\Models\Post
 * @see \Illuminate\Database\Eloquent\Concerns\HasAttributes
 */
trait HasAttribute
{
    /**
     * Get the post's user name.
     */
    protected function userName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->user->name
        );
    }
}
