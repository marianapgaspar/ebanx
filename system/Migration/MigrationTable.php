<?php
namespace System\Migration;

use System\DataBase\TableFactory;

class MigrationTable{
    protected string $table = 'migration';
    public function up(){
        $table = TableFactory::mysqli($this->table);
        $table->addInt("id")->autoincrement();
        $table->addVarchar('file')->size('128');
        $table->addVarchar('hash')->size('256');
        $table->addDatetime('insert_at');
        $table->primaryKey('id');
        $table->create();
    }
}