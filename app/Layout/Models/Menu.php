<?php

namespace App\Layout\Models;

use System\Models\AModel;

class Menu extends AModel{
    protected array $fields = ['name','icon','url','scope'];
    private array $children = [];

    public function addChild(Menu $menu = null):Menu{
        if($menu === null){
            $menu = new Menu();
        }
        $this->children[] = $menu;
        return $menu;
    }

    public function getChildren():array{
        return $this->children;
    }
}