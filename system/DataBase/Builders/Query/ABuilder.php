<?php declare(strict_types=1);
namespace System\DataBase\Builders\Query;

use System\DataBase\Entities\Select;

abstract class ABuilder{

    abstract function delete(Select $select, array $tables):string;

    abstract function insertSelect(Select $select, array $fields, string $table):string;

    abstract function replaceSelect(Select $select, array $fields, string $table):string;

    abstract function update(Select $select,array $values,bool $quotes = true):string;

    abstract function insert(string $table,array $values);

    abstract function select(Select $select):string;
}