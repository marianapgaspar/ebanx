<?php
namespace App\Trigger\Routes;
use App\Trigger\Web\Triggers;
use App\Users\Rules\Scopes;
use System\Server\Interfaces\IRoutes;
use System\Server\Routes;

class Web implements IRoutes{
    public function load(Routes $routes)
    {
        $routes->get('/list',Triggers::class,'table', Scopes::DESENVOLVEDORES);
        $routes->get('/add',Triggers::class,'formAdd', Scopes::DESENVOLVEDORES);
        $routes->post('/add',Triggers::class,'add', Scopes::DESENVOLVEDORES);
        $routes->get('/update/{id}',Triggers::class,'formUpdate', Scopes::DESENVOLVEDORES);
        $routes->post('/update/{id}',Triggers::class,'update', Scopes::DESENVOLVEDORES);        
    }
}