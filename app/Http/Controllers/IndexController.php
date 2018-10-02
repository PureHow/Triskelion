<?php

namespace Triskelion\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class IndexController extends Controller
{
    //
    const MESSAGE_INDEX = 'Here is Triskelion!';

    public function show()
    {
        $ret = [
            'code' => SYS_STATUS_OK,
            'message' => self::MESSAGE_INDEX,
        ];

        Log::info('Triskelion index requested!', $ret);

        return $ret;
    }
}
