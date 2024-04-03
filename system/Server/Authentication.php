<?php
namespace System\Server;

use App\Error\Web\Errors;
use App\Users\Models\Users;
use App\Users\Rules\Scopes;
use App\Users\Web\Authentication as WebAuthentication;
use System\Server\Entities\Auth;
use System\Server\Entities\Route;
use System\Server\Interfaces\IAuthentication;

class Authentication{
    

    private string $authenticationNameSpace = "";
    public bool $underConstruction = false;
    private Auth $auth;

    private static $sessionAuth =null;

    public function __construct(string $authenticationNameSpace)
    {
        if(!class_exists($authenticationNameSpace)){

        }
        $this->authenticationNameSpace = $authenticationNameSpace;
        $this->auth = new Auth();
        self::$sessionAuth = $this->auth;
        $this->prepare();
    }

    private function prepare(){
        $namespace = $this->authenticationNameSpace;
        $instance = new $namespace();
        if(!($instance instanceof IAuthentication)){

        }
        $instance->getAuth($this->auth);
    }

    public function getAuth():Auth{
        return $this->auth;
    }
    
    public function authenticate(Route $route):bool{ 
        if(!$route->getScope()){
            return true;
        }
        $user = Users::instance()->getById($this->auth->getId());
        // if (!$this->getAuth()->getId() || $user->session_id != session()->get("session_id")){
        //     response()->redirect(url()->toRoute('users/login'));
        // } 
        if (!in_array('docsimport', $this->auth->getScopes()) && $this->underConstruction){
            return false;
        }
        if($this->auth->getScopes()[0]=='*'){
            
            return true;
        }
        if( in_array($route->getScope(),$this->auth->getScopes())){
            return true;
        }else{
            $route->setController(Errors::class);
            $route->setMethod('permissionDenied');
            $route->setArgs([]);
            return true;
        }
              
    }
    static function getSessionAuth():Auth|null{
        return self::$sessionAuth;
    }

    
}