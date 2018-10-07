<?php

namespace Triskelion\Services;

use Auth;
use Triskelion\Contracts\UserContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Triskelion\Models\User;
use Triskelion\Exceptions\TriskelionException;
use Log;

class UserService extends BaseService implements UserContract
{
    protected $user;

    public function __construct (User $user)
    {
        $this->user = $user;
    }

    protected function generatePassword (int $length = 32)
    {
        return str_random($length);
    }

    public function getSession ()
    {
        $userId = Auth::user()->id;
        try {
            $user = $this->user->getUserById($userId);

            $ret = [
                'user' => $user->toArray(),
            ];
        } catch (ModelNotFoundException $e) {
            Log::error("User not found, id: $userId.", [$e]);
            throw new TriskelionException("Get session failed, id: $userId.", USER_NOT_FOUND);
        }

        return $ret;
    }

    public function getUserInfo(string $code)
    {
        try {
            $user = $this->user->getUserByCode($code);
        } catch (ModelNotFoundException $e) {
            Log::error("User not found, code: $code.", [$e]);
            throw new TriskelionException("Get user info failed, code: $code.", USER_NOT_FOUND);
        }

        return $user->toArray();
    }

    public function createUser(array $userData)
    {
        if (!array_key_exists('mobile', $userData)) {
            $userData['mobile'] = '';
        }

        $userData['active'] = 0;
        $userData['password'] = $this->generatePassword();

        $user = $this->user->register($userData);

        return $user->toArray();
    }
}
