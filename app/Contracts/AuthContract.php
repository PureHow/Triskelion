<?php

namespace Triskelion\Contracts;

interface AuthContract extends BaseInterface
{
    public function loginByEmail (string $email, string $password);
    public function loginByMobile (string $mobile, string $password);
}
