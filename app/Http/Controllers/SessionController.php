<?php

namespace Triskelion\Http\Controllers;

use Illuminate\Http\Request;
use Triskelion\Contracts\UserContract;
use Triskelion\Exceptions\TriskelionException;
use Exception;

class SessionController extends Controller
{
    //
    public function show (UserContract $userService)
    {
        try {
            $session = $userService->getSession();

            $ret = [
                'code' => SYS_STATUS_OK,
                'data' => $session,
            ];
        } catch (TriskelionException $e) {
            Log::error('Get session failed.', [$e]);
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
