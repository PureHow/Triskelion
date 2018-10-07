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
}
