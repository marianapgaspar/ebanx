<?php
namespace System\DataBase\Entities;

class Select extends Conditionals{
    protected $select = [];
    protected $joins = [];
    protected $orderBys = [];
    protected $groupBys = [];
    protected $havings = [];
    protected $limit = null;
    protected $offset = null;
    protected $table = [];

    public function select(array $fields): self {
        set_time_limit(480);

        $this->select = array_merge($this->select, $fields);
        return $this;
    }

    public function join(string $table, string $condition, string $type = "INNER", string $name = ""): self {
        $this->joins[] = ["table" => $table, "condition" => $condition, "type" => $type, "name" => $name];
        return $this;
    }

    public function joinSelect(Select $select, string $condition, string $type = "INNER", string $name = ""): self {
        $this->joins[] = ["select" => $select, "condition" => $condition, "type" => $type, "name" => $name];
        return $this;
    }

    public function orderBy(string $field, string $direction = "ASC"): self {
        $this->orderBys[] = ["field" => $field, "direction" => $direction];
        return $this;
    }

    public function groupBy(string $field): self {
        $this->groupBys[] = $field;
        return $this;
    }

    public function having(string $field, string $operador, string $value, bool $quotes = true): self {
        $this->havings[] = ["field" => $field, "operador" => $operador, "value" => $value, "quotes" => $quotes, "type" => self::TYPE_AND];
        return $this;
    }

    public function orHaving(string $field, string $operador, string $value, bool $quotes = true): self {
        $this->havings[] = ["field" => $field, "operador" => $operador, "value" => $value, "quotes" => $quotes, "type" => self::TYPE_OR];
        return $this;
    }

    public function from(string $table, string $name = ""): self {
        $this->table = ["table" => $table, "name" => $name];
        return $this;
    }

    public function fromSelect(Select $select, string $name = ""): self {
        $this->table = ["select" => $select, "name" => $name];
        return $this;
    }

    public function limit(int $limit,int $offset = 0):self{
        $this->limit = $limit;
        $this->offset = $offset;
        return $this;
    }

    function getSelect() {
        return $this->select;
    }

    function getJoins() {
        return $this->joins;
    }

    function getOrderBys() {
        return $this->orderBys;
    }

    function getGroupBys() {
        return $this->groupBys;
    }

    function getHavings() {
        return $this->havings;
    }

    function getLimit() {
        return $this->limit;
    }

    function getOffset() {
        return $this->offset;
    }

    function getTable():array {
        return $this->table;
    }

    public function clear(): self {
        $this->wheres = [];
        $this->select = [];
        $this->joins = [];
        $this->orderBys = [];
        $this->groupBys = [];
        $this->havings = [];
        $this->limit = null;
        $this->offset = null;
        $this->table = "";
        return $this;
    }
    public function clearSelect():self{
        $this->select = [];
        return $this;
    }

}