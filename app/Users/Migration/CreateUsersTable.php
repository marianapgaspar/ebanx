<?php
namespace App\Users\Migration;
use System\Migration\Interfaces\IMigration;
use System\DataBase\TableFactory;

class CreateUsersTable implements IMigration{
    public function up():string{
        $table = TableFactory::mysqli('users');
        $table->addInt("id")->autoincrement();
        $table->addVarchar("name")->size("12");
        $table->addVarchar("nome_completo")->size("50");
        $table->addVarchar("email")->size("40");
        $table->addVarchar("telefone")->size("20")->nullable(true);
        $table->addVarchar("password")->size("128");
        $table->addVarchar("lembrete_senha")->size("255");
        $table->addInt("id_group");
        $table->addVarchar("cod_estabel")->size("200")->nullable(true);
        $table->addInt("cod_rep")->nullable(true);
        $table->addInt("cod_at")->nullable(true);
        $table->addInt("cod_fornecedor")->nullable(true);
        $table->addInt("ativo")->nullable(true);
        $table->addDate("dt_expira_senha");
        $table->addInt("qt_dias_senha");
        $table->addVarchar("hash")->size("44")->nullable(true);
        $table->addVarchar("session_id")->size("45")->nullable(true);
        $table->addDecimal("perc_desc_max")->size("8,5")->nullable(true);
        $table->addInt("qtd_dias_prazo_medio_max")->size("3")->nullable(true);
        $table->addInt("gerente")->nullable(true);
        $table->addInt("comprador")->nullable(true);
        $table->addDecimal("vlr_max_ped")->size("11,2")->nullable(true);
        $table->addDecimal("vlr_max_mes")->size("11,2")->nullable(true);

        $table->primaryKey("id");
        // $table->foreignKey('id_group','users_groups','id');
        $table->uniqueKey('email');
         
        $table->create();
        return "users table created";
    }
    public function down():string{
        return "teste migracao";
    }
    public function getDatetime():string{
        return "2021-01-19 07:00:00";
    }
}
