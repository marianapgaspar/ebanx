<?php
namespace App\Users\Models;

use System\Models\TableModel;
use System\Models\Validation;
use System\Models\Validations\Required;


class UsersGroups extends TableModel{
    protected string $table = "users_groups";
    protected array $fields = ["id","name","scope"];
    protected array $primaryKeys = ["id"];


    public function getById(int $id):self{
        $this->queryFactory->where('id','=',$id);
        return $this->get();
    }
    public function getByName(string $name):self{
        $this->queryFactory->where('name','=',$name);
        return $this->get();
    }
 
    public function prepareScopes(array $scopes){
        $this->scope = implode(' ',$scopes);
    }
    public function getGerentes():array{
        $this->query()->clearSelect();
        $this->queryFactory->select(['users.id','users.name']);
        $this->queryFactory->join("users","users_groups.id = users.id_group ")->like('scope','%user_manager_seller%');
        return $this->result();  
    }
    public function setName(string $name):self{
        $this->name = $name;
        return $this;
    }
    public function getLast(): int
    {
        $model = clone $this;
        $model->query()->orderBy('id', 'desc');
        $data =  $model->get();
        return $data->id;
    }

    public function getUsers():array{
        return Users::instance()->getIdGroup($this->id);
    }
    
    
    public function validate(){
        $validation = new Validation();
        $required = 'Campo Obrigatório';
        $validation->addValidation('name', Required::instance($required));
        $validation->validate($this);
    }

    
}