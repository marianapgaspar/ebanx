<?php
namespace App\Users\Migration;
use System\Migration\Interfaces\IMigration;
use System\DataBase\TableFactory;

class CreateSectorTable implements IMigration{
    public function up():string{
        $table = TableFactory::mysqli('sector');
        $table->addInt('id')->autoincrement();
        $table->addVarchar('name')->size(50);
        $table->primaryKey('id');
        $table->create();
        return "sector table created";
    }
    public function down():string{
        return "teste migracao";
    }

    public function getDatetime():string{
        return "2021-09-03 11:51:09";
    }
}
