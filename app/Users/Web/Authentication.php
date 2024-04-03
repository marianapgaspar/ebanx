<?php
namespace App\Users\Web;

use App\Users\Models\Users;
use App\Localisation\Rules\Localisation;
use App\Trigger\Models\Triggers as ModelsTriggers;
use App\Trigger\Rules\Triggers;
use App\Users\Rules\UserSession;
use System\Server\Entities\Request;
use App\Users\Rules\Authentication\Authentication as AuthenticationRule;
use App\Users\Rules\Scopes;
use Exception;

class Authentication{
    public function index(Request $request){
        response()->html(
            layout()->login()
                ->setUrlLogin(url()->toRoute('users/login'))
                ->setLocalisations(Localisation::instance()->getActives())
                // ->setUrlRedirect(url()->toRoute("Home"))
                ->html()
        );
    }
    public function reminder(Request $request){
  
        try{
            $usr = Users::instance()->getByEmail($request->post('user')); 
            if (Users::instance()->getByName($request->post('user'))->id){
                $usr =Users::instance()->getByName($request->post('user'));
            }
            if($usr->id){
                response()->json(['success'=>true, 'message'=>"Lembrete: ".$usr->lembrete_senha],200);
            }else{
                throw new Exception('Usuário não encontrado ou e-mail não inserido');
            }
        }catch(Exception $e){
            response()->json(['success'=>false,'message'=>$e->getMessage()],404);
        }
    }
    public function redefinir(Request $request){
        try{
            $user = Users::instance()->getByName($request->post('user')); 
            $actualPassword = $request->post("atual_password");
            $nova_password = $request->post("nova_password");
            $repetir_password = $request->post("repetir_password");
            if ($user->id && $user->validatePassword($actualPassword)){
                if ($nova_password == $actualPassword){
                    throw new Exception('Favor inserir uma senha diferente da atual');
                }
                if ($nova_password == $repetir_password){
                    $user->setPassword($nova_password);
                    $user->setDtExpira($user->qt_dias_senha);
                    $user->save();
                    response()->json(['success'=>true, 'message'=>"Senha atualizada com sucesso"],200);
                } else {
                    throw new Exception('Favor repetir a senha corretamente');
                }
            } else {
                throw new Exception('Nome do usuário ou senha atual incorretos');
            }
        }catch(Exception $e){
            response()->json(['success'=>false,'message'=>$e->getMessage()],404);
        }
    }
    public function login(Request $request){
        $userRules = new UserSession();
        if(!$request->post('user')){
            response()->json(['success'=>false, 'message'=>'Favor inserir o usuário']);
        } elseif(!$request->post('password')){
            response()->json(['success'=>false, 'message'=>'Favor inserir a senha']);
        } elseif (!$userRules->verificaAtivo($request->post('user'),$request->post('password'))){
            response()->json(['success'=>false, 'message'=>'Usuário inativo']);
        } elseif($userRules->verificaAutenticacao($request->post('user'),$request->post('password'))){
            if (!$userRules->verificaValidade($request->post('user'))){
                response()->json(['success'=>false, 'message'=>'Senha expirada']);
            }
            $userRules->authenticate($request->post('user'),$request->post('password'));
            response()->json(['success'=>true]);
        }
        response()->json(['success'=>false, 'message'=>'Dados incorretos']);
    }

    public function signOut(){
        
        session()->set(AuthenticationRule::USER_SESSION_KEY,0);
        response()->html(
            layout()->login()
                ->setUrlLogin(url()->toRoute('users/login'))
                ->setLocalisations(Localisation::instance()->getActives())
                ->setUrlRedirect(url()->toRoute('Home'))
                ->html());
                
    }
    public function forgot(){        
        response()->html(
            layout()->login()
                ->setPageForgot(true)
                ->setUrlLogin(url()->toRoute('users/forgot'))
                ->setLocalisations(Localisation::instance()->getActives())
                ->setUrlRedirect(url()->toRoute('users/login'))
                ->html()
        );            
    }
    public function forgotPage(Request $request,$hash){     
        response()->html(
            layout()->login()
                ->setPageForgot(true)
                ->setFormForgot(true)
                ->setUrlLogin(url()->toRoute('users/forgot-new/'.$hash))
                ->setLocalisations(Localisation::instance()->getActives())
                ->setUrlRedirect(url()->toRoute('users/login'))
                ->html()
        );            
    }
    public function forgotNewPassword(Request $request,$hash){     
        //buscar a senha hash
        
        $usr = Users::instance()->getByHash($hash); 
        $usr->setPassword($request->post('password'));
        $usr->setDtExpira((int) $usr->qt_dias_senha);
        $usr->hash = '';
        try{
            $usr->save();
            response()->json(['success'=>true, 'message'=>"Senha alterada com sucesso"],200);
        }catch(Exception $e){
            response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }
    public function forgotPost(Request $request){ 
        $usr = Users::instance()->getByName($request->post('user')); 
        if(!$usr->id){
            $usr = Users::instance()->getByEmail($request->post('user')); 
        }
        try {
           if(count($usr->toArray())>0 ){
                //criar hash simples
                $usr->hash = md5($usr->email);
                $usr->save();
                $usr->link = url()->toRoute("users/forgot/{$usr->hash}"); 
                Triggers::instance()->dispachTriggers(ModelsTriggers::RECUPERAR_SENHA,$usr);
                //enviar e-mail com o hash da senha $usr->hash
                //http://danica.com.br/fotgot/$2y$10$c22460825a630d5c78ce9u2Mquh.yIpQkMMwX6/JzKf8sK/qwBlvm
                response()->json(['success'=>true],200);
            }else{
                response()->json(['success'=>false,'message'=>"Usuário não encontrado"]);
            }
        }catch (Exception $e){
            response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }    
    }
}