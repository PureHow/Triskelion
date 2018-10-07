<?php

namespace Triskelion\Http\Controllers;

use Illuminate\Http\Request;
use Triskelion\Contracts\UserContract;
use Triskelion\Exceptions\TriskelionException;
use Exception;

class UserController extends Controller
{
    //
    protected $request;

    public function __construct (Request $request)
    {
        $this->request = $request;
    }

    public function show (UserContract $userService, string $code)
    {
        try {
            $userInfo = $userService->getUserInfo($code);
            $ret = [
                'code' => SYS_STATUS_OK,
                'data' => [
                    'user' => $userInfo,
                ],
            ];
        } catch (TriskelionException $e) {
            Log::error('Get user info failed.', [$e]);
            $ret = [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        } catch (Exception $e) {
            Log::error('Get session failed.', [$e]);
            $ret = [
                'code' => SYS_STATUS_ERROR_UNKNOW,
                'message' => 'Unknow Exception.',
            ];
        }

        return $ret;
    }
}
