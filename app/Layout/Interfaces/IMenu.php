<?php
namespace App\Layout\Interfaces;

use App\Layout\Rules\Dashboard\Menu;

interface IMenu{

    public function load(Menu $menu);
}