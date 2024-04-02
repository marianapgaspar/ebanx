<?php declare(strict_types=1);
namespace System\DataBase\Entities;

use stdClass;

class Result{
    private int $numRows;
    private array $data;

    public function __construct(int $numRows,array $data)
    {
        $this->numRows = $numRows;
        $this->data = $data;
    }

    public function getNumRows():int{
        return $this->numRows;
    }
    public function rows():array{
        return $this->data;
    }
    public function row():object{
        if(!$this->data){
            return new stdClass();
        }
        return reset($this->data);
    }

}