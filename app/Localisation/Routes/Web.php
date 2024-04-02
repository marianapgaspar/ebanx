<?php
namespace App\Localisation\Routes;

use App\Localisation\Web\Localisation;
use System\Server\Interfaces\IRoutes;
use System\Server\Routes;

class Web implements IRoutes{
    public function load(Routes $routes){
        $routes->get('change/{code}',Localisation::class,'change');
    }
}