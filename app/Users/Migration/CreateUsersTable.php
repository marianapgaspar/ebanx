<?php
namespace App\Users\Migration;
use System\Migration\Interfaces\IMigration;
use System\DataBase\TableFactory;

class CreateUsersTable implements IMigration{
    public function up():string{
        $table = TableFactory::mysqli('users');
        $table->addInt("id")->autoincrement();
        $table->addInt("id_group");
        $table->addVarchar("name")->size("12");
        $table->addVarchar("email")->size("40");
        $table->addVarchar("password")->size("128");
        $table->primaryKey("id");
        $table->foreignKey('id_group','users_groups','id');
        $table->uniqueKey('email');
         
        $table->create();
        return "users table created";
    }
    public function down():string{
        return "teste migracao";
    }
    public function getDatetime():string{
        return "2024-04-02 07:00:00";
    }
}
