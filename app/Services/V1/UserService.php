<?php

namespace App\Services\V1;

use App\Models\User;
use App\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserService
{
    /**
     * Register a new user.
     *
     * @param array<string, mixed> $data
     * @return \App\Models\User
     */
    public function register(array $data): User
    {
        return DB::transaction(function () use ($data) {
            /** @var \App\Models\User $user */
            $user = User::query()->create($data);

            $user->access_token = $user->createToken($user->id)->plainTextToken;

            return $user;
        });
    }

    /**
     * Logout from the active user.
     *
     * @return void
     */
    public function logout()
    {
        $user = Auth::user();

        $user->currentAccessToken()->delete();
    }
}
