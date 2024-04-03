<?php
namespace System\Server;

use System\Server\Entities\Auth;
use System\Server\Entities\Request;
use System\Server\Entities\Route;

class Controller{

    private Request $request;

    private string $uri;
    private string $verb;
    private Routes $routes;
    private Route $route;

    public function __construct(string $uri,string $verb)
    {
        $this->uri = trim($uri,'/');
        $this->verb = strtoupper($verb);
        $this->routes = new Routes();
        $this->prepareRequest();
        $this->prepareRoute();
        $this->authenticate();
    }
    private function prepareRequest(){
        $this->request = new Request();
        $uriSegments = explode('/',$this->uri);
        $module = ucfirst(reset($uriSegments));
        // unset($uriSegments[0]);
        $path = implode('/',$uriSegments);
        // $this->request->setCalledModule($module);
        $this->request->setCalledModule("Account");
        $this->request->setEndpoint($path);
        $this->request->setVerb($this->verb);
        $this->request->setPosts($_POST);
        $this->request->setGets($_GET);

    }

    private function authenticate(){
        $authentication = new Authentication(APP_AUTH);
        if(!$authentication->authenticate($this->route)){
            if ($authentication->underConstruction){
                exit(response()->redirect(url()->toRoute('Error/under-construction')));
            }
            exit(response()->redirect(url()->toRoute('Error/permission-denied')));
        }
        $this->request->setAuth($authentication->getAuth());
    }


    private function prepareRoute(){
        $this->route = $this->routes->load($this->request);
    }

    public function dispatch(){
        $classPath = $this->route->getController();
        $controlerInstance = new $classPath;
        call_user_func_array([$controlerInstance,$this->route->getMethod()],array_merge([$this->request],$this->route->getArgs()));
    }
}