<?php

namespace Triskelion\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'mobile', 'email', 'password', 'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function generateCode (int $length = 32)
    {
        return str_random($length);
    }

    public function register (array $userData)
    {
        $userData['code'] = $this->generateCode();
        $user = self::create($userData);

        return $user;
    }

    public function getUserById (int $id)
    {
        $user = self::findOrFail($id);

        return $user;
    }

    public function getUserByCode (string $code)
    {
        $user = self::where('code', $code)->take(1)->firstOrFail();

        return $user;
    }

    public function getUserByMobile (string $mobile)
    {
        if (empty($mobile)) {
            // Throw a instants of ModelNotFoundException
            throw new ModelNotFoundException('Mobile must not be a empty string.');
        }

        $user = self::where('mobile', $mobile)->take(1)->firstOrFail();

        return $user;
    }

    public function getUserByEmail (string $email)
    {
        if (empty($email)) {
            // Throw a instants of ModelNotFoundException
            throw new ModelNotFoundException('Email must not be a empty string.');
        }

        $user = self::where('email', $email)->take(1)->firstOrFail();

        return $user;
    }
}
