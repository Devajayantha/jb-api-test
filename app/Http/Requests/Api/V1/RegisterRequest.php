<?php

namespace App\Http\Requests\Api\V1;

use App\Infrastructure\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * {@inheritDoc}
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    /**
     * Get the user data from the request.
     *
     * @return array<string, string>
     */
    public function getUserData(): array
    {
        return array_merge($this->only(['name', 'email', 'password']), [
            'email_verified_at' => now(),
        ]);
    }
}
