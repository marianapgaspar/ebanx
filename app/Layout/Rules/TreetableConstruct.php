<?php

namespace App\Layout\Rules;

use App\Layout\Models\Treetable;

class TreetableConstruct{
    protected array $treetables = [];

    public function addTreetable(Treetable $treetable = null):Treetable{
        if($treetable === null){
            $treetable = new Treetable();
        }
        $this->treetables[] = $treetable;
        return $treetable;
    }

    public function getTreetables():array{
        return $this->treetables;
    }
}