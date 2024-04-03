<?php
namespace App\Users\Migration;

use App\Users\Models\Users;
use System\Migration\Interfaces\IMigration;

class PopulateUsers implements IMigration{
    public function up():string{
        $users = Users::instance()->getByEmail('marianapachecogaspar@gmail.com');
        $users->id_group = 1;
        $users->email = 'marianapachecogaspar@gmail.com';
        $users->name = 'mariana';
        $users->password = security()->encrypt('tng@123');
        if ($users->id){
            $users->save();
        } else {
            $users->insert();
        }
 
        return "usuario populado";
    }
    public function down():string{
        return "teste migracao";
    }
    public function getDatetime():string{
        return "2021-01-19 15:09:00";
    }
}