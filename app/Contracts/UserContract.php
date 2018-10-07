<?php

namespace Triskelion\Contracts;

interface UserContract extends BaseInterface
{
    public function getSession ();
    public function getUserInfo(string $code);
    public function createUser(array $userData);
}
