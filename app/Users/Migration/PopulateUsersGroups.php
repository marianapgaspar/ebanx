<?php
namespace App\Users\Migration;

use App\Users\Models\UsersGroups;
use System\Migration\Interfaces\IMigration;

class PopulateUsersGroups implements IMigration{
    public function up():string{
        
        if (!UsersGroups::instance()->getByName('Desenvolvedores')->id){
            $usersGroups = UsersGroups::instance();
            $usersGroups->id = 1;
            $usersGroups->name = 'Desenvolvedores';
            $usersGroups->scope = '*';
            $usersGroups->save();
        }
        return "grupo criado";
    }
    public function down():string{
        return "teste migracao";
    }
    public function getDatetime():string{
        return "2021-01-19 15:08:00";
    }
}