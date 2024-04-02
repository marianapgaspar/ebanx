<?php
namespace App\Users\Models;

use System\DataBase\Entities\Select;
use System\Models\TableModel;

class SectorResponsible extends TableModel{
    protected string $table = "sector_responsible";
    protected array $fields = ["id","name","responsible_id"];
    protected array $primaryKeys = ["id"];

    public function getById(int $id): self
    {
        $this->queryFactory->where('id', '=', $id);
        return $this->get();
    }
    public function getByName( $id): self
    {
        $this->queryFactory->where('name', '=', $id);
        return $this->get();
    }
    public function getByResponsible(int $id): self
    {
        $this->queryFactory->where('responsible_id', '=', $id);
        return $this->get();
    }
    public function getByResponsibleResult(int $id): array
    {
        $this->queryFactory->where('responsible_id', '=', $id);
        return $this->result();
    }
    public function getNameGerente():array{
        $this->query()->clearSelect()->select(['name_gerente','name']);
        $select = new Select;
        $select->select(['id AS id_user','name AS name_gerente'])->from("users");
        $this->query()->joinSelect($select,"responsible_id=id_user");
        return $this->result();
    }
    public function getByResponsibleSector(int $id, string $sector): self
    {
        $this->queryFactory->where('responsible_id', '=', $id)->where('name', '=', $sector);
        return $this->get();
    }

    public function getBySector(string $id): array
    {
        $this->queryFactory->where('name', '=', $id);
        return $this->result();
    }
    

    public function getLast(): int
    {
        $model = clone $this;
        $model->query()->orderBy('id', 'desc');
        $data =  $model->get();
        return $data->id;
    }
}