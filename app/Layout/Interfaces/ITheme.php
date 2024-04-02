<?php
namespace App\Layout\Interfaces;

use App\Layout\Rules\Dashboard\Menu;

interface ITheme{
    public function html():string;
}