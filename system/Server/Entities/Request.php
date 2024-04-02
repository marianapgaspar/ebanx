<?php
namespace System\Server\Entities;

class Request{
    private string $verb = "";
    private string $endpoint = "";
    private string $calledModule = "";

    private array $gets = [];
    private array $posts = [];
    private array $puts = [];

    private Auth $auth;


    public function setVerb(string $verb):self{
        $this->verb = $verb;
        return $this;
    }
    public function setEndpoint(string $endpoint):self{
        $this->endpoint = $endpoint;
        return $this;
    }
    public function setCalledModule(string $calledModule):self{
        $this->calledModule = $calledModule;
        return $this;
    }

    public function setGets(array $gets):self{
        $this->gets = $gets;
        return $this;
    }
    public function setPosts(array $posts):self{
        $this->posts = $posts;
        return $this;
    }

    public function getVerb():string{
        return $this->verb;
    }
    public function getEndpoint():string{
        return $this->endpoint;
    }
    public function getCalledModule():string{
        return $this->calledModule;
    }
    public function post(string $key){
        if(!isset($this->posts[$key])){
            return null;
        }
        return $this->posts[$key];
    }
    public function get(string $key){
        if(!isset($this->gets[$key])){
            return null;
        }
        return $this->gets[$key];
    }
    public function put(string $key){
        if(!isset($this->puts[$key])){
            return null;
        }
        return $this->puts[$key];
    }

    public function posts():array{
        return $this->posts;
    }
    public function puts():array{
        return $this->puts;
    }
    public function gets():array{
        return $this->gets;
    }

    public function getAuth():Auth{
        return $this->auth;
    }

    public function setAuth(Auth $auth):self{
        $this->auth = $auth;
        return $this;
    }

}