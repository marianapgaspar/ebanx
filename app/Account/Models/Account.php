<?php
namespace App\Account\Models;

use System\Models\TableModel;

class Account extends TableModel{
    protected string $table = "account";
    protected array $fields = ["id","amount"];
    protected array $primaryKeys = ["id"];

    public function getById($id){
        $this->query()->where('id', '=', $id);
        return $this->get();
    }
}