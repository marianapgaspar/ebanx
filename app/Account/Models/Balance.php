<?php
namespace App\Account\Models;

use System\Models\TableModel;

class Balance extends TableModel{
    protected string $table = "balance";
    protected array $fields = ["id","source","destination","type","amount","date"];
    protected array $primaryKeys = ["id"];

    public function getById($id){
        $this->query()->where('id', '=', $id);
        return $this->get();
    }
}