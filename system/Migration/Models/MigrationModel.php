<?php
namespace System\Migration\Models;

use System\Models\TableModel;

class MigrationModel extends TableModel{
    protected string $table = 'migration';
    protected array $fields = ['id','file','hash','insert_at'];
    protected array $primaryKeys = ['id'];
    public function getByFile($file){
        $this->query()->where("file","=",$file);
        return $this->get();
    }
}