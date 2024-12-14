<?php

namespace App\Services\V1;

use App\Jobs\RegisteredEmail;
use App\Models\User;
use App\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserService
{
    /**
     * Get the list of users.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function list(Request $request): \Illuminate\Pagination\LengthAwarePaginator
    {
        $users = User::query()
            ->filter($request)
            ->latest()
            ->paginate($request->input('limit', 10));

        return $users;
    }

    /**
     * Register a new user.
     *
     * @param array<string, mixed> $data
     * @return \App\Models\User
     */
    public function register(array $data): User
    {
        DB::beginTransaction();
        try {
            $user = User::query()->create($data);

            $user->access_token = $user->createToken($user->id)->plainTextToken;

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }

        RegisteredEmail::dispatch($user);

        return $user;
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
