<?php
namespace App\Users\Migration;
use System\Migration\Interfaces\IMigration;
use System\DataBase\TableFactory;

class CreateUserLogTable implements IMigration{
    public function up():string{
        $table = TableFactory::mysqli('user_log');
        $table->addInt("codigo");
        $table->addDatetime("dt_emis");
        $table->addVarchar("nome_user")->size("12")->nullable(true);
        $table->addVarchar("assunto")->size("50")->nullable(true);
        $table->addVarchar("narrativa")->size("100")->nullable(true);

         
        $table->create();
        return "user_log table created";
    }
    public function down():string{
        return "teste migracao";
    }
    public function getDatetime():string{
        return "2021-01-20 07:00:00";
    }
}
