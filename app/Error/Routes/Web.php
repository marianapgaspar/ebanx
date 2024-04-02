<?php
namespace App\Error\Routes;

use App\Error\Web\Errors;
use System\Server\Interfaces\IRoutes;
use System\Server\Routes;

class Web implements IRoutes{
    public function load(Routes $routes)
    {
        $routes->get('/not-found',Errors::class,'notFound');
        $routes->get('/server-error',Errors::class,'serverError');
        $routes->get('/no-authentication',Errors::class,'noAuthentication');
        $routes->get('/permission-denied',Errors::class,'permissionDenied');
        $routes->get('/under-construction',Errors::class,'construction');

    }
}