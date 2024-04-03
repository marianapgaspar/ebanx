<?php
namespace App\Account\Migration;

use App\Account\Models\Account;
use System\Migration\Interfaces\IMigration;

class PopulateAccount implements IMigration{
    public function up():string{
        $account = Account::instance()->getById(300);
        if (!$account->id){
            $account->id = 300;
            $account->insert();
        }

        return "Populated account table";
    }
    public function down():string{
        return "teste migracao";
    }
    public function getDatetime():string{
        return "2024-04-02 15:07:00";
    }
}