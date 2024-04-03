<?php
namespace App\Account\Routes;

use App\Account\Web\Balance;
use System\Server\Interfaces\IRoutes;
use System\Server\Routes;

class Web implements IRoutes{
    public function load(Routes $routes){
        $routes->post("reset",Balance::class,"reset");
        $routes->get("balance",Balance::class,"getBalance");
        $routes->post("event",Balance::class,"event");
       
    }    
}