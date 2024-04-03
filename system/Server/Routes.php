<?php
namespace System\Server;

use App\Error\Web\Errors;
use App\Migration\Models\Settings;
use System\Server\Entities\Route;
use System\Server\Entities\Request;

class Routes{
    private array $loadedRoutes = [];
    public function get(string $route, string $controller, string $method, string $scope = ""):self{
        $this->loadedRoutes['GET'][] = ['route'=>trim($route,'/'),'controller'=>$controller,'method'=>$method,'scope'=>$scope];
        return $this;
    }
    public function post(string $route, string $controller, string $method, string $scope = ""):self{
        $this->loadedRoutes['POST'][] = ['route'=>trim($route,'/'),'controller'=>$controller,'method'=>$method,'scope'=>$scope];
        return $this;
    }
    public function put(string $route, string $controller, string $method, string $scope = ""):self{
        $this->loadedRoutes['PUT'][] = ['route'=>trim($route,'/'),'controller'=>$controller,'method'=>$method,'scope'=>$scope];
        return $this;
    }
    

    public function load(Request $request){
        $this->loadedRoutes = [];
        $this->loadModule($request->getCalledModule());
        return $this->loadRoute($request);
    } 
    private function loadModule($module){
        $namespace = "App\\{$module}\Routes\Web";
        if(!class_exists($namespace)){
            return;
        }
        $instance = new $namespace;
        $instance->load($this);
    }
    private function loadRoute(Request $request){
        if(!$this->loadedRoutes){
            $routeObject =  new Route();
            $routeObject->setController(Errors::class);
            $routeObject->setMethod('notFound');
            return $routeObject;
        }
        foreach ((array)$this->loadedRoutes[$request->getVerb()] as $route) {
            $segments = explode("/", $request->getEndpoint());
            $routeFound = true;
            $uriVariables= [];
            $path = explode("/", $route['route']);
            foreach ($path as $index => $segment) {
                
                if (!isset($segments[$index])) {
                    $routeFound = false;
                    break;
                }
                if (strpos($segment, "{") !== false && strpos($segment, "}") !== false) {
                    $variableKey = str_replace(["{", "}"], "", $segment);
                    $uriVariables[$variableKey] = $segments[$index];
                    unset($segments[$index]);
                    continue;
                }
                if ($segments[$index] != $segment) {
                    $routeFound = false;
                    break;
                }
                unset($segments[$index]);
                
            }
            if(count($segments)){
                continue;
            }
            if ($routeFound) {
                
                $routeObject =  new Route();
                $routeObject->setArgs($uriVariables);
                $routeObject->setController($route['controller']);
                $routeObject->setMethod($route['method']);
                $routeObject->setScope($route['scope']);
                return $routeObject;
            }
        }
        $routeObject =  new Route();
        $routeObject->setController(Errors::class);
        $routeObject->setMethod('notFound');
        return $routeObject;
    }
}
