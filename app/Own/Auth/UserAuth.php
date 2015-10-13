<?php

namespace App\Own\Auth;

interface UserAuth
{
    public function auth($request);

    public function fbAuth($user);

    public static function check();

    public static function id();

    public static function user();

    public function userFromCookie();

    public function idFromCookie();

    public function checkFromCookie();

    public function token();

    public function logout();
}
