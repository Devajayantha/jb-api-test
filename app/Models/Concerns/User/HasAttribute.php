<?php

namespace App\Models\Concerns\User;

use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @property string $password
 *
 * @see \App\Models\User
 * @see \Illuminate\Database\Eloquent\Concerns\HasAttributes
 */
trait HasAttribute
{
    /**
     * Interact with the user's password.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value,
            set: fn($value) => bcrypt($value)
        );
    }
}
