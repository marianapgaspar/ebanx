<?php
namespace App\Layout\Routes;

use App\Layout\Web\Teste;
use System\Server\Interfaces\IRoutes;
use System\Server\Routes;

class Web implements IRoutes{

    public function load(Routes $routes){
        $routes->get("teste/{nome}",Teste::class,'teste');
    }
}