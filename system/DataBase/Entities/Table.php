<?php
namespace System\DataBase\Entities;

class Table{
    protected $columns = [];
    protected $indexes = [];
    protected $primaryKeys = [];
    protected $foreignKeys = [];
    protected $uniqueKeys = [];
    protected $name;
    
    public function __construct(string $name) {
        $this->name = $name;
    }

    public function addInt(string $name): Column {
        $int = new Column($name, "INT");
        $this->columns[] = $int;
        return $int;
    }

    public function addFloat(string $name): Column {
        $int = new Column($name, "FLOAT");
        $this->columns[] = $int;
        return $int;
    }
    public function addDouble(string $name): Column {
        $int = new Column($name, "DOUBLE");
        $this->columns[] = $int;
        return $int;
    }
    public function addDecimal(string $name): Column {
        $int = new Column($name, "DECIMAL");
        $this->columns[] = $int;
        return $int;
    }
    public function addChar(string $name): Column {
        $int = new Column($name, "CHAR");
        $this->columns[] = $int;
        return $int;
    }
    public function addEnum(string $name): Column {
        $enum = new Column($name, "ENUM");
        $this->columns[] = $enum;
        return $enum;
    }

    public function addVarchar(string $name): Column {
        $varchar = new Column($name, "VARCHAR");
        $varchar->size(255);
        $this->columns[] = $varchar;
        return $varchar;
    }

    public function addTinyint(string $name): Column {
        $tinyint = new Column($name, "TINYINT");
        $this->columns[] = $tinyint;
        return $tinyint;
    }

    public function addDate(string $name): Column {
        $date = new Column($name, "DATE");
        $this->columns[] = $date;
        return $date;
    }
    public function addTime(string $name): Column {
        $date = new Column($name, "TIME");
        $this->columns[] = $date;
        return $date;
    }

    public function addDatetime(string $name): Column {
        $datetime = new Column($name, "DATETIME");
        $this->columns[] = $datetime;
        return $datetime;
    }

    public function addText(string $name): Column {
        $text = new Column($name, "TEXT");
        $this->columns[] = $text;
        return $text;
    }

    public function addJson(string $name): Column {
        $text = new Column($name, "JSON");
        $this->columns[] = $text;
        return $text;
    }

    public function index(string $index): self {

        $this->indexes[] = $index;
        return $this;
    }

    public function primaryKey(string $primaryKey): self {
        $this->primaryKeys[] = $primaryKey;
        return $this;
    }

    public function foreignKey(string $column, string $refTable, string $key): self {
        $this->foreignKeys[] = ["column" => $column, "refTable" => $refTable, "key" => $key];
        return $this;
    }

    public function uniqueKey(string $uniqueKey): self {
        $this->uniqueKeys[] = $uniqueKey;
        return $this;
    }
    function getColumns() {
        return $this->columns;
    }

    function getIndexes() {
        return $this->indexes;
    }

    function getPrimaryKeys() {
        return $this->primaryKeys;
    }

    function getForeignKeys() {
        return $this->foreignKeys;
    }

    function getUniqueKeys() {
        return $this->uniqueKeys;
    }

    function getName() {
        return $this->name;
    }
}