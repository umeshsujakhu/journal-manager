<?php

namespace App\Domain\Auth\Controllers;

use App\Constants\StatusCodes;
use App\Core\Controllers\BaseController;
use App\Domain\Auth\Services\AuthService;
use App\Domain\Users\Repositories\UserRepository;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class AuthController extends BaseController
{

    protected $userRepository;

    protected $authService;

    public function __construct(AuthService $authService, UserRepository $userRepository)
    {
        $this->authService = $authService;
        $this->userRepository = $userRepository;
    }

    public function login(Request $request)
    {
        try {
            $user = $this->authService->authenticate($request->only(['email', 'password']));
            return $this->responseSuccess($user->toArray(), 'User logged in successfully.');
        } catch (AuthenticationException $exception) {
            return $this->responseError(StatusCodes::HTTP_UNAUTHORIZED, $exception->getMessage());
        }
    }
}
