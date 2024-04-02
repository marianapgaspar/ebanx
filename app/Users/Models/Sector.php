<?php
namespace App\Users\Models;

use System\Models\TableModel;

class Sector extends TableModel{
    protected string $table = "sector";
    protected array $fields = ["id","name"];
    protected array $primaryKeys = ["id"];
    public function getById(int $id): self
    {
        $this->queryFactory->where('id', '=', $id);
        return $this->get();
    }

}