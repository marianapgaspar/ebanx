<?php
namespace System\Server\Interfaces;

use System\Server\Entities\Auth;

interface IAuthentication{

    public function getAuth(Auth $auth);
}