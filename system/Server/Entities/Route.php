<?php

namespace System\Server\Entities;

class Route{
    private string $controller = "";
    private string $method = "";
    private string $scope = "";
    private array $args = [];

    public function setController(string $controller):self{
        $this->controller = $controller;
        return $this;
    }

    public function setMethod(string $method):self{
        $this->method = $method;
        return $this;
    }

    public function setScope(string $scope):self{
        $this->scope = $scope;
        return $this;
    }
    public function setArgs(array $args):self{
        $this->args = $args;
        return $this;
    }

    public function getController():string{
        return $this->controller;
    }

    public function getMethod():string{
        return $this->method;
    
    }

    public function getScope():string{
        return $this->scope;
    }
    public function getArgs():array{
        return $this->args;
    }
}