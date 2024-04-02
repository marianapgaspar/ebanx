<?php

namespace System\Server\Entities;

use App\Users\Rules\Scopes;

class Auth{

    private array $scopes = [];

    private string $name = "";

    private int $id = 0;
    private string $avatar = "";

    public function setId(int $id):self{
        $this->id = $id;
        return $this;
    }

    public function setName(string $name):self{
        $this->name = $name;
        return $this;
    }

    public function setScopes(array $scopes):self{
        $this->scopes = $scopes;
        return $this;
    }
    public function setAvatar(string $avatar){
        $this->avatar = $avatar;
    }
    public function getId():int{
        return $this->id;
    }

    public function getName():string{
        return $this->name;
    }

    public function getScopes():array{
        return $this->scopes;
    }

    public function getAvatar():string{
        return $this->avatar;
    }
    public function hasScope(string $scope):bool{
        if(!$this->scopes) {
            return false;
        }
        return in_array($scope,(array) $this->scopes) || $this->scopes[0] == '*';
    }
}