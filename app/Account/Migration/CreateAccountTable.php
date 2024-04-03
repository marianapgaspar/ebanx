<?php
namespace App\Account\Migration;
use System\Migration\Interfaces\IMigration;
use System\DataBase\TableFactory;

class CreateAccountTable implements IMigration{
    public function up():string{
        $table = TableFactory::mysqli('account');
        $table->addInt("id")->autoincrement();
        $table->addDecimal("amount")->nullable(true);

        $table->primaryKey("id");
         
        $table->create();

        return "account table created";
    } 
    public function down():string{
        return "teste migracao";
    }
    public function getDatetime():string{
        return "2024-04-02 15:00:00";
    }
}
