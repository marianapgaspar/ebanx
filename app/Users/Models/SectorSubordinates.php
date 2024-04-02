<?php
namespace App\Users\Models;

use System\Models\TableModel;

class SectorSubordinates extends TableModel{
    protected string $table = "sector_subordinates";
    protected array $fields = ["responsible_sector_id","subordinate_id"];
    protected array $primaryKeys = ["responsible_sector_id","subordinate_id"];
   
    public function getBySubordinate(int $id): self
    {
        $this->queryFactory->where('subordinate_id', '=', $id);
        return $this->get();
    }
    public function getByResponsibleResult(int $id): array
    {
        $this->queryFactory->where('responsible_sector_id', '=', $id);
        return $this->result();
    }
    public function getDpto(int $subordinate):self {
        $this->query()->clearSelect();
        $this->query()->select(['*']);
        $this->query()->where("subordinate_id","=",$subordinate);
        $this->query()->join("sector_responsible"," sector_subordinates.responsible_sector_id = sector_responsible.id");
        return $this->get();
    }
}