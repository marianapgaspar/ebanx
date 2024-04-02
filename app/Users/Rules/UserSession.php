<?php
namespace App\Users\Rules;

use App\Users\Models\Users;
use App\Users\Rules\Authentication\Authentication;

class UserSession{

    private Users $usersModel;
    public function __construct()
    {
        $this->usersModel = Users::instance();
    }
    public function authenticate($user,$password):bool{
        $userModel = $this->usersModel->getByName($user);
        if($this->verificaAutenticacao($user,$password)){
            session()->set(Authentication::USER_SESSION_KEY,$userModel->id);
            session_regenerate_id();
            session()->set("session_id",session_id());
            $this->usersModel->session_id = session()->get("session_id");
            $this->usersModel->save();
            return true;
        }
        return false;
    }
    public function verificaAutenticacao($user,$password){
        $userModel = $this->usersModel->getByName($user);

        if(!$userModel->id){
            $userModel = $this->usersModel->getByEmail($user);
        }
        if(!$userModel->id){
            return false;
        }
        
        if($userModel->validatePassword($password)){
            return true;
        }
        return false;
    }
    public function verificaAtivo($user,$password){
        $userModel = $this->usersModel->getByName($user);
        if (!$userModel->ativo){
            return false;
        }
        return true;
    }
    public function verificaValidade(string $user):bool{
        $userModel = $this->usersModel->getByName($user);
        if ($userModel->dt_expira_senha < date('Y-m-d')){
            return false;
        } 
        return true;
    }
    public function getUserInSession():Users{
        if(session()->get(Authentication::USER_SESSION_KEY)){
            return $this->usersModel->getById(session()->get(Authentication::USER_SESSION_KEY));
        }
        return $this->usersModel;
    }

    public static function instance():UserSession{
        return new UserSession();
    }
}