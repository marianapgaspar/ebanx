<?php

namespace App\Layout\Models;

use System\Models\AModel;

class Treetable extends AModel{
    protected array $fields = [];
    private array $children = [];

    public function addChild(Treetable $menu = null):Treetable{
        if($menu === null){
            $menu = new Treetable();
        }
        $this->children[] = $menu;
        return $menu;
    }

    public function getChildren():array{
        return $this->children;
    }
    public function addDados(array $dados){
        if (empty($dados)){
            return;
        }
        $this->fields = $dados;
    }
    public function getDados(){
        return $this->fields;
    }
}