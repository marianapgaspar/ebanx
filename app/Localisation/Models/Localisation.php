<?php

namespace App\Localisation\Models;

use System\Models\TableModel;

class Localisation extends TableModel{
    protected string $table = "localisation";
    protected array $fields = ["id","code","active","image"];
    protected array $primaryKeys = ["id"];

    public function getActives():array{
        $this->queryFactory->where('active','=',1);
        return $this->result();
    }
    public function getByCode(string $code):self{
        $this->queryFactory->where('code','=',$code);
        return $this->get();
    }

}