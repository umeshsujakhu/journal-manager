<?php

namespace App\Domain\Auth\Services;

use App\Domain\Users\Entities\User;
use App\Domain\Users\Repositories\UserRepository;
use Illuminate\Auth\AuthenticationException;

/**
 * Class AuthService
 * @package App\Domain\Auth\Services
 */
class AuthService
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * AuthService constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $credentials
     *
     * @return User
     * @throws AuthenticationException
     */
    public function authenticate(array $credentials)
    {
        if (!auth()->attempt($credentials)) {
            throw new AuthenticationException('Authentication Failed.');
        }

        /** @var User $user */
        $user = auth()->user();
        $user->makeHidden([
            'created_at',
            'updated_at',
            'deleted_at',
            'created_by',
            'updated_by',
            'deleted_by',
            'email_verified_at',
        ]);
        $user->token = $user->createToken('journal')->accessToken;
        return $user;
    }

}
