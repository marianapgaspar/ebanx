<?php

namespace App\Users\Models;

use App\CRM\Models\CrmParam;
use App\Email\Models\EmailConfig;
use App\Users\Rules\Scopes;
use Svg\Tag\Rect;
use System\DataBase\Entities\Conditionals;
use System\DataBase\Entities\Select;
use System\Models\TableModel;
use System\Models\Validation;
use System\Models\Validations\Min;
use System\Models\Validations\Required;
use System\Models\Validations\Unique;
use System\Server\Entities\Request;
use System\Tools\File;

class Users extends TableModel
{
    protected string $table = "users";
    protected array $fields = [
        "id", "name", "email","password"
    ];
    protected array $primaryKeys = ["id"];
    protected array $protectedFields = ["password"];

    public function getByName(string $name): self
    {
        $this->queryFactory->where('name', '=', $name);
        return $this->get();
    }
    public function getByLikeName(string $name): self
    {
        $this->queryFactory->like('name', $name);
        return $this->get();
    }
    
    public function getIdGroup(int $id): array
    {
        $this->queryFactory->where('id_group', '=', $id)->where('ativo','=',1);
        return $this->result();
    }
    public function getLast(): int
    {
        $model = clone $this;
        $model->query()->orderBy('id', 'desc');
        $data =  $model->get();
        return $data->id;
    }
    public function getScope(string $scope):array{
        $this->query()->clearSelect();
        $this->query()->select(['users.*'])->where('ativo', '=', 1);
        $this->query()->join("users_groups", "id_group = users_groups.id");
        $this->query()->like('scope',"%$scope%");
        return $this->result();
    }
    public function getScopes(int $id):string{
        $this->query()->clearSelect();
        $this->query()->select(['scope', 'id AS id_user'])->where('ativo', '=', 1)->where('users.id', '=', $id);
        $select = new Select;
        $select->select(['id AS id_join', 'scope' ])->from('users_groups');
        $this->query()->joinSelect($select, 'users.id_group = id_join');
        return $this->get()->scope;
    }
    public function getByEmail(string $email): self
    {
        $this->queryFactory->where('email', '=', $email);
        return $this->get();
    }
    public function getByHash(string $hash): self
    {
        $this->queryFactory->where('hash', '=', $hash);
        return $this->get();
    }
    public function getById(int $id): self
    {
        $this->queryFactory->where('id', '=', $id);
        return $this->get();
    }
    public function getArrayById(int $id): array
    {
        $this->queryFactory->where('id', '=', $id);
        $array = [];
        $params = [];
        foreach ($this->result() as $row){
            $array[] = $row->toArray();
        }
        foreach ($array as $row){
            foreach ($row as $key=>$value){
                $params[$key] = $value;
            }
        }
        return $params;
    }
    
    public function getByIdResult(int $id): array
    {
        $this->queryFactory->where('id', '=', $id);
        return $this->result();
    }
    public function getSuborinados(int $idGerente):array{ 
        $this->query()->clearSelect();
        $this->query()->select(['id', 'name']);

        $responsavel = new Select;
        $responsavel->select(['id'])->from('sector_responsible')->where('responsible_id','=',$idGerente);

        $subordinados = new Select;
        $subordinados->select(['subordinate_id'])->from('sector_subordinates');
        $subordinados->joinSelect($responsavel,'sector_subordinates.responsible_sector_id= id')->groupBy('subordinate_id');

        $this->query()->joinSelect($subordinados,'users.id = subordinate_id');
        return $this->result();
    }
    public function getGerenteSetor():self{ 
        $this->query()->clearSelect();
        $this->query()->select(['id', 'name', 'email']);

        $responsavel = new Select;
        $responsavel->select(['id as id_setor', 'responsible_id AS id_gerente'])->from('sector_responsible');
        $subordinado = new Select;
        $subordinado->select(['responsible_sector_id', 'subordinate_id'])->from('sector_subordinates');
        $subordinado->joinSelect($responsavel, 'id_setor = responsible_sector_id')->where('subordinate_id', '=', $this->id);

        $this->query()->joinSelect($subordinado, 'responsible_sector_id = id');
        return $this->get();
    }
    public function addSectorResponsable($sectors){
        $deletar = array_diff_key(SectorResponsible::instance()->getByResponsibleResult($this->id),$sectors);
        foreach($deletar as $delete){
            SectorResponsible::instance()->query()->where('responsible_id','=',$this->id)->where('sector_id', '=', $delete->sector_id)->delete(['sector_responsible']);
        }
        foreach($sectors as $sector){
            if (!SectorResponsible::instance()->getByResponsibleSector($this->id, $sector)->id){
                $sectorResponsible  = SectorResponsible::instance();
                $sectorResponsible->sector_id = $sector;
                $sectorResponsible->responsible_id = $this->id;
                $sectorResponsible->insert();
            }
        }
        
    }

    public function addSectorSubordinate($sector){
        SectorSubordinates::instance()->query()->where('subordinate_id','=',$this->id)->delete(['sector_subordinates']);
            $sectorResponsible  = SectorSubordinates::instance();
            $sectorResponsible->responsible_sector_id = $sector;
            $sectorResponsible->subordinate_id = $this->id;
            $sectorResponsible->insert();
    }


    public function getGroup(): UsersGroups
    {
        return UsersGroups::instance()->getById($this->id_group);
    }
    public function validatePassword(string $password): bool
    {
        return security()->verify($this->getProtectedValue('password'), $password);
    }
    public function setPassword(string $password): self
    {
        if(strlen($password)>0){
            $this->password = security()->encrypt($password);
        }else{
            $this->password = $this->password;
        }
        
        return $this;
    }
    public function formatDatas(Request $request){
        $this->setPassword($request->post('password'));
    }
    public function formatUpdate(Request $request, $oldUser){
        $email = $this->email;
        $name = $this->name;
        $this->setValues($request->posts());
       
        if ($request->post('password') && $this->password != $this->password_repeat) {
            response()->json(['message'=>'Favor repetir a senha corretamente'], 422);  
        }
        if (!$request->getAuth()->hasScope(Scopes::USERS)){
            $this->id_group = $oldUser->id_group;
            $this->ativo = $oldUser->ativo;
        }
        $this->setPassword($request->post('password'));
        if (!$this->password){
            $this->password = $oldUser->password;
        }
       
        if ($request->post('email') && $email != $request->post('email')){
            if (Users::instance()->getByEmail($request->post('email'))->id) {
                response()->json(['message'=>'Já existe usuario com esse email '], 422); 
            }
        }if ($request->post('name')){
            if ($name != $request->post('name')){
                if (Users::instance()->getByName($request->post('name'))->id) {
                    response()->json(['message'=>'Já existe usuario com esse nome '], 422); 
                }
            }
        }
    }
    /**
     * Validacao do formulario
     *
     * @return void
     */
    public function validateSave()
    {
        $validation = new Validation();
        $required = 'Campo Obrigatório';
        $validation->addValidation('name', Unique::instance('Ja existe esse nome cadastrado'));
        $validation->addValidation('email', Unique::instance('Ja existe esse email cadastrado'));
        $validation->addValidation('name', Required::instance($required));
        $validation->addValidation('email', Required::instance($required));
        $validation->addValidation('id_group', Required::instance($required));
        $validation->addValidation('password', Required::instance($required));
        $validation->addValidation('password_repeat', Required::instance($required));
        $validation->validate($this);
    }
    public function validateUpdate()
    {
        $validation = new Validation();
        $required = 'Campo Obrigatório';
        $validation->addValidation('name', Required::instance($required));
        $validation->addValidation('email', Required::instance($required));
        $validation->addValidation('id_group', Required::instance($required));
        $validation->validate($this);
    }
}
