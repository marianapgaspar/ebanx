<?php
namespace System\DataBase\Builders\Table;

use System\DataBase\Entities\Column;
use System\DataBase\Entities\Table;

abstract class ABuilder{
    abstract function create(Table $table):string;
    abstract function dropTable(Table $table):string;

    abstract function dropColumn(Table $table):string;
    abstract function addColumn(Table $table):string;

    abstract function modifyColumn(Table $table, Column $column,Column $newColumn);

    abstract function addColumnToTable(string $table,Column $column,string|null $after = null):string;
    abstract function updateColumnFromTable(string $table,Column $column,string|null $after = null):string;
    abstract function dropColumnFromTable(string $table,string $column):string;
}