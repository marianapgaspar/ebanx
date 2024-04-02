<?php
namespace App\Users\Rules\Authentication;

use App\Users\Models\Users;
use App\Users\Rules\UserSession;
use System\Server\Entities\Auth;
use System\Server\Interfaces\IAuthentication;

class Authentication implements IAuthentication{

    const USER_SESSION_KEY = 'user';
    public function getAuth(Auth $auth){
        $user = UserSession::instance()->getUserInSession();
        if(!$user->id){
            return;
        }
        $auth->setId($user->id);
        $auth->setName($user->name);
        $auth->setAvatar((string)$user->avatar);
        $auth->setScopes(explode(' ',$user->getGroup()->scope));
    }
}