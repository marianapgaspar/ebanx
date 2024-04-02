<?php
namespace App\Users\Migration;
use System\Migration\Interfaces\IMigration;
use System\DataBase\TableFactory;

class CreateSectorSubordinatesTable implements IMigration{
    public function up():string{
        $table = TableFactory::mysqli('sector_subordinates');
        $table->addInt('responsible_sector_id');
        $table->addInt('subordinate_id');

        $table->primaryKey('responsible_sector_id,subordinate_id');
        $table->create();
        return "sector_subordinates table created";
    }
    public function down():string{
        return "teste migracao";
    }

    public function getDatetime():string{
        return "2021-09-03 11:52:16";
    }
}
