<?php
namespace App\Users\Migration;

use App\Users\Models\Users;
use System\Migration\Interfaces\IMigration;

class PopulateUsers implements IMigration{
    public function up():string{
        $users = Users::instance()->getByEmail('marianapachecogaspar@gmail.com');
        $users->id_group = 1;
        $users->email = 'marianapachecogaspar@gmail.com';
        $users->name = 'mariana';
        $users->password = security()->encrypt('tng@123');
        $users->cod_rep = 0;
        $users->nome_completo = "Mariana Pacheco";
        $users->codigo_tab_comis = 0;
        $users->perc_max_desc = 0;
        $users->ativo = 1;
        $users->dt_expira_senha = '2024-01-01';
        $users->lembrete_senha = 'Padrão';
        $users->qt_dias_senha = '90';
        $users->avatar = '';
        if ($users->id){
            $users->save();
        } else {
            $users->insert();
        }

        $users = Users::instance()->getByEmail('luiz.gaspar@tngtec.com.br');
        $users->id_group = 1;
        $users->email = 'luiz.gaspar@tngtec.com.br';
        $users->name = 'gaspar';
        $users->password = security()->encrypt('tng@123');
        $users->cod_rep = 0;
        $users->nome_completo = "Luiz Gaspar";
        $users->codigo_tab_comis = 0;
        $users->perc_max_desc = 0;
        $users->ativo = 1;
        $users->dt_expira_senha = '2024-01-01';
        $users->lembrete_senha = 'Padrão';
        $users->qt_dias_senha = '90';
        $users->avatar = '';
        if ($users->id){
            $users->save();
        } else {
            $users->insert();
        }

        $users = Users::instance()->getByEmail('paularossini@gmail.com');
        $users->id_group = 1;
        $users->email = 'paularossini@gmail.com';
        $users->name = 'paula';
        $users->password = security()->encrypt('tng@123');
        $users->cod_rep = 0;
        $users->nome_completo = "Paula Rossini";
        $users->codigo_tab_comis = 0;
        $users->perc_max_desc = 0;
        $users->ativo = 1;
        $users->dt_expira_senha = '2024-01-01';
        $users->lembrete_senha = 'Padrão';
        $users->qt_dias_senha = '90';
        $users->avatar = '';
        if ($users->id){
            $users->save();
        } else {
            $users->insert();
        }
 
        return "usuario populado";
    }
    public function down():string{
        return "teste migracao";
    }
    public function getDatetime():string{
        return "2021-01-19 15:09:00";
    }
}