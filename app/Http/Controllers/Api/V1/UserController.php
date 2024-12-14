<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\RegisterRequest;
use App\Http\Resources\Api\V1\GuestUserResource;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use App\Services\V1\LoginService;
use App\Services\V1\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    /**
     * Create a contructor for the controller.
     *
     * @param \App\Services\V1\UserService $service
     * @param \App\Services\V1\LoginService $loginService
     */
    public function __construct(
      protected UserService $service,
      protected LoginService $loginService
    ){}

    /**
     * This method uses to get the list of users with guest mode.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $request->validate([
            'limit' => ['sometimes', 'nullable', 'integer', 'min:1'],
            'search' => ['sometimes', 'nullable', 'string', 'min:2'],
        ]);

        $users = $this->service->list($request);

        return GuestUserResource::collection($users);
    }

    /**
     * Register a new user.
     *
     * @param \App\Http\Requests\Api\V1\RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->service->register($request->getUserData());

        return JsonResource::make($user);
    }

    /**
     * Login a user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = $this->loginService->login($request);

        return JsonResource::make($user);
    }

    /**
     * Show the user.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        /** Another way to get active user can use auth()->user() helper.*/
        return UserResource::make($user);
    }

    /**
     * Logout the user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->service->logout();

        return JsonResource::make([]);
    }
}
