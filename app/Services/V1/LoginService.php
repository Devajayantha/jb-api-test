<?php

namespace App\Services\V1;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginService
{
    /**
     * Authenticate login user.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @throws \Illuminate\Validation\ValidationException
     * @return \App\Models\User\User $user
     */
    public function login(Request $request)
    {
        $this->ensureIsNotRateLimited($request);

        /** @var \App\Models\User $user */
        $user = User::query()
            ->where('email', $request->input('email'))
            ->first();

        if (!$user instanceof User) {
            $this->hitRateLimiter($request);

            throw ValidationException::withMessages([
                $this->username() => sprintf('The provided credentials are incorrect.'),
            ])->status(Response::HTTP_UNAUTHORIZED);
        }

        if (!Hash::check($request->input('password'), $user->password)) {
            $this->hitRateLimiter($request);

            throw ValidationException::withMessages([
                'password' => sprintf('The username or password you entered is incorrect'),
            ])->status(Response::HTTP_UNAUTHORIZED);
        }

        $token = $user->createToken($user->id);

        $user->access_token = $token->plainTextToken;

        return $user;
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(Request $request)
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return;
        }

        event(new Lockout($request));

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            $this->username() => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ])->status(Response::HTTP_TOO_MANY_REQUESTS);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey(Request $request)
    {
        return (auth()->check() ? auth()->id() : 'guest') . '|' . $request->ip();
    }

    /**
     * Get phone property.
     *
     * @return string
     */
    public function username(): string
    {
        return 'email';
    }

    /**
     * Determine to retrieve the number of attempts.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function hitRateLimiter(Request $request)
    {
        return RateLimiter::hit($this->throttleKey($request));
    }
}
