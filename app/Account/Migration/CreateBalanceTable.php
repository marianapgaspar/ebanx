<?php
namespace App\Account\Migration;
use System\Migration\Interfaces\IMigration;
use System\DataBase\TableFactory;

class CreateBalanceTable implements IMigration{
    public function up():string{
        $table = TableFactory::mysqli('balance');
        $table->addInt("id")->autoincrement();
        $table->addInt("source")->nullable(true);
        $table->addInt("destination");
        $table->addVarchar("type");
        $table->addDecimal("amount");
        $table->addDatetime("date")->defaultValue("CURRENT_TIMESTAMP");

        $table->primaryKey("id");
        // $table->foreignKey("source","account","id");
        // $table->foreignKey("destination","account","id");
         
        $table->create();
        return "balance table created";
    }
    public function down():string{
        return "teste migracao";
    }
    public function getDatetime():string{
        return "2024-04-02 15:10:00";
    }
}
