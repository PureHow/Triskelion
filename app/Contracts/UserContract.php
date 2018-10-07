<?php

namespace Triskelion\Contracts;

interface UserContract extends BaseInterface
{
    public function getSession ();
    public function getUserInfo(string $code);
}
