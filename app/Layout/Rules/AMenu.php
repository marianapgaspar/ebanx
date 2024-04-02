<?php

namespace App\Layout\Rules;

use App\Layout\Models\Menu;

abstract class AMenu{
    protected array $menus = [];

    public function addMenu(Menu $menu = null):Menu{
        if($menu === null){
            $menu = new Menu();
        }
        $this->menus[] = $menu;
        return $menu;
    }

    public function getMenus():array{
        return $this->menus;
    }
}