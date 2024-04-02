<?php
namespace App\Trigger\Migration;
use System\Migration\Interfaces\IMigration;
use System\DataBase\TableFactory;

class CreateTriggersTable implements IMigration{
    public function up():string{
        $table = TableFactory::mysqli('triggers');
        $table->addInt("id")->autoincrement();
        $table->addVarchar("trigger_class")->size("50");
        $table->addVarchar("class")->size("50");
        $table->addVarchar("config")->size("4000");
        $table->primaryKey("id");

        
        $table->create();
        return "triggers table created";
    }
    public function down():string{
        return "teste migracao";
    }
    public function getDatetime():string{
        return "2021-07-19 11:46:18";
    }
}
