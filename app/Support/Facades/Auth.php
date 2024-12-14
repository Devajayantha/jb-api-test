<?php

namespace App\Support\Facades;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class Auth extends FacadesAuth
{
  /**
   * Get the currently authenticated user.
   *
   * @return \App\Models\User
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   */
  public static function user(): User
  {
    return tap(parent::user(), function ($user) {
      abort_unless($user instanceof User, Response::HTTP_FORBIDDEN, sprintf(
        'The auth user is not an instance from %s class',
        User::class
      ));
    });
  }
}
