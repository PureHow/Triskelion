<?php

namespace Triskelion\Http\Controllers\Auth;

use Triskelion\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Triskelion\Exceptions\TriskelionException;
use Triskelion\Contracts\AuthContract;
use Exception;
use Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    protected $request;

    public function __construct (Request $request)
    {
        $this->request = $request;
    }

    protected function getUsernameField (string $username)
    {
        $email = filter_var($username, FILTER_VALIDATE_EMAIL);
        if (!empty($email)) {
            return 'email';
        } elseif (is_numeric($username) && strlen($username)) {
            return 'mobile';
        }

        throw new TriskelionException("Bad login username: $username", USER_BAD_USERNAME);
    }

    public function postLogin (AuthContract $auth)
    {
        $credentials = $this->request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        try {
            $usernameField = $this->getUsernameField(array_get($credentials, 'username'));
            switch ($usernameField) {
                case 'email':
                    // login by email
                    $userInfo = $auth->loginByEmail($credentials['username'], $credentials['password']);
                    Log::info("User {$userInfo['code']} login success, email: {$credentials['username']}.");
                    break;
                case 'mobile':
                    // login by mobile
                    $userInfo = $auth->loginByMobile($credentials['username'], $credentials['password']);
                    Log::info("User {$userInfo['code']} login success, mobile: {$credentials['username']}.");
                    break;
                default:
                    throw new TriskelionException("Bad login username: $username", USER_BAD_USERNAME);
            }

            $ret = [
                'code' => SYS_STATUS_OK,
                'data' => [
                    'user' => $userInfo,
                ],
            ];
        } catch (TriskelionException $e) {
            Log::error('Login failed.', [$e]);
            $ret = [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        } catch (Exception $e) {
            Log::error('Login failed.', [$e]);
            $ret = [
                'code' => SYS_STATUS_ERROR_UNKNOW,
                'message' => 'Unknow Exception.',
            ];
        }


        return $ret;
    }

}
