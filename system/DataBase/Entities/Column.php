<?php
namespace System\DataBase\Entities;
class Column{
    private $type;
    private string|int $size = 0;
    private $null = false;
    private $defaultValue = null;
    private $name;
    private $autoincrement = false;

    public function __construct(string $name, string $type) {
        $this->name = $name;
        $this->type = $type;
    }
    function getType() {
        return $this->type;
    }

    function getSize():string|int {
        return $this->size;
    }

    function getNull() {
        return $this->null;
    }

    function getDefaultValue() {
        return $this->defaultValue;
    }

    function size(string|int $size): self {
        $this->size = $size;
        return $this;
    }

    function nullable(bool $null): self {
        $this->null = $null;
        return $this;
    }

    function defaultValue(string $defaultValue): self {
        $this->defaultValue = $defaultValue;
        return $this;
    }
    function getName() {
        return $this->name;
    }
    function getAutoincrement() {
        return $this->autoincrement;
    }

    function autoincrement(bool $autoincrement = true):self {
        $this->autoincrement = $autoincrement;
        return $this;
    }
}
