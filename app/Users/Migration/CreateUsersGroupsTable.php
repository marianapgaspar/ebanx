<?php
namespace App\Users\Migration;
use System\Migration\Interfaces\IMigration;
use System\DataBase\TableFactory;

class CreateUsersGroupsTable implements IMigration{
    public function up():string{
        $table = TableFactory::mysqli('users_groups');
        $table->addInt("id")->autoincrement();
$table->addVarchar("name")->size("50");
$table->addVarchar("scope")->size("2500");
$table->primaryKey("id");
$table->uniqueKey('name');
        
        $table->create();
        return "users_groups table created";
    }
    public function down():string{
        return "teste migracao";
    }
    public function getDatetime():string{
        return "2021-01-19 06:00:00";
    }
}
