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
        "id", "name", "nome_completo", "email", "telefone", "password", "lembrete_senha", "id_group","cod_estabel","cod_rep","cod_at","cod_fornecedor", "ativo", "dt_expira_senha", "qt_dias_senha", "hash","session_id","perc_desc_max","qtd_dias_prazo_medio_max","gerente","comprador","vlr_max_ped","vlr_max_mes"
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
    public function getComprador(){
        $this->query()->where("comprador","=",1);
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
    public function getAtivos():array{
        $this->query()->where('ativo','=',1);
        return $this->result();
    }
    public function getByHash(string $hash): self
    {
        $this->queryFactory->where('hash', '=', $hash);
        return $this->get();
    }
    public function getEmailByCodAt($cod_at){
        $this->query()->where("cod_at",'=',$cod_at)->limit(1);
        return $this->get()->email;
    }
    public function getById(int $id): self
    {
        $this->queryFactory->where('id', '=', $id);
        return $this->get();
    }
    public function getByIdAtivo(int $id): self
    {
        $this->queryFactory->where('id', '=', $id)->where('ativo','=',1);
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
    public function getUserRepres(string $cod_rep):self{
        $this->query()->clearSelect();
        $this->query()->select(['id', 'name', 'email']);
        $this->query()->where('cod_rep', '=', $cod_rep)->orderBy('id', 'DESC')->limit(1);
        return $this->get();
    }
    public function getSuborinadosBySector(int $idSector):self{ 
        $setor = new Select;
        $setor->select(['subordinate_id'])->from('sector_subordinates')->where('responsible_sector_id','=',$idSector);

        $this->query()->joinSelect($setor,'users.id = subordinate_id');
        return $this;
    }
    public function getGerente(int $id):array{
        $model = clone $this;
        $model->query()->clearSelect();
        $model->query()->select(['id','name']);
        $this->queryFactory->where('id', '=', $id);
        return $this->result();
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
    public function getEstabel():array{
        return json_decode($this->cod_estabel);
    }
    public function getEstabelByUser(int $id)  {
        $this->query()->clearSelect();
        $this->query()->select(['cod_estabel'])->from('users')->where('id', '=', $id);
        $array = substr($this->queryFactory->get()->row()->cod_estabel, 1);
        $array = substr($array, 0,-1);
        $estabel = json_decode($array);
        return $estabel;
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
    public function setDtExpira(int $nDias = 0):self
    {
        $this->dt_expira_senha = date('Y-m-d', strtotime('+' . $nDias . ' days'));
        return $this;
    }

    public function setId(int $id):self{
        $this->id = $id;
        return $this;
    }

    public function setAtivo(string $ativo = 'Sim'):self
    {
        $this->ativo = $ativo == 'Sim' ? 1 : 0;
        return $this;
    }
    public function setEstabel(array $cod_estabel){
        $this->cod_estabel = json_encode($cod_estabel);
        return $this->cod_estabel;
    }

    public function formatDatas(Request $request){
        $this->setPassword($request->post('password'));
        $this->setDtExpira((int) $request->post('qt_dias_senha'));
        $this->setAtivo($request->post('ativo'));
        if ($request->post('cod_estabel')){
            $this->setEstabel($request->post('cod_estabel'));
        }
        if (!$request->post("comprador") && !$request->post("gerente")){
            $this->vlr_max_ped = 0;
            $this->vlr_max_mes = 0;
        }
    }
    public function formatUpdate(Request $request, $oldUser){
        // unset($data['departamento_subordinado']);
        $email = $this->email;
        $name = $this->name;
        $this->setValues($request->posts());
        if (!$request->post("cod_at")){
            $this->cod_at = 0;
        }
        if (!$request->post("cod_fornecedor")){
            $this->cod_fornecedor = 0;
        }
        if (!$request->post("cod_rep")){
            $this->cod_rep = 0;
        }
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
        if ($request->post('cod_estabel')){
            $this->setEstabel($request->post('cod_estabel'));
        }
        if (!$request->post("comprador") && !$request->post("gerente")){
            $this->vlr_max_ped = 0;
            $this->vlr_max_mes = 0;
        }
        $request->post('qt_dias_senha') ? $this->setDtExpira((int) $request->post('qt_dias_senha')): null;
        $request->post('ativo') ? $this->setAtivo($request->post('ativo')): null;       
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
        $validation->addValidation('lembrete_senha', Required::instance($required));
        $validation->addValidation('qt_dias_senha', Required::instance($required));
        $validation->addValidation('nome_completo', Required::instance($required));
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
        $validation->addValidation('lembrete_senha', Required::instance($required));
        $validation->addValidation('qt_dias_senha', Required::instance($required));
        $validation->addValidation('nome_completo', Required::instance($required));
        $validation->validate($this);
    }
}
