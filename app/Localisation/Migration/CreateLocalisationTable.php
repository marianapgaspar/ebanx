<?php
namespace App\Localisation\Migration;
use System\Migration\Interfaces\IMigration;
use System\DataBase\TableFactory;

class CreateLocalisationTable implements IMigration{
    public function up():string{
        $table = TableFactory::mysqli('localisation');
        $table->addInt("id")->autoincrement();
        $table->addVarchar("code")->size("32");
        $table->addTinyint("active")->size("1");
        $table->addVarchar("image")->size("64");
        $table->primaryKey("id");
        $table->uniqueKey('code');
        
        $table->create();
        return "localisation table created";
    }
    public function down():string{
        return "teste migracao";
    }
    public function getDatetime():string{
        return "2021-01-25 08:43:00";
    }
}
