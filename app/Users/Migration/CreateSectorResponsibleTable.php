<?php
namespace App\Users\Migration;
use System\Migration\Interfaces\IMigration;
use System\DataBase\TableFactory;

class CreateSectorResponsibleTable implements IMigration{
    public function up():string{
        $table = TableFactory::mysqli('sector_responsible');
        $table->addInt('id')->autoincrement();
        $table->addVarchar("name")->size("50");
        $table->addInt('responsible_id');

        $table->primaryKey('id');
        $table->create();
        return "sector_responsible table created";
    }
    public function down():string{
        return "teste migracao";
    }
    public function getDatetime():string{
        return "2021-09-03 11:51:56";
    }
}
