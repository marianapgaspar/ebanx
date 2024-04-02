<?php
namespace System\Server\Interfaces;

use System\Server\Routes;

interface IRoutes{
    public function load(Routes $routes);
}