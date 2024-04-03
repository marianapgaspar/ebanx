<?php
namespace App\Users\Routes;

use App\Users\Web\Authentication;
use App\Users\Web\Users;
use App\Users\Web\UsersGroups;
use App\Users\Web\UsersLog;
use System\Server\Interfaces\IRoutes;
use System\Server\Routes;
use App\Users\Rules\Scopes;
use App\Users\Web\Sector;

class Web implements IRoutes{
    public function load(Routes $routes){
        $routes->post('login',Authentication::class,'login');
        $routes->post('login/reminder',Authentication::class,'reminder');
        $routes->post('login/redefinir',Authentication::class,'redefinir');
        $routes->get('login',Authentication::class,'index');
        $routes->get('sign-out', Authentication::class, 'signOut');
        $routes->get('forgot', Authentication::class, 'forgot');
        $routes->get('forgot/{hash}', Authentication::class, 'forgotPage');
        $routes->post('forgot', Authentication::class, 'forgotPost');
        $routes->post('forgot-new/{hash}', Authentication::class, 'forgotNewPassword');      

        $routes->get('list',Users::class,'table', Scopes::USERS);
        
        $routes->get('form',Users::class,'formAdd', Scopes::USERS);
        $routes->get('form/{id}',Users::class,'formUpdate', Scopes::HOME);
        $routes->get('export',Users::class,'exportList',Scopes::USERS);
        $routes->post('add',Users::class,'add',Scopes::USERS); 
        $routes->post('update/{id}',Users::class,'update', Scopes::HOME);
        $routes->get('delete/{id}',Users::class,'delete', Scopes::USERS);
        $routes->post('copy',Users::class,'copy',Scopes::USERS); 


        $routes->get('users-groups/list',UsersGroups::class,'table', Scopes::USERS_GROUPS);
        $routes->get('users-groups/form',UsersGroups::class,'formAdd', Scopes::USERS_GROUPS);
        $routes->get('users-groups/form/{id}',UsersGroups::class,'formUpdate', Scopes::USERS_GROUPS);
        $routes->post('users-groups/add',UsersGroups::class,'add', Scopes::USERS_GROUPS);
        $routes->post('users-groups/update/{id}',UsersGroups::class,'update', Scopes::USERS_GROUPS);
        $routes->get('users-groups/delete/{id}',UsersGroups::class,'delete', Scopes::USERS_GROUPS);
        $routes->get('users-groups/get',UsersGroups::class,'get');
        
        $routes->get('sector/list',Sector::class,'table', Scopes::SETOR);
        $routes->get('sector/form',Sector::class,'addForm', Scopes::SETOR);
        $routes->get('sector/form/{id}',Sector::class,'updateForm', Scopes::SETOR);
        $routes->post('sector/add',Sector::class,'add', Scopes::SETOR);
        $routes->post('sector/update/{id}',Sector::class,'update', Scopes::SETOR);
        $routes->get('sector/delete/{id}',Sector::class,'delete', Scopes::SETOR);

        $routes->get('get', Users::class, 'get');

        $routes->get('getByName/{name}', Users::class, 'getByName');
        $routes->get('getById/{id}', Users::class, 'getById');
    }
}