<?php

namespace Triskelion\Services;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Triskelion\Contracts\AuthContract;
use Triskelion\Exceptions\TriskelionException;
use Triskelion\Models\User;
use Exception;
use Auth;
use Log;

class AuthService extends BaseService implements AuthContract
{
    protected $user;

    public function __construct (User $user)
    {
        $this->user = $user;
    }

    public function loginByEmail (string $email, string $password)
    {
        try {
            $user = $this->user->getUserByEmail($email);
            if ($user->active != 1) {
                throw new TriskelionException("Login failed, email: $email.", USER_LOCKED);
            }
            $creditials = [
                'email' => $email,
                'password' => $password,
            ];
            if (!Auth::attempt($creditials)) {
                Log::error("User password wrong, email: $email.", [$e]);
                throw new TriskelionException("Login failed, email: $email.", USER_WRONG_PASSWORD);
            }
        } catch (ModelNotFoundException $e) {
            Log::error("User not found, email: $email.", [$e]);
            throw new TriskelionException("Login failed, email: $email.", USER_NOT_FOUND);
        }

        return $user->toArray();
    }

    public function loginByMobile (string $mobile, string $password)
    {
        try {
            $user = $this->user->getUserByMobile($mobile);
            if ($user->active != 1) {
                throw new TriskelionException("Login failed, mobile: $mobile.", USER_LOCKED);
            }
            $creditials = [
                'mobile' => $mobile,
                'password' => $password,
            ];
            if (!Auth::attempt($creditials)) {
                Log::error("User password wrong, mobile: $mobile.", [$e]);
                throw new TriskelionException("Login failed, mobile: $mobile.", USER_WRONG_PASSWORD);
            }
        } catch (ModelNotFoundException $e) {
            Log::error("User not found, mobile: $mobile.", [$e]);
            throw new TriskelionException("Login failed, mobile: $mobile.", USER_NOT_FOUND);
        }

        return $user->toArray();
    }

    public function logout()
    {
        Auth::logout();
    }
}
