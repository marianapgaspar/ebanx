<?php

namespace App\Users\Menus;

use App\Layout\Interfaces\IMenu;
use App\Layout\Rules\Dashboard\Menu;
use App\Users\Rules\Scopes;

class Dashboard implements IMenu{
    public function load(Menu $menu){
        
        $settings = $menu->addMenu();
        $settings->name = 'configuracoes';
        $settings->icon = 'ionicons ion-android-settings';
        $settings->scope = Scopes::CONFIGURACOES;        
        
        $users = $settings->addChild();
        $users->name = 'users';
        $users->icon = 'fa fa-users';
        $users->url = url()->toRoute('users/list');
        $users->scope = Scopes::USERS;

        $sector = $settings->addChild();
        $sector->name = 'Departamentos';
        $sector->icon = 'fa fa-users';
        $sector->url = url()->toRoute('users/sector/list');
        $sector->scope = Scopes::SETOR;

        $group = $settings->addChild();
        $group->name = 'users-group';
        $group->icon = 'fa fa-users';
        $group->url = url()->toRoute('users/users-groups/list');
        $group->scope = Scopes::USERS_GROUPS;

        $email = $settings->addChild();
        $email->name = 'E-mail  ';
        $email->icon = 'fas fa-wrench';
        $email->url = url()->toRoute('email/list');
        $email->scope = Scopes::CONFIGURACOES_EMAIL;

        $documentos = $settings->addChild();
        $documentos->name = 'Documentos';
        $documentos->icon = 'fas fa-wrench';
        $documentos->url = url()->toRoute('Documentos/list');
        $documentos->scope = Scopes::CONFIGURACOES_EMAIL;
        


        $dev = $settings->addChild();
        $dev->name = 'privaty';
        $dev->icon = 'fas fa-wrench';
        $dev->scope = Scopes::DESENVOLVEDORES;       

        $triggers = $dev->addChild();
        $triggers->name = 'triggers';
        $triggers->icon = 'fas fa-wrench';
        $triggers->url = url()->toRoute('trigger/list');
        $triggers->scope = Scopes::DESENVOLVEDORES;

        $imports = $dev->addChild();
        $imports->name = 'imports';
        $imports->icon = 'fa fa-users';
        $imports->url = url()->toRoute('integration/imports/list');
        $imports->scope = Scopes::DESENVOLVEDORES;

        $docsImport = $dev->addChild();
        $docsImport->name = 'Importar doc';
        $docsImport->icon = 'fa fa-users';
        $docsImport->url = url()->toRoute('integration/settings/docs/form');
        $docsImport->scope = Scopes::DESENVOLVEDORES;

        $migrate = $dev->addChild();
        $migrate->name = 'migrate';
        $migrate->icon = 'fa fa-users';
        $migrate->url = url()->toRoute('migration/');
        $migrate->scope = Scopes::DESENVOLVEDORES;
    }
}